<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'customer_id',
    'fitting_date',
    'booking_time',
    'fitting_type',
    'notes',
    'status',
    'height',
    'weight',
    'customer_needs',
    'fitting_result',
    'recommendation',
])]
class CustomFitting extends Model
{
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    protected function casts(): array
    {
        return [
            'fitting_date' => 'date',
        ];
    }
}