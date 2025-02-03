@extends('layouts.admin-nav')

@section('content')


<div class="container mx-auto p-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Sales Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Sales</h2>
            <p class="text-3xl font-bold text-green-500 mt-2">Rs {{$totalSales}}</p>
        </div>

        <!-- Total Orders Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Orders</h2>
            <p class="text-3xl font-bold text-purple-500 mt-2">{{$totalOrders}}</p>
        </div>

        <!-- Total Products Sold Card -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Products Sold</h2>
            <p class="text-3xl font-bold text-purple-500 mt-2">{{$totalOrders}}</p>
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
        <!-- Revenue Graph -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Revenue Over Time</h2>
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Available vs Out of Stock Pie Chart -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Stock Status</h2>
            <canvas id="stockChart"></canvas>
        </div>

        <!-- Customer Growth Chart -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700">Customer Growth</h2>
            <canvas id="customerGrowthChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Revenue Chart
    var revenueData = @json($revenueData);
    revenueData.sort((a, b) => new Date(a.date) - new Date(b.date)); // Ensure sorting by date

    var revenueLabels = revenueData.map(data => data.date);
    var revenueValues = revenueData.map(data => parseFloat(data.revenue)); // Ensure numeric values

    new Chart(document.getElementById("revenueChart"), {
        type: 'line',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: "Revenue (Rs)",
                data: revenueValues,
                borderColor: "rgba(75, 192, 192, 1)",
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Stock Status Pie Chart
    new Chart(document.getElementById("stockChart"), {
        type: 'pie',
        data: {
            labels: ["Available Products", "Out of Stock"],
            datasets: [{
                data: [{{ $activeProducts }}, {{ $outOfStockProducts }}],
                backgroundColor: ["#4CAF50", "#F44336"]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Customer Growth Chart
    var customerGrowthData = @json($customerGrowthData);
    customerGrowthData.sort((a, b) => new Date(a.date) - new Date(b.date)); // Ensure sorting by date

    var customerLabels = customerGrowthData.map(data => data.date);
    var customerValues = customerGrowthData.map(data => parseInt(data.count)); // Ensure numeric values

    new Chart(document.getElementById("customerGrowthChart"), {
        type: 'bar',
        data: {
            labels: customerLabels,
            datasets: [{
                label: "New Customers",
                data: customerValues,
                backgroundColor: "rgba(54, 162, 235, 0.5)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

@endsection
