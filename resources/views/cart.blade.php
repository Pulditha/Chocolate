@extends('layouts.external')
{{-- need to add a clear cart option --}}
@section('page-title', 'Cart')
@section('content')
@if(session('status'))
<div  id="notification" class="alert alert-success fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 ">
    {{ session('status') }}
</div>
@endif



<div class="container mx-auto py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="col-span-2 bg-white p-6 rounded-lg shadow-md">
        @if ($cartItems->isEmpty())
            <p class="text-gray-700 text-lg">Your cart is empty.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-left border-b-2 border-gray-200">
                        <th class="py-2">Product</th>
                        <th class="py-2 text-center">Quantity</th>
                        <th class="py-2 text-right">Price</th>
                        <th class="py-2 text-right">Subtotal</th>
                        <th class="py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr class="border-b">
                            <td class="py-4 flex items-center space-x-4">
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
                                        <h2 class="text-2xl text-gray-700 group-hover:underline font-anton uppercase md:uppercase">{{ $item->product->name }}</h2>
                                        <p class="text-sm text-gray-500">{{ ucfirst($item->product->category) }}</p>
                                    </div>
                                </a>
                              
                            </td>
                            <td class="py-4 text-center">
                                <form action="{{ route('cart.decreaseQuantity') }}" method="POST" class="inline-block">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <button type="submit" class="px-2 py-1 bg-gray-200 rounded">-</button>
                                </form>
                                <span class="mx-2">{{ $item->quantity }}</span>
                                <form action="{{ route('cart.increaseQuantity') }}" method="POST" class="inline-block">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <button type="submit" class="px-2 py-1 bg-gray-200 rounded">+</button>
                                </form>
                            </td>
                            <td class="py-4 text-right">LKR {{ number_format($item->product->price, 2) }}</td>
                            <td class="py-4 text-right">LKR {{ number_format($item->quantity * $item->product->price, 2) }}</td>
                            <td class="py-4 text-center">
                                <form action="{{ route('cart.toggle') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" class="text-red-500 text-xl"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Order Summary -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Order Summary</h2>
        <ul class="space-y-2">
            <li class="flex justify-between">
                <span>Subtotal</span>
                <span>LKR {{ number_format($subtotal, 2) }}</span>
            </li>
            <li class="flex justify-between">
                <span>Shipping</span>
                <span>LKR {{ number_format($shipping, 2) }}</span>
            </li>
            <li class="flex justify-between font-semibold text-lg">
                <span>Total</span>
                <span>LKR {{ number_format($total, 2) }}</span>
            </li>
        </ul>
        <form action="{{ route('checkout') }}" method="GET">
            @csrf
            <button type="submit" class="mt-4 w-full bg-brown-700 text-white py-4 text-xl rounded-lg font-anton uppercase md:uppercase ">
                Proceed to Checkout
            </button>
        </form>
    </div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notification = document.getElementById('notification');
        if (notification) {
            setTimeout(() => {
                notification.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
                setTimeout(() => notification.remove(), 1000);
            }, 3000);
        }
    });
</script>
@endsection
