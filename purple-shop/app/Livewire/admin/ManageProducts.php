<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $products, $name, $description, $price, $category, $image, $product_id;
    public $isEditMode = false;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string',
        'image' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function render()
    {
        $this->products = Product::latest()->get();
        return view('livewire.admin.manage-products')->layout('layouts.app');
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->category = 'Audio';
        $this->image = null;
        $this->product_id = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('products', 'public') : 'products/default.jpg';

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Product Created Successfully!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category = $product->category;
        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);
        $imagePath = $product->image;

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Product Updated Successfully!');
        $this->closeModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully!');
    }
}