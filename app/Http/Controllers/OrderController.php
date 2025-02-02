<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Controllers\CheckoutController;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get(); // Get orders by user ID
        return view('orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::where('id', $id)->where('email', auth()->user()->email)->firstOrFail();
        $order->delete();
        return redirect()->back()->with('status', 'Order deleted successfully.');
    }
}
