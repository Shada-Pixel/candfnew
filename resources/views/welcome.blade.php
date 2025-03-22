<x-guest-layout>

    <main>
        <x-marquee></x-marguee>
        <x-hero></x-hero>


        {{-- Notice Board --}}
        <section class=" pb-10 pt-16">
            <div class="max-w-7xl mx-auto flex gap-4">
                <div class="flex-grow">

                    <h2 class="text-3xl font-bold text-left mb-8 text-gray-800">Notice Board</h2>

                    <div class="flex flex-col gap-4">
                        @forelse ($notices as $notice)
                            {{-- Displaying notice title and id --}}
                            <a href="{{ route('notices.show', $notice->id) }}" class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg"> > {{ $notice->title }}
                            </a>
                        @empty
                            <p>No notices available.</p>
                        @endforelse
                        <div class="flex items-center justify-center mt-4">
                            <a class="text-center px-4 py-2 bg-gradient-to-r from-violet-400 to-purple-300 rounded-md shadow-md hover:shadow-lg hover:scale-110 duration-150 transition-all  font-bold text-lg text-white" href="{{route('notices.index')}}">See All</a>
                        </div>
                    </div>
                </div>
                <x-aside></x-aside>
            </div>
        </section>


        {{-- Advisory Committee --}}
        <section class=" py-10">
            <div class="max-w-7xl mx-auto flex gap-4">
                <div class="flex-grow">

                    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Advisory Committee</h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 mt-5">
                        {{-- Member --}}
                        <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            {{-- image --}}
                            <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                            <div>
                                {{-- name --}}
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                {{-- designation --}}
                                <p class="text-gray-600">Developer</p>
                            </div>
                        </div>
                        {{-- Repeat the above block for other members --}}
                        <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            {{-- image --}}
                            <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                            <div>
                                {{-- name --}}
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                {{-- designation --}}
                                <p class="text-gray-600">Developer</p>
                            </div>
                        </div>
                        {{-- Repeat the above block for other members --}}
                        <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            {{-- image --}}
                            <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                            <div>
                                {{-- name --}}
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                {{-- designation --}}
                                <p class="text-gray-600">Developer</p>
                            </div>
                        </div>
                        {{-- Repeat the above block for other members --}}
                        <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            {{-- image --}}
                            <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                            <div>
                                {{-- name --}}
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                {{-- designation --}}
                                <p class="text-gray-600">Developer</p>
                            </div>
                        </div>
                        {{-- Repeat the above block for other members --}}
                        <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            {{-- image --}}
                            <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                            <div>
                                {{-- name --}}
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                {{-- designation --}}
                                <p class="text-gray-600">Developer</p>
                            </div>
                        </div>
                        {{-- Repeat the above block for other members --}}
                        <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            {{-- image --}}
                            <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset('images/placeholder.jpg') }})"></div>
                            <div>
                                {{-- name --}}
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                {{-- designation --}}
                                <p class="text-gray-600">Developer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact us form --}}
        <section class="bg-gray-100 py-10">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-left mb-8 text-gray-800">Contact Us</h2>
                <div class="flex justify-between gap-4">
                    <div class="basis-1/2">
                        <p>You can send us a message using this form, <br/> or contact us by email or phone.</p>
                    </div>
                    <div class="px-4 py-8 basis-1/2">
                        <form action="#" method="POST" class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                <textarea name="message" id="message" rows="4" class="mt-1 block
                                w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="py-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">FAQ</h2>
                <div class="container mx-auto px-4 py-8">
                    <div class="accordion">
                        <div class="accordion-item border-b border-gray-200">
                            <button class="accordion-title w-full text-left py-4 px-2 text-gray-800 font-semibold focus:outline-none">
                                What is ITC?
                            </button>
                            <div class="accordion-content hidden px-2 pb-4 text-gray-600">
                                <p>ITC is a short form of Information Technology Center. It is a center that provides IT services to the university.</p>
                            </div>
                        </div>
                        <div class="accordion-item border-b border-gray-200">
                            <button class="accordion-title w-full text-left py-4 px-2 text-gray-800 font-semibold focus:outline-none">
                                What is the purpose of ITC?
                            </button>
                            <div class="accordion-content hidden px-2 pb-4 text-gray-600">
                                <p>The purpose of ITC is to provide IT services to the university.</p>
                            </div>
                        </div>
                        <div class="accordion-item border-b border-gray-200">
                            <button class="accordion-title w-full text-left py-4 px-2 text-gray-800 font-semibold focus:outline-none">
                                What services does ITC provide?
                            </button>
                            <div class="accordion-content hidden px-2 pb-4 text-gray-600">
                                <p>ITC provides services like web development, software development, network management, etc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const items = document.querySelectorAll('.accordion-title');
            items.forEach(item => {
                item.addEventListener('click', function () {
                    const content = this.nextElementSibling;
                    content.classList.toggle('hidden');
                });
            });
        });
    </script>

</x-guest-layout>
