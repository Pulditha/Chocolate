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
        $totalCustomers = User::count(); // Assuming all users are customers

        // Customer Growth (Monthly Growth)
        $customerGrowth = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->pluck('count', 'month')
            ->toArray();

        // Hardcoded Data for Orders by Status and Top-Selling Products
        $ordersByStatus = [
            'Pending' => 45,
            'Shipped' => 120,
            'Delivered' => 200,
            'Cancelled' => 10,
        ];

        // $topSellingProducts = Product::select('name', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.total_price) as total_revenue'))
        //     ->join('order_items', 'order_items.product_id', '=', 'products.id')
        //     ->groupBy('products.id')
        //     ->orderByDesc('total_quantity')
        //     ->limit(5)
        //     ->get();

        // Pass to view
        return view('admins.dashboard', compact('activeProducts', 'outOfStockProducts', 'totalCustomers', 'customerGrowth', 'ordersByStatus'));
    }
}
