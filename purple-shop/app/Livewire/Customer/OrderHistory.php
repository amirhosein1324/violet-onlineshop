<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Component
{
    public $selectedOrder = null;

    public function viewOrderDetails($orderId)
    {
        $this->selectedOrder = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);
    }

    public function closeDetails()
    {
        $this->selectedOrder = null;
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('livewire.customer.order-history', compact('orders'));
    }
}