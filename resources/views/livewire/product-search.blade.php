<div id="search-bar" class="w-full flex flex-col items-center my-8 relative">
    <!-- Search Form -->
    <form class="w-3/4 flex items-center relative z-10">
        <input wire:model.live.debounce.500ms="search" 
               type="search" 
               placeholder="Search products..." 
               class="w-full text-xl placeholder-gray-500 text-gray-700 border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </form>

    @if (!empty($search)) <!-- Check if user has typed something -->
        <div class="w-3/4">
            @if ($products->isNotEmpty())
                <!-- List Layout for Products -->
                <div class="grid grid-cols-1">
                    @foreach ($products as $product)
                        <a href="{{ route('product.show', $product->id) }}" 
                           class="group flex items-center bg-white shadow-lg  overflow-hidden hover:shadow-xl transition-shadow p-4">
                            <!-- Product Image -->
                            <div 
                                class="relative w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden
                                {{ strtolower($product->category) === 'white' ? 'bg-whitechoc' : '' }}
                                {{ strtolower($product->category) === 'dark' ? 'bg-brown-900' : '' }}
                                {{ strtolower($product->category) === 'milk' ? 'bg-milkchoc' : '' }}
                                {{ strtolower($product->category) === 'fruitnnut' ? 'bg-fruitnnutchoc' : '' }}
                                {{ strtolower($product->category) === 'strawberry' ? 'bg-pink-500' : '' }}
                                {{ strtolower($product->category) === 'caramel' ? 'bg-caramelchoc' : '' }}
                                {{ strtolower($product->category) === 'vegan' ? 'bg-veganchoc' : '' }}">
                                
                                <img src="{{ $product->images ? asset('storage/' . json_decode($product->images)[0]) : asset('images/default-product.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="object-contain h-full w-full group-hover:scale-105 transition-transform">
                            </div>

                            <!-- Product Details -->
                            <div class="w-2/3 px-4 flex flex-col ">
                                <h2 class="text-lg font-bold text-gray-700 group-hover:underline uppercase">{{ $product->name }}</h2>
                                <p class="text-sm text-gray-500">{{ ucfirst($product->category) }}</p>
                                
                            </div>

                              <!-- Product Brand -->
                              <div class="w-1/3 text-center uppercase  ">
                                <p class="text-lg text-gray-500">Brand: <span class="font-medium">{{ $product->brand ?? 'N/A' }}</span></p>
                            </div>

                            <!-- Product Price -->
                            <div class="w-1/3 text-right">
                                <p class="text-lg font-semibold text-gray-800">LKR {{ number_format($product->price, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- No Products Found -->
                <div class="bg-white shadow-lg  w-full z-20 p-4 text-center text-gray-700">
                    <p class="text-lg">😔 No sweet treats found! Try searching for something else delicious.</p>
                </div>
            @endif
        </div>
    @endif
</div>
