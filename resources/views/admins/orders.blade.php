@extends('layouts.admin-nav')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Orders</h2>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Total Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Payment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="px-3 py-1 rounded {{ $order->payment_status === 'paid' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
