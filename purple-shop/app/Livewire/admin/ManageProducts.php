<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $products, $name, $description, $price, $category, $image, $product_id;
    public $isEditing = false;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string',
        'image' => 'nullable|image|max:2048', // Max 2MB
    ];

    public function render()
    {
        $this->products = Product::latest()->get();
        return view('livewire.admin.manage-products');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->image = null;
        $this->product_id = null;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => strtolower($this->category),
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Product created successfully!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category = $product->category;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($this->product_id);

        $imagePath = $product->image;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => strtolower($this->category),
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Product updated successfully!');
        $this->resetFields();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully!');
    }
}