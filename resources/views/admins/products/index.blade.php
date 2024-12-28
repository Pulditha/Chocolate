@extends('layouts.admin-nav')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    
    @if(session('success'))
    <div id="success-alert" class="bg-green-100 text-green-700 p-4 rounded mb-4 flex justify-between items-center">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('success-alert').remove();" class="text-green-700 hover:text-green-900 font-bold text-lg">
            &times;
        </button>
    </div>
@endif

    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Product</a>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                    <th class="border border-gray-300 px-4 py-2">Brand</th>
                    <th class="border border-gray-300 px-4 py-2">Weight</th>
                    <th class="border border-gray-300 px-4 py-2">Stock</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            @php
                                $images = $product->images ? json_decode($product->images, true) : [];
                            @endphp
                            @if(!empty($images) && isset($images[0]))
                                <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        
                        <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->category }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->price }} {{ $product->currency }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->brand ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->weight ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->stock_quantity }} ({{ $product->stock_status }})</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="text-center text-sm text-white-600 mt-10 text-gray-500">
    Created by : Pulditha Wathsal | CB011498 | CB011498@students.apiit.lk
</div>


@endsection
