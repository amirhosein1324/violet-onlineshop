<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;

class ManageOrders extends Component
{
    public function updateStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        session()->flash('message', "Order #{$order->order_number} status updated to " . strtoupper($status) . "!");
    }

    public function render()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('livewire.admin.manage-orders', compact('orders'));
    }
}