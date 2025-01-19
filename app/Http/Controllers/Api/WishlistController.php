<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;

class WishlistController extends Controller
{
    // Fetch all wishlist items for the authenticated user
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wishlistItems = Wishlist::where('user_id', $user->id)
                                  ->with('product') // Ensure Wishlist has a 'product' relationship
                                  ->get();

        return response()->json($wishlistItems);
    }

    // Toggle a product in the wishlist
    public function toggle(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $productId = $request->input('product_id');
        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $productId)
                                ->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();

            return response()->json([
                'status' => 'removed',
                'message' => 'Product removed from wishlist.',
            ]);
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);

            return response()->json([
                'status' => 'added',
                'message' => 'Product added to wishlist.',
            ]);
        }
    }

    // Remove a specific product from the wishlist
    public function remove($productId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $productId)
                                ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['message' => 'Product removed from wishlist']);
        }

        return response()->json(['message' => 'Product not found in wishlist'], 404);
    }

    // Move all wishlist items to cart
    public function moveToCart()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $wishlistItems = Wishlist::where('user_id', $user->id)->get();

        if ($wishlistItems->isEmpty()) {
            return response()->json(['message' => 'Wishlist is empty'], 400);
        }

        foreach ($wishlistItems as $item) {
            $cartItem = Cart::firstOrCreate(
                ['user_id' => $user->id, 'product_id' => $item->product_id],
                ['quantity' => 1] // Adjust default quantity if needed
            );

            $item->delete();
        }

        return response()->json(['message' => 'Wishlist items moved to cart']);
    }
}
