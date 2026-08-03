<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Livewire\Checkout;
use App\Livewire\Admin\ManageProducts;
use App\Livewire\Admin\ManageCoupons;
use App\Livewire\Admin\ManageOrders;
use App\Livewire\Customer\OrderHistory;


/*
|--------------------------------------------------------------------------
| Public Storefront Routes
|--------------------------------------------------------------------------
*/

// Home / Main Storefront
Route::get('/', [ProductController::class, 'index'])->name('home');

// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/{product}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

// Checkout (Livewire Component)
Route::get('/checkout', Checkout::class)->name('checkout');




/*
|--------------------------------------------------------------------------
| Authenticated Customer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/my-orders', OrderHistory::class)->name('customer.orders');
});
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Management Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', ManageProducts::class)->name('products');
    Route::get('/coupons', ManageCoupons::class)->name('coupons');
    Route::get('/orders', ManageOrders::class)->name('admin.orders');
});

require __DIR__.'/auth.php';