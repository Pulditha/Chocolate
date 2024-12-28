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
            <div class="overflow-x-auto">
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
                           <!-- Product Image with Category Background -->
<td class="py-4 px-6 flex items-center space-x-4">
    <a href="{{ route('product.show', $item->product->id) }}" class="group flex items-center space-x-4">
        <div 
            class="relative w-24 h-24 rounded-lg overflow-hidden 
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
            <h2 class="text-2xl text-gray-700 group-hover:underline font-anton uppercase md:uppercase  ">{{ $item->product->name }}</h2>
            <p class="text-sm text-gray-600">{{ $item->product->currency }} {{ number_format($item->product->price, 2) }}</p>
        </div>
    </a>
</td>

    
                            <!-- Product Category -->
                            <td class="py-4 px-6 text-gray-800 font-medium">
                                {{ $item->product->category }}
                            </td>
    
                            <!-- Remove from Wishlist Button -->
                            <td class="py-4 px-6 text-right">
                                <button 
                                    class="wishlist-button text-red-500 text-2xl hover:scale-110 transition-transform"
                                    data-product-id="{{ $item->product->id }}"
                                    onclick="removeFromWishlist(event, {{ $item->product->id }})">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Move to Cart Button -->
        <form method="POST" action="{{ route('wishlist.moveToCart') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-brown-700 text-white py-4 px-5 rounded-lg hover:bg-brown-800 font-anton uppercase md:uppercase">
                Move to Cart
            </button>
        </form>
            </div>
            
        @endif
    </div>
    
    
@endsection


<script>
    function removeFromWishlist(event, productId) {
        event.preventDefault();

        // Perform AJAX request to remove item from the wishlist
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
                // Remove the product row from the table
                event.target.closest('tr').remove();

                // Optionally, show a notification
                alert('Product removed from wishlist');
            } else {
                console.error(data.message || 'Failed to remove product');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


 

</script>
    