@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Your Orders</h2>

    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Order ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Total</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2">101</td>
                <td class="border border-gray-300 px-4 py-2">01/10/2025</td>
                <td class="border border-gray-300 px-4 py-2">Completed</td>
                <td class="border border-gray-300 px-4 py-2">$50.00</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <a href="#" class="text-blue-500">View</a>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">102</td>
                <td class="border border-gray-300 px-4 py-2">01/12/2025</td>
                <td class="border border-gray-300 px-4 py-2">Pending</td>
                <td class="border border-gray-300 px-4 py-2">$30.00</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <a href="#" class="text-blue-500">View</a>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">103</td>
                <td class="border border-gray-300 px-4 py-2">01/14/2025</td>
                <td class="border border-gray-300 px-4 py-2">Shipped</td>
                <td class="border border-gray-300 px-4 py-2">$20.00</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <a href="#" class="text-blue-500">View</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

