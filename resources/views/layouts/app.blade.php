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
    @livewireStyles
</head>

@if (session('error'))
    <div id="errorMessage" class="fixed top-0 left-0 w-full bg-red-500 text-white py-4 px-6 shadow-lg z-50">
        <div class="flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button id="dismissButton" class="text-white bg-red-700 px-4 py-2 rounded hover:bg-red-600 focus:outline-none">
                OK
            </button>
        </div>
    </div>
@endif



<body class="bg-gray-200 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

<!-- Header (Sticky) -->
<header class="fixed top-0 left-0 w-full bg-white z-50 shadow">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-2xl md:text-5xl font-anton text-brown-700 hover:text-brown-600">  
            BARS  
        </a>  

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex space-x-10 font-anton text-2xl relative">
            <a href="{{ url('/') }}" class="relative text-brown-700 hover:text-brown-600">HOME</a>
            <a href="{{ route('shop') }}" class="relative text-brown-700 hover:text-brown-600">PRODUCTS</a>
            <a href="{{ route('about') }}" class="relative text-brown-700 hover:text-brown-600">ABOUT US</a>
            @auth
                <a href="{{ route('account') }}" class="relative text-brown-700 hover:text-brown-600">MY ACCOUNT</a>
            @else
                <a href="{{ route('login') }}" class="relative text-brown-700 hover:text-brown-600">MY ACCOUNT</a>
            @endauth
        </nav>

        <!-- Mobile Icons & Hamburger -->
        <div class="flex items-center space-x-4 lg:hidden">
            <a href="{{ route('wishlist.index') }}" class="text-brown-700 text-xl hover:text-brown-600">
                <i class="fas fa-heart"></i>
            </a>
            <a href="{{ route('cart.index') }}" class="text-brown-700 text-xl hover:text-brown-600">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <button class="text-brown-700 text-2xl focus:outline-none" id="menu-btn">
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
            <a href="{{ url('/') }}" class="hover:text-gray-300 {{ request()->is('/') ? 'line-through decoration-red-500' : '' }}">HOME</a>
            <a href="{{ route('shop') }}" class="hover:text-gray-300 {{ request()->is('shop') ? 'line-through decoration-red-500' : '' }}">PRODUCTS</a>
            <a href="{{ route('about') }}" class="hover:text-gray-300 {{ request()->is('about') ? 'line-through decoration-red-500' : '' }}">ABOUT US</a>
            @auth
                <a href="{{ route('account') }}" class="hover:text-gray-300 {{ request()->is('account') ? 'line-through decoration-red-500' : '' }}">MY ACCOUNT</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-gray-300 {{ request()->is('login') ? 'line-through decoration-red-500' : '' }}">MY ACCOUNT</a>
            @endauth

            <!-- Mobile Icons Inside Hamburger Menu -->
            <div class="flex space-x-6 mt-6">
                <a href="{{ route('wishlist.index') }}" class="text-white text-2xl hover:text-gray-300 ">
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

        <!-- Desktop Icons -->
        <div class="hidden lg:flex items-center space-x-6 text-2xl">
            <a href="{{ route('wishlist.index') }}" class="text-brown-700 hover:text-brown-600">
                <i class="fas fa-heart"></i>
            </a>
            <a href="{{ route('cart.index') }}" class="text-brown-700 hover:text-brown-600">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="{{ url('shop#searchtitle') }}" class="text-brown-700 hover:text-brown-600">
                <i class="fas fa-search"></i>
            </a>
            @auth
                <a href="{{ url('/account') }}" class="text-brown-700 hover:text-brown-600">
                    <i class="fas fa-user"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-brown-700 hover:text-brown-600">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
        </div>
    </div>
</header>



    <!-- Main Content (Add padding to prevent overlap with fixed header) -->
    <main class="container mx-auto pt-24 py-8 flex-1">

        @yield('content')
        @livewireScripts
    </main>

   <!-- Footer -->  
<!-- Footer -->  
<footer class="bg-brown-700 text-white py-10 px-5 md:px-10">  
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">  
        <!-- Social Links -->  
        <div class="hidden md:flex flex-col items-start">  
            <h3 class="text-lg font-semibold">Follow Us</h3>  
            <div class="flex space-x-4 mt-4">  
                <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-facebook-f"></i></a>  
                <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-twitter"></i></a>  
                <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-instagram"></i></a>  
                <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-linkedin-in"></i></a>  
            </div>  
        </div>  

        <!-- Footer Navigation -->  
        <div class="flex flex-col items-start"> <!-- Updated to keep it vertical with flex-col -->  
            <h3 class="text-lg font-anton">Quick Links</h3>  
            <nav class="flex space-x-4 mt-4"> <!-- Change to space-x-4 to arrange horizontally -->  
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-white font-anton">Home</a>  
                <a href="{{ route('shop') }}" class="text-gray-300 hover:text-white font-anton">Shop</a>  
                <a href="{{ route('about') }}" class="text-gray-300 hover:text-white font-anton">About Us</a>  
                <a href="{{ route('wishlist.index') }}" class="text-gray-300 hover:text-white font-anton">Wishlist</a>  
                <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white font-anton">Cart</a>  
            </nav>  
        </div>  

        <!-- Newsletter Section -->  
        <div class="hidden md:flex flex-col items-start ">  
            <h3 class="text-lg font-semibold">Stay Updated</h3>  
            <p class="text-gray-300 mt-4">  
                Subscribe to our newsletter for the latest deals and updates!  
            </p>  
            <form class="mt-4 flex flex-col md:flex-row space-x-0 md:space-x-2">  
                <input type="email" placeholder="Enter your email"  
                       class="w-full px-4 py-2 rounded bg-gray-300 text-brown-700 border border-gray-600 focus:outline-none mb-2 md:mb-0">  
                <button class="px-4 py-2 bg-gray-300 text-brown-700 rounded hover:bg-brown-500">  
                    Subscribe  
                </button>  
            </form>  
        </div>  
    </div>  

    <!-- Copyright Section -->  
    <div class="mt-10 border-t border-white pt-6 text-center">  
        <p class="text-gray-400">  
            &copy; {{ date('Y') }} BARS. All rights reserved.  
        </p>  
        <div class="text-center text-sm text-gray-300 mt-4">  
            Created by: Pulditha Wathsal | CB011498 | CB011498@students.apiit.lk  
        </div>  
    </div>  
</footer>
    <!-- Dismiss Button Script -->
    <script>
        document.getElementById('dismissButton')?.addEventListener('click', () => {
            document.getElementById('errorMessage').remove();
        });

        setTimeout(() => {
            document.getElementById('errorMessage')?.remove();
        }, 5000);



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
