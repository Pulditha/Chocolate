<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body class=" font-sans leading-normal tracking-normal">

    <header class="absolute top-0 left-0 w-full z-10 shadow-none" 
        :class="{{ strtolower($product->category) === 'white' ? 'bg-white' : 'bg-gray-800' }}">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo and Arrow -->
            <div class="flex flex-col items-start space-y-2">
                <a href="{{ url('/') }}" 
                   class="text-5xl font-anton {{ strtolower($product->category) === 'white' ? 'text-brown-700' : 'text-white' }} hover:text-opacity-75">
                    BARS
                </a>
                <a href="/shop" 
                   class="text-3xl {{ strtolower($product->category) === 'white' ? 'text-brown-700' : 'text-white' }} font-anton">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
    
            <!-- Navigation Icons -->
            <div class="flex items-center space-x-10 text-2xl text-brown-700">
                <a href="/wishlist" class="hover:opacity-75">
                    <i class="fas fa-heart"></i>
                </a>
                <a href="/cart" class="hover:opacity-75">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="#" class="hover:opacity-75">
                    <i class="fas fa-search"></i>
                </a>
                @auth
                    <a href="/account" class="hover:opacity-75">
                        <i class="fas fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:opacity-75">
                        <i class="fas fa-user"></i>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto min-h-screen flex flex-col lg:flex-row ">
        <!-- Image Section -->
        <!-- Parent container -->
<div class="w-full lg:w-[65%] relative flex items-center justify-center lg:items-start 
{{ strtolower($product->category) === 'white' ? 'bg-whitechoc' : '' }} 
{{ strtolower($product->category) === 'dark' ? 'bg-brown-900' : '' }} 
{{ strtolower($product->category) === 'milk' ? 'bg-milkchoc' : '' }} 
{{ strtolower($product->category) === 'fruitnnut' ? 'bg-fruitnnutchoc' : '' }} 
{{ strtolower($product->category) === 'strawberry' ? 'bg-pink-500' : '' }} 
{{ strtolower($product->category) === 'caramel' ? 'bg-caramelchoc' : '' }} 
{{ strtolower($product->category) === 'vegan' ? 'bg-veganchoc' : '' }}" 
style="min-height: 200vh; padding-bottom: 200px;">

<!-- Sticky Element -->
<div class="sticky top-[10%] max-w-[80%] max-h-[80%] w-[700px] h-[700px]">
    @if($product->stock_status === 'Out of Stock')
        <div class="absolute inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-10">
            <p class="text-red-400 text-7xl font-anton uppercase tracking-wider transform rotate-12">
                Out of Stock
            </p>
        </div>
    @endif

    <!-- Product Image -->
    <img 
        src="{{ $product->images ? asset('storage/' . json_decode($product->images)[0]) : asset('images/default-product.jpg') }}" 
        alt="{{ $product->name }}" 
        class="object-cover w-full h-full"
    >
