@extends('layouts.app')

@section('content')
<div class="container mx-auto  flex flex-col md:flex-row ">
    <!-- Left Section -->
    <div class="flex flex-col items-center justify-center md:w-1/3 p-6 h-[calc(100vh-3rem)] border-r-2 border-brown-700">
        <!-- User Avatar -->
        <div class="w-64 h-64 bg-brown-700 text-white flex items-center justify-center rounded-full text-9xl font-anton">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <!-- User Info -->
        <h2 class="mt-4 text-3xl font-semibold">{{ auth()->user()->name }}</h2>
        <p class="text-gray-600">{{ auth()->user()->email }}</p>
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded">
                Logout
            </button>
        </form>
    </div>
    

 <!-- Right Section -->
 <div class="flex flex-col md:w-2/3 p-6 space-y-4 justify-center">
    <!-- Profile Manage -->
    <div onclick="window.location.href='{{ route('profile.edit') }}'" 
        class="p-7 rounded-lg hover:bg-gray-100 transition duration-300 cursor-pointer border-b border-gray-300">
        <a href="{{ route('profile.edit') }}" class="text-xl font-semibold text-brown-700 hover:underline">
            Manage Profile
        </a>
        <p class="text-gray-600">Update your personal information and settings here.</p>
    </div>

    <!-- Orders -->
    <div onclick="window.location.href='{{ route('orders.index') }}'" 
        class="p-7 rounded-lg hover:bg-gray-100 transition duration-300 cursor-pointer border-b border-gray-300">
        <a href="{{ route('orders.index') }}" class="text-xl font-semibold text-brown-700 hover:underline">
            Orders
        </a>
        <p class="text-gray-600">Track and manage your orders.</p>
    </div>

    <!-- Wishlist -->
    <div onclick="window.location.href='{{ route('wishlist.index') }}'" 
        class="p-7 rounded-lg hover:bg-gray-100 transition duration-300 cursor-pointer border-b border-gray-300">
        <a href="{{ route('wishlist.index') }}" class="text-xl font-semibold text-brown-700 hover:underline">
            Wishlist
        </a>
        <p class="text-gray-600">View and manage your wishlist.</p>
    </div>

    <!-- Cart -->
    <div onclick="window.location.href='{{ route('cart.index') }}'" 
        class="p-7 rounded-lg hover:bg-gray-100 transition duration-300 cursor-pointer border-b border-gray-300">
        <a href="{{ route('cart.index') }}" class="text-xl font-semibold text-brown-700 hover:underline">
            Cart
        </a>
        <p class="text-gray-600">View and manage your cart.</p>
    </div>
</div>

</div>
@endsection
