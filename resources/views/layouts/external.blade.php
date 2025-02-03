<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bars-Chocolate</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    <!-- External Nav Bar -->
    <header class="bg-transparent absolute top-0 left-0 w-full z-10 shadow-none">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-2xl md:text-5xl font-anton text-brown-700 hover:text-brown-600">
                BARS
            </a>
            <!-- Page Title with Back Button -->
            <div class="flex items-center space-x-4">
                <a href="javascript:history.back()" class="text-4xl md:text-8xl text-brown-700 font-anton">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-4xl md:text-8xl text-brown-700 font-anton uppercase md:uppercase">
                    @yield('page-title', 'Page Title')
                </h1>
            </div>

            <div class="hidden md:flex items-center space-x-10 text-2xl">
                <a href="/wishlist" class="text-brown-700 hover:text-brown-600">
                    <i class="fas fa-heart"></i>
                </a>
                <a href="/cart" class="text-brown-700 hover:text-brown-600">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="shop#searchtitle" class="text-brown-700 hover:text-brown-600">
                    <i class="fas fa-search"></i>
                </a>
                @auth
                    <a href="/account" class="text-brown-700 hover:text-brown-600">
                        <i class="fas fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-brown-700 hover:text-brown-600">
                        <i class="fas fa-user"></i>
                    </a>
                @endauth
            </div>

            <button class="md:hidden text-brown-700 text-2xl focus:outline-none" id="menu-btn">
                <i class="fas fa-bars"></i> <!-- Hamburger Icon -->
            </button>
        </div>
        <!-- Mobile Fullscreen Menu -->
        <div class="fixed inset-0 bg-brown-700 text-white flex flex-col items-center justify-center text-3xl font-anton space-y-8 opacity-0 invisible transition-all duration-300"
            id="mobile-menu">
            <!-- Close Button -->
            <button class="absolute top-6 right-6 text-white text-2xl focus:outline-none" id="close-menu">
                <i class="fas fa-times"></i> <!-- X (Close) Icon -->
            </button>

            <!-- Navigation Links -->
            <a href="{{ url('/') }}" class="hover:text-gray-300">HOME</a>
            <a href="{{ route('shop') }}" class="hover:text-gray-300">PRODUCTS</a>
            <a href="{{ route('about') }}" class="hover:text-gray-300">ABOUT US</a>
            @auth
                <a href="{{ route('account') }}" class="hover:text-gray-300">MY ACCOUNT</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-gray-300">MY ACCOUNT</a>
            @endauth

            <!-- Mobile Icons Inside Hamburger Menu -->
            <div class="flex space-x-6 mt-6">
                <a href="{{ route('wishlist.index') }}" class="text-white text-2xl hover:text-gray-300">
                    <i class="fas fa-heart"></i>
                </a>
                <a href="{{ route('cart.index') }}" class="text-white text-2xl hover:text-gray-300">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="{{ url('shop#searchtitle') }}" class="text-white text-2xl hover:text-gray-300">
                    <i class="fas fa-search"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-24 flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-brown-700 text-white py-8 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-sm text-gray-300">© {{ date('Y') }} BARS. All rights reserved.</p>
        </div>
    </footer>


    <script>
        
    const menuBtn = document.getElementById("menu-btn");
    const closeMenuBtn = document.getElementById("close-menu");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.remove("opacity-0", "invisible");
    });

    closeMenuBtn.addEventListener("click", () => {
        mobileMenu.classList.add("opacity-0", "invisible");
    });

    </script>
</body>
</html>
