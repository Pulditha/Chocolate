<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail; 

class CheckoutController extends Controller
{
    /**
     * Show the billing form.
     */
    public function showBillingForm()
    {
        $user = auth()->user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);
        $shipping = 500;
        $total = $subtotal + $shipping;

        return view('checkout.billing', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Store billing details and proceed to payment.
     */
    public function storeBillingInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        // Save billing details in session
        Session::put('billing_info', $request->only('name', 'email', 'phone', 'address'));

        return redirect()->route('checkout.payment');
    }

    /**
     * Show payment page.
     */
    public function showPayment()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('checkout.payment', compact('cartItems'));
    }

    /**
     * Process Stripe payment.
     */
    public function processPayment()
    {
        $user = auth()->user();
        $billingInfo = Session::get('billing_info');
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if (!$billingInfo || $cartItems->isEmpty()) {
            return redirect()->route('checkout.billing')->with('error', 'Please complete the billing details.');
        }

        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);
        $shipping = 500;
        $total = $subtotal + $shipping;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Create Stripe Checkout Session
        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.payment'),
        ]);

        return redirect($checkoutSession->url);
    }

    /**
     * Handle successful payment.
     */
   
     public function success()
     {
         $user = auth()->user();
         
         if (!$user) {
             return redirect()->route('login')->with('error', 'Please log in to complete your purchase.');
         }
     
         $cartItems = $user->cartItems; // Fetch user's cart items
     
         if ($cartItems->isEmpty()) {
             return redirect()->route('shop')->with('error', 'Your cart is empty.');
         }
     
         // Calculate total amount
         $totalAmount = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);
     
         // Create Order
         $order = Order::create([
            'user_id' => $user->id, // Ensure user_id is set
             'name' => $user->name,
             'email' => $user->email,
             'phone' => $user->phone ?? 'N/A',
             'address' => $user->address ?? 'N/A',
             'total_amount' => $totalAmount,
             'payment_status' => 'paid',
         ]);
     
        
         // ✅ Clear user's cart
         $user->cartItems()->delete();
     
         return redirect()->route('success');
     }
     
     
}
