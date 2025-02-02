@extends('layouts.external')

@section('page-title', 'Payment ')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-6">
    <div class="bg-white shadow-lg rounded-lg p-6 text-center w-full max-w-md">
        <div class="flex justify-center">
            <svg class="w-16 h-16 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-semibold text-gray-800 mt-4">Thank You for Your Purchase!</h1>
        <p class="text-gray-600 mt-2">Your payment was successful.You can also view your orders in the orders page.</p>

        <div class="mt-6">
            <a href="{{ route('shop') }}" class="inline-block px-6 py-3 bg-brown-700 text-white rounded-lg shadow-md hover:bg-brown-600 transition font-anton">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection
