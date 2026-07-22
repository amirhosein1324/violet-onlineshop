<div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 transition-all duration-300 hover:border-purple-500/50 hover:shadow-[0_0_25px_rgba(168,85,247,0.15)] relative group">
    
    <div class="relative overflow-hidden rounded-xl mb-4 bg-slate-950 aspect-square flex items-center justify-center">
        <span class="absolute top-3 left-3 bg-purple-950/80 border border-purple-500/30 text-purple-300 text-xs px-2.5 py-1 rounded-full backdrop-blur-md">
            {{ $product->category }}
        </span>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover group-hover:scale-105 transition-transform duration-300">
    </div>

    <div class="space-y-2">
        <div class="flex justify-between items-center text-xs text-slate-400">
            <span class="text-amber-400 font-medium">★ 4.9 (18)</span>
            <span class="text-emerald-400 font-medium">In Stock</span>
        </div>

        <h3 class="text-lg font-bold text-slate-100 group-hover:text-purple-400 transition-colors">
            {{ $product->name }}
        </h3>

        <div class="flex items-center justify-between pt-2">
            <span class="text-xl font-extrabold text-purple-400 font-mono">
                ${{ number_format($product->price, 2) }}
            </span>

            <button wire:click="$dispatch('addToCart', { id: {{ $product->id }} })" 
                    class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white font-semibold text-sm rounded-xl transition shadow-lg shadow-purple-600/20 active:scale-95">
                Add to Cart
            </button>
        </div>
    </div>
</div>