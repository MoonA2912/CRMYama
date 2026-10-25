<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Feedback;
use App\Models\CustomFitting;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);

        // =========================
        // RINGKASAN
        // =========================

        $totalCustomers = Customer::count();

        $totalOrders = Order::whereYear('order_date', $year)
            ->count();

        $completedOrders = Order::where('status', 'completed')
            ->whereYear('order_date', $year)
            ->count();

        $totalSales = Order::where('status', 'completed')
            ->whereYear('order_date', $year)
            ->sum('total_amount');

        // =========================
        // MEMBERSHIP
        // =========================

        $membership = Customer::selectRaw('membership_level, COUNT(*) as total')
            ->groupBy('membership_level')
            ->pluck('total', 'membership_level');
            $topMembership = $membership->sortDesc()->keys()->first();
            $topMembershipCount = $membership->sortDesc()->first() ?? 0;

        // =========================
        // PRODUK TERLARIS
        // =========================

        $bestSellingProducts = OrderItem::select(
                'product_id'
            )
            ->selectRaw('SUM(quantity) as total_quantity')
            ->whereHas('order', function ($query) use ($year) {
                $query->where('status', 'completed')
                    ->whereYear('order_date', $year);
            })
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();
        $topProduct = $bestSellingProducts->first();
            // =========================
// PENJUALAN BULANAN
// =========================

$monthlySales = Order::selectRaw('MONTH(order_date) as month, SUM(total_amount) as total')
    ->where('status', 'completed')
    ->whereYear('order_date', $year)
    ->groupByRaw('MONTH(order_date)')
    ->orderByRaw('MONTH(order_date)')
    ->pluck('total', 'month');


        // =========================
        // FEEDBACK
        // =========================

        $feedbackCount = Feedback::whereYear('created_at', $year)
            ->count();

        $averageRating = Feedback::whereYear('created_at', $year)
            ->avg('rating');

            $feedbackInsight = $feedbackCount > 0
    ? 'Rata-rata rating pelanggan tahun '.$year.' adalah '.number_format($averageRating, 1).' dari 5 berdasarkan '.$feedbackCount.' feedback.'
    : 'Belum tersedia feedback pelanggan pada tahun '.$year.'.';

        $ratingDistribution = Feedback::selectRaw('rating, COUNT(*) as total')
    ->whereYear('created_at', $year)
    ->groupBy('rating')
    ->orderBy('rating')
    ->pluck('total', 'rating');

        // =========================
        // CUSTOM FITTING
        // =========================

        $customFittingCount = CustomFitting::whereYear('fitting_date', $year)
            ->count();

        return view('reports.index', compact(
    'year',
    'totalCustomers',
    'totalOrders',
    'completedOrders',
    'totalSales',
    'membership',
    'topMembership',
    'topMembershipCount',
    'bestSellingProducts',
    'topProduct',
    'monthlySales',
    'feedbackCount',
    'averageRating',
    'feedbackInsight',
    'ratingDistribution',
    'customFittingCount'
));
    }
}