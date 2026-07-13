<div class="min-h-screen bg-slate-950 text-slate-100 p-8">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-purple-400">🎟️ Manage Promo Coupons</h1>
            <a href="{{ route('admin.analytics') }}" class="text-sm text-slate-400 hover:text-purple-300">← Back to Analytics</a>
        </div>

        @if (session()->has('message'))
            <div class="p-4 bg-purple-900/50 border border-purple-500 text-purple-200 rounded-xl">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl">
            <h2 class="text-lg font-bold text-slate-200 mb-4">Create New Coupon</h2>
            <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Coupon Code</label>
                    <input type="text" wire:model="code" placeholder="e.g. SAVE20" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500 uppercase">
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Type</label>
                    <select wire:model="type" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500">
                        <option value="percent">Percentage (%)</option>
                        <option value="fixed">Fixed Amount ($)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Discount Value</label>
                    <input type="number" step="0.01" wire:model="value" placeholder="15" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500">
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Min Order ($)</label>
                    <input type="number" step="0.01" wire:model="min_order_amount" placeholder="0" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-2.5 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl transition shadow-lg shadow-purple-600/30">
                        + Save Code
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800/60 text-slate-400 text-xs uppercase border-b border-slate-800">
                        <th class="p-4">Code</th>
                        <th class="p-4">Discount</th>
                        <th class="p-4">Min. Order</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse($coupons as $coupon)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="p-4 font-mono font-bold text-purple-400">{{ $coupon->code }}</td>
                            <td class="p-4 font-semibold">{{ $coupon->type === 'percent' ? $coupon->value . '%' : '$' . number_format($coupon->value, 2) }}</td>
                            <td class="p-4 font-mono">${{ number_format($coupon->min_order_amount, 2) }}</td>
                            <td class="p-4">
                                <button wire:click="toggleStatus({{ $coupon->id }})" class="px-3 py-1 text-xs rounded-full border {{ $coupon->is_active ? 'bg-emerald-950 text-emerald-400 border-emerald-800' : 'bg-slate-800 text-slate-500 border-slate-700' }}">
                                    {{ $coupon->is_active ? 'Active' : 'Disabled' }}
                                </button>
                            </td>
                            <td class="p-4 text-right">
                                <button wire:click="delete({{ $coupon->id }})" class="px-3 py-1 bg-red-950/60 hover:bg-red-900 border border-red-800 text-red-300 text-xs rounded-lg transition">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-500">No promo coupons created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>