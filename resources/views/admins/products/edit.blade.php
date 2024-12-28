@extends('layouts.admin-nav')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="flex flex-col">
            <label for="name" class="font-semibold">Product Name</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2" value="{{ $product->name }}" required>
        </div>

        <!-- Category -->
        <div class="flex flex-col">
            <label for="category" class="font-semibold">Category</label>
            <select name="category" id="category" class="border border-gray-300 rounded p-2" required>
                <option value="WHITE" {{ $product->category == 'WHITE' ? 'selected' : '' }}>White</option>
                <option value="DARK" {{ $product->category == 'DARK' ? 'selected' : '' }}>Dark</option>
                <option value="MILK" {{ $product->category == 'MILK' ? 'selected' : '' }}>Milk</option>
                <option value="FRUITNNUT" {{ $product->category == 'FRUITNNUT' ? 'selected' : '' }}>Fruitnut</option>
                <option value="STRAWBERRY" {{ $product->category == 'STRAWBERRY' ? 'selected' : '' }}>Strawberry</option>
                <option value="CARAMEL" {{ $product->category == 'CARAMEL' ? 'selected' : '' }}>Caramel</option>
                <option value="VEGAN" {{ $product->category == 'VEGAN' ? 'selected' : '' }}>Vegan</option>
            </select>
        </div>

        <!-- Price -->
        <div class="flex flex-col">
            <label for="price" class="font-semibold">Price</label>
            <input type="number" name="price" id="price" class="border border-gray-300 rounded p-2" value="{{ $product->price }}" required>
        </div>

        <!-- Stock Quantity -->
        <div class="flex flex-col">
            <label for="stock_quantity" class="font-semibold">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="border border-gray-300 rounded p-2" value="{{ $product->stock_quantity }}" required>
        </div>

        <!-- Stock Status -->
        <div class="flex flex-col">
            <label for="stock_status" class="font-semibold">Stock Status</label>
            <select name="stock_status" id="stock_status" class="border border-gray-300 rounded p-2" required>
                <option value="In Stock" {{ $product->stock_status == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                <option value="Out of Stock" {{ $product->stock_status == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                <option value="Pre-Order" {{ $product->stock_status == 'Pre-Order' ? 'selected' : '' }}>Pre-Order</option>
            </select>
        </div>

        <!-- Description -->
        <div class="flex flex-col">
            <label for="description" class="font-semibold">Description</label>
            <textarea name="description" id="description" rows="4" class="border border-gray-300 rounded p-2">{{ $product->description }}</textarea>
        </div>

        <!-- Upload New Images -->
        <div class="flex flex-col">
            <label for="images" class="font-semibold">Product Images</label>
            <input type="file" name="images[]" id="images" class="border border-gray-300 rounded p-2" multiple>
        </div>

        @if($product->images)
        <div>
            <label class="font-semibold">Existing Images:</label>
            <div class="flex flex-wrap gap-4 mt-2" id="existing-images">
                @foreach(json_decode($product->images) as $key => $image)
                    <div class="relative w-32 h-32 border border-gray-300 rounded overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="object-cover w-64 h-64">
                        <button type="button" 
                                class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded shadow hover:bg-red-600" 
                                onclick="removeImage('{{ $image }}', this)">
                            Remove
                        </button>
                        <input type="hidden" name="existing_images[]" value="{{ $image }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

        <!-- Additional Fields -->
        <div class="flex flex-col">
            <label for="ingredients" class="font-semibold">Ingredients</label>
            <textarea name="ingredients" id="ingredients" class="border border-gray-300 rounded p-2">{{ old('ingredients', $product->ingredients) }}</textarea>
        </div>

        <div class="flex flex-col">
            <label for="allergy_info" class="font-semibold">Allergy Information</label>
            <textarea name="allergy_info" id="allergy_info" class="border border-gray-300 rounded p-2">{{ old('allergy_info', $product->allergy_info) }}</textarea>
        </div>

        <div class="flex flex-col">
            <label for="storage_instructions" class="font-semibold">Storage Instructions</label>
            <textarea name="storage_instructions" id="storage_instructions" class="border border-gray-300 rounded p-2">{{ old('storage_instructions', $product->storage_instructions) }}</textarea>
        </div>

        <div class="flex flex-col">
            <label for="brand" class="font-semibold">Brand</label>
            <input type="text" name="brand" id="brand" class="border border-gray-300 rounded p-2" value="{{ old('brand', $product->brand) }}">
        </div>

        <div class="flex flex-col">
            <label for="weight" class="font-semibold">Weight</label>
            <input type="text" name="weight" id="weight" class="border border-gray-300 rounded p-2" value="{{ old('weight', $product->weight) }}">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">Update</button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">Cancel</a>
        </div>
    </form>
</div>



<div class="text-center text-sm text-white-600 mt-10 text-gray-500">
    Created by : Pulditha Wathsal | CB011498 | CB011498@students.apiit.lk
</div>


<script>
    function removeImage(image, button) {
        // Remove the corresponding image container
        button.closest('.relative').remove();

        // Add a hidden input to notify the server to remove this image
        const removedImagesInput = document.createElement('input');
        removedImagesInput.type = 'hidden';
        removedImagesInput.name = 'removed_images[]';
        removedImagesInput.value = image;
        document.querySelector('form').appendChild(removedImagesInput);
    }
</script>

@endsection
