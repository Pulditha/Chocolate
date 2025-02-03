<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Dynamic Data
        $activeProducts = Product::where('stock_status', 'In Stock')->count();
        $outOfStockProducts = Product::where('stock_status', 'Out of Stock')->count();
        $totalCustomers = User::where('role', 'user')->count(); // Assuming all users are customers
        $totalOrders = Order::count(); // Count total orders
        $totalSales = Order::sum('total_amount'); // Sum of all total_amount values


        $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as revenue')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Customer Growth Data (For Chart)
    $customerGrowthData = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('role', 'customer')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return view('admins.dashboard', compact('activeProducts','customerGrowthData','revenueData','totalSales','totalOrders', 'outOfStockProducts', 'totalCustomers',));
    }
}
