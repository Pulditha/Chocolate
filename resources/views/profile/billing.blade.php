@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Billing Information</h2>

    <div class="mb-4">
        <p class="font-medium">Billing Address:</p>
        <p>123 Main Street</p>
        <p>Colombo, Sri Lanka</p>
        <p>ZIP: 00100</p>
    </div>

    <div class="mb-4">
        <p class="font-medium">Payment Method:</p>
        <p>Visa ending in 1234</p>
        <p>Expiration Date: 12/2026</p>
    </div>

    <div class="mb-4">
        <p class="font-medium">Recent Transactions:</p>
        <ul>
            <li>Order #101 - $50.00 - 01/10/2025</li>
            <li>Order #102 - $30.00 - 01/12/2025</li>
            <li>Order #103 - $20.00 - 01/14/2025</li>
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit Billing Info</a>
    </div>
</div>
@endsection
