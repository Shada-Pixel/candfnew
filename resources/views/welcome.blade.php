<x-guest-layout>


    {{-- Title --}}
    <x-slot name="title">Home</x-slot>

    <main>
        {{-- check marquees value --}}
        @if ($marquees->count() > 0)
        <div class="overflow-hidden bg-gradient-to-r from-violet-400 to-purple-300 py-2">
            <div id="marquee" class="whitespace-nowrap">
                @foreach ($marquees as $marquee)
                    @if ($marquee->active)
                        <span class="font-bold text-white">{{ $marquee->content }} 🌟 </span>
                    @endif

                @endforeach
            </div>
        </div>

        @endif
        <x-hero></x-hero>





        <section class=" pb-10 pt-16">
            <div class="container mx-auto flex gap-4 px-4">
                <div class="basis-4/5">

                    {{-- Gallery section --}}
                    <div class="flex-grow mb-8">
                        <h2 class="text-3xl font-bold text-left mb-8 text-gray-800">Photo Gallery</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @forelse($galleries as $gallery)
                                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl"
                                    style="min-height: 300px;">
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                        style="background-image: url('{{ asset($gallery->image) }}')">
                                    </div>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 transition-all duration-300 group-hover:bg-opacity-50">
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white translate-y-full transition-transform duration-300 group-hover:translate-y-0">
                                        <h3 class="text-lg font-semibold">{{ $gallery->title }}</h3>
                                        @if($gallery->description)
                                            <p class="mt-2 text-sm opacity-90">{{ $gallery->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-12 bg-gray-50 rounded-lg">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mt-2 text-gray-500">No gallery images available</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

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
                                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
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
                                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
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
                        @forelse ($advisories as $advisory)
                            {{-- Member --}}
                            <div class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                {{-- image --}}
                                <div class="w-20 h-20 rounded-full bg-cover bg-no-repeat" style="background-image: url({{ asset($advisory->photo) }})"></div>
                                <div>
                                    {{-- name --}}
                                    <h3 class="font-bold text-lg text-gray-900">{{ $advisory->name }}</h3>
                                    {{-- designation --}}
                                    <p class="text-gray-600">{{ $advisory->designation }}</p>
                                </div>
                            </div>
                        @empty
                            {{-- No members found --}}
                            <div class="text-center col-span-2 sm:col-span-3">
                                <p class="text-gray-600">No advisory committee members found.</p>
                            </div>

                        @endforelse
                    </div>
                </div>
            </div>
        </section>


        {{-- Make a two colum add showing section --}}
        <section>
            <div class="container mx-auto flex gap-4 px-4 pb-8">
                <div class="">
                    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Advertisement</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-5">
                        <a class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            <div>
                                <h3 class="font-bold text-lg text-gray-900">Advertisement Title</h3>
                                <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum!</p>
                            </div>
                        </a>
                        <a class="card p-6 shadow-md flex gap-4 justify-start items-center rounded-lg bg-white transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                            <div>
                                <h3 class="font-bold text-lg text-gray-900">Advertisement Title</h3>
                                <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum!</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <x-slot name="script">

        {{-- Scripts --}}

        <script>

        </script>
    </x-slot>


</x-guest-layout>
