<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; // Assuming you have a Product model
use App\Models\Wishlist;
use App\Models\Cart; // Assuming you have a Wishlist model

class WishlistController extends Controller


{
    public function index()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'You need to log in to view your wishlist.');
    }

    // Retrieve wishlist items with associated product details
    $wishlistItems = Wishlist::where('user_id', $user->id)
                              ->with('product') // Ensure Wishlist model has this relationship
                              ->get();

    return view('wishlist', ['wishlistItems' => $wishlistItems]);
}


public function toggle(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'You must be logged in to add items to the wishlist.',
        ], 403);
    }

    $productId = $request->input('product_id');
    $wishlistItem = $user->wishlist()->where('product_id', $productId)->first();

    if ($wishlistItem) {
        // Remove from wishlist
        $wishlistItem->delete();
        return response()->json([
            'status' => 'removed',
            'message' => 'Product removed from wishlist.',
        ]);
    } else {
        // Add to wishlist
        $user->wishlist()->create(['product_id' => $productId]);
        return response()->json([
            'status' => 'added',
            'message' => 'Product added to wishlist.',
        ]);
    }
}
public function removeFromWishlist(Request $request, $productId)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    $wishlistItem = Wishlist::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

    if ($wishlistItem) {
        $wishlistItem->delete();
        return response()->json(['success' => true, 'message' => 'Product removed from wishlist']);
    }

    return response()->json(['success' => false, 'message' => 'Product not found'], 404);
}

public function moveToCart()
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'You need to log in to move items to the cart.');
    }

    $wishlistItems = Wishlist::where('user_id', $user->id)->get();

    if ($wishlistItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your wishlist is empty.');
    }

    foreach ($wishlistItems as $item) {
        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $item->product_id)
                        ->first();

        if (!$cartItem) {
            // Add product to cart
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $item->product_id,
                'quantity' => 1, // Adjust quantity as needed
            ]);
        }

        // Remove from wishlist
        $item->delete();
    }

    return redirect()->route('cart.index')->with('success', 'All wishlist items have been moved to your cart.');
}


}
