<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Charge;

class Checkout extends Component
{
    public $name, $email, $address, $stripeToken;
    public $cartItems = [];
    public $total = 0;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'address' => 'required|string',
        'stripeToken' => 'required',
    ];

    public function mount()
    {
        $this->cartItems = session()->get('cart', []);
        $this->total = array_reduce($this->cartItems, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
    }

    public function processOrder()
    {
        $this->validate();

        try {
            // Process Stripe Charge
            Stripe::setApiKey(config('services.stripe.secret'));

            $charge = Charge::create([
                'amount' => $this->total * 100, // Amount in cents
                'currency' => 'usd',
                'description' => 'Byte Bazaar Order',
                'source' => $this->stripeToken,
                'receipt_email' => $this->email,
            ]);

            // Save Order to Database
            $order = Order::create([
                'customer_name' => $this->name,
                'customer_email' => $this->email,
                'shipping_address' => $this->address,
                'total' => $this->total,
                'status' => 'Paid',
                'stripe_charge_id' => $charge->id,
            ]);

            // Clear Cart Session
            session()->forget('cart');

            // Send Confirmation Email
            Mail::to($this->email)->send(new OrderConfirmed($order));

            session()->flash('success', 'Payment successful! Confirmation email sent.');
            return redirect()->route('order.success', $order->id);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }
}