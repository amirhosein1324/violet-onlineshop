<div class="min-h-screen bg-slate-950 text-slate-100 p-8">
    <div class="max-w-7xl mx-auto space-y-8">
        
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold text-purple-400">📊 Analytics & Performance</h1>
                <p class="text-slate-400 text-sm mt-1">Real-time overview of Byte Bazaar's store performance.</p>
            </div>
            <a href="{{ route('admin.products') }}" class="px-4 py-2 bg-slate-900 border border-purple-500/30 text-purple-300 hover:bg-slate-800 rounded-xl font-medium transition text-sm">
                Manage Products →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-purple-500/40 transition">
                <div class="flex justify-between items-center text-slate-400 mb-2">
                    <span class="text-xs font-semibold uppercase tracking-wider">Total Revenue</span>
                    <span class="p-2 bg-purple-950 text-purple-400 rounded-lg text-lg">💰</span>
                </div>
                <div class="text-2xl font-black text-slate-100 font-mono">
                    ${{ number_format($totalRevenue, 2) }}
                </div>
                <span class="text-xs text-emerald-400 mt-2 block">↑ Completed transactions</span>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-purple-500/40 transition">
                <div class="flex justify-between items-center text-slate-400 mb-2">
                    <span class="text-xs font-semibold uppercase tracking-wider">Total Orders</span>
                    <span class="p-2 bg-purple-950 text-purple-400 rounded-lg text-lg">📦</span>
                </div>
                <div class="text-2xl font-black text-slate-100 font-mono">
                    {{ $totalOrders }}
                </div>
                <span class="text-xs text-purple-400 mt-2 block">All-time order volume</span>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-purple-500/40 transition">
                <div class="flex justify-between items-center text-slate-400 mb-2">
                    <span class="text-xs font-semibold uppercase tracking-wider">Avg. Order Value</span>
                    <span class="p-2 bg-purple-950 text-purple-400 rounded-lg text-lg">📈</span>
                </div>
                <div class="text-2xl font-black text-slate-100 font-mono">
                    ${{ number_format($averageOrderValue, 2) }}
                </div>
                <span class="text-xs text-slate-400 mt-2 block">Per customer checkout</span>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-purple-500/40 transition">
                <div class="flex justify-between items-center text-slate-400 mb-2">
                    <span class="text-xs font-semibold uppercase tracking-wider">Active Inventory</span>
                    <span class="p-2 bg-purple-950 text-purple-400 rounded-lg text-lg">🏷️</span>
                </div>
                <div class="text-2xl font-black text-slate-100 font-mono">
                    {{ $totalProducts }}
                </div>
                <span class="text-xs text-slate-400 mt-2 block">Listed store items</span>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-2xl">
                <h3 class="text-lg font-bold text-slate-200 mb-4">🛒 Recent Orders</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-800 text-xs uppercase tracking-wider">
                                <th class="pb-3">Order ID</th>
                                <th class="pb-3">Customer</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-sm">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-slate-800/30 transition">
                                    <td class="py-3 font-mono text-purple-400 font-bold">#{{ $order->id }}</td>
                                    <td class="py-3 text-slate-300">{{ $order->customer_name }}</td>
                                    <td class="py-3">
                                        <span class="px-2.5 py-1 text-xs rounded-full border {{ $order->status === 'Paid' ? 'bg-emerald-950 text-emerald-400 border-emerald-800' : 'bg-amber-950 text-amber-400 border-amber-800' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right font-mono font-bold text-slate-100">${{ number_format($order->total, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-500">No recent orders recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-2xl">
                <h3 class="text-lg font-bold text-slate-200 mb-4">🔥 Featured Catalog</h3>
                <div class="space-y-4">
                    @forelse($topProducts as $product)
                        <div class="flex items-center justify-between p-3 bg-slate-800/40 rounded-xl border border-slate-800">
                            <div>
                                <p class="font-semibold text-slate-200 text-sm">{{ $product->name }}</p>
                                <span class="text-xs text-purple-400">{{ $product->category }}</span>
                            </div>
                            <span class="font-mono text-sm font-bold text-slate-100">${{ number_format($product->price, 2) }}</span>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm text-center py-4">No catalog items available.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</div>