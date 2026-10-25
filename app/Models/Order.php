<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Feedback;

#[Fillable([
    'customer_id',
    'order_number',
    'order_date',
    'total_amount',
    'status',
    'payment_proof',
    'discount_percentage',
    'discount_amount',
])]
class Order extends Model
{
    protected function casts(): array
    {
        return [
            'order_date' => 'datetime',
            'total_amount' => 'decimal:2',
            'discount_percentage' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            ];
    }

    /**
     * Order belongs to one Customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Order has many OrderItems.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function feedbacks(): HasMany
    {
    return $this->hasMany(Feedback::class);
    }
}
