@extends('layouts.app')  
{{-- need to add pagination , breadcrumb navigation for product detailed view --}}
@section('content')  

<div class="bg-gray-200 relative">  
    <div class="text-center py-10">  
        <p class="text-[4rem] sm:text-[6rem] md:text-[10rem] lg:text-[15rem] text-brown-700 font-anton">
            OUR PRODUCTS
        </p>  
    </div>  

    <div class="flex flex-col md:flex-row justify-center md:justify-around space-y-10 md:space-y-0 md:space-x-4 px-4 relative -mt-[100px] md:-mt-[250px]">  
        <!-- Product 1 -->  
        <div class="flex-1 text-center">
            <a href="{{ url('/product/6') }}">
            <img src="{{ asset('images/product1.png') }}" alt="Description 1" class="rounded-lg w-3/4 md:w-full h-auto mx-auto">  
            <p class="mt-4 text-gray-500 text-xl">Cadbury Dairy Milk Chocolate</p>  
            </a>
        </div>  

        <!-- Product 2 -->  
        <div class="flex-1 text-center">  
            <a href="{{ url('/product/5') }}">
            <img src="{{ asset('images/choc.png') }}" alt="Description 2" class="rounded-lg w-3/4 md:w-full h-auto mx-auto">  
            <p class="mt-4 text-gray-500 text-xl">Hersheys dark chocolate bar</p>  
            </a>
        </div>  

        <!-- Product 3 -->  
        <div class="flex-1 text-center">
            <a href="{{ url('/product/7') }}"> 
            <img src="{{ asset('images/fruit.png') }}" alt="Description 3" class="rounded-lg w-3/4 md:w-full h-auto mx-auto">  
            <p class="mt-4 text-gray-500 text-xl">lindt fruit and nut milk chocolate</p>  
            </a>
        </div>  
    </div>  
</div>

    <h2 class="text-brown-700 text-[4rem] sm:text-[6rem] md:text-[10rem] text-center mb-5 font-anton" id="searchtitle">Explore</h2>  
    <div>
        @livewire('product-search')
    </div>

<!-- Categories Section -->  
<div class="">  
    <!-- Categories Filter -->
    <div class="grid grid-cols-4 gap-3 md:flex md:justify-center md:space-x-6 mb-10">
        <button class="category-button bg-whitechoc border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="white">
            <p class="text-gray-700 font-anton text-lg md:transform md:rotate-90 md:text-6xl">WHITE</p>
        </button>

        <button class="category-button bg-milkchoc border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="milk">
            <p class="text-brown-800 font-anton text-lg md:transform md:rotate-90 md:text-6xl">MILK</p>
        </button>

        <button class="category-button bg-brown-900 border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="dark">
            <p class="text-white font-anton text-lg md:transform md:rotate-90 md:text-6xl">DARK</p>
        </button>

        <button class="category-button bg-fruitnnutchoc border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="fruitnnut">
            <p class="text-white font-anton text-sm md:transform md:rotate-90 md:text-5xl">FRUIT&NUT</p>
        </button>

        <button class="category-button bg-brown-700 border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="all">
            <p class="text-white font-anton text-lg md:transform md:rotate-90 md:text-6xl">ALL</p>
        </button>

        <button class="category-button bg-pink-500 border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="strawberry">
            <p class="text-white font-anton text-sm md:transform md:rotate-90 md:text-4xl">STRAWBERRY</p>
        </button>

        <button class="category-button bg-caramelchoc border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="caramel">
            <p class="text-brown-800 font-anton text-lg md:transform md:rotate-90 md:text-5xl">CARAMEL</p>
        </button>

        <button class="category-button bg-veganchoc border border-gray-300 shadow-md h-28 w-16 md:h-56 md:w-24 flex items-center justify-center opacity-85 hover:opacity-100" data-category="vegan">
            <p class="text-white font-anton text-lg md:transform md:rotate-90 md:text-6xl">VEGAN</p>
        </button>
    </div>
</div>  


{{-- product section --}}

