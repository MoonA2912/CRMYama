<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\MembershipService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
        ]);

        $validated['order_number'] = 'ORD-'.now()->format('YmdHis');
        $validated['total_amount'] = 0;

        $order = Order::create($validated);

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'items.product']);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customers = Customer::orderBy('name')->get();

        return view('orders.edit', compact('order', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'order_date' => 'required|date',
        'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
        'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
    ]);

    if ($request->hasFile('payment_proof')) {
        $validated['payment_proof'] = $request
            ->file('payment_proof')
            ->store('payment-proofs', 'public');
    }

    $order->update($validated);

    // Sinkronisasi membership berdasarkan seluruh
    // transaksi completed pada tahun berjalan.
    app(MembershipService::class)
        ->updateMembership($order->customer);

    return redirect()
        ->route('orders.show', $order)
        ->with('success', 'Pesanan berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
public function customerOrders()
{
    $customer = auth()->user()->customer;

    if (!$customer || blank($customer->phone)) {
        return redirect()
            ->route('profile.edit')
            ->with(
                'error',
                'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengakses Orders.'
            );
    }

    $orders = $customer->orders()
        ->with('items.product')
        ->latest('order_date')
        ->get();

    return view('customer-orders.index', compact('orders'));
}

public function customerShow(Order $order)
{
    $customer = auth()->user()->customer;

    if (!$customer || blank($customer->phone)) {
        return redirect()
            ->route('profile.edit')
            ->with(
                'error',
                'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengakses Orders.'
            );
    }

    // Pastikan pesanan milik pelanggan yang sedang login.
    if ((int) $order->customer_id !== (int) $customer->id) {
        abort(403);
    }

    $order->load([
        'items.product',
        'feedbacks',
    ]);

    return view('customer-orders.show', compact('order'));
}

public function customerCancel(Order $order)
{
    $customer = auth()->user()->customer;

    if (!$customer || blank($customer->phone)) {
        return redirect()
            ->route('profile.edit')
            ->with(
                'error',
                'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengakses Orders.'
            );
    }

    // Pelanggan hanya boleh membatalkan pesanan miliknya sendiri.
    if ((int) $order->customer_id !== (int) $customer->id) {
        abort(403);
    }

    // Hanya pesanan pending yang dapat dibatalkan.
    if ($order->status !== 'pending') {
        return back()->with(
            'error',
            'Pesanan hanya dapat dibatalkan saat status masih Pending.'
        );
    }

    $order->load('items');

    \Illuminate\Support\Facades\DB::transaction(
        function () use ($order) {
            foreach ($order->items as $item) {
                $product = \App\Models\Product::lockForUpdate()
                    ->find($item->product_id);

                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }

            $order->update([
                'status' => 'cancelled',
            ]);
        }
    );

    return redirect()
        ->route('customer.orders.show', $order)
        ->with('success', 'Pesanan berhasil dibatalkan.');
}
}
