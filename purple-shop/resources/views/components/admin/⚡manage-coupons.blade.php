<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;

class ManageCoupons extends Component
{
    public $code, $type = 'percent', $value, $min_order_amount = 0, $usage_limit;

    protected $rules = [
        'code' => 'required|string|unique:coupons,code',
        'type' => 'required|in:fixed,percent',
        'value' => 'required|numeric|min:0.01',
        'min_order_amount' => 'nullable|numeric|min:0',
        'usage_limit' => 'nullable|integer|min:1',
    ];

    public function store()
    {
        $this->validate();

        Coupon::create([
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'value' => $this->value,
            'min_order_amount' => $this->min_order_amount ?? 0,
            'usage_limit' => $this->usage_limit,
        ]);

        session()->flash('message', 'Coupon Created Successfully!');
        $this->reset(['code', 'value', 'min_order_amount', 'usage_limit']);
    }

    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
    }

    public function delete($id)
    {
        Coupon::findOrFail($id)->delete();
        session()->flash('message', 'Coupon Deleted Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.manage-coupons', [
            'coupons' => Coupon::latest()->get()
        ])->layout('layouts.app');
    }
}