<div class="mb-8 bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-2xl">
    <form action="{{ route('home') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
        
        <div class="relative">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Search products..." 
                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-500 focus:border-purple-500 focus:outline-none transition">
        </div>

        <div>
            <select name="category" 
                    onchange="this.form.submit()" 
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-300 focus:border-purple-500 focus:outline-none cursor-pointer">
                <option value="all">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <select name="sort" 
                    onchange="this.form.submit()" 
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-300 focus:border-purple-500 focus:outline-none cursor-pointer">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="top_rated" {{ request('sort') == 'top_rated' ? 'selected' : '' }}>Highest Rated</option>
            </select>
        </div>

        <div class="flex items-center space-x-2">
            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold text-sm py-2.5 rounded-xl transition shadow-lg shadow-purple-600/30">
                Filter
            </button>

            @if(request()->anyFilled(['search', 'category', 'sort', 'min_price', 'max_price']))
                <a href="{{ route('home') }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-400 text-xs font-semibold rounded-xl transition">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<div class="mt-8">
    {{ $products->links() }}
</div>

@php
    $inWishlist = in_array($product->id, session()->get('wishlist', []));
@endphp

<form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="p-2 rounded-xl border {{ $inWishlist ? 'bg-purple-950 border-purple-500 text-purple-400' : 'bg-slate-800/80 border-slate-700 text-slate-400 hover:text-purple-400' }} transition">
        {{ $inWishlist ? '❤️' : '🤍' }}
    </button>
</form>