</div>
</div>

    
        <!-- Text Section -->
        <div class="w-full lg:w-[35%] flex flex-col justify-start space-y-6 px-6 py-8 lg:py-0 mt-32 pt-10">
            <h1 class="text-7xl font-anton text-gray-800 uppercase md:uppercase ">{{ $product->name }}</h1>

            <p class="text-8xl font-anton">
                @if($product->discount_price)
                    <span class="text-red-500">{{ $product->currency }} {{ number_format($product->price - $product->discount_price) }}</span>
                    <span class="line-through text-gray-400 text-4xl">{{ $product->currency }} {{ number_format($product->price) }}</span>
                @else
                    <span class="text-brown-700">{{ $product->currency }} {{ number_format($product->price) }}</span>
                @endif
            </p>


            <p class="text-4xl text-gray-700 font-anton uppercase md:uppercase "> {{ ucfirst(strtolower($product->category)) }} CHOCOLATE</p>
            <p class="text-xl text-gray-600">{{ $product->description ?? 'No description available.' }}</p>
    
          
            <p class="text-4xl font-anton text-gray-700 uppercase md:uppercase">BRAND: {{ $product->brand ?? 'No brand specified' }}</p>
            <p class="text-4xl font-anton text-gray-700 uppercase md:uppercase">STOCK STATUS: {{ ucfirst(strtolower($product->stock_status)) }}</p>
            <p class="text-4xl font-anton text-gray-700 uppercase md:uppercase">ALLERGY INFORMATION: {{ $product->allergy_info ?? 'Not specified' }}</p>
            <p class="text-2xl font-anton text-gray-500 uppercase md:uppercase">WEIGHT: {{ $product->weight ?? 'Not specified' }}</p>
            <p class="text-2xl font-anton text-gray-500 uppercase md:uppercase"> {{ $product->storage_instructions ?? 'Not specified' }}</p>

    
    
            <div class="mt-6">
                @if($product->stock_status === 'Out of Stock')
                    <button 
                        class="cart-button bg-gray-400 text-white font-medium rounded-lg text-sm px-6 py-3 cursor-not-allowed opacity-50" 
                        disabled>
                        Out of Stock
                    </button>
                @elseif(auth()->check())
                    <button
                        class="cart-button {{ in_array($product->id, $cartProductIds ?? []) ? 'bg-red-600' : 'bg-brown-700' }} 
                        text-white  font-anton rounded-lg px-6 py-3 text-4xl" 
                        data-product-id="{{ $product->id }}">
                        <i class="{{ in_array($product->id, $cartProductIds ?? []) ? 'fas fa-trash-alt' : 'fas fa-cart-plus' }} mr-2"></i>
                        {{ in_array($product->id, $cartProductIds ?? []) ? 'Remove from Cart' : 'Add to Cart' }}
                    </button>
                @else
                    <a href="{{ route('login') }}" class="bg-brown-700 text-white px-4 py-2 font-anton rounded-lg  text-2xl">
                        Login to Add to Cart
                    </a>
                @endif
            </div>
        </div>
    </main>
    
    <!-- Ingredients Section -->
    <section class="bg-white py-12 mt-10">
        <h2 class="text-center text-9xl font-anton text-gray-600">INGREDIENTS</h2>
        <p class="text-center text-2xl mt-6 text-gray-700 px-4">
            {{ $product->ingredients ?? 'No ingredients specified.' }}
        </p>
    </section>
    
    
    

<div id="notification" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <p id="notification-message"></p>
</div>

</main>

<!-- Optional Footer -->
<footer class="bg-brown-700 text-white py-8">
    <div class="container mx-auto text-center">
        <p class="text-sm text-gray-300">© {{ date('Y') }} BARS. All rights reserved.</p>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    
            const cartButtons = document.querySelectorAll('.cart-button');
            const notification = document.getElementById('notification');
            const messageElement = document.getElementById('notification-message');
        
            // Utility function: Display notification with a message and type
            const showNotification = (message, type = 'success') => {
                notification.classList.remove('hidden', 'bg-green-500', 'bg-red-500');
                notification.classList.add(type === 'success' ? 'bg-green-500' : 'bg-red-500');
                messageElement.textContent = message;
        
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 3000);
            };
        
            // Utility function: Fetch API wrapper with error handling
            const sendRequest = async (url, data) => {
                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify(data),
                    });
                    return await response.json();
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                }
            };
        
            // Prevent click event propagation and default behavior
            const preventNavigation = (event) => {
                event.preventDefault(); // Prevent default anchor or form actions
                event.stopPropagation(); // Stop event bubbling
            };
        
    cartButtons.forEach(button => {
                button.addEventListener('click', async (event) => {
                    preventNavigation(event);
        
                    const productId = button.getAttribute('data-product-id');
                    const url = '{{ route("cart.toggle") }}';
                    const data = { product_id: productId };
        
                    const response = await sendRequest(url, data);
                    if (response) {
                        if (response.status === 'added') {
                            button.classList.replace('bg-brown-700', 'bg-red-600');
                            button.innerHTML = '<i class="fas fa-trash-alt mr-2"></i> Remove from Cart';
                            showNotification('Added to cart.', 'success');
                        } else if (response.status === 'removed') {
                            button.classList.replace('bg-red-600', 'bg-brown-700');
                            button.innerHTML = '<i class="fas fa-cart-plus mr-2"></i> Add to Cart';
                            showNotification('Removed from cart.', 'success');
                        }
                    }
                });
            });
        });
    
    </script>
</body>
</html>