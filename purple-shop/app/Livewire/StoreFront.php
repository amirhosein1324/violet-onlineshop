<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class StoreFront extends Component
{
    public $search = '';
    public $selectedCategory = 'All';

    // Cart State
    public $cart = []; // [product_id => ['product' => Product, 'quantity' => int]]
    public $isCartOpen = false;

    // Quick View Modal State
    public $selectedProduct = null;
    public $isModalOpen = false;
    public $modalQuantity = 1;

    public function mount()
    {
        // Initialize empty session cart if needed
        $this->cart = session()->get('cart', []);
    }

    // --- CART ACTIONS ---
    public function addToCart($productId,$quantity = 1)
    {
        $product = Product::find($productId);
        if (!$product) return;

        if (isset($this->cart[$productId])) {$this->cart[$productId]['quantity'] +=$quantity;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $this->cart);
        $this->dispatch('item-added', name:$product->name);
        
        if ($this->isModalOpen) {$this->closeModal();
        }
    }

    public function updateQuantity($productId,$change)
    {
        if (isset($this->cart[$productId])) {$this->cart[$productId]['quantity'] +=$change;

            if ($this->cart[$productId]['quantity'] <= 0) {
                unset($this->cart[$productId]);
            }

            session()->put('cart', $this->cart);
        }
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
        session()->put('cart', $this->cart);
    }

    public function toggleCart()
    {
        $this->isCartOpen = !$this->isCartOpen;
    }

    // --- PRODUCT MODAL ACTIONS ---
    public function openModal($productId)
    {
        $this->selectedProduct = Product::with('category')->find($productId);$this->modalQuantity = 1;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedProduct = null;
    }

    // Computed total count
    public function getCartCountProperty()
    {
        return array_sum(array_column($this->cart, 'quantity'));
    }

    // Computed total price
    public function getCartTotalProperty()
    {
        return array_reduce($this->cart, function ($total,$item) {
            return $total + ($item['price'] *$item['quantity']);
        }, 0);
    }

    public function render()
    {
        $categories = Category::all();

        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '\%' .$this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory !== 'All', function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('name',$this->selectedCategory);
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