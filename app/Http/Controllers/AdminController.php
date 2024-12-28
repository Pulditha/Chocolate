<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  

class AdminController extends Controller
{
    public function index()
    {
        return view('admins.dashboard'); // Admin dashboard view
    }
    public function analytics()
    {
        return view('admins.analytics');
    }
    
    public function manageOrders()
    {
        return view('admins.orders');
    }
    
    public function manageProducts()
    {
        return view('admins.products');
    }
    
    public function manageUsers()
    {
        return view('admins.users');
    }
    
    public function editHomepage()
    {
        return view('admins.pages.home');
    }
    
    public function editStorepage()
    {
        return view('admins.pages.store');
    }
    
    public function editAboutPage()
    {
        return view('admins.pages.about');
    }
    
    public function editProfilePage()
    {
        return view('admins.profile');
    }
}