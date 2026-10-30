<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['customer', 'order'])
            ->latest()
            ->get();

        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $orders = Order::with('customer')
            ->latest('order_date')
            ->get();

        return view('feedback.create', compact('customers', 'orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'nullable|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
            'status' => 'required|in:baru,dibaca,ditindaklanjuti',
            'response' => 'nullable|string',
        ]);

        Feedback::create($validated);

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Feedback berhasil ditambahkan.');
    }

    public function show(Feedback $feedback)
    {
        $feedback->load(['customer', 'order']);

        return view('feedback.show', compact('feedback'));
    }

    public function edit(Feedback $feedback)
    {
        $customers = Customer::orderBy('name')->get();
        $orders = Order::with('customer')
            ->latest('order_date')
            ->get();

        return view('feedback.edit', compact(
            'feedback',
            'customers',
            'orders'
        ));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'nullable|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
            'status' => 'required|in:baru,dibaca,ditindaklanjuti',
            'response' => 'nullable|string',
        ]);

        $feedback->update($validated);

        return redirect()
            ->route('feedback.show', $feedback)
            ->with('success', 'Feedback berhasil diperbarui.');
    }

public function customerIndex()
{
    $customer = auth()->user()->customer;

    if (!$customer || blank($customer->phone)) {
        return redirect()
            ->route('profile.edit')
            ->with(
                'error',
                'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengakses Feedback.'
            );
    }

    $feedbacks = $customer->feedbacks()
        ->with([
            'order.items.product',
        ])
        ->latest()
        ->get();

    return view('customer-feedback.index', compact('feedbacks'));
}

public function customerCreate(Request $request)
{
    $customer = auth()->user()->customer;

    if (!$customer || blank($customer->phone)) {
        return redirect()
            ->route('profile.edit')
            ->with(
                'error',
                'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengirim Feedback.'
            );
    }

    $order = null;

    if ($request->filled('order_id')) {
        $order = $customer->orders()
            ->where('id', $request->order_id)
            ->where('status', 'completed')
            ->first();

        if (!$order) {
            return redirect()
                ->route('customer.orders')
                ->with(
                    'error',
                    'Pesanan tidak ditemukan atau belum selesai.'
                );
        }
    }

    return view('customer-feedback.create', compact('order'));
}

public function customerStore(Request $request)
{
    $customer = auth()->user()->customer;

    if (!$customer || blank($customer->phone)) {
        return redirect()
            ->route('profile.edit')
            ->with(
                'error',
                'Silakan lengkapi profil Anda, terutama nomor telepon, sebelum mengirim Feedback.'
            );
    }

    $validated = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|integer|min:1|max:5',
        'message' => 'nullable|string',
    ], [
        'order_id.required' => 'Pesanan wajib dipilih.',
        'order_id.exists' => 'Pesanan tidak ditemukan.',
        'rating.required' => 'Rating wajib diisi.',
        'rating.min' => 'Rating minimal 1.',
        'rating.max' => 'Rating maksimal 5.',
    ]);

    // Pastikan pesanan milik pelanggan yang login
    // dan sudah berstatus completed.
    $order = $customer->orders()
        ->where('id', $validated['order_id'])
        ->where('status', 'completed')
        ->first();

    if (!$order) {
        return back()
            ->withErrors([
                'order_id' => 'Pesanan tidak valid atau belum selesai.',
            ])
            ->withInput();
    }

    // Satu feedback untuk setiap pesanan.
    $alreadyFeedback = $customer->feedbacks()
        ->where('order_id', $order->id)
        ->exists();

    if ($alreadyFeedback) {
        return redirect()
            ->route('customer.orders.show', $order)
            ->with('error', 'Pesanan ini sudah memiliki feedback.');
    }

    Feedback::create([
        'customer_id' => $customer->id,
        'order_id' => $order->id,
        'rating' => $validated['rating'],
        'message' => $validated['message'] ?? null,
        'status' => 'baru',
        'response' => null,
    ]);

    return redirect()
        ->route('customer.feedback')
        ->with(
            'success',
            'Feedback berhasil dikirim. Terima kasih atas masukan Anda.'
        );
}

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }
}