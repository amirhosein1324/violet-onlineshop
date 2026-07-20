<div x-data="{ toast: false, toastMessage: '' }" 
     @item-added.window="toast = true; toastMessage = 'Item added to cart!'; setTimeout(() => toast = false, 3000)"
     class="min-h-screen bg-slate-950 text-slate-100 font-sans selection:bg-purple-600 selection:text-white">

    <div x-show="toast" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-5"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-5"
         class="fixed bottom-5 right-5 z-50 bg-slate-900 border border-purple-500/50 text-white px-5 py-3 rounded-xl shadow-purple-glow flex items-center space-x-3">
        <span class="text-purple-400">✨</span>
        <span x-text="toastMessage" class="text-sm font-medium"></span>
    </div>

    <header class="sticky top-0 z-40 backdrop-blur-xl bg-slate-950/80 border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="text-2xl font-black tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-violet-300 to-indigo-400">
                PURPLE<span class="text-white font-light">STORE</span>
            </a>

            <div class="relative w-1/3 hidden md:block">
                <input wire:model.live="search" type="text" placeholder="Search premium tech..." 
                       class="w-full bg-slate-900/90 border border-slate-800 rounded-xl px-4 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all duration-200">
            </div>

            <button class="relative bg-gradient-to-r from-purple-600 to-violet-600 hover:from-purple-500 hover:to-violet-500 text-white font-semibold px-5 py-2.5 rounded-xl shadow-purple-glow transition-all duration-300 hover:scale-105 active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span>Cart</span>
                <span class="bg-white/20 text-xs px-2 py-0.5 rounded-full" wire:text="cartCount">0</span>
            </button>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 pt-12 pb-8">
        <div class="relative rounded-3xl p-8 md:p-12 overflow-hidden border border-purple-500/20 bg-gradient-to-br from-slate-900 via-slate-900 to-purple-950/40 shadow-purple-glow">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="max-w-xl relative z-10">
                <span class="text-purple-400 text-xs font-bold uppercase tracking-widest bg-purple-950/60 border border-purple-500/30 px-3 py-1 rounded-full">New Release 2026</span>
                <h1 class="text-4xl md:text-5xl font-black mt-4 text-white leading-tight">Elevate Your Setup with Next-Gen Tech</h1>
                <p class="text-slate-400 mt-4 text-sm md:text-base">Experience high-performance gear wrapped in sleek, ultra-modern aesthetics.</p>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex items-center space-x-3 mb-8 overflow-x-auto pb-2 scrollbar-none">
            @foreach($categories as $category)
                <button wire:click="$set('selectedCategory', '{{ $category }}')"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap
                        {{ $selectedCategory === $category 
                           ? 'bg-purple-600 text-white shadow-purple-glow' 
                           : 'bg-slate-900 text-slate-400 hover:text-white border border-slate-800' }}">
                    {{ $category }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="group bg-slate-900/80 rounded-2xl p-4 border border-slate-800/80 transition-all duration-300 hover:-translate-y-2 hover:border-purple-500/50 hover:shadow-purple-glow">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-slate-800/50 flex items-center justify-center">
                    <span class="text-slate-600 text-sm">Product Image</span>
                    <span class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-md text-xs font-bold px-3 py-1 rounded-full text-white">Featured</span>
                </div>

                <div class="mt-4">
                    <span class="text-xs text-purple-400 font-medium">Audio</span>
                    <h3 class="text-base font-bold text-white mt-1 group-hover:text-purple-300 transition-colors">Apex Pro Wireless ANC</h3>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-lg font-black text-white">$249.00</span>
                        <button wire:click="addToCart(1)" 
                                class="bg-purple-600/20 hover:bg-purple-600 text-purple-300 hover:text-white border border-purple-500/30 p-2.5 rounded-xl transition-all duration-200 hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>