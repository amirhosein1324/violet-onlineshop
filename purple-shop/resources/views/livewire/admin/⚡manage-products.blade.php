<div class="p-6 bg-slate-950 text-slate-100 min-h-screen">
    
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-2xl font-black text-purple-400">⚡ Admin Dashboard: Manage Products</h1>
            <p class="text-xs text-slate-400 mt-1">Add, update, or remove products from Byte Bazaar storefront.</p>
        </div>
        <button wire:click="openModal" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-purple-600/30 flex items-center gap-2">
            <span>➕ Add New Product</span>
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
                    <th class="p-4">Product</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Price</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-10 h-10 bg-slate-950 border border-slate-800 rounded-lg overflow-hidden flex-shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-slate-600">N/A</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-slate-100">{{ $product->name }}</div>
                                <div class="text-[11px] text-slate-500 truncate max-w-xs">{{ $product->description }}</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 bg-slate-950 border border-slate-800 rounded-lg text-slate-300 font-mono">
                                {{ ucfirst($product->category) }}
                            </span>
                        </td>
                        <td class="p-4 font-mono font-bold text-purple-400">
                            ${{ number_format($product->price, 2) }}
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <button wire:click="edit({{ $product->id }})" class="px-3 py-1.5 bg-slate-800 hover:bg-purple-600 text-slate-200 hover:text-white rounded-lg transition font-bold">
                                Edit
                            </button>
                            <button wire:click="delete({{ $product->id }})" wire:confirm="Are you sure you want to delete this product?" class="px-3 py-1.5 bg-slate-800 hover:bg-red-600/80 text-slate-400 hover:text-white rounded-lg transition font-bold">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-500">No products found in store.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-lg shadow-2xl">
                <h3 class="text-lg font-bold text-slate-100 mb-4">
                    {{ $isEditing ? '✏️ Edit Product' : '➕ Add New Product' }}
                </h3>

                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Product Name</label>
                        <input type="text" wire:model="name" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none">
                        @error('name') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Category</label>
                            <input type="text" wire:model="category" placeholder="e.g. Hardware, Software" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none">
                            @error('category') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-1">Price ($)</label>
                            <input type="number" step="0.01" wire:model="price" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none">
                            @error('price') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-xs text-slate-100 focus:border-purple-500 outline-none"></textarea>
                        @error('description') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Product Image</label>
                        <input type="file" wire:model="image" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-purple-950 file:text-purple-300 hover:file:bg-purple-900">
                        @error('image') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2 pt-4 border-t border-slate-800">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold rounded-xl transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-purple-600/30">
                            {{ $isEditing ? 'Save Changes' : 'Create Product' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>