<div class="min-h-screen bg-slate-950 text-slate-100 p-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-purple-400">⚡ Admin Product Dashboard</h1>
            <button wire:click="openModal" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-500 rounded-xl font-bold transition shadow-lg shadow-purple-600/30">
                + Add New Product
            </button>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-purple-900/50 border border-purple-500 text-purple-200 rounded-xl">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800/60 text-slate-400 border-b border-slate-800 text-sm">
                        <th class="p-4">Product</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Price</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="p-4 font-semibold text-slate-200">{{ $product->name }}</td>
                            <td class="p-4"><span class="px-3 py-1 bg-purple-950 text-purple-300 border border-purple-800 text-xs rounded-full font-medium">{{ $product->category }}</span></td>
                            <td class="p-4 font-mono text-purple-400 font-bold">${{ number_format($product->price, 2) }}</td>
                            <td class="p-4 text-right space-x-2">
                                <button wire:click="edit({{ $product->id }})" class="px-3 py-1 bg-slate-800 hover:bg-purple-900/50 border border-slate-700 text-purple-300 text-sm rounded-lg transition">Edit</button>
                                <button wire:click="delete({{ $product->id }})" class="px-3 py-1 bg-red-950/60 hover:bg-red-900 border border-red-800 text-red-300 text-sm rounded-lg transition">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-500">No products found. Add your first product above!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($showModal)
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-md flex items-center justify-center z-50 p-4">
            <div class="bg-slate-900 border border-purple-500/30 rounded-2xl max-w-lg w-full p-6 shadow-2xl">
                <h2 class="text-xl font-bold mb-4 text-purple-300">{{ $isEditMode ? 'Edit Product' : 'Create Product' }}</h2>
                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="space-y-4">
                    <div>
                        <label class="block text-sm text-slate-400 mb-1">Product Name</label>
                        <input type="text" wire:model="name" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-1">Category</label>
                        <select wire:model="category" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500 focus:outline-none">
                            <option value="Audio">Audio</option>
                            <option value="Wearables">Wearables</option>
                            <option value="Gaming">Gaming</option>
                            <option value="Accessories">Accessories</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-1">Price ($)</label>
                        <input type="number" step="0.01" wire:model="price" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-2.5 text-slate-100 focus:border-purple-500 focus:outline-none"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl">{{ $isEditMode ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>