<div id="product-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4 mt-20">
    @foreach($products as $product)
    
    <div class="product-card {{ strtolower($product->category) }} w-full h-auto rounded-lg flex flex-col justify-between relative overflow-hidden"
        data-category="{{ strtolower($product->category) }}" data-product-id="{{ $product->id }}">
    
        <!-- Wishlist Button in Top-Right Corner -->
        <div class="absolute top-2 right-2 z-20">
            @if($product->stock_status === 'Out of Stock')
                <button 
                    class="wishlist-button text-gray-400 text-2xl cursor-not-allowed opacity-50">
                    <i class="fa-regular fa-heart"></i>
                </button>
            @elseif(auth()->check())
                <button
                    class="wishlist-button {{ in_array($product->id, $wishlistProductIds) ? 'text-red-500' : 'text-gray-500' }} 
                    text-2xl hover:scale-110 transition-transform" 
                    data-product-id="{{ $product->id }}">
                    <i class="{{ in_array($product->id, $wishlistProductIds) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                </button>
            @else
                <a href="{{ route('login') }}" 
                    class="text-gray-500 text-2xl hover:text-red-500 transition-transform">
                    <i class="fa-regular fa-heart"></i>
                </a>
            @endif
        </div>

        <!-- Out of Stock Watermark -->
        @if($product->stock_status === 'Out of Stock')
        <div class="absolute inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center z-10 pointer-events-none">
            <p class="text-red-400 text-3xl font-anton uppercase tracking-wide transform rotate-12">Out of Stock</p>
        </div>
        @endif

        <!-- Product Image -->
        <div 
            class="relative w-full h-48 sm:h-60 md:h-72 flex items-center justify-center rounded-lg overflow-hidden 
            {{ strtolower($product->category) === 'white' ? 'bg-whitechoc' : '' }} 
            {{ strtolower($product->category) === 'dark' ? 'bg-brown-900' : '' }} 
            {{ strtolower($product->category) === 'milk' ? 'bg-milkchoc' : '' }} 
            {{ strtolower($product->category) === 'fruitnnut' ? 'bg-fruitnnutchoc' : '' }} 
            {{ strtolower($product->category) === 'strawberry' ? 'bg-pink-500' : '' }} 
            {{ strtolower($product->category) === 'caramel' ? 'bg-caramelchoc' : '' }} 
            {{ strtolower($product->category) === 'vegan' ? 'bg-veganchoc' : '' }}">

            <a href="{{ route('product.show', $product->id) }}" class="relative w-full h-full flex items-center justify-center rounded-lg overflow-hidden">  
                <img src="{{ $product->images ? asset('storage/' . json_decode($product->images)[0]) : asset('images/default-product.jpg') }}"  
                     alt="{{ $product->name }}"  
                     class="object-contain h-full w-full">  
            </a>  
        </div>

        <!-- Product Details -->
        <div class="flex-1 flex flex-col items-center px-4 sm:px-6 bg-gray-300">
            <!-- Product Name -->
            <a href="{{ route('product.show', $product->id) }}" class="flex flex-col items-center justify-between px-4 sm:px-6 bg-gray-300 w-full">
            <p class="text-gray-800 text-2xl sm:text-3xl font-anton uppercase text-center">{{ $product->name }}</p>

            <!-- Product Price -->
            <p class="mt-2 text-gray-600 text-center">
                @if($product->discount_price)
                    @php
                        $final_price = $product->price - $product->discount_price;
                    @endphp
                    <span class="text-red-500 font-semibold text-lg">{{ $product->currency }} {{ number_format($final_price, 2) }}</span>
                    <br>
                    <span class="line-through text-gray-400 text-sm">{{ $product->currency }} {{ number_format($product->price, 2) }}</span>
                @else
                    <span class="font-semibold text-lg">{{ $product->currency }} {{ number_format($product->price, 2) }}</span>
                @endif
            </p>
            </a>
        </div>

        <!-- Product Category and Cart Button -->
        <div class="flex flex-col items-center justify-between px-4 sm:px-6 bg-gray-300 pb-6">
            <!-- Product Category -->
            <p class="text-xl sm:text-2xl font-anton text-{{ strtolower($product->category) }}choc">{{ $product->category }}</p>

            <!-- Add to Cart Button -->
            <div class="mt-4">
                @if($product->stock_status === 'Out of Stock')
                    <button 
                        class="cart-button bg-gray-400 text-white font-anton rounded-lg text-lg px-6 py-3 cursor-not-allowed opacity-50" disabled>
                        Out of Stock
                    </button>
                @elseif(auth()->check())
                    <button
                        class="cart-button {{ in_array($product->id, $cartProductIds ?? []) ? 'bg-red-600' : 'bg-brown-700' }} 
                        text-white  font-anton rounded-lg text-lg px-6 py-3 uppercase" 
                        data-product-id="{{ $product->id }}">
                        <i class="{{ in_array($product->id, $cartProductIds ?? []) ? 'fas fa-trash-alt' : 'fas fa-cart-plus' }} mr-2"></i> 
                        {{ in_array($product->id, $cartProductIds ?? []) ? 'Remove from Cart' : 'Add to Cart' }}
                    </button>
                @else
                    <a href="{{ route('login') }}" 
                        class="bg-brown-700 text-white font-anton rounded-lg text-sm px-6 py-3 text-center block">
                        Login to Add to Cart
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

    
 
