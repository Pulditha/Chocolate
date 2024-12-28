<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::all();
        return view('admins.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('admins.products.create');
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:WHITE,DARK,MILK,FRUITNNUT,STRAWBERRY,CARAMEL,VEGAN',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'stock_status' => 'required|in:In Stock,Out of Stock,Pre-Order',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'allergy_info' => 'nullable|string',
            'storage_instructions' => 'nullable|string',
            'brand' => 'nullable|string|max:100',
            'weight' => 'nullable|string|max:50',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $images[] = $path;
            }
        }

        $validated['images'] = json_encode($images);
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show a single product
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Get all product IDs in the user's cart if the user is authenticated
        $cartProductIds = auth()->check() 
            ? auth()->user()->cart->pluck('product_id')->toArray() 
            : []; // Empty array for guests
    
        return view('products.productview', compact('product', 'cartProductIds'));
    }

    // Show the form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admins.products.edit', compact('product'));
    }

    // Update the specified product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:WHITE,DARK,MILK,FRUITNNUT,STRAWBERRY,CARAMEL,VEGAN',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'stock_status' => 'required|in:In Stock,Out of Stock,Pre-Order',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'allergy_info' => 'nullable|string',
            'storage_instructions' => 'nullable|string',
            'brand' => 'nullable|string|max:100',
            'weight' => 'nullable|string|max:50',
        ]);

          $existingImages = json_decode($product->images, true);

    // Handle new image uploads
    $newImages = [];
    if ($request->hasFile('images')) {
        // Delete old images from storage
        foreach ($existingImages as $image) {
            Storage::disk('public')->delete($image);
        }

        // Upload new images
        foreach ($request->file('images') as $image) {
            $path = $image->store('product_images', 'public');
            $newImages[] = $path;
        }
    }

    // Combine old images with new ones, or just save new ones if none exist
    $allImages = $newImages ?: $existingImages;

    $validated['images'] = json_encode($allImages); // Store as JSON
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->images) {
            foreach (json_decode($product->images, true) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }


    public function storeFront()
    {
        // Retrieve 9 products per page
        $products = Product::paginate(9); 
    
        // Wishlist product IDs for the logged-in user
        $wishlistProductIds = auth()->check() 
            ? Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray() 
            : []; 
    
        // Cart product IDs for the logged-in user
        $cartProductIds = auth()->check() 
            ? Cart::where('user_id', auth()->id())->pluck('product_id')->toArray() 
            : []; 
    
        // Return the view with products, wishlist IDs, and cart IDs
        return view('shop', compact('products', 'wishlistProductIds', 'cartProductIds'));
    }
}    