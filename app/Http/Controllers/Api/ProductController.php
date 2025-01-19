<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the products (for mobile app).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all(); // Get all products

        return response()->json([
            'products' => $products
        ], 200);
    }

    /**
     * Show a single product's details (for mobile app).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Get product IDs in the user's cart (if authenticated)
        $cartProductIds = auth()->check() 
            ? auth()->user()->cart->pluck('product_id')->toArray() 
            : []; // Empty array for guests

        return response()->json([
            'product' => $product,
            'cartProductIds' => $cartProductIds
        ], 200);
    }
    

    /**
     * Get products for the store front (for mobile app).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeFront()
    {
        $products = Product::paginate(9);

        // Wishlist product IDs for the logged-in user
        $wishlistProductIds = auth()->check() 
            ? Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray() 
            : [];

        // Cart product IDs for the logged-in user
        $cartProductIds = auth()->check() 
            ? Cart::where('user_id', auth()->id())->pluck('product_id')->toArray() 
            : [];

        return response()->json([
            'products' => $products,
            'wishlistProductIds' => $wishlistProductIds,
            'cartProductIds' => $cartProductIds
        ], 200);
    }
}