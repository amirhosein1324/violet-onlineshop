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
        'is_active',
    ];

    /**
     * Calculate discount amount for a given order total.
     */
    public function calculateDiscount(float $total): float
    {
        if ($this->type === 'percent') {
            return ($total * $this->value) / 100;
        }

        return min($this->value, $total);
    }
}