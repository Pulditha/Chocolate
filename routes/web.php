<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

Route::get('/storage/{path}', function ($path) {
    if (Storage::exists("public/$path")) {
        return Response::make(Storage::get("public/$path"))
            ->header("Content-Type", Storage::mimeType("public/$path"))
            ->header("Access-Control-Allow-Origin", "*"); // Allow CORS
    }
})->where('path', '.*');


// Public Routes
Route::get('/', fn () => view('home'))->name('home');
Route::get('/shop', [ProductController::class, 'storeFront'])->name('shop.front');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
// Auth Routes for Laravel Breeze
require __DIR__ . '/auth.php';

// Authentication Routes
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// Authenticated Routes for Regular Users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account', fn () => view('account'))->name('account');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->middleware('auth')->name('wishlist.toggle');
    Route::post('/wishlist/remove/{productId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
    Route::get('/profile', fn () => view('profile'))->name('profile');
});

// Admin Routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard'); // Corrected Route
    Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::delete('/users/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // Admin Management Routes
   
    Route::get('/orders', [AdminController::class, 'manageOrders'])->name('admin.orders');
    Route::get('/products', [AdminController::class, 'manageProducts'])->name('admin.products');
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

// Product Routes
Route::resource('products', ProductController::class);


Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/shop', [ProductController::class, 'storeFront'])->name('shop');





Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/toggle', [CartController::class, 'toggleCart'])->name('cart.toggle');
    Route::post('/cart/increase-quantity', [CartController::class, 'increaseQuantity'])->name('cart.increaseQuantity');
    Route::post('/cart/decrease-quantity', [CartController::class, 'decreaseQuantity'])->name('cart.decreaseQuantity');
    Route::get('/checkout', [CheckoutController::class, 'showBillingForm'])->name('checkout.billing');  
});



Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
   
    Route::post('/checkout', [CheckoutController::class, 'storeBillingInfo'])->name('checkout.storeBilling');
    Route::get('/checkout/payment', [CheckoutController::class, 'showPayment'])->name('checkout.payment');
    Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.processPayment');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/success', fn () => view('checkout.success'))->name('success');


});


Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');