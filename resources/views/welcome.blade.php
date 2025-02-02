<x-guest-layout>

    <main>

        {{-- Hero --}}
        <section
            class="w-full min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 herobgo bg-cover bg-center"
            style="background-image: url('{{ asset('images/background.jpg') }}');">
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
        {{-- Notice section --}}
        <section class="bg-indigo-300 py-2">
            <!-- Inspired by: https://pocket.tailwindui.com/#reviews -->
            <div class="overflow-hidden w-full">
                <div class="flex gap-4 pr-4 w-[200%] animate-marquee" style="--marquee-duration: 10000ms;">
                    <div class="flex flex-1 gap-4">
                        <div class=" ">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti at aliquam quo reiciendis nostrum doloribus itaque veniam minima rerum non.
                        </div>
                        <div class=" ">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti at aliquam quo reiciendis nostrum doloribus itaque veniam minima rerum non.
                        </div>
                        <div class=" ">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti at aliquam quo reiciendis nostrum doloribus itaque veniam minima rerum non.
                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- Advisory Comitee --}}
        <section>
            <div class="max-w-7xl mx-auto py-10">
                <h2 class="text-3xl font-bold text-center mb-8">Advisory Comitee</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-5">


                    {{-- Member --}}
                    <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg">
                        {{-- image --}}
                        <div class="w-20 aspect-square rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                        <div class="">

                            {{-- name --}}
                            <h3 class="font-bold text-lg">Sabbir Hussain</h3>
                            {{-- designation --}}
                            <p>Developer</p>
                        </div>
                    </div>
                    {{-- Member --}}
                    <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg">
                        {{-- image --}}
                        <div class="w-20 aspect-square rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                        <div class="">

                            {{-- name --}}
                            <h3 class="font-bold text-lg">Sabbir Hussain</h3>
                            {{-- designation --}}
                            <p>Developer</p>
                        </div>
                    </div>
                    {{-- Member --}}
                    <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg">
                        {{-- image --}}
                        <div class="w-20 aspect-square rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                        <div class="">

                            {{-- name --}}
                            <h3 class="font-bold text-lg">Sabbir Hussain</h3>
                            {{-- designation --}}
                            <p>Developer</p>
                        </div>
                    </div>
                    {{-- Member --}}
                    <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg">
                        {{-- image --}}
                        <div class="w-20 aspect-square rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                        <div class="">

                            {{-- name --}}
                            <h3 class="font-bold text-lg">Sabbir Hussain</h3>
                            {{-- designation --}}
                            <p>Developer</p>
                        </div>
                    </div>
                    {{-- Member --}}
                    <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg">
                        {{-- image --}}
                        <div class="w-20 aspect-square rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                        <div class="">

                            {{-- name --}}
                            <h3 class="font-bold text-lg">Sabbir Hussain</h3>
                            {{-- designation --}}
                            <p>Developer</p>
                        </div>
                    </div>
                    {{-- Member --}}
                    <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg">
                        {{-- image --}}
                        <div class="w-20 aspect-square rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                        <div class="">
                            {{-- name --}}
                            <h3 class="font-bold text-lg">Sabbir Hussain</h3>
                            {{-- designation --}}
                            <p>Developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

</x-guest-layout>
