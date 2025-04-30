<x-guest-layout>


    {{-- Title --}}
    <x-slot name="title">Contact</x-slot>

    <main>
        <section>
            <div class="bg-gradient-to-r from-violet-400 to-purple-300 py-8">
                <div class="container mx-auto px-4">
                    <h1 class="text-3xl font-bold text-center text-gray-800">Contact Us</h1>
                </div>
            </div>
        </section>
        {{-- Contact us form --}}
        <section class="bg-gray-100 py-10">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">

                    
                    <!-- Contact Information -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Get in Touch</h3>
                    
                        <p class="text-gray-600 mb-4">
                            You can send us a message using this form, or contact us by email or phone. We'd love to hear from you!
                        </p>
                        <ul class="text-gray-600 space-y-3">
                            <li><i class="mdi mdi-phone text-indigo-500"></i> <strong>Phone:</strong> <a href="tel:+88029667400" class="hover:text-violet-600 transition-colors">+88029667400</a></li>
                            <li><i class="mdi mdi-email text-indigo-500"></i> <strong>Email:</strong> <a href="mailto:info@benapole.gov.bd" class="hover:text-violet-600 transition-colors">info@benapole.gov.bd</a></li>
                            <li><i class="mdi mdi-map-marker text-indigo-500"></i> <strong>Address:</strong> Benapole Customs House Benapole-7431, BANGLADESH</li>
                        </ul>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Send Us a Message</h3>
                        @if(session('success'))
                            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST" class="grid grid-cols-1 gap-6">
                            @csrf
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
                {{-- Google Map --}}
                <div class="rounded-md overflow-hidden shadow-md">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.4267809471976!2d88.89689597594261!3d23.044810015496765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff37d7fc8587bd%3A0xd04c6da8aa7688af!2z4Kas4KeH4Kao4Ka-4Kaq4KeL4KayIOCmuOCmvybgpo_gpqsg4KaP4Kac4KeH4Kao4KeN4Kaf4Ka4IOCmheCnjeCmr-CmvuCmuOCni-CmuOCmv-Cmr-CmvOCnh-CmtuCmqA!5e0!3m2!1sbn!2sbd!4v1744119932034!5m2!1sbn!2sbd" class="w-full" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

    </main>

    <x-slot name="script">

    </x-slot>


</x-guest-layout>
