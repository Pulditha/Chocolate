<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Toggle a product in the cart.
     */
    public function toggleCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $productId = $request->input('product_id');
        $userId = auth()->id();
        $action = $request->input('action'); // e.g., 'add' or 'remove'
    
        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }
    
        $cartItem = Cart::where('product_id', $productId)
                        ->where('user_id', $userId)
                        ->first();
    
                        if ($action === 'remove' && $cartItem) {
                            $cartItem->delete();
                            return redirect()->route('cart.index')->with('status', 'Product removed from cart');
                        }
        if ($cartItem) {
            $cartItem->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Product removed from cart',
            ]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Product added to cart',
            ]);
        }
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
            return redirect()->back()->with('success', 'Quantity increased.');
        }

        return redirect()->back()->withErrors('Product not found in cart.');
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
                return redirect()->back()->with('success', 'Quantity decreased.');
            } else {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Product removed from cart.');
            }
        }

        return redirect()->back()->withErrors('Product not found in cart.');
    }

    /**
     * Display the cart items.
     */
    public function index()
    {
        $userId = auth()->id();
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }
    
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
    
        // Calculate subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    
        // Define shipping cost
        $shipping = 500; // You can make this dynamic if needed
    
        // Calculate total
        $total = $subtotal + $shipping;
    
        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }
    
    public function orderSummary()
{
    // Fetch cart items from session or database
    $cartItems = auth()->user()->cartItems ?? Session::get('cart', []);

    return view('order-summary', compact('cartItems'));
}

public function checkout()
{
    $cartItems = auth()->user()->cartItems ?? Session::get('cart', []);

    if (empty($cartItems)) {
        return redirect()->route('cart')->with('status', 'Your cart is empty!');
    }

    // Handle checkout logic (e.g., payment processing, order saving)
    // Example: Save order details in the database

    // Clear the cart
    if (auth()->check()) {
        auth()->user()->cartItems()->delete();
    } else {
        Session::forget('cart');
    }

    return redirect()->route('shop')->with('status', 'Order placed successfully!');
}
}
