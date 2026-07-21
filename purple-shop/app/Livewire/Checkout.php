<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Livewire\Component;

class Checkout extends Component
{
    // Form fields
    public $name = '';
    public $email = '';
    public $address = '';
    public $city = '';
    public $postal_code = '';
    public $payment_method = 'card';

    public $cart = [];
    public $orderPlaced = false;
    public $placedOrderNumber = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'address' => 'required|min:5',
        'city' => 'required',
        'postal_code' => 'required',
        'payment_method' => 'required',
    ];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function getCartTotalProperty()
    {
        return array_reduce($this->cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function placeOrder()
    {
        $this->validate();

        if (empty($this->cart)) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $this->name,
            'customer_email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'total_amount' => $this->cartTotal,
            'payment_method' => $this->payment_method,
            'status' => 'completed',
        ]);

        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear session cart
        session()->forget('cart');
        $this->cart = [];

        $this->placedOrderNumber = $orderNumber;
        $this->orderPlaced = true;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}