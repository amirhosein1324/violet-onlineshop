<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;

class ManageCoupons extends Component
{
    public $coupons;
    public $code, $type = 'fixed', $value, $min_order_amount = 0, $coupon_id;
    public $isEditing = false;
    public $showModal = false;

    protected $rules = [
        'code' => 'required|string|max:50|unique:coupons,code',
        'type' => 'required|in:fixed,percent',
        'value' => 'required|numeric|min:0.01',
        'min_order_amount' => 'required|numeric|min:0',
    ];

    public function render()
    {
        $this->coupons = Coupon::latest()->get();
        return view('livewire.admin.manage-coupons');
    }

    public function resetFields()
    {
        $this->code = '';
        $this->type = 'fixed';
        $this->value = '';
        $this->min_order_amount = 0;
        $this->coupon_id = null;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        Coupon::create([
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'value' => $this->value,
            'min_order_amount' => $this->min_order_amount,
            'is_active' => true,
        ]);

        session()->flash('message', 'Coupon created successfully!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->coupon_id = $coupon->id;
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->min_order_amount = $coupon->min_order_amount;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $this->coupon_id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0.01',
            'min_order_amount' => 'required|numeric|min:0',
        ]);

        $coupon = Coupon::findOrFail($this->coupon_id);
        $coupon->update([
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'value' => $this->value,
            'min_order_amount' => $this->min_order_amount,
        ]);

        session()->flash('message', 'Coupon updated successfully!');
        $this->resetFields();
    }

    public function toggleActive($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
    }

    public function delete($id)
    {
        Coupon::findOrFail($id)->delete();
        session()->flash('message', 'Coupon deleted successfully!');
    }
}