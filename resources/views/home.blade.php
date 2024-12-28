@extends('layouts.app')

@section('content')
<div class="bg-gray-200 relative">
    <div class="text-center py-10">
        <p class="text-[20rem] text-brown-700 font-anton">CHOCOLATE</p>
    </div>

    <div class="flex justify-around space-x-4 px-4 relative -mt-[250px]">
        <!-- Product 1 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate3.webp') }}" alt="Description 1" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem] ">Product Name 1</p> <!-- Gray Anton-styled text -->
        </div>
        
        <!-- Product 2 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate4.webp') }}" alt="Description 2" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem] ">Product Name 2</p> <!-- Gray Anton-styled text -->
        </div>
        
        <!-- Product 3 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate3.webp') }}" alt="Description 3" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem] ">Product Name 3</p> <!-- Gray Anton-styled text -->
        </div>
    </div>
</div>


    <!-- Slider Section -->
    <div class="relative overflow-hidden mt-20 w-full h-[100vh] flex bg-brown-700">
        <div class="slider flex transition-transform duration-300" id="slider">
            <!-- Slide 1 -->
            <div class="slide flex items-center justify-between w-full h-full flex-shrink-0 relative">
                <img src="{{ asset('images/chocolate1.png') }}" alt="Product 1" class="w-1/2 h-auto object-cover" />
                <div class="text-section w-1/2 pr-10">
                    <p class="text-[6rem] text-white font-anton text-left">Product Description 1</p>
                    <button class="mt-4 px-8 py-4 bg-white text-brown-700 text-[2rem] rounded-lg shadow-lg hover:bg-gray-200 transition font-anton">
                        SHOP NOW
                    </button>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide flex items-center justify-between w-full h-full flex-shrink-0 relative">
                <div class="text-section w-1/2 pl-10 text-center">
                    <p class="text-[6rem] text-white font-anton">Product Description 2</p>
                    <button class="mt-4 px-8 py-4 bg-white text-brown-700 text-[2rem] rounded-lg shadow-lg hover:bg-gray-200 transition font-anton">
                        SHOP NOW
                    </button>
                </div>
                <img src="{{ asset('images/chocolate1.png') }}" alt="Product 2" class="w-1/2 h-auto object-cover" />
            </div>

            <!-- Slide 3 -->
            <div class="slide flex items-center justify-between w-full h-full flex-shrink-0 relative">
                <img src="{{ asset('images/chocolate1.png') }}" alt="Product 3" class="w-1/2 h-auto object-cover" />
                <div class="text-section w-1/2 pr-10">
                    <p class="text-[6rem] text-white font-anton text-left">Product Description 3</p>
                    <button class="mt-4 px-8 py-4 bg-white text-brown-700 text-[2rem] rounded-lg shadow-lg hover:bg-gray-200 transition font-anton">
                        SHOP NOW
                    </button>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button class="absolute top-1/2 left-4 transform -translate-y-1/2 p-0 text-white transition hover:scale-110" id="prev">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button class="absolute top-1/2 right-4 transform -translate-y-1/2 p-0 text-white transition hover:scale-110" id="next">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Dots Section -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3" id="dots">
            <span class="dot w-4 h-4 bg-white rounded-full opacity-50"></span>
            <span class="dot w-4 h-4 bg-white rounded-full opacity-50"></span>
            <span class="dot w-4 h-4 bg-white rounded-full opacity-50"></span>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="bg-gray-100 py-20">
    <div class="text-center">
        <h2 class="text-brown-700 font-anton text-[15rem] leading-none">OUR CATEGORIES</h2>
    </div>
    
    <div class="flex justify-around space-x-4 px-4 mt-16 font-anton">
        <!-- Category 1 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate1.png') }}" alt="Dark Chocolate" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem] ">Dark Chocolate</p>
        </div>
        
        <!-- Category 2 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate1.png') }}" alt="Milk Chocolate" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem] ">Milk Chocolate</p>
        </div>
        
        <!-- Category 3 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate1.png') }}" alt="White Chocolate" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem]">White Chocolate</p>
        </div>
        
        <!-- Category 4 -->
        <div class="flex-1 text-center">
            <img src="{{ asset('images/chocolate1.png') }}" alt="Assorted" class="rounded-lg w-full h-auto">
            <p class="mt-4 text-gray-700 text-[2rem]">Assorted Chocolates</p>
        </div>
    </div>
</div>


<script>
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const dots = document.querySelectorAll('.dot');

    let currentIndex = 0;

    // Function to update the slider's position
    function updateSlider() {
        const offset = -currentIndex * 100; // Calculate the translateX offset
        slider.style.transform = `translateX(${offset}%)`;

        // Update dots
        dots.forEach((dot, index) => {
            dot.style.opacity = index === currentIndex ? '1' : '0.5';
        });
    }

    // Move to the next slide
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length; // Loop to the first slide if at the end
        updateSlider();
    });

    // Move to the previous slide
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length; // Loop to the last slide if at the beginning
        updateSlider();
    });

    // Initialize slider
    updateSlider();
</script>

@endsection
