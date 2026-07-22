public $couponCode = '';
public $appliedCoupon = null;
public $discount = 0;

public function applyCoupon()
{
    $coupon = Coupon::where('code', strtoupper($this->couponCode))
        ->where('is_active', true)
        ->first();

    if (!$coupon) {
        session()->flash('coupon_error', 'Invalid or expired coupon code.');
        return;
    }

    if ($this->total < $coupon->min_order_amount) {
        session()->flash('coupon_error', "Minimum order amount of $" . number_format($coupon->min_order_amount, 2) . " required.");
        return;
    }

    $this->appliedCoupon = $coupon;
    $this->discount = $coupon->calculateDiscount($this->total);
    session()->flash('coupon_success', 'Coupon applied successfully!');
}

public function removeCoupon()
{
    $this->appliedCoupon = null;
    $this->discount = 0;
    $this->couponCode = '';
}

// Update payment calculations:
public function getFinalTotalProperty()
{
    return max(0, $this->total - $this->discount);
}