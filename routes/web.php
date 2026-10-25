<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomFittingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

    if (auth()->user()->role === 'admin') {

        // =========================
        // STATISTIK DASHBOARD ADMIN
        // =========================

        $totalCustomers = \App\Models\Customer::count();

        $totalProducts = \App\Models\Product::where('is_active', true)->count();

        $totalOrders = \App\Models\Order::count();

        $totalFeedback = \App\Models\Feedback::count();

        $totalSales = \App\Models\Order::where('status', 'completed')
    ->sum('total_amount');


        // =========================
        // ANALYTICAL CRM
        // PRODUK TERLARIS
        // =========================

        $bestSellingProducts = \App\Models\OrderItem::select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalProducts',
            'totalOrders',
            'totalFeedback',
            'totalSales',
            'bestSellingProducts'
        ));
    }

    // Customer langsung masuk ke katalog
    return redirect()->route('catalog');

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

     // ROUTE UNTUK CUSTOMER & ADMIN
    Route::get('/catalog', [ProductController::class, 'catalog'])
        ->name('catalog');
    Route::get('/catalog/{product}', [ProductController::class, 'customerShow'])
    ->name('catalog.show');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
    Route::patch('/cart/update/{cartKey}', [CartController::class, 'update'])
    ->name('cart.update');
    Route::delete('/cart/remove/{cartKey}', [CartController::class, 'remove'])
    ->name('cart.remove');
    Route::post('/checkout/prepare', [CartController::class, 'prepareCheckout'])
    ->name('checkout.prepare');
    Route::get('/checkout', [CartController::class, 'checkout'])
    ->name('checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])
    ->name('checkout.process');

    // PROFILE

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/my-orders', [OrderController::class, 'customerOrders'])
    ->name('customer.orders');

    Route::post('/my-orders/{order}/cancel', [OrderController::class, 'customerCancel'])
    ->name('customer.orders.cancel');

    Route::get('/my-orders/{order}', [OrderController::class, 'customerShow'])
    ->name('customer.orders.show');

    Route::get('/my-custom-fittings', [CustomFittingController::class, 'customerIndex'])
    ->name('customer.custom-fittings');

    Route::get('/my-custom-fittings/book', [CustomFittingController::class, 'customerCreate'])
    ->name('customer.custom-fittings.create');

    Route::post('/my-custom-fittings/book', [CustomFittingController::class, 'customerStore'])
    ->name('customer.custom-fittings.store');

    Route::patch('/custom-fittings/{customFitting}/confirm', [CustomFittingController::class, 'confirm'])
    ->name('custom-fittings.confirm');

    Route::get('/my-feedback', [FeedbackController::class, 'customerIndex'])
    ->name('customer.feedback');

    Route::get('/my-feedback/create', [FeedbackController::class, 'customerCreate'])
    ->name('customer.feedback.create');

    Route::post('/my-feedback', [FeedbackController::class, 'customerStore'])
    ->name('customer.feedback.store');
    // KHUSUS ADMIN

    Route::middleware('admin')->group(function () {

        Route::resource('customers', CustomerController::class);

        Route::resource('products', ProductController::class);

        Route::resource('orders', OrderController::class);

        Route::resource('custom-fittings', CustomFittingController::class);

        Route::resource('feedback', FeedbackController::class);

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

        Route::post('/orders/{order}/items', [OrderItemController::class, 'store'])
            ->name('orders.items.store');

    });

});


require __DIR__.'/auth.php';