<?php

namespace App\Services;

use App\Models\Customer;

class MembershipService
{
    public function updateMembership(Customer $customer): void
    {
        $year = now()->year;

        $totalTransaction = $customer->orders()
            ->where('status', 'completed')
            ->whereYear('order_date', $year)
            ->sum('total_amount');

        if ($totalTransaction < 5000000) {
            $level = 'none';
        } elseif ($totalTransaction < 15000000) {
            $level = 'bronze';
        } elseif ($totalTransaction <= 40000000) {
            $level = 'silver';
        } else {
            $level = 'gold';
        }

        $customer->update([
            'membership_level' => $level,
        ]);
    }

    public function getDiscountPercentage(Customer $customer): float
    {
    return match ($customer->membership_level) {
        'bronze' => 5,
        'silver' => 10,
        'gold' => 15,
        default => 0,
    };
    }
}