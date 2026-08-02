<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductReviews extends Component
{
    public $productId;
    public $rating = 5;
    public $comment = '';

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:5|max:500',
    ];

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function submitReview()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to submit a review.');
            return;
        }

        $this->validate();

        // Optional: Ensure user has only reviewed once per product
        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
            ],
            [
                'rating' => $this->rating,
                'comment' => $this->comment,
            ]
        );

        $this->comment = '';
        $this->rating = 5;

        session()->flash('message', 'Thank you! Your review has been submitted.');
    }

    public function render()
    {
        $product = Product::with(['reviews.user'])->findOrFail($this->productId);
        $reviews = $product->reviews()->latest()->get();

        return view('livewire.product-reviews', [
            'product' => $product,
            'reviews' => $reviews,
            'avgRating' => $product->averageRating(),
        ]);
    }
}