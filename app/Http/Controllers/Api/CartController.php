<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Fetch all items in the user's cart.
     */
    public function index()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $shipping = 500; // Define fixed or dynamic shipping cost
        $total = $subtotal + $shipping;

        return response()->json([
            'cart_items' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    /**
     * Toggle a product in the cart.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|in:add,remove',
        ]);

        $productId = $request->input('product_id');
        $userId = auth()->id();
        $action = $request->input('action');

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($action === 'remove' && $cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Product removed from cart']);
        }

        if (!$cartItem) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Product added to cart']);
    }

    /**
     * Increase product quantity in the cart.
     */
    public function increaseQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $userId = auth()->id();

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            return response()->json(['message' => 'Quantity increased']);
        }

        return response()->json(['message' => 'Product not found in cart'], 404);
    }

    /**
     * Decrease product quantity in the cart.
     */
    public function decreaseQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $userId = auth()->id();

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
                return response()->json(['message' => 'Quantity decreased']);
            } else {
                $cartItem->delete();
                return response()->json(['message' => 'Product removed from cart']);
            }
        }

        return response()->json(['message' => 'Product not found in cart'], 404);
    }

    /**
     * Checkout and clear the cart.
     */
    public function checkout()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        // Handle order logic here, e.g., create an Order record

        Cart::where('user_id', $userId)->delete();

        return response()->json(['message' => 'Order placed successfully']);
    }
}
