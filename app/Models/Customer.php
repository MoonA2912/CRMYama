<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CustomFitting;
use App\Models\Feedback;

#[Fillable(['user_id', 'name', 'phone', 'address', 'birth_date', 'membership_level'])]
class Customer extends Model
{
    /**
     * Customer belongs to one User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Customer has many Orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function customFittings(): HasMany
    {
    return $this->hasMany(CustomFitting::class);
    }
    public function feedbacks(): HasMany
    {
    return $this->hasMany(Feedback::class);
    }
    public function vouchers(): HasMany
{
    return $this->hasMany(Voucher::class);
}
protected function casts(): array
{
    return [
        'birth_date' => 'date',
    ];
}
}
