@extends('layouts.external')

@section('page-title', 'Payment')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Confirm Payment</h2>

    <!-- Mobile Grid Layout -->
    <div class="md:hidden grid gap-4 sm:grid-cols-2">
        @foreach ($cartItems as $item)
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
                            class="object-contain h-full w-full hover:scale-105 transition-transform">
                    </div>
                </a>

                <!-- Product Info -->
                <div class="text-center mt-2">
                    <h2 class="text-lg text-gray-700 uppercase font-anton">{{ $item->product->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $item->product->currency }} {{ number_format($item->product->price * $item->quantity, 2) }}</p>
                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                </div>
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
                    <th class="py-3 px-6 text-gray-700 font-semibold">Price</th>
                    <th class="py-3 px-6 text-gray-700 font-semibold">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
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
                                    <h2 class="text-lg text-gray-700 group-hover:underline font-anton uppercase">{{ $item->product->name }}</h2>
                                </div>
                            </a>
                        </td>
                        <td class="py-4 px-6">{{ ucfirst($item->product->category) }}</td>
                        <td class="py-4 px-6">{{ $item->product->currency }} {{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td class="py-4 px-6">{{ $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Payment Button -->
    <div class="flex justify-center mt-8">
        <form action="{{ route('checkout.processPayment') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-brown-700 text-white rounded-lg font-anton">Pay with Stripe</button>
        </form>
    </div>
</div>
@endsection
