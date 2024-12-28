<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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


<body class="bg-gray-200 font-sans leading-normal tracking-normal">
    <!-- Header -->
    <header class="bg-transparent absolute top-0 left-0 w-full z-10 shadow-none">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-5xl font-anton text-brown-700 hover:text-brown-600">
            BARS
        </a>

        <!-- Navigation Links -->
        <nav class="flex space-x-40 font-anton text-2xl">
            <a href="/shop" class="text-brown-700 hover:text-brown-600">PRODUCTS</a>
            <a href="/about" class="text-brown-700 hover:text-brown-600">ABOUT US</a>
            @auth
            <a href="/account" class="text-brown-700 hover:text-brown-600">MY ACCOUNT</a>
        @else
            <a href="{{ route('login') }}" class="text-brown-700 hover:text-brown-600">MY ACCOUNT</a>
        @endauth
    </nav>

        <!-- Icons Section -->
        <div class="flex items-center space-x-10 text-2xl">
            <a href="/wishlist" class="text-brown-700 hover:text-brown-600">
                <i class="fas fa-heart"></i>
            </a>
            <a href="/cart" class="text-brown-700 hover:text-brown-600">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="#" class="text-brown-700 hover:text-brown-600">
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
    </div>
</header>   
    <!-- Main Content -->
    <main class="container mx-auto  py-8">
        @yield('content')
        @livewireScripts
    </main>

    <!-- Footer -->
    <footer class="bg-brown-700 text-white py-10 px-10 ">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Social Links -->
            <div class="flex flex-col items-start">
                <h3 class="text-lg ">Follow Us</h3>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-white hover:text-gray-400">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-400">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-400">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-400">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
    
            <!-- Footer Navigation -->
            <div>
                <h3 class="text-lg font-anton">Quick Links</h3>
                <nav class="flex justify-start space-x-4 mt-4">
                    <a href="/" class="text-gray-300 hover:text-white font-anton">Home</a>
                    <a href="/shop" class="text-gray-300 hover:text-white font-anton">Shop</a>
                    <a href="/about" class="text-gray-300 hover:text-white font-anton">About Us</a>
                    <a href="/wishlist" class="text-gray-300 hover:text-white font-anton">Wishlist</a>
                    <a href="/cart" class="text-gray-300 hover:text-white font-anton">Cart</a>
                </nav>
            </div>
    
            <!-- Newsletter Section -->
            <div class="flex flex-col items-start">
                <h3 class="text-lg ">Stay Updated</h3>
                <p class="text-gray-300 mt-4">
                    Subscribe to our newsletter for the latest deals and updates!
                </p>
                <form class="mt-4 flex space-x-2">
                    <input type="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 rounded bg-gray-300 text-brown-700 border border-gray-600 focus:outline-none">
                    <button class="px-4 py-2 bg-gray-300 text-brown-700 rounded hover:bg-brown-500">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    
        <!-- Copyright Section -->
        <div class="mt-10 border-t border-white pt-6 text-center">
            <p class="text-gray-400">
                &copy; {{ date('Y') }} BARS. All rights reserved. I think..
            </p>
            <div class="text-center text-sm text-white-600 mt-4">
                Created by : Pulditha Wathsal | CB011498 | CB011498@students.apiit.lk
            </div>
        </div>
    </footer>
       <!-- Dismiss Button Script -->
       <script>
        // Dismiss button functionality
        document.getElementById('dismissButton')?.addEventListener('click', () => {
            document.getElementById('errorMessage').remove();
        });
    
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            document.getElementById('errorMessage')?.remove();
        }, 5000);
    </script>
</body>
</html>
