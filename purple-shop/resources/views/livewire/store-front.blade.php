<div x-data="{ toast: false, toastMsg: '' }" 
     x-on:item-added.window="toastMsg = $event.detail.name + ' added to cart!'; toast = true; setTimeout(() => toast = false, 3000)"
     class="min-h-screen bg-slate-950 text-slate-100 font-sans pb-16 relative overflow-x-hidden">

    <div x-show="toast" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-8 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-8 opacity-0"
         class="fixed bottom-6 right-6 z-50 bg-violet-600 text-white px-5 py-3 rounded-xl shadow-lg shadow-violet-500/30 flex items-center gap-3 border border-violet-400/30"
         x-cloak>
        <svg class="w-5 h-5 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span x-text="toastMsg" class="font-medium text-sm"></span>
    </div>

    <header class="sticky top-0 z-40 backdrop-blur-md bg-slate-900/80 border-b border-slate-800/80 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-violet-600 to-purple-400 flex items-center justify-center font-black text-xl shadow-lg shadow-violet-600/30">
                    V
                </div>
                <span class="font-bold text-xl tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-purple-200">
                    VIOLET<span class="text-violet-500">.</span>
                </span>
            </div>

            <div class="flex-1 max-w-md relative">
                <input wire:model.live.debounce.300ms="search" 
                       type="text" 
                       placeholder="Search headphones, smartwatches..." 
                       class="w-full bg-slate-900/90 border border-slate-700/60 rounded-xl pl-10 pr-4 py-2 text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <button wire:click="toggleCart" class="relative p-2.5 rounded-xl bg-slate-800/80 border border-slate-700/50 hover:bg-slate-800 hover:border-violet-500/50 transition-all group">
                <svg class="w-5 h-5 text-slate-300 group-hover:text-violet-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                @if($this->cartCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-violet-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-md animate-pulse">
                        {{ $this->cartCount }}
                    </span>
                @endif
            </button>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 pt-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-violet-900/40 via-purple-900/20 to-slate-900 border border-violet-500/20 p-8 md:p-12 mb-10 shadow-2xl">
            <div class="relative z-10 max-w-xl">
                <span class="px-3 py-1 text-xs font-semibold uppercase tracking-wider text-violet-300 bg-violet-500/10 border border-violet-500/20 rounded-full">Next-Gen Audio & Gear</span>
                <h1 class="text-3xl md:text-5xl font-black tracking-tight mt-4 text-white leading-tight">
                    Elevate Your Tech Experience
                </h1>
                <p class="text-slate-400 mt-3 text-sm md:text-base">
                    Discover premium wireless headphones, gaming peripherals, and modern tech accessories crafted for perfection.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-3 overflow-x-auto pb-4 mb-8 no-scrollbar">
            <button wire:click="$set('selectedCategory', 'All')" 
                    class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $selectedCategory === 'All' ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/30' : 'bg-slate-900/80 text-slate-400 hover:bg-slate-800 border border-slate-800' }}">
                All Products
            </button>
            @foreach($categories as $category)
                <button wire:click="$set('selectedCategory', '{{ $category->name }}')" 
                        class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $selectedCategory === $category->name ? 'bg-violet-600 text-white shadow-lg shadow-violet-600/30' : 'bg-slate-900/80 text-slate-400 hover:bg-slate-800 border border-slate-800' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="group bg-slate-900/60 border border-slate-800/80 rounded-2xl p-4 hover:border-violet-500/40 hover:shadow-[0_10px_30px_rgba(124,58,237,0.15)] transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div wire:click="openModal({{ $product->id }})" class="cursor-pointer relative aspect-square rounded-xl bg-slate-950/80 border border-slate-800/60 flex items-center justify-center overflow-hidden mb-4 group-hover:border-violet-500/20 transition-colors">
                            <div class="w-24 h-24 rounded-full bg-violet-600/10 border border-violet-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-10 h-10 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="absolute top-3 left-3 text-[10px] uppercase tracking-wider font-semibold px-2 py-0.5 rounded-md bg-slate-900/80 text-violet-300 border border-violet-500/20">
                                {{ $product->category->name }}
                            </span>
                        </div>

                        <h3 wire:click="openModal({{ $product->id }})" class="font-bold text-slate-100 hover:text-violet-400 transition-colors cursor-pointer text-base line-clamp-1">
                            {{ $product->name }}
                        </h3>
                        <p class="text-slate-400 text-xs mt-1 line-clamp-2 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-800/60 flex items-center justify-between">
                        <span class="text-lg font-black text-white">${{ number_format($product->price, 2) }}</span>
                        <button wire:click="addToCart({{ $product->id }})" class="bg-violet-600/20 hover:bg-violet-600 text-violet-300 hover:text-white border border-violet-500/30 px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all duration-200">
                            + Add
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-500">
                    No products found matching your search or criteria.
                </div>
            @endforelse
        </div>
    </main>

    @if($isCartOpen)
        <div class="fixed inset-0 z-50 overflow-hidden">
            <div wire:click="toggleCart" class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity"></div>

            <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div class="w-screen max-w-md bg-slate-900 border-l border-slate-800 p-6 flex flex-col justify-between shadow-2xl">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                                Shopping Cart
                                <span class="text-xs bg-violet-600/20 text-violet-300 px-2 py-0.5 rounded-full border border-violet-500/30">
                                    {{ $this->cartCount }} items
                                </span>
                            </h2>
                            <button wire:click="toggleCart" class="text-slate-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="mt-6 space-y-4 max-h-[60vh] overflow-y-auto pr-1">
                            @forelse($cart as $id => $item)
                                <div class="flex items-center justify-between bg-slate-950/60 border border-slate-800/80 p-3 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 font-bold text-sm">
                                            {{ substr($item['name'], 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-semibold text-white leading-tight">{{ $item['name'] }}</h4>
                                            <span class="text-xs text-slate-400">${{ number_format($item['price'], 2) }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center bg-slate-900 border border-slate-700/60 rounded-lg">
                                            <button wire:click="updateQuantity({{ $id }}, -1)" class="px-2 py-0.5 text-xs text-slate-400 hover:text-white">-</button>
                                            <span class="px-2 text-xs font-semibold text-white">{{ $item['quantity'] }}</span>
                                            <button wire:click="updateQuantity({{ $id }}, 1)" class="px-2 py-0.5 text-xs text-slate-400 hover:text-white">+</button>
                                        </div>
                                        <button wire:click="removeFromCart({{ $id }})" class="text-slate-500 hover:text-red-400 text-xs ml-1">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12 text-center text-slate-500 text-sm">
                                    Your cart is currently empty.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="border-t border-slate-800 pt-4 mt-6">
                        <div class="flex justify-between text-base font-semibold text-white mb-4">
                            <span>Subtotal</span>
                            <span class="text-violet-400">${{ number_format($this->cartTotal, 2) }}</span>
                        </div>
                        <button @click="alert('Proceeding to Checkout!')" 
                                class="w-full bg-violet-600 hover:bg-violet-500 text-white font-bold py-3 rounded-xl shadow-lg shadow-violet-600/30 transition-all text-sm {{ empty($cart) ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                {{ empty($cart) ? 'disabled' : '' }}>
                            Checkout Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($isModalOpen && $selectedProduct)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div wire:click="closeModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

            <div class="relative bg-slate-900 border border-slate-800 rounded-3xl max-w-lg w-full p-6 overflow-hidden shadow-2xl z-10">
                <button wire:click="closeModal" class="absolute top-4 right-4 text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="aspect-video w-full rounded-2xl bg-slate-950 border border-slate-800/80 flex items-center justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-violet-600/20 border border-violet-500/30 flex items-center justify-center">
                        <svg class="w-10 h-10 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <span class="text-xs uppercase tracking-wider font-semibold text-violet-400 bg-violet-500/10 border border-violet-500/20 px-2.5 py-1 rounded-md">
                    {{ $selectedProduct->category->name }}
                </span>

                <h2 class="text-2xl font-bold text-white mt-2">{{ $selectedProduct->name }}</h2>
                <p class="text-slate-400 text-sm mt-2 leading-relaxed">{{ $selectedProduct->description }}</p>

                <div class="mt-6 flex items-center justify-between pt-4 border-t border-slate-800">
                    <span class="text-2xl font-black text-white">${{ number_format($selectedProduct->price, 2) }}</span>
                    
                    <button wire:click="addToCart({{ $selectedProduct->id }}, {{ $modalQuantity }})" 
                            class="bg-violet-600 hover:bg-violet-500 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-violet-600/30 transition-all text-sm">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>