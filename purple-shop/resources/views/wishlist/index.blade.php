<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist — Byte Bazaar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen font-sans">

    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-black text-purple-400 tracking-wider hover:text-purple-300 transition">
                ⚡ BYTE BAZAAR
            </a>
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-purple-400 font-semibold transition">
                ← Back to Store
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-100">❤️ My Favorites & Wishlist</h1>
                <p class="text-slate-400 text-sm mt-1">Products you saved for later.</p>
            </div>
            <span class="px-3 py-1 bg-purple-950/80 border border-purple-500/30 text-purple-300 rounded-full text-xs font-mono font-bold">
                {{ count($products) }} {{ Str::plural('item', count($products)) }}
            </span>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-purple-950/60 border border-purple-500/50 text-purple-200 rounded-xl text-sm">
                ✨ {{ session('success') }}
            </div>
        @endif

        @if($products->isEmpty())
            <div class="text-center py-20 bg-slate-900/50 border border-dashed border-slate-800 rounded-2xl">
                <p class="text-slate-400 text-base mb-4">Your wishlist is currently empty.</p>
                <a href="{{ route('home') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-purple-600/30">
                    Explore Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-xl flex flex-col justify-between hover:border-purple-500/50 transition duration-300 group">
                        
                        <div>
                            <div class="relative w-full h-48 bg-slate-950 rounded-xl overflow-hidden mb-4 border border-slate-800/80">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-600 text-xs font-mono">
                                        No Image Available
                                    </div>
                                @endif

                                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-2 right-2">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 rounded-full bg-slate-900/80 backdrop-blur-md border border-slate-700 flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition shadow-md" title="Remove from wishlist">
                                        ✕
                                    </button>
                                </form>
                            </div>

                            <h3 class="font-bold text-slate-100 text-base mb-1 group-hover:text-purple-400 transition">
                                {{ $product->name }}
                            </h3>
                            <p class="text-slate-400 text-xs line-clamp-2 mb-3">
                                {{ $product->description }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-800/80 flex items-center justify-between mt-auto">
                            <span class="text-lg font-black text-purple-400 font-mono">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <a href="{{ route('home') }}" class="px-3 py-1.5 bg-slate-800 hover:bg-purple-600 text-slate-200 hover:text-white text-xs font-bold rounded-lg transition">
                                View Details
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>