</div>
<div class="mt-6 text-center">
    <div class="flex justify-center ">
        {{ $products->links() }}
    </div>
</div>


{{-- notification for adding to wishlist --}}
<div id="notification" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <p id="notification-message"></p>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {  
    const productContainer = document.getElementById('product-container');  

    // Event delegation for product cards – handles clicks efficiently  
    productContainer.addEventListener('click', (event) => {  
        if (event.target.classList.contains('product-card-link')) {  
            event.preventDefault();  
            const productId = event.target.dataset.productId;  
            window.location.href = `/product/${productId}`;  
        }  
    });  

    const wishlistButtons = document.querySelectorAll('.wishlist-button');  
    const cartButtons = document.querySelectorAll('.cart-button');  
    const categoryButtons = document.querySelectorAll('.category-button');  
    const notification = document.getElementById('notification');  
    const messageElement = document.getElementById('notification-message');  
    const productCards = document.querySelectorAll('.product-card'); // Add this line 


    const showNotification = (message, type = 'success') => {  
        notification.classList.remove('hidden', 'bg-green-500', 'bg-red-500');  
        notification.classList.add(type === 'success' ? 'bg-green-500' : 'bg-red-500');  
        messageElement.textContent = message;  
        setTimeout(() => notification.classList.add('hidden'), 3000);  
    };  

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

    const handleButtonAction = async (button, url, data, successMessage, failureMessage) => {  
        event.preventDefault();  
        if (!authCheck()) {  
            window.location.href = '{{ route('login') }}';  
            return;  
        }  
        const response = await sendRequest(url, data);  
        if (response && response.status === 'success') {  
            showNotification(successMessage, 'success');  
            // Update button UI as needed (example for cart)  
            if(url.includes('cart')){  
                button.classList.toggle('bg-brown-700', !response.inCart);  
                button.classList.toggle('bg-red-600', response.inCart);  
                button.querySelector('i').classList.toggle('fa-trash-alt', response.inCart);  
                button.querySelector('i').classList.toggle('fa-cart-plus', !response.inCart);  
                button.querySelector('span').textContent = response.inCart ? 'Remove from Cart' : 'Add to Cart';  
            }  
            // Add similar UI updates for wishlist as needed.  
        } else {  
            showNotification(failureMessage ?? 'Action failed.', 'error');  
        }  
    };  



    // Wishlist button handler
    wishlistButtons.forEach(button => {
        button.addEventListener('click', async event => {
            event.preventDefault();
            const productId = button.getAttribute('data-product-id');
            const url = '{{ route("wishlist.toggle") }}';
            const data = { product_id: productId };

            const response = await sendRequest(url, data);
            if (response) {
                if (response.status === 'added') {
                    button.classList.replace('text-gray-500', 'text-red-500');
                    button.querySelector('i').classList.replace('fa-regular', 'fa-solid');
                    showNotification('Added to wishlist.', 'success');
                } else if (response.status === 'removed') {
                    button.classList.replace('text-red-500', 'text-gray-500');
                    button.querySelector('i').classList.replace('fa-solid', 'fa-regular');
                    showNotification('Removed from wishlist.', 'success');
                }
            }
        });
    });

    // Cart button handler
    cartButtons.forEach(button => {
        button.addEventListener('click', async event => {
            event.preventDefault();
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

    // Category filtering
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedCategory = button.getAttribute('data-category');

            productCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                card.style.display = (selectedCategory === 'all' || selectedCategory === cardCategory) 
                    ? 'block' 
                    : 'none';
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".category-button");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            // Remove strikethrough and red color from all buttons
            buttons.forEach(btn => btn.classList.remove("line-through", "text-red-500"));

            // Add strikethrough and red color to the clicked button
            this.classList.add("line-through", "text-red-500");
        });
    });
});

</script>
    @endsection