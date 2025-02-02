<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- External Nav Bar -->
<header class="bg-transparent absolute top-0 left-0 w-full z-10 shadow-none">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-5xl font-anton text-brown-700 hover:text-brown-600">
            BARS
        </a>
        <!-- Page Title with Back Button -->
        <div class="flex items-center space-x-4">
            <a href="javascript:history.back()" class="text-8xl text-brown-700 font-anton">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-8xl text-brown-700 font-anton uppercase md:uppercase">
                @yield('page-title', 'Page Title')
            </h1>
        </div>

        <div class="flex items-center space-x-10 text-2xl">
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
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto ">
    <body class="font-anton">
        <div class="flex flex-col sm:justify-center items-center min-h-screen pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4  bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</main>

<!-- Optional Footer -->
<footer class="bg-brown-700 text-white py-8">
    <div class="container mx-auto text-center">
        <p class="text-sm text-gray-300">© {{ date('Y') }} BARS. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
