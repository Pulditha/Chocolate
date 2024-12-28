@extends('layouts.admin-nav')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Create New Product</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Product creation form --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        {{-- Product Name --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" 
                   required>
        </div>

        {{-- Category --}}
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" name="category" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" 
                    required>
                <option value="" disabled selected>Select a category</option>
                <option value="WHITE">White</option>
                <option value="DARK">Dark</option>
                <option value="MILK">Milk</option>
                <option value="FRUITNNUT">Fruitnut</option>
                <option value="STRAWBERRY">Strawberry</option>
                <option value="CARAMEL">Caramel</option>
                <option value="VEGAN">Vegan</option>
            </select>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" 
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
        </div>

        {{-- Price --}}
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price (LKR)</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" 
                   required>
        </div>

        {{-- Discount Price --}}
        <div class="mb-4">
            <label for="discount_price" class="block text-sm font-medium text-gray-700">Discount Price (optional)</label>
            <input type="number" id="discount_price" name="discount_price" value="{{ old('discount_price') }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </div>

        {{-- Stock Quantity --}}
        <div class="mb-4">
            <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" 
                   required>
        </div>

        {{-- Stock Status --}}
        <div class="mb-4">
            <label for="stock_status" class="block text-sm font-medium text-gray-700">Stock Status</label>
            <select id="stock_status" name="stock_status" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" 
                    required>
                <option value="" disabled selected>Select a status</option>
                <option value="In Stock">In Stock</option>
                <option value="Out of Stock">Out of Stock</option>
                <option value="Pre-Order">Pre-Order</option>
            </select>
        </div>

        {{-- Ingredients --}}
        <div class="mb-4">
            <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
            <textarea id="ingredients" name="ingredients" rows="2" 
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">{{ old('ingredients') }}</textarea>
        </div>

        {{-- Allergy Info --}}
        <div class="mb-4">
            <label for="allergy_info" class="block text-sm font-medium text-gray-700">Allergy Information</label>
            <textarea id="allergy_info" name="allergy_info" rows="2" 
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">{{ old('allergy_info') }}</textarea>
        </div>

        {{-- Storage Instructions --}}
        <div class="mb-4">
            <label for="storage_instructions" class="block text-sm font-medium text-gray-700">Storage Instructions</label>
            <textarea id="storage_instructions" name="storage_instructions" rows="2" 
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">{{ old('storage_instructions') }}</textarea>
        </div>

        {{-- Brand --}}
        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <input type="text" id="brand" name="brand" value="{{ old('brand') }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </div>

        {{-- Weight --}}
        <div class="mb-4">
            <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
            <input type="text" id="weight" name="weight" value="{{ old('weight') }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </div>

        {{-- Images --}}
        <div class="mb-4">
            <label for="images" class="block text-sm font-medium text-gray-700">Product Images</label>
            <input type="file" id="images" name="images[]" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" 
                   multiple>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-between mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">Add Product</button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">Cancel</a>
        </div>
    </form>
</div>

<div class="text-center text-sm text-white-600 mt-10 text-gray-500">
    Created by : Pulditha Wathsal | CB011498 | CB011498@students.apiit.lk
</div>

@endsection
