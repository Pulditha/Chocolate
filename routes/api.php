<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{RegisterController, LoginController};
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\CartController;



// Route::get('/user', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:sanctum');
    
    
    Route::get('/',function(){
        return 'API';
    });
    
    // Route::get('/user', function (Request $request) {
        //     return $request->user();
        // })->middleware('auth:sanctum');
        
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'apiLogout'])->name('logout')->middleware('auth:sanctum');
        
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle']);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'remove']);
    Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/toggle', [CartController::class, 'toggle']);
    Route::post('/cart/increase-quantity', [CartController::class, 'increaseQuantity']);
    Route::post('/cart/decrease-quantity', [CartController::class, 'decreaseQuantity']);
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
});


