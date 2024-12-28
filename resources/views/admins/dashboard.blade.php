@extends('layouts.admin-nav')

@section('content')
<div class="container mx-auto p-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Sales Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Sales</h2>
            <p class="text-3xl font-bold text-green-500 mt-2">LKR 50,000</p> <!-- Hard-coded -->
        </div>

        <!-- Total Orders Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Orders</h2>
            <p class="text-3xl font-bold text-blue-500 mt-2">120</p> <!-- Hard-coded -->
        </div>

        <!-- Total Products Sold Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Products Sold</h2>
            <p class="text-3xl font-bold text-purple-500 mt-2">300</p> <!-- Hard-coded -->
        </div>

        <!-- Active Products Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Active Products</h2>
            <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $activeProducts }}</p>
        </div>

        <!-- Out-of-Stock Products Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Out-of-Stock Products</h2>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ $outOfStockProducts }}</p>
        </div>

        <!-- Total Customers Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Customers</h2>
            <p class="text-3xl font-bold text-indigo-500 mt-2">{{ $totalCustomers }}</p>
        </div>
    </div>

    <!-- Graphs Section -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Orders by Status (Hardcoded) -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Orders by Status</h2>
            <canvas id="ordersStatusChart"></canvas>
        </div>

        <!-- Top-Selling Products (Hardcoded) -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Top-Selling Products</h2>
            <canvas id="topSellingProductsChart"></canvas>
        </div>

        <!-- Customer Growth (Dynamic) -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Customer Growth</h2>
            <canvas id="customerGrowthChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Orders by Status - Hardcoded Pie Chart
    var ordersStatusCtx = document.getElementById('ordersStatusChart').getContext('2d');
    var ordersStatusChart = new Chart(ordersStatusCtx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Shipped', 'Delivered', 'Cancelled'],
            datasets: [{
                data: [45, 120, 200, 10],
                backgroundColor: ['#FFA500', '#28a745', '#007bff', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
        }
    });

    // Top-Selling Products - Hardcoded Bar Chart
    // var topSellingProductsCtx = document.getElementById('topSellingProductsChart').getContext('2d');
    // var topSellingProductsChart = new Chart(topSellingProductsCtx, {
    //     type: 'bar',
    //     data: {
    //         labels: ['Product 1', 'Product 2', 'Product 3', 'Product 4', 'Product 5'],
    //         datasets: [{
    //             label: 'Quantity Sold',
    //             data: [150, 200, 250, 180, 220],
    //             backgroundColor: '#007bff',
    //             borderColor: '#0056b3',
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // Customer Growth - Dynamic Line Chart
    var customerGrowthCtx = document.getElementById('customerGrowthChart').getContext('2d');
    var customerGrowthChart = new Chart(customerGrowthCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($customerGrowth)) !!},  // Month numbers as labels
            datasets: [{
                label: 'Customer Growth',
                data: {!! json_encode(array_values($customerGrowth)) !!},  // Customer counts per month
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
