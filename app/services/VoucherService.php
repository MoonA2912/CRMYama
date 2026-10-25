<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherService
{
    public function createBirthdayVoucher(Customer $customer): ?Voucher
    {
        if (!$customer->birth_date) {
            return null;
        }

        $today = Carbon::today();

        $birthDate = Carbon::parse($customer->birth_date);

        if ($birthDate->month !== $today->month) {
            return null;
        }

        $year = $today->year;

        $alreadyExists = Voucher::where('customer_id', $customer->id)
            ->where('type', 'birthday')
            ->whereYear('valid_from', $year)
            ->exists();

        if ($alreadyExists) {
            return null;
        }

        return Voucher::create([
            'customer_id' => $customer->id,
            'code' => 'BDAY-' . strtoupper(substr(md5(uniqid()), 0, 8)),
            'type' => 'birthday',
            'discount_percent' => 10,
            'minimum_purchase' => 0,
            'maximum_discount' => 100000,
            'valid_from' => $today,
            'valid_until' => $today->copy()->endOfMonth(),
            'is_used' => false,
        ]);
    }
}