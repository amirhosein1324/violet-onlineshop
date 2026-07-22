<div class="min-h-screen bg-slate-950 text-slate-100 p-8">
    <div class="max-w-3xl mx-auto bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-2xl">
        <h2 class="text-2xl font-extrabold text-purple-400 mb-6">💳 Secure Checkout</h2>

        @if (session()->has('error'))
            <div class="mb-4 p-4 bg-red-900/50 border border-red-500 text-red-200 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <form id="payment-form" wire:submit.prevent="processOrder" class="space-y-4">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Full Name</label>
                <input type="text" wire:model="name" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-slate-100 focus:border-purple-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Email Address</label>
                <input type="email" wire:model="email" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-slate-100 focus:border-purple-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Shipping Address</label>
                <textarea wire:model="address" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-slate-100 focus:border-purple-500 focus:outline-none" rows="2" required></textarea>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Credit / Debit Card</label>
                <div id="card-element" class="bg-slate-800 border border-slate-700 rounded-xl p-3"></div>
            </div>

            <button id="card-button" type="submit" class="w-full py-3.5 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl transition shadow-lg shadow-purple-600/30">
                Pay ${{ number_format($total, 2) }}
            </button>
        </form>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: { color: '#f8fafc', fontSize: '16px', '::placeholder': { color: '#94a3b8' } }
        }
    });
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const { token, error } = await stripe.createToken(cardElement);

        if (error) {
            alert(error.message);
        } else {
            @this.set('stripeToken', token.id);
            @this.call('processOrder');
        }
    });
</script>