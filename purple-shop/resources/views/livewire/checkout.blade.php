<div class="min-h-screen bg-slate-950 text-slate-100 font-sans pb-16">

    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-violet-600 to-purple-400 flex items-center justify-center font-black text-xl shadow-lg shadow-violet-600/30">
                    V
                </div>
                <span class="font-bold text-xl tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-purple-200">
                    VIOLET<span class="text-violet-500">.</span>
                </span>
            </a>
            <a href="/" class="text-xs text-violet-400 hover:text-violet-300 font-medium">← Back to Store</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 pt-10">

        @if($orderPlaced)
            <div class="max-w-lg mx-auto bg-slate-900 border border-violet-500/30 rounded-3xl p-8 text-center shadow-2xl">
                <div class="w-16 h-16 bg-violet-600/20 text-violet-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-violet-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 class="text-2xl font-bold text-white">Order Confirmed!</h2>
                <p class="text-slate-400 text-sm mt-2">Thank you for your purchase. Your order identifier is:</p>
                <div class="inline-block bg-slate-950 border border-slate-800 text-violet-300 font-mono text-lg font-bold px-4 py-2 rounded-xl mt-3">
                    {{ $placedOrderNumber }}
                </div>
                <div class="mt-6">
                    <a href="/" class="inline-block bg-violet-600 hover:bg-violet-500 text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-lg shadow-violet-600/30 transition-all">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @else
            <h1 class="text-2xl md:text-3xl font-black text-white mb-8">Checkout</h1>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 bg-slate-900 border border-slate-800/80 rounded-2xl p-6 shadow-xl">
                    <form wire:submit.prevent="placeOrder" class="space-y-5">
                        <h3 class="text-base font-bold text-slate-200 border-b border-slate-800 pb-3">Shipping Details</h3>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Full Name</label>
                            <input wire:model="name" type="text" placeholder="John Doe" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:border-violet-500 focus:outline-none">
                            @error('name') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Email Address</label>
                            <input wire:model="email" type="email" placeholder="john@example.com" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:border-violet-500 focus:outline-none">
                            @error('email') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Street Address</label>
                            <input wire:model="address" type="text" placeholder="123 Cyber St" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:border-violet-500 focus:outline-none">
                            @error('address') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-1">City</label>
                                <input wire:model="city" type="text" placeholder="Neo City" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:border-violet-500 focus:outline-none">
                                @error('city') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-1">Postal Code</label>
                                <input wire:model="postal_code" type="text" placeholder="90210" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:border-violet-500 focus:outline-none">
                                @error('postal_code') <span class="text-xs text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <h3 class="text-base font-bold text-slate-200 border-b border-slate-800 pb-3 pt-4">Payment Method</h3>

                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer border rounded-xl p-3 flex items-center gap-3 transition-all {{ $payment_method === 'card' ? 'border-violet-500 bg-violet-600/10' : 'border-slate-800 bg-slate-950' }}">
                                <input type="radio" wire:model.live="payment_method" value="card" class="hidden">
                                <span class="text-sm font-semibold text-slate-200">Credit Card</span>
                            </label>

                            <label class="cursor-pointer border rounded-xl p-3 flex items-center gap-3 transition-all {{ $payment_method === 'paypal' ? 'border-violet-500 bg-violet-600/10' : 'border-slate-800 bg-slate-950' }}">
                                <input type="radio" wire:model.live="payment_method" value="paypal" class="hidden">
                                <span class="text-sm font-semibold text-slate-200">PayPal</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full mt-6 bg-violet-600 hover:bg-violet-500 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-violet-600/30 transition-all text-sm">
                            Complete Order (${{ number_format($this->cartTotal, 2) }})
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-6 shadow-xl sticky top-24">
                        <h3 class="text-base font-bold text-slate-200 border-b border-slate-800 pb-3">Order Summary</h3>

                        <div class="mt-4 space-y-3 max-h-60 overflow-y-auto pr-1">
                            @forelse($cart as $item)
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-slate-300">{{ $item['name'] }}</span>
                                        <span class="text-xs text-slate-500">x{{ $item['quantity'] }}</span>
                                    </div>
                                    <span class="font-semibold text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                            @empty
                                <div class="text-slate-500 text-sm py-4">Your cart is empty.</div>
                            @endforelse
                        </div>

                        <div class="border-t border-slate-800 pt-4 mt-4 space-y-2 text-sm">
                            <div class="flex justify-between text-slate-400">
                                <span>Subtotal</span>
                                <span>${{ number_format($this->cartTotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-slate-400">
                                <span>Shipping</span>
                                <span class="text-violet-400">FREE</span>
                            </div>
                            <div class="flex justify-between font-bold text-base text-white border-t border-slate-800 pt-3">
                                <span>Total</span>
                                <span class="text-violet-400">${{ number_format($this->cartTotal, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
</div>