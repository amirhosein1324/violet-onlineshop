<div class="p-6 bg-slate-950 text-slate-100 min-h-screen">
    
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-2xl font-black text-purple-400">📦 Admin Dashboard: Manage Orders</h1>
            <p class="text-xs text-slate-400 mt-1">Review placed customer orders and update shipping statuses.</p>
        </div>
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
                    <th class="p-4">Order #</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Date</th>
                    <th class="p-4 text-right">Update Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($orders as $order)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="p-4 font-bold font-mono text-purple-300">
                            #{{ $order->order_number }}
                        </td>
                        <td class="p-4">
                            <div class="font-semibold text-slate-100">{{ $order->user->name ?? 'Guest/Unknown' }}</div>
                            <div class="text-[10px] text-slate-500">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td class="p-4 font-mono font-bold text-slate-100">
                            ${{ number_format($order->total, 2) }}
                        </td>
                        <td class="p-4">
                            @php
                                $badgeClass = match($order->status) {
                                    'completed' => 'bg-emerald-950 text-emerald-400 border-emerald-800',
                                    'processing' => 'bg-blue-950 text-blue-400 border-blue-800',
                                    'cancelled' => 'bg-red-950 text-red-400 border-red-800',
                                    default => 'bg-amber-950 text-amber-400 border-amber-800',
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold font-mono border {{ $badgeClass }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-slate-400 font-mono text-[11px]">
                            {{ $order->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="p-4 text-right">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" class="bg-slate-950 border border-slate-800 rounded-lg px-2.5 py-1 text-xs text-slate-300 focus:border-purple-500 outline-none">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">No orders placed yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>