@extends('layouts.external')

@section('page-title', 'Billing')

@section('content')
<div class="container mx-auto py-8 px-4 lg:px-0">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Billing Information</h2>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('checkout.storeBilling') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold">Full Name</label>
                <input type="text" name="name" placeholder="Full Name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 font-semibold">Phone</label>
                <input type="text" name="phone" placeholder="Phone" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 font-semibold">Address</label>
                <textarea name="address" placeholder="Address" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">Proceed to Payment</button>
        </form>
    </div>
</div>
@endsection
