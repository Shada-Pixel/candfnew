<section>
    <div class="mx-auto container px-4 py-4 flex gap-4">
        <div class="basis-4/5">
            <!-- Carousel Container -->
            <div class="carousel-container rounded-md">

                {{-- Slide one --}}
                <div class="carousel-slide active">
                    <img src="https://picsum.photos/1200/600?random=1" alt="Slide 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center px-6">
                        <h1 class="text-white text-5xl font-extrabold drop-shadow-lg mb-4">Explore New Horizons</h1>
                        <p class="text-white text-lg font-medium drop-shadow-md mb-6">
                            Step into a world of innovation and creativity. Together, we can achieve greatness and redefine possibilities.
                        </p>
                        <a href="#services" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition duration-300">
                            Our Services
                        </a>
                    </div>
                </div>
                {{-- Slide one --}}
                <div class="carousel-slide">
                    <img src="https://picsum.photos/1200/600?random=2" alt="Slide 2" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center px-6">
                        <h1 class="text-white text-5xl font-extrabold drop-shadow-lg mb-4">Welcome to Our Platform</h1>
                        <p class="text-white text-lg font-medium drop-shadow-md mb-6">
                            Discover endless possibilities and opportunities with us. Let’s embark on a journey of growth and success together.
                        </p>
                        <a href="#about" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
                {{-- Slide one --}}
                <div class="carousel-slide">
                    <img src="https://picsum.photos/1200/600?random=3" alt="Slide 3" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center px-6">
                        <h1 class="text-white text-5xl font-extrabold drop-shadow-lg mb-4">Discover Your Journey</h1>
                        <p class="text-white text-lg font-medium drop-shadow-md mb-6">
                            Your dreams are within reach. Let us guide you toward achieving your goals and making a lasting impact.
                        </p>
                        <a href="#contact" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition duration-300">
                            Contact Us
                        </a>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <div class="carousel-btn prev-btn">❮</div>
                <div class="carousel-btn next-btn">❯</div>

                <div class="carousel-bullets">
                    <div class="bullet active" data-slide="0"></div>
                    <div class="bullet" data-slide="1"></div>
                    <div class="bullet" data-slide="2"></div>
                </div>
            </div>
        </div>
        <div class="card px-2 w-60 flex justify-between flex-col flex-grow">
            <div   class="block text-center px-4 py-2 bg-white shadow-md hover:shadow-lg hover:scale-105 duration-150 transition-all w-full font-bold text-lg" href="">
                <img src="{{ asset('images/President.jpg') }}" alt="President" class="full h-auto">
                <div class="text-center text-lg font-bold text-gray-800 py-4">
                    President
                </div>
            </div>
            <div   class="block text-center px-4 py-2 bg-white shadow-md hover:shadow-lg hover:scale-105 duration-150 transition-all w-full font-bold text-lg" href="">
                <img src="{{ asset('images/General Secretary.jpg') }}" alt="General Secretary" class="full h-auto">
                <div class="text-center text-lg font-bold text-gray-800 py-4">
                    General Secretary
                </div>
            </div>
        </div>
    </div>
</section>


