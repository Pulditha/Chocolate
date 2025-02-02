@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 ">
    <!-- Header Section -->
    <div class="text-center">  
        <p class="text-[4rem] sm:text-[5rem] md:text-[6rem] lg:text-[10rem] text-brown-700 font-anton">ABOUT US</p>  
    </div>  

    <!-- Content Sections -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left my-5">
        <!-- Story Section -->
        <div class="border-2 border-brown-700 p-4 rounded-md">
            <h2 class="text-3xl  text-brown-700 font-anton">OUR STORY</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">
                At ChocoShop, we bring together the finest chocolates from well-loved brands around the world. We started with a passion for sharing the joy of premium chocolates, and our goal is to offer an indulgent experience through a curated selection that delights every chocolate lover.
            </p>
            <img src="{{ asset('images/chocolate1.png') }}" alt="Our Story Image" class="mt-6 mx-auto rounded-lg">
        </div>

        <!-- Process & Benefits Section -->
        <div class="border-2 border-brown-700 p-4 rounded-md">
            <h2 class="text-3xl  text-brown-700 font-anton">OUR PROMISE</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">
                We work with top-tier chocolate brands that share our commitment to quality and ethical sourcing. Our platform ensures that every chocolate is a testament to premium ingredients, sustainability, and a passion for flavor.
            </p>
            <div class="mt-6">
                <h3 class="text-lg text-brown-700 font-anton underline">PREMIUM QUALITY</h3>
                <p class="text-gray-600 mt-2">
                    We offer chocolates made from the finest cocoa and natural ingredients, ensuring every bite is exceptional.
                </p>
                <h3 class="text-lg text-brown-700 font-anton underline mt-4">ETHICALLY SOURCED</h3>
                <p class="text-gray-600 mt-2">
                    Partnering with brands that prioritize sustainability, we ensure that every chocolate is sourced responsibly.
                </p>
            </div>
        </div>

            <!-- Our Chocolates Section -->
            <div class="border-2 border-brown-700 p-4 rounded-md">
                <h2 class="text-3xl font-anton text-brown-700 font-anton">OUR CHOCOLATES</h2>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    Whether it's the smoothness of milk chocolate or the boldness of dark chocolate, we offer a range of products from brands that create memorable indulgences. There's something for every taste and craving at ChocoShop.
                </p>
                <div class="border-2 border-brown-700 p-4 rounded-md mt-6">
                    <h3 class="text-xl font-anton text-brown-700">EXCEPTIONAL SELECTION</h3>
                    <p class="text-gray-600 mt-2">
                        We carefully select premium chocolates to ensure an indulgent and satisfying experience.
                    </p>
                </div>
                <div class="border-2 border-brown-700 p-4 rounded-md mt-4">
                    <h3 class="text-xl font-anton  text-brown-700">FOR ALL TASTES</h3>
                    <p class="text-gray-600 mt-2">
                        From creamy milk to intense dark, we offer chocolates that cater to every preference.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center">  
            <p class="text-[4rem] sm:text-[5rem] md:text-[6rem] lg:text-[10rem] text-brown-700 font-anton">Our Brands</p>  
        </div>  

<!-- Marquee Section -->  
<div class="bg-gray-200 overflow-hidden">  
    <div class="marquee flex items-center space-x-8 h-28">  
        <img src="{{ asset('images/brand1.png') }}" alt="Brand 1" class="h-24">  
        <img src="{{ asset('images/brand2.png') }}" alt="Brand 2" class="h-24">  
        <img src="{{ asset('images/brand3.png') }}" alt="Brand 3" class="h-24">  
        <img src="{{ asset('images/brand4.png') }}" alt="Brand 4" class="h-24">  
        <img src="{{ asset('images/brand5.png') }}" alt="Brand 5" class="h-24">  
        <img src="{{ asset('images/brand6.png') }}" alt="Brand 6" class="h-24">  
        <img src="{{ asset('images/brand7.png') }}" alt="Brand 7" class="h-24">  
        <img src="{{ asset('images/brand8.png') }}" alt="Brand 8" class="h-24">  
        <img src="{{ asset('images/brand9.png') }}" alt="Brand 9" class="h-24">  
        <!-- Add more brands as needed -->
    </div>  
</div>

</div>
@endsection
