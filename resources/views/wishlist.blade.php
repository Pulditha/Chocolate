@extends('layouts.external')

@section('page-title', 'Wishlist')
@section('content')

@if(session('success'))
    <div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <p id="notification-message">{{ session('success') }}</p>
    </div>
@endif
@if(session('error'))
    <div id="notification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <p id="notification-message">{{ session('error') }}</p>
    </div>
@endif

<div class="container mx-auto px-4 py-8 bg-gray-100 relative">
    <div class="container mx-auto mt-8">
        @if($wishlistItems->isEmpty())
            <p class="text-center text-gray-600 text-lg">Your wishlist is empty.</p>
        @else
            <!-- Responsive Wishlist Layout -->
            <div class="md:hidden grid gap-4 sm:grid-cols-2">
                @foreach($wishlistItems as $item)
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
                        <!-- Product Image -->
                        <a href="{{ route('product.show', $item->product->id) }}" class="block">
                            <div class="relative w-32 h-32 rounded-lg overflow-hidden 
                                {{ strtolower($item->product->category) === 'white' ? 'bg-whitechoc' : '' }}
                                {{ strtolower($item->product->category) === 'dark' ? 'bg-brown-900' : '' }}
                                {{ strtolower($item->product->category) === 'milk' ? 'bg-milkchoc' : '' }}
                                {{ strtolower($item->product->category) === 'fruitnnut' ? 'bg-fruitnnutchoc' : '' }}
                                {{ strtolower($item->product->category) === 'strawberry' ? 'bg-pink-500' : '' }}
                                {{ strtolower($item->product->category) === 'caramel' ? 'bg-caramelchoc' : '' }}
                                {{ strtolower($item->product->category) === 'vegan' ? 'bg-veganchoc' : '' }}">
                                <img src="{{ $item->product->images ? asset('storage/' . json_decode($item->product->images)[0]) : asset('images/default-product.jpg') }}" 
                                    alt="{{ $item->product->name }}" 
                                    class="object-contain h-full w-full hover:scale-105 transition-transform font-anton">
                            </div>
                        </a>

                        <!-- Product Info -->
                        <div class="text-center mt-2">
                            <h2 class="text-lg text-gray-700 font-anton uppercase">{{ $item->product->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $item->product->currency }} {{ number_format($item->product->price, 2) }}</p>
                            <p class="text-xs text-gray-500">{{ $item->product->category }}</p>
                        </div>

                        <!-- Remove Button -->
                        <button 
                            class="text-red-500 text-xl mt-2 hover:scale-110 transition-transform"
                            onclick="removeFromWishlist(event, {{ $item->product->id }})">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Table Layout for Larger Screens -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="py-3 px-6 text-gray-700 font-semibold">Product</th>
                            <th class="py-3 px-6 text-gray-700 font-semibold">Category</th>
                            <th class="py-3 px-6 text-gray-700 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlistItems as $item)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 px-6 flex items-center space-x-4">
                                <a href="{{ route('product.show', $item->product->id) }}" class="group flex items-center space-x-4">
                                    <div class="relative w-24 h-24 rounded-lg overflow-hidden 
                                        {{ strtolower($item->product->category) === 'white' ? 'bg-whitechoc' : '' }}
                                        {{ strtolower($item->product->category) === 'dark' ? 'bg-brown-900' : '' }}
                                        {{ strtolower($item->product->category) === 'milk' ? 'bg-milkchoc' : '' }}
                                        {{ strtolower($item->product->category) === 'fruitnnut' ? 'bg-fruitnnutchoc' : '' }}
                                        {{ strtolower($item->product->category) === 'strawberry' ? 'bg-pink-500' : '' }}
                                        {{ strtolower($item->product->category) === 'caramel' ? 'bg-caramelchoc' : '' }}
                                        {{ strtolower($item->product->category) === 'vegan' ? 'bg-veganchoc' : '' }}">
                                        
                                        <img src="{{ $item->product->images ? asset('storage/' . json_decode($item->product->images)[0]) : asset('images/default-product.jpg') }}" 
                                            alt="{{ $item->product->name }}" 
                                            class="object-contain h-full w-full group-hover:scale-105 transition-transform">
                                    </div>
                                    <div>
                                        <h2 class="text-2xl text-gray-700 group-hover:underline font-anton uppercase">{{ $item->product->name }}</h2>
                                        <p class="text-sm text-gray-600">{{ $item->product->currency }} {{ number_format($item->product->price, 2) }}</p>
                                    </div>
                                </a>
                            </td>

                            <td class="py-4 px-6 text-gray-800 font-medium">
                                {{ $item->product->category }}
                            </td>

                            <td class="py-4 px-6 text-right">
                                <button 
                                    class="text-red-500 text-2xl hover:scale-110 transition-transform"
                                    onclick="removeFromWishlist(event, {{ $item->product->id }})">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Move to Cart Button -->
            <form method="POST" action="{{ route('wishlist.moveToCart') }}" class="mt-4 text-center">
                @csrf
                <button type="submit" class="bg-brown-700 text-white py-3 px-5 rounded-lg hover:bg-brown-800 font-anton uppercase w-full sm:w-auto">
                    Move to Cart
                </button>
            </form>
        @endif
    </div>
</div>

@endsection

<script>
    function removeFromWishlist(event, productId) {
        event.preventDefault();

        fetch(`/wishlist/remove/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                event.target.closest('tr, .bg-white').remove();
                alert('Product removed from wishlist');
            } else {
                console.error(data.message || 'Failed to remove product');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
