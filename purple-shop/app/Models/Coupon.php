<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    public function calculateDiscount($subtotal)
    {
        if ($this->type === 'percent') {
            return ($subtotal * ($this->value / 100));
        }

        return min($this->value, $subtotal); // Don't exceed subtotal
    }
}