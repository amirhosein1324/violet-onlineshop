<div class="p-6 bg-slate-900 border border-slate-800 rounded-2xl text-slate-100">
    <h2 class="text-xl font-bold mb-4">🛒 Checkout</h2>

    @if(session('coupon_error'))
        <div class="mb-4 p-3 bg-red-950/80 border border-red-500/50 text-red-300 text-xs rounded-xl">
            {{ session('coupon_error') }}
        </div>
    @endif

    @if(session('coupon_success'))
        <div class="mb-4 p-3 bg-purple-950/80 border border-purple-500/50 text-purple-300 text-xs rounded-xl">
            {{ session('coupon_success') }}
        </div>
    @endif

    <div class="flex gap-2 mb-4">
        <input type="text" wire:model="couponCode" placeholder="Enter coupon code" class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-sm text-slate-100 focus:border-purple-500 outline-none">
        <button wire:click="applyCoupon" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs rounded-xl transition">
            Apply
        </button>
    </div>

    <div class="text-sm space-y-1 font-mono">
        <p>Subtotal: ${{ number_format($total, 2) }}</p>
        <p class="text-purple-400">Discount: -${{ number_format($discount, 2) }}</p>
        <p class="text-lg font-bold text-white pt-2 border-t border-slate-800">Total: ${{ number_format($this->finalTotal, 2) }}</p>
    </div>
</div>