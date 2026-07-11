<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class StoreFront extends Component
{
    public $search = '';
    public $selectedCategory = 'All';
    public $cartCount = 0;

    public function addToCart($productId)
    {
        $this->cartCount++;
        $this->dispatch('item-added', id: $productId);
    }

    public function render()
    {
        $categories = Category::all();

        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory !== 'All', function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('name', $this->selectedCategory);
                });
            })
            ->with('category')
            ->get();

        return view('livewire.store-front', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}