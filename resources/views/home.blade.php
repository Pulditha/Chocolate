@extends('layouts.app')

@section('content')
<div class="bg-gray-200 relative">
    <!-- Large Text -->
    <div class="text-center">
        <p class="text-[4rem] sm:text-[6rem] md:text-[13rem] lg:text-[20rem] text-brown-700 font-anton">CHOCOLATE</p>
    </div>

   <!-- Product Images (Column on Mobile, Row on Desktop) -->  
<div class="flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-6 px-4 relative -mt-[50px] md:-mt-[250px]">  
    
    <!-- Product 1 -->  
    <div class="text-center w-full md:w-1/3">  
        <img src="{{ asset('images/choc2.png') }}" alt="Description 1" class="rounded-lg w-auto max-w-[200px] md:max-w-none mx-auto">  
        <p class="mt-2 text-gray-700 text-[0.8rem] md:text-[1.5rem]">Product Name 1</p>  
    </div>  

    <!-- Product 2 -->  
    <div class="text-center w-full md:w-1/3">  
        <img src="{{ asset('images/choc.png') }}" alt="Description 2" class="rounded-lg w-auto max-w-[200px] md:max-w-none mx-auto">  
        <p class="mt-2 text-gray-700 text-[0.8rem] md:text-[1.5rem]">Product Name 2</p>  
    </div>  

    <!-- Product 3 -->  
    <div class="text-center w-full md:w-1/3">  
        <img src="{{ asset('images/white1234.png') }}" alt="Description 3" class="rounded-lg w-auto max-w-[200px] md:max-w-none mx-auto">  
        <p class="mt-2 text-gray-700 text-[0.8rem] md:text-[1.5rem]">Product Name 3</p>  
    </div>  

</div>
</div>


<div class="overflow-hidden">
    <div class="slide h-screen flex flex-col md:flex-row items-center justify-center w-screen flex-shrink-0 px-6 md:px-16 py-16 bg-gray-200 bg-cover bg-center text-brown-700 font-anton space-y-8">
        <!-- Image -->
        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('images/dark.png') }}" alt="Limited Edition Dark Chocolate" class="max-w-[80%] md:max-w-[50%] h-auto object-contain">
        </div>
        <!-- Text Content -->
        <div class="md:w-1/2 text-center md:text-left">
            <h2 class="text-3xl md:text-8xl mb-4">Limited Edition Dark Chocolate</h2>
            <p class="text-base md:text-lg mb-6">
                Experience the richness of our handpicked cocoa beans. A must-try for all chocolate lovers.
            </p>
            <a href="{{ route('shop') }}" class="text-white bg-brown-700 px-6 py-3 rounded-lg text-lg hover:bg-brown-500 transition">
                Shop Now
            </a>
        </div>
    </div>

    <div class="slide flex flex-col md:flex-row-reverse items-center justify-center w-screen flex-shrink-0 px-6 md:px-16 py-16 bg-gray-200 bg-cover bg-center text-brown-700 font-anton space-y-8">
        <!-- Image (Placed Above Text in Mobile View) -->
        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('images/three.png') }}" alt="New Chocolate Launch" class="max-w-[100%] md:max-w-[80%] h-auto object-contain">
        </div>
        <!-- Text Content -->
        <div class="md:w-1/2 text-center md:text-left">
            <h2 class="text-3xl md:text-8xl mb-4">A New Brand, A New Taste</h2>
            <p class="text-base md:text-lg mb-6">
                Indulge in our latest chocolate creation—crafted with premium cocoa and a unique blend of flavors.
            </p>
            <a href="{{ route('shop') }}" class="text-white bg-brown-700 px-6 py-3 rounded-lg text-lg hover:bg-brown-500 transition">
                View now
            </a>
        </div>
    </div>

    <div class="slide2 h-screen flex flex-col md:flex-row items-center justify-center w-screen flex-shrink-0 px-6 md:px-16 py-16 bg-gray-200 bg-cover bg-center text-brown-700 font-anton space-y-20 relative overflow-hidden">
        <!-- Sparkle Background Image -->
       
        
        <!-- Text Content -->
        <div class="md:w-3/4 text-center relative z-10">
            <h2 class="text-3xl md:text-8xl mb-4">The Chocolate You’ve Been Looking For</h2>
            <p class="text-base md:text-lg mb-6">
                Rich, smooth, and absolutely irresistible—just a click away.
            </p>
            <a href="{{ route('shop') }}" class="text-white bg-brown-700 px-6 py-3 rounded-lg text-lg hover:bg-brown-500 transition">
                Click Here
            </a>
        </div>
    </div>
    
</div>


<!-- Marquee Section -->  
<div class="bg-gray-200 overflow-hidden">
    <div class="marquee flex items-center space-x-8 h-28 md:h-24">
        <img src="{{ asset('images/brand1.png') }}" alt="Brand 1" class="h-16 md:h-24">
        <img src="{{ asset('images/brand2.png') }}" alt="Brand 2" class="h-16 md:h-24">
        <img src="{{ asset('images/brand3.png') }}" alt="Brand 3" class="h-16 md:h-24">
        <img src="{{ asset('images/brand4.png') }}" alt="Brand 4" class="h-16 md:h-24">
        <img src="{{ asset('images/brand5.png') }}" alt="Brand 5" class="h-16 md:h-24">
        <img src="{{ asset('images/brand6.png') }}" alt="Brand 6" class="h-16 md:h-24">
        <img src="{{ asset('images/brand7.png') }}" alt="Brand 7" class="h-16 md:h-24">
        <img src="{{ asset('images/brand8.png') }}" alt="Brand 8" class="h-16 md:h-24">
        <img src="{{ asset('images/brand9.png') }}" alt="Brand 9" class="h-16 md:h-24">
        <!-- Duplicating for smoother animation -->
        <img src="{{ asset('images/brand1.png') }}" alt="Brand 1" class="h-16 md:h-24">
        <img src="{{ asset('images/brand2.png') }}" alt="Brand 2" class="h-16 md:h-24">
    </div>
</div>



{{-- <!-- Slider Section -->
<div class="relative overflow-hidden mt-10 md:mt-20 w-full h-auto md:h-screen flex flex-col bg-brown-700">
    <div class="slider flex transition-transform duration-300 w-full h-full" id="slider">
        
        <!-- Slide 1 -->
        <div class="slide flex flex-col-reverse md:flex-row items-center justify-center w-full h-full flex-shrink-0 px-6 md:px-16 bg-cover bg-center text-white">
            <!-- Text Content -->
            <div class="md:w-1/2 text-center md:text-left ml-5">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">A New Brand, A New Taste</h2>
                <p class="text-base md:text-lg mb-6">
                    Indulge in our latest chocolate creation—crafted with premium cocoa and a unique blend of flavors.
                </p>
                <a href="{{ route('shop') }}" class="bg-gray-300 text-brown-700 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-brown-500 transition">
                    Add to Cart
                </a>
            </div>
            <!-- Image -->
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/image.png') }}" alt="New Chocolate Launch" class="max-w-[80%] md:max-w-[60%] h-auto object-contain">
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide flex flex-col md:flex-row items-center justify-center w-full h-full flex-shrink-0 px-6 md:px-16 bg-cover bg-center text-white">
            <!-- Image -->
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/dark.png') }}" alt="Limited Edition Dark Chocolate" class="max-w-[80%] md:max-w-[60%] h-auto object-contain">
            </div>
            <!-- Text Content -->
            <div class="md:w-1/2 text-center md:text-left">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">Limited Edition Dark Chocolate</h2>
                <p class="text-base md:text-lg mb-6">
                    Experience the richness of our handpicked cocoa beans. A must-try for all chocolate lovers.
                </p>
                <a href="{{ route('shop') }}" class="bg-gray-300 text-brown-700 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-brown-500 transition">
                    Shop Now
                </a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide flex flex-col-reverse md:flex-row items-center justify-center w-full h-full flex-shrink-0 px-6 md:px-16 bg-cover bg-center text-white">
            <!-- Text Content -->
            <div class="md:w-1/2 text-center md:text-left ml-5">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">The Surprise Chocolate Box</h2>
                <p class="text-base md:text-lg mb-6">
                    Unbox happiness with our special selection of chocolates—perfect for gifts or self-indulgence.
                </p>
                <a href="{{ route('shop') }}" class="bg-gray-300 text-brown-700 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-brown-500 transition">
                    Order Yours
                </a>
            </div>
            <!-- Image -->
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/chocolate3.png') }}" alt="Surprise Chocolate Box" class="max-w-[80%] md:max-w-[60%] h-auto object-contain">
            </div>
        </div>
    </div>



    <!-- Navigation Arrows -->
    <button class="absolute top-1/2 left-4 transform -translate-y-1/2 p-2 text-white  transition hover:scale-110" id="prev">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="absolute top-1/2 right-4 transform -translate-y-1/2 p-2  text-white  transition hover:scale-110" id="next">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-12 md:w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Dots Section -->
    <div class="absolute bottom-4 md:bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2" id="dots">
        <span class="dot w-3 h-3 md:w-4 md:h-4 bg-white rounded-full opacity-50"></span>
        <span class="dot w-3 h-3 md:w-4 md:h-4 bg-white rounded-full opacity-50"></span>
        <span class="dot w-3 h-3 md:w-4 md:h-4 bg-white rounded-full opacity-50"></span>
    </div>
</div>





<script>
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const dots = document.querySelectorAll('.dot');

    let currentIndex = 0;

    function updateSlider() {
        const offset = -currentIndex * 100;
        slider.style.transform = `translateX(${offset}%)`;

        dots.forEach((dot, index) => {
            dot.style.opacity = index === currentIndex ? '1' : '0.5';
        });
    }

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    });

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlider();
    });

    updateSlider();
</script> --}}

@endsection
