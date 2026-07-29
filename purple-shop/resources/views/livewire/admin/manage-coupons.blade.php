<div class="p-6 bg-slate-950 text-slate-100 min-h-screen">
    
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-2xl font-black text-purple-400">🎟️ Admin Dashboard: Manage Coupons</h1>
            <p class="text-xs text-slate-400 mt-1">Create and manage discount codes for store promotions.</p>
        </div>
        <button wire:click="openModal" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-purple-600/30 flex items-center gap-2">
            <span>➕ Add New Coupon</span>
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-purple-950/80 border border-purple-500/50 text-purple-200 rounded-xl text-xs font-semibold">
            ✨ {{ session('message') }}
        </div>
    @endif

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
        <table class="w-full text-left text-xs text-slate-300">
            <thead class="bg-slate-950 text-slate-400 uppercase font-mono border-b border-slate-800">
                <tr>
                    <th class="p-4">Code</th>
                    <th class="p-4">Discount</th>
                    <th class="p-4">Min Order</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($coupons as $coupon)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="p-4 font-bold font-mono text-purple-300">
                            {{ $coupon->code }}
                        </td>
                        <td class="p-4 font-semibold text-slate-100">
                            @if($coupon->type === 'percent')
                                {{ number_format($coupon->value, 0) }}% Off
                            @else
                                ${{ number_format($coupon->value, 2) }} Off
                            @endif
                        </td>
                        <td class="p-4 font-mono text-slate-400">
                            ${{ number_format($coupon->min_order_amount, 2) }}
                        </td>
                        <td class="p-4">
                            <button wire:click="toggleActive({{ $coupon->id }})" class="px-2.5 py-1 rounded-lg text-[10px] font-bold font-mono transition {{ $coupon->is_active ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-red-950 text-red-400 border border-red-800' }}">
                                {{ $coupon->is_active ? 'ACTIVE' : 'DISABLED' }}
                            </button>
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <button wire:click="edit({{ $coupon->id }})" class="px-3 py-1.5 bg-slate-800 hover:bg-purple-600 text-slate-200 hover:text-white rounded-lg transition font-bold">
                                Edit
                            </button>
                            <button wire:click="delete({{ $coupon->id }})" wire:confirm="Are you sure you want to delete this coupon?" class="px-3 py-1.5 bg-slate-800 hover:bg-red-600/80 text-slate-400 hover:text-white rounded-lg transition font-bold">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">No coupons created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-lg shadow-2xl">
                <h3 class="text-lg font-bold text-slate-100 mb-4">
                    {{ $isEditing ? '✏️ Edit Coupon' : '🎟️ Create Coupon' }}
                </h3>

                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Coupon Code</label>
                        <input type="text" wire:model="code" placeholder="e.g. SAVE20" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 uppercase focus:border-purple-500 outline-none">
                        @error('code') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Discount Type</label>
                            <select wire:model="type" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none">
                                <option value="fixed">Fixed Amount ($)</option>
                                <option value="percent">Percentage (%)</option>
                            </select>
                            @error('type') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Value ($ or %)</label>
                            <input type="number" step="0.01" wire:model="value" placeholder="10.00" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none">
                            @error('value') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Minimum Order Amount ($)</label>
                        <input type="number" step="0.01" wire:model="min_order_amount" placeholder="0.00" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none">
                        @error('min_order_amount') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2 pt-4 border-t border-slate-800">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold rounded-xl transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-purple-600/30">
                            {{ $isEditing ? 'Save Changes' : 'Create Coupon' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>