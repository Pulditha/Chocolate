@extends('layouts.external')

@section('page-title', ' Orders')

@section('content')
<div class="container mx-auto py-8 px-4 lg:px-0">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Orders</h2>
    @if($orders->isEmpty())
        <p class="text-gray-600 text-lg">No orders found.</p>
    @else
        <div class="bg-white p-6 rounded-lg shadow-md">
            <ul class="space-y-4">
                @foreach($orders as $order)
                    <li class="flex flex-col md:flex-row md:items-center justify-between bg-gray-100 p-4 rounded-lg shadow">
                        <div>
                            <span class="text-lg font-semibold text-gray-700">Order ID: {{ $order->id }}</span>
                            <span class="text-sm bg-green-500 text-white px-2 py-1 rounded-lg ml-2">Paid</span>
                            <p class="text-gray-600">Total: LKR {{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="mt-2 md:mt-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete Order</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
