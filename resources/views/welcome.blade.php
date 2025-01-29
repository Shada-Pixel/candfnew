<x-guest-layout>

    <main>

        {{-- Hero --}}
        <section class="w-full min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 herobgo bg-cover bg-center bg-red-500" style="background-image: url('{{ asset('images/background.jpg') }}');">
            <div class="">
                <!-- filepath: welcome.blade.php -->
                <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
                    <h1 class="text-5xl font-bold leading-tight mb-4">Welcome to Our Awesome Website</h1>
                    <p class="text-lg text-gray-300 mb-8">Discover amazing features and services that await you.</p>
                    <a href="#"
                        class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Get
                        Started</a>
                </div>
        </section>

    </main>

</x-guest-layout>
