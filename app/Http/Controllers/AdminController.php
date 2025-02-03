<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request; 
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        return view('admins.dashboard'); // Admin dashboard view
    }

    
    public function manageOrders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admins.orders', compact('orders'));
      
    }
    
    public function manageProducts()
    {
        return view('admins.products');
    }
    
    public function manageUsers()
    {
        return view('admins.users');
    }
    

}