<x-guest-layout>


    {{-- Title --}}
    <x-slot name="title">Web Links</x-slot>

    <main>
        {{-- Web Links --}}
        <section class="" id="">
            <div class="bg-gradient-to-r from-violet-400 to-purple-300 py-8">
                <div class="container mx-auto px-4">
                    <h1 class="text-3xl font-bold text-center text-gray-800">Web Links</h1>
                </div>
            </div>
            <div class="bg-white py-8">
                <div class="max-w-6xl mx-auto px-4">
                  <h2 class="text-2xl font-bold mb-6">Important Government Links</h2>
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="https://benapolecustoms.portal.gov.bd" class="block p-4 border rounded hover:bg-gray-50 transition">
                      <h3 class="text-lg font-semibold">Custom House, Benapole</h3>
                      <p class="text-sm text-gray-600">Official portal for Benapole Customs House.</p>
                    </a>
                    <a href="https://www.bangladesh.gov.bd" class="block p-4 border rounded hover:bg-gray-50 transition">
                      <h3 class="text-lg font-semibold">Bangladesh National Portal</h3>
                      <p class="text-sm text-gray-600">Central gateway to government services and information.</p>
                    </a>
                    <a href="https://bdlaws.minlaw.gov.bd" class="block p-4 border rounded hover:bg-gray-50 transition">
                      <h3 class="text-lg font-semibold">Laws of Bangladesh</h3>
                      <p class="text-sm text-gray-600">Official repository of all laws and acts.</p>
                    </a>
                    <!-- Add more links similarly -->
                  </div>
                </div>
              </div>

        </section>
        
    </main>

</x-guest-layout>
