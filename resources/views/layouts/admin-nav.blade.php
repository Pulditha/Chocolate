<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-brown-700 text-white flex flex-col">

        <div class="p-1 text-center">
        <div class="font-anton text-sm">BARS ADMIN DASHBOARD</div>
          </div>
          
        <!-- Logo / Title -->
        <div class="p-4 text-center">
          <!-- Font Awesome icon -->
          <a href="{{ route('admin.dashboard') }}" >
            <div class="font-anton text-5xl">BARS</div>
          </a>
        </div>

        <div class="text-6xl text-center space-y-2">
            <a href="{{ route('admin.dashboard') }}" >
            <i class="fa-solid fa-cookie-bite"></i>
        </a>
        </div>

        <!-- User Info -->
        <div class="p-4 flex flex-col items-center ">
            <span class="font-anton text-xl">Welcome {{ Auth::user()->name }}</span>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('home') }}" target="_blank" class=" p-2 hover:bg-brown-800 rounded flex items-center justify-between">Visit Store  <i class="fa-solid fa-arrow-up-right-from-square"></i>  </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-brown-800 rounded">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.analytics') }}" class="block p-2 hover:bg-brown-800 rounded">Analytics</a>
                </li>
                <li>
                    <button
                        id="pages-toggle"
                        class="w-full text-left block p-2 hover:bg-brown-800 rounded"
                    >
                        Pages
                    </button>
                    <ul
                        id="pages-menu"
                        class="hidden bg-brown-600 space-y-1 rounded p-2 mt-1"
                    >
                        <li><a href="{{ route('admin.pages.home') }}" class="block hover:bg-brown-700 p-1 rounded">Homepage</a></li>
                        <li><a href="{{ route('admin.pages.store') }}" class="block hover:bg-brown-700 p-1 rounded">Store Page</a></li>
                        <li><a href="{{ route('admin.pages.about') }}" class="block hover:bg-brown-700 p-1 rounded">About Us</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="block p-2 hover:bg-brown-800 rounded">Orders</a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="block p-2 hover:bg-brown-800 rounded">Products</a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="block p-2 hover:bg-brown-800 rounded">Users</a>
                </li>
                <li>
                    <a href="{{ route('admin.profile') }}" class="block p-2 hover:bg-brown-800 rounded">Profile</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-6">
        @yield('content') <!-- Dynamic Content Will Be Injected Here -->
    </main>
    
</div>





<!-- JavaScript -->
<script>
    // Toggle Pages Dropdown Menu
    const pagesToggle = document.getElementById('pages-toggle');
    const pagesMenu = document.getElementById('pages-menu');

    pagesToggle.addEventListener('click', () => {
        pagesMenu.classList.toggle('hidden');
    });
</script>

</body>
</html>
