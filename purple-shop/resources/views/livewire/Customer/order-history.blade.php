<div class="p-6 max-w-6xl mx-auto min-h-screen text-slate-100">
    
    <div class="mb-8 pb-4 border-b border-slate-800 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-purple-400">🛍️ My Orders</h1>
            <p class="text-xs text-slate-400 mt-1">Track and manage your past purchases and store order receipts.</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($orders as $order)
            <div class="bg-slate-900 border border-slate-800 hover:border-purple-500/50 rounded-2xl p-6 transition shadow-xl">
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 pb-4 border-b border-slate-800/60">
                    <div>
                        <span class="text-xs font-mono text-purple-400 font-bold">#{{ $order->order_number }}</span>
                        <div class="text-[11px] text-slate-400 mt-0.5">Placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}</div>
                    </div>

                    <div class="flex items-center gap-4">
                        @php
                            $badgeClass = match($order->status) {
                                'completed' => 'bg-emerald-950 text-emerald-400 border-emerald-800',
                                'processing' => 'bg-blue-950 text-blue-400 border-blue-800',
                                'cancelled' => 'bg-red-950 text-red-400 border-red-800',
                                default => 'bg-amber-950 text-amber-400 border-amber-800',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-xl text-xs font-bold font-mono border {{ $badgeClass }}">
                            {{ strtoupper($order->status) }}
                        </span>

                        <div class="font-mono font-bold text-lg text-slate-100">
                            ${{ number_format($order->total, 2) }}
                        </div>

                        <button wire:click="viewOrderDetails({{ $order->id }})" class="px-4 py-2 bg-slate-800 hover:bg-purple-600 text-slate-200 hover:text-white rounded-xl text-xs font-bold transition">
                            View Details
                        </button>
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-3 overflow-x-auto">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-2 bg-slate-950 px-3 py-1.5 rounded-xl border border-slate-800 text-xs">
                            <span class="font-bold text-slate-200">{{ $item->product->name ?? 'Product' }}</span>
                            <span class="text-slate-500">x{{ $item->quantity }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="p-12 text-center bg-slate-900 border border-slate-800 rounded-2xl text-slate-400">
                <p class="text-lg">🛒 You haven't placed any orders yet!</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 px-6 py-2.5 bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs rounded-xl transition shadow-lg shadow-purple-600/30">
                    Explore Store
                </a>
            </div>
        @endforelse
    </div>

    @if($selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-800">
                    <div>
                        <h3 class="text-lg font-bold text-slate-100">Order Receipts #{{ $selectedOrder->order_number }}</h3>
                        <p class="text-xs text-slate-400">Status: <span class="text-purple-400 uppercase font-mono font-bold">{{ $selectedOrder->status }}</span></p>
                    </div>
                    <button wire:click="closeDetails" class="text-slate-400 hover:text-white font-bold text-lg">✕</button>
                </div>

                <div class="mb-6 p-4 bg-slate-950 border border-slate-800 rounded-xl text-xs space-y-1">
                    <div class="font-bold text-slate-300">Shipping Address</div>
                    <div class="text-slate-400">{{ $selectedOrder->shipping_address }}</div>
                    <div class="font-bold text-slate-300 pt-2">Payment Method</div>
                    <div class="text-purple-400 uppercase font-mono">{{ $selectedOrder->payment_method }}</div>
                </div>

                <div class="space-y-3 mb-6">
                    <h4 class="text-xs font-bold uppercase text-slate-400 font-mono">Items Purchased</h4>
                    @foreach($selectedOrder->items as $item)
                        <div class="flex justify-between items-center bg-slate-950 p-3 rounded-xl border border-slate-800 text-xs">
                            <div>
                                <div class="font-bold text-slate-100">{{ $item->product->name ?? 'Product' }}</div>
                                <div class="text-slate-500">${{ number_format($item->price, 2) }} × {{ $item->quantity }}</div>
                            </div>
                            <div class="font-mono font-bold text-purple-300">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 bg-slate-950 border border-slate-800 rounded-xl space-y-1.5 text-xs font-mono">
                    <div class="flex justify-between text-slate-400">
                        <span>Subtotal:</span>
                        <span>${{ number_format($selectedOrder->subtotal, 2) }}</span>
                    </div>
                    @if($selectedOrder->discount > 0)
                        <div class="flex justify-between text-purple-400">
                            <span>Discount:</span>
                            <span>-${{ number_format($selectedOrder->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between font-bold text-slate-100 text-sm pt-2 border-t border-slate-800">
                        <span>Total Paid:</span>
                        <span class="text-purple-400">${{ number_format($selectedOrder->total, 2) }}</span>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-slate-800 mt-6">
                    <button wire:click="closeDetails" class="px-5 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold rounded-xl transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>