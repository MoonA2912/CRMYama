<?php

namespace App\Http\Controllers;

use App\Exceptions\CloudinaryUploadException;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Voucher;
use App\Support\CloudinaryUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADD TO CART
    |--------------------------------------------------------------------------
    */

    public function add(
        Request $request,
        Product $product,
        CloudinaryUploader $cloudinaryUploader
    ) {
        if (! $product->is_active) {
            abort(404);
        }

        if ($product->stock <= 0) {
            return back()->with(
                'error',
                'Produk sedang habis.'
            );
        }

        $quantity = (int) $request->input('quantity', 1);

        if ($quantity < 1) {
            $quantity = 1;
        }

        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'Jumlah produk melebihi stok yang tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PRINTED GOLF BALLS
        |--------------------------------------------------------------------------
        */

        $printCustom =
            $product->category === 'Golf Ball'
            && $request->boolean('print_custom');

        $printPrice = $printCustom ? 5000 : 0;
        $designImage = null;

        if ($printCustom) {

            if (! $request->hasFile('design_image')) {
                return back()
                    ->with(
                        'error',
                        'Silakan upload gambar desain untuk custom print.'
                    )
                    ->withInput();
            }

            $request->validate([
                'design_image' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ], [
                'design_image.required' => 'Gambar desain wajib diupload.',

                'design_image.file' => 'File desain tidak valid.',

                'design_image.mimes' => 'Desain harus berupa JPG, JPEG, PNG, atau WEBP.',

                'design_image.max' => 'Ukuran desain maksimal 2 MB.',
            ]);

            try {
                $designImage = $cloudinaryUploader->upload(
                    $request->file('design_image')
                );
            } catch (CloudinaryUploadException $exception) {
                return back()
                    ->withErrors(['design_image' => $exception->getMessage()])
                    ->withInput();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CARI CART MILIK USER
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('print_custom', $printCustom)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | JIKA ITEM SUDAH ADA
        |--------------------------------------------------------------------------
        */

        if ($cartItem) {

            $newQuantity =
                $cartItem->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'Jumlah produk di keranjang melebihi stok yang tersedia.'
                );
            }

            $cartItem->quantity = $newQuantity;

            if ($designImage) {
                $cartItem->design_image = $designImage;
            }

            $cartItem->save();

        } else {

            /*
            |--------------------------------------------------------------------------
            | ITEM BARU
            |--------------------------------------------------------------------------
            */

            Cart::create([
                'user_id' => $user->id,

                'product_id' => $product->id,

                'quantity' => $quantity,

                'print_custom' => $printCustom,

                'print_price' => $printPrice,

                'design_image' => $designImage,
            ]);
        }

        return redirect()
            ->route(
                'catalog.show',
                $product
            )
            ->with(
                'success',
                '✓ Produk berhasil ditambahkan ke keranjang.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CART INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        $cartItems = $user->carts()
            ->with('product')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | UBAH DATA DATABASE MENJADI FORMAT YANG
        | SUDAH DIGUNAKAN OLEH CART BLADE
        |--------------------------------------------------------------------------
        */

        $cart = [];

        $total = 0;

        foreach ($cartItems as $item) {

            if (! $item->product) {
                continue;
            }

            $cartKey =
                $item->product_id.
                '_'.
                ($item->print_custom
                    ? 'print'
                    : 'normal');

            $productPrice =
                $item->product->price *
                $item->quantity;

            $printPrice =
                ($item->print_price ?? 0) *
                $item->quantity;

            $itemTotal =
                $productPrice +
                $printPrice;

            $total += $itemTotal;

            $cart[$cartKey] = [
                'cart_key' => $cartKey,

                'id' => $item->product_id,

                'name' => $item->product->name,

                'price' => $item->product->price,

                'image' => $item->product->image,

                'quantity' => $item->quantity,

                'print_custom' => $item->print_custom,

                'print_price' => $item->print_price,

                'design_image' => $item->design_image,

                'cart_id' => $item->id,
            ];
        }

        return view(
            'cart.index',
            compact(
                'cart',
                'total'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE QUANTITY
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        string $cartKey
    ) {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | AMBIL PRODUCT ID DARI CART KEY
        |--------------------------------------------------------------------------
        |
        | Contoh:
        | 7_normal
        | 7_print
        |
        */

        $parts = explode('_', $cartKey);

        $productId = $parts[0] ?? null;
        $variant = $parts[1] ?? 'normal';

        $printCustom =
            $variant === 'print';

        $cartItem = $user->carts()
            ->where('product_id', $productId)
            ->where('print_custom', $printCustom)
            ->first();

        if (! $cartItem) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Produk tidak ditemukan di keranjang.'
                );
        }

        $quantity =
            (int) $request->input('quantity');

        /*
        |--------------------------------------------------------------------------
        | JIKA QUANTITY 0 → HAPUS
        |--------------------------------------------------------------------------
        */

        if ($quantity < 1) {

            $cartItem->delete();

        } else {

            $product = Product::find(
                $cartItem->product_id
            );

            if (! $product) {

                $cartItem->delete();

                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        'Produk sudah tidak tersedia.'
                    );
            }

            if ($quantity > $product->stock) {

                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        'Jumlah melebihi stok yang tersedia.'
                    );
            }

            $cartItem->quantity =
                $quantity;

            $cartItem->save();
        }

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Keranjang berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | REMOVE ITEM
    |--------------------------------------------------------------------------
    */

    public function remove(string $cartKey)
    {
        $user = auth()->user();

        $parts = explode('_', $cartKey);

        $productId = $parts[0] ?? null;
        $variant = $parts[1] ?? 'normal';

        $printCustom =
            $variant === 'print';

        $cartItem = $user->carts()
            ->where('product_id', $productId)
            ->where('print_custom', $printCustom)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Produk berhasil dihapus dari keranjang.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | PREPARE CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function prepareCheckout(
        Request $request
    ) {
        $selectedItems =
            $request->input(
                'selected_items',
                []
            );

        if (empty($selectedItems)) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Silakan pilih minimal satu produk untuk checkout.'
                );
        }

        $user = auth()->user();

        $selectedCart = [];

        foreach ($selectedItems as $cartKey) {

            $parts =
                explode(
                    '_',
                    $cartKey
                );

            $productId =
                $parts[0] ?? null;

            $variant =
                $parts[1] ?? 'normal';

            $printCustom =
                $variant === 'print';

            $cartItem = $user->carts()
                ->with('product')
                ->where(
                    'product_id',
                    $productId
                )
                ->where(
                    'print_custom',
                    $printCustom
                )
                ->first();

            if ($cartItem && $cartItem->product) {

                $selectedCart[$cartKey] = [
                    'cart_key' => $cartKey,

                    'id' => $cartItem->product_id,

                    'name' => $cartItem->product->name,

                    'price' => $cartItem->product->price,

                    'image' => $cartItem->product->image,

                    'quantity' => $cartItem->quantity,

                    'print_custom' => $cartItem->print_custom,

                    'print_price' => $cartItem->print_price,

                    'design_image' => $cartItem->design_image,

                    'cart_id' => $cartItem->id,
                ];
            }
        }

        if (empty($selectedCart)) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Produk yang dipilih tidak ditemukan di keranjang.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN HANYA PILIHAN CHECKOUT SEMENTARA
        |--------------------------------------------------------------------------
        |
        | Cart utama tetap berada di database.
        | Session hanya menyimpan item mana yang sedang
        | diproses untuk checkout.
        |
        */

        session()->put(
            'checkout_cart',
            $selectedCart
        );

        return redirect()
            ->route('checkout');
    }

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT PAGE
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        $checkoutCart =
            session()->get(
                'checkout_cart',
                []
            );

        if (empty($checkoutCart)) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Silakan pilih produk yang ingin di-checkout terlebih dahulu.'
                );
        }

        $user = auth()->user();

        $customer =
            $user->customer;

        if (! $customer) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Data pelanggan belum tersedia. Silakan lengkapi profil terlebih dahulu.'
                );
        }

        $subtotal = 0;

        foreach ($checkoutCart as $item) {

            $productPrice =
                $item['price'] *
                $item['quantity'];

            $printPrice =
                ($item['print_price'] ?? 0) *
                $item['quantity'];

            $subtotal +=
                $productPrice +
                $printPrice;
        }

        $discountPercentage = match (
            $customer->membership_level
        ) {
            'bronze' => 5,
            'silver' => 10,
            'gold' => 15,
            default => 0,
        };

        $discountAmount =
            $subtotal *
            ($discountPercentage / 100);

        $total =
            $subtotal -
            $discountAmount;

        $birthdayVoucher = Voucher::where('customer_id', $customer->id)
            ->where('type', 'birthday')
            ->where('is_used', false)
            ->whereDate('valid_from', '<=', today())
            ->whereDate('valid_until', '>=', today())
            ->latest()
            ->first();

        return view(
            'checkout.index',
            compact(
                'checkoutCart',
                'customer',
                'subtotal',
                'discountPercentage',
                'discountAmount',
                'total',
                'birthdayVoucher'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function processCheckout(
        Request $request,
        CloudinaryUploader $cloudinaryUploader
    ) {
        $request->validate([
            'payment_proof' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:2048',
            ],
        ], [
            'payment_proof.required' => 'Bukti pembayaran wajib diupload.',

            'payment_proof.file' => 'File bukti pembayaran tidak valid.',

            'payment_proof.mimes' => 'Bukti pembayaran harus berupa JPG, JPEG, PNG, WEBP, atau PDF.',

            'payment_proof.max' => 'Ukuran bukti pembayaran maksimal 2 MB.',
        ]);

        $checkoutCart =
            session()->get(
                'checkout_cart',
                []
            );

        if (empty($checkoutCart)) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Silakan pilih produk yang ingin di-checkout terlebih dahulu.'
                );
        }

        $user = auth()->user();

        $customer =
            $user->customer;

        if (! $customer) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Data pelanggan belum tersedia.'
                );
        }

        try {
            $paymentProof = $cloudinaryUploader->upload(
                $request->file('payment_proof')
            );

            $order = DB::transaction(
                function () use (
                    $checkoutCart,
                    $customer,
                    $user,
                    $request
                ) {

                    $subtotal = 0;

                    /*
                    |--------------------------------------------------------------------------
                    | CEK CART DAN STOK
                    |--------------------------------------------------------------------------
                    */

                    $cartItems = [];

                    foreach (
                        $checkoutCart as $cartKey => $selectedItem
                    ) {

                        $cartItem =
                            $user->carts()
                                ->with('product')
                                ->where(
                                    'id',
                                    $selectedItem['cart_id']
                                )
                                ->lockForUpdate()
                                ->first();

                        if (
                            ! $cartItem ||
                            ! $cartItem->product
                        ) {
                            throw new \Exception(
                                'Produk yang dipilih sudah tidak tersedia di keranjang.'
                            );
                        }

                        $product =
                            Product::lockForUpdate()
                                ->find(
                                    $cartItem->product_id
                                );

                        if (
                            ! $product ||
                            ! $product->is_active
                        ) {
                            throw new \Exception(
                                'Produk '.
                                $selectedItem['name'].
                                ' sudah tidak tersedia.'
                            );
                        }

                        if (
                            $cartItem->quantity >
                            $product->stock
                        ) {
                            throw new \Exception(
                                'Stok produk '.
                                $product->name.
                                ' tidak mencukupi.'
                            );
                        }

                        $productPrice =
                            $product->price *
                            $cartItem->quantity;

                        $printPrice =
                            ($cartItem->print_price ?? 0) *
                            $cartItem->quantity;

                        $subtotal +=
                            $productPrice +
                            $printPrice;

                        $cartItems[] = [
                            'cart' => $cartItem,

                            'product' => $product,
                        ];
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | MEMBERSHIP DISCOUNT
                    |--------------------------------------------------------------------------
                    */

                    $discountPercentage = match (
                        $customer->membership_level
                    ) {
                        'bronze' => 5,
                        'silver' => 10,
                        'gold' => 15,
                        default => 0,
                    };

                    $membershipDiscountAmount =
                        $subtotal *
                        ($discountPercentage / 100);

                    $birthdayVoucher = null;

                    $birthdayVoucherDiscountAmount = 0;

                    if ($request->boolean('use_birthday_voucher')) {

                        $birthdayVoucher = Voucher::where('customer_id', $customer->id)
                            ->where('type', 'birthday')
                            ->where('is_used', false)
                            ->whereDate('valid_from', '<=', today())
                            ->whereDate('valid_until', '>=', today())
                            ->latest()
                            ->first();

                        if (! $birthdayVoucher) {

                            throw new \Exception(
                                'Birthday Voucher tidak tersedia atau sudah tidak berlaku.'
                            );
                        }

                        $afterMembershipDiscount =
                            $subtotal -
                            $membershipDiscountAmount;

                        if (
                            $afterMembershipDiscount <
                            $birthdayVoucher->minimum_purchase
                        ) {
                            throw new \Exception(
                                'Minimum pembelian untuk voucher belum terpenuhi.'
                            );
                        }

                        $calculatedBirthdayDiscount =
                        $afterMembershipDiscount *
                        ($birthdayVoucher->discount_percent / 100);

                        $birthdayVoucherDiscountAmount =
                            min(
                                $calculatedBirthdayDiscount,
                                $birthdayVoucher->maximum_discount
                            );
                    }

                    $discountAmount =
                        $membershipDiscountAmount +
                        $birthdayVoucherDiscountAmount;

                    $total =
                        $subtotal -
                        $discountAmount;

                    /*
                    |--------------------------------------------------------------------------
                    | CREATE ORDER
                    |--------------------------------------------------------------------------
                    */

                    $order =
                        Order::create([
                            'customer_id' => $customer->id,

                            'order_number' => 'ORD-'.
                                now()->format(
                                    'YmdHis'
                                ).
                                '-'.
                                random_int(
                                    100,
                                    999
                                ),

                            'order_date' => now(),

                            'total_amount' => $total,

                            'discount_percentage' => $discountPercentage,

                            'discount_amount' => $discountAmount,

                            'status' => 'pending',
                        ]);

                    /*
                    |--------------------------------------------------------------------------
                    | CREATE ORDER ITEMS
                    |--------------------------------------------------------------------------
                    */

                    foreach ($cartItems as $data) {

                        $cartItem =
                            $data['cart'];

                        $product =
                            $data['product'];

                        $printCustom =
                            $cartItem->print_custom;

                        $printPrice =
                            $printCustom
                                ? ($cartItem->print_price ?? 5000)
                                : 0;

                        $itemSubtotal =
                            (
                                $product->price +
                                $printPrice
                            ) *
                            $cartItem->quantity;

                        OrderItem::create([
                            'order_id' => $order->id,

                            'product_id' => $product->id,

                            'quantity' => $cartItem->quantity,

                            'price' => $product->price,

                            'subtotal' => $itemSubtotal,

                            'print_custom' => $printCustom,

                            'print_price' => $printPrice,

                            'design_image' => $cartItem->design_image,
                        ]);

                        /*
                        |--------------------------------------------------------------------------
                        | KURANGI STOK
                        |--------------------------------------------------------------------------
                        */

                        $product->decrement(
                            'stock',
                            $cartItem->quantity
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | HAPUS HANYA ITEM YANG CHECKOUT
                        |--------------------------------------------------------------------------
                        */

                        $cartItem->delete();
                    }

                    return $order;
                }
            );

            /*
            |--------------------------------------------------------------------------
            | PAYMENT PROOF
            |--------------------------------------------------------------------------
            */

            $order->update([
                'payment_proof' => $paymentProof,
            ]);

            if ($request->boolean('use_birthday_voucher')) {

                $birthdayVoucher = Voucher::where('customer_id', $customer->id)
                    ->where('type', 'birthday')
                    ->where('is_used', false)
                    ->whereDate('valid_from', '<=', today())
                    ->whereDate('valid_until', '>=', today())
                    ->latest()
                    ->first();

                if ($birthdayVoucher) {

                    $birthdayVoucher->update([
                        'is_used' => true,
                        'used_at' => now(),
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CLEAR CHECKOUT SESSION
            |--------------------------------------------------------------------------
            */

            session()->forget(
                'checkout_cart'
            );

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'customer.orders.show',
                    $order
                )
                ->with(
                    'success',
                    'Pesanan berhasil dibuat dan bukti pembayaran berhasil diupload.'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('checkout')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
}
