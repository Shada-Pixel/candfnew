<x-guest-layout>


    {{-- Title --}}
    <x-slot name="title">Home</x-slot>

    <main>
        <x-marquee></x-marguee>
        <x-hero></x-hero>


        <section class=" pb-10 pt-16">
            <div class="container mx-auto flex gap-4 px-4">
                <div class="basis-4/5">

                    {{-- Notice Board --}}
                    <div class="flex-grow">

                        <h2 class="text-3xl font-bold text-left mb-8 text-gray-800">Notice Board</h2>

                        <div class="flex flex-col gap-4">
                            @forelse ($notices as $notice)
                                {{-- Displaying notice title and id --}}
                                <a href="{{ route('notices.show', $notice->id) }}" class="card px-6 py-4 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg"><i class="mdi mdi-arrow-right-bold-circle text-lg text-green-500"></i> {{ $notice->title }}
                                </a>
                            @empty
                                <p>No notices available.</p>
                            @endforelse
                            <div class="flex items-center justify-center mt-4">
                                <a class="text-center px-4 py-2 bg-gradient-to-r from-violet-400 to-purple-300 rounded-md shadow-md hover:shadow-lg hover:scale-110 duration-150 transition-all  font-bold text-lg text-white" href="{{route('notices.index')}}">See All</a>
                            </div>
                        </div>
                    </div>


                    {{-- Mesages From the President --}}
                    <div class="mt-12">
                        <h2 class="text-3xl font-bold text-left mb-8 text-gray-800">Mesages From the President</h2>


                        <div class="flex justify-between items-start gap-6">

                            <div class="basis-1/4 flex flex-col items-center">
                                {{-- image --}}
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="President">
                            </div>

                            <div class="text-gray-600 basis-3/4">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                                    nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                                    tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
                                    quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos
                                    sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
                                    recusandae alias error harum maxime adipisci amet laborum. Perspiciatis
                                    minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit
                                    quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur
                                    fugiat, temporibus enim commodi iusto libero magni deleniti quod quam
                                    consequuntur! Commodi minima excepturi repudiandae velit hic maxime
                                    doloremque. Quaerat provident commodi consectetur veniam similique ad
                                    earum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo
                                    fugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore
                                    suscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium
                                    modi minima sunt esse temporibus sint culpa, recusandae aliquam numquam
                                    totam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam
                                    quasi aliquam eligendi, placeat qui corporis!
                                </p>
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                <p class="text-gray-600">President</p>
                            </div>
                        </div>
                        {{-- message --}}

                    </div>
                    {{-- Mesages From the General Secretary --}}
                    <div class="mt-12">
                        <h2 class="text-3xl font-bold text-left mb-8 text-gray-800">Mesages From the General Secretary</h2>


                        <div class="flex justify-between items-start gap-6">

                            <div class="basis-1/4 flex flex-col items-center">
                                {{-- image --}}
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="President">
                            </div>

                            <div class="text-gray-600 basis-3/4">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                                    nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                                    tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
                                    quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos
                                    sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
                                    recusandae alias error harum maxime adipisci amet laborum. Perspiciatis
                                    minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit
                                    quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur
                                    fugiat, temporibus enim commodi iusto libero magni deleniti quod quam
                                    consequuntur! Commodi minima excepturi repudiandae velit hic maxime
                                    doloremque. Quaerat provident commodi consectetur veniam similique ad
                                    earum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo
                                    fugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore
                                    suscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium
                                    modi minima sunt esse temporibus sint culpa, recusandae aliquam numquam
                                    totam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam
                                    quasi aliquam eligendi, placeat qui corporis!
                                </p>
                                <h3 class="font-bold text-lg text-gray-900">Sabbir Hussain</h3>
                                <p class="text-gray-600">President</p>
                            </div>
                        </div>
                        {{-- message --}}

                    </div>
                </div>
                <x-aside></x-aside>
            </div>
        </section>


        {{-- Advisory Committee --}}
        <section class=" py-10">
            <div class="container mx-auto flex gap-4 px-4">
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
        <section class="bg-gray-100 py-10 hidden">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Contact Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Contact Information -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Get in Touch</h3>
                        <p class="text-gray-600 mb-4">
                            You can send us a message using this form, or contact us by email or phone. We’d love to hear from you!
                        </p>
                        <ul class="text-gray-600 space-y-3">
                            <li><i class="mdi mdi-phone text-indigo-500"></i> <strong>Phone:</strong> +123 456 7890</li>
                            <li><i class="mdi mdi-email text-indigo-500"></i> <strong>Email:</strong> contact@example.com</li>
                            <li><i class="mdi mdi-map-marker text-indigo-500"></i> <strong>Address:</strong> 123 Main Street, City, Country</li>
                        </ul>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Send Us a Message</h3>
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
                                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="py-12 bg-gray-50 hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Frequently Asked Questions</h2>

                <div class="space-y-4">
                    <div class="rounded-lg shadow-md overflow-hidden">
                        <button
                            class="faq-button block w-full text-left p-4 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200 ease-in-out"
                            aria-expanded="false"
                        >
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-medium text-gray-800">What is ITC?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 ease-in-out"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-content hidden p-4 bg-gray-50 text-gray-700">
                            ITC is a short form of Information Technology Center. It is a center that provides IT services to the university.
                        </div>
                    </div>

                    <div class="rounded-lg shadow-md overflow-hidden">
                        <button
                            class="faq-button block w-full text-left p-4 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200 ease-in-out"
                            aria-expanded="false"
                        >
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-medium text-gray-800">What is the purpose of ITC?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 ease-in-out"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-content hidden p-4 bg-gray-50 text-gray-700">
                            The purpose of ITC is to provide IT services to the university.
                        </div>
                    </div>

                    <div class="rounded-lg shadow-md overflow-hidden">
                        <button
                            class="faq-button block w-full text-left p-4 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200 ease-in-out"
                            aria-expanded="false"
                        >
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-medium text-gray-800">What services does ITC provide?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 ease-in-out"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-content hidden p-4 bg-gray-50 text-gray-700">
                            ITC provides services like web development, software development, network management, etc.
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <x-slot name="script">

        {{-- Scripts --}}

        <script>
            $(document).ready(function () {
                $('.faq-button').on('click', function () {
                    const $this = $(this);
                    const $content = $this.next('.faq-content');
                    const $icon = $this.find('svg');
                    const isExpanded = $this.attr('aria-expanded') === 'true';

                    $this.attr('aria-expanded', !isExpanded);
                    $content.toggleClass('hidden');
                    $icon.toggleClass('rotate-180');

                    // Close other accordions
                    $('.faq-button').not($this).each(function () {
                        const $otherButton = $(this);
                        const $otherContent = $otherButton.next('.faq-content');
                        const $otherIcon = $otherButton.find('svg');
                        $otherButton.attr('aria-expanded', 'false');
                        $otherContent.addClass('hidden');
                        $otherIcon.removeClass('rotate-180');
                    });
                });
            });
        </script>
    </x-slot>


</x-guest-layout>
