<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Display Wishlist Page
    public function index()
    {
        $wishlistIds = session()->get('wishlist', []);
        $products = Product::whereIn('id', $wishlistIds)->get();

        return view('wishlist.index', compact('products'));
    }

    // Toggle (Add/Remove) item in Wishlist
    public function toggle(Product $product)
    {
        $wishlist = session()->get('wishlist', []);

        if (in_array($product->id, $wishlist)) {
            // Remove from wishlist
            $wishlist = array_diff($wishlist, [$product->id]);
            $message = 'Item removed from your wishlist.';
        } else {
            // Add to wishlist
            $wishlist[] = $product->id;
            $message = 'Item added to your wishlist!';
        }

        session()->put('wishlist', $wishlist);

        return back()->with('success', $message);
    }
}