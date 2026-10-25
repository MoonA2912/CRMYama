<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\MembershipService;

class OrderItemController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($validated['quantity'] > $product->stock) {
            return back()->withErrors([
                'quantity' => 'Jumlah produk melebihi stok yang tersedia.',
            ]);
        }

        $price = $product->price;
        $subtotal = $price * $validated['quantity'];

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'price' => $price,
            'subtotal' => $subtotal,
        ]);

        $product->decrement('stock', $validated['quantity']);

        $subtotal = $order->items()->sum('subtotal');

$discountPercentage = app(MembershipService::class)
    ->getDiscountPercentage($order->customer);

$discountAmount = $subtotal * ($discountPercentage / 100);

$totalAmount = $subtotal - $discountAmount;

$order->total_amount = $totalAmount;
$order->discount_percentage = $discountPercentage;
$order->discount_amount = $discountAmount;
$order->save();

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Produk berhasil ditambahkan ke pesanan.');
    }
}
