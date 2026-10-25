<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'customer_id',
    'code',
    'type',
    'discount_percent',
    'minimum_purchase',
    'maximum_discount',
    'valid_from',
    'valid_until',
    'is_used',
    'used_at',
])]
class Voucher extends Model
{
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    protected function casts(): array
    {
        return [
            'discount_percent' => 'decimal:2',
            'minimum_purchase' => 'decimal:2',
            'maximum_discount' => 'decimal:2',
            'valid_from' => 'date',
            'valid_until' => 'date',
            'is_used' => 'boolean',
            'used_at' => 'datetime',
        ];
    }
}