<nav class="hidden flex-wrap items-center justify-between max-w-7xl mx-auto py-4 md:py-0 px-4 text-lg text-gray-700 bg-white">
    <div class="py-2.5">
        <a href="/" >
            <div class="flex gap-2 items-center">
                <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px]">
                <p class="text:nblue text-2xl uppercase font-bold leading-none">Benapole<br/>C&F Association</p>
            </div>
        </a>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-6 w-6 cursor-pointer md:hidden block"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>

    <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
        <ul
            class="
              pt-4
              text-base text-nblue
              md:flex
              md:justify-between
              md:pt-0">

            <li class="relative">
                <a class="md:p-4 py-2 block hover:text-bb" href="{{route('notices.index')}}">ITC Reports</a>
                <ul class="absolute bg-red-500 p-4">
                    <li>hi</li>
                </ul>
            </li>





            <li>
                <a class="md:p-4 py-2 block hover:text-bb" href="{{route('notices.index')}}">Notices</a>
            </li>
            <li>
                <a class="md:p-4 py-2 block hover:text-bb" href="#">General Members</a>
            </li>
            <li>
                @guest

                <a class="md:p-4 py-2 block hover:text-bb text-purple-500" href="{{route('login')}}">Login</a>
                @endguest
                @auth
                <a class="md:p-4 py-2 block hover:text-bb text-purple-500" href="{{route('dashboard')}}">Chada</a>

                @endauth
            </li>
        </ul>
    </div>
</nav>


<!-- Navigation Bar -->
<nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="py-4">
                    <div class="flex gap-2 items-center">
                        <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px]">
                        <p class="text:nblue text-2xl uppercase font-bold leading-none">Benapole<br/>C&F Association</p>
                    </div>
                </a>

                <!-- Menu Items (Desktop) -->
                <div class="hidden md:flex items-center">
                    <a href="/" class="text-gray-800 hover:text-blue-500 px-3 py-2">Home</a>

                    <!-- Dropdown Container -->
                    <div class="relative">
                        <button id="desktop-dropdown-button" class="text-gray-800 hover:text-blue-500 px-3 py-2 flex items-center">ITC Reports
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="desktop-dropdown-menu" class="absolute hidden bg-white shadow-md rounded-lg mt-2 py-2 w-48 z-10">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">Monthly</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">Yearly</a>
                            <a href="{{route('itc-reports.index')}}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">All</a>
                        </div>
                    </div>

                    <a class="md:p-4 py-2 block hover:text-bb" href="{{route('notices.index')}}">Notices</a>
                    <a href="#" class="text-gray-800 hover:text-blue-500 px-3 py-2">Contact</a>
                    <a class="md:p-4 py-2 block hover:text-bb" href="#">General Members</a>

                    @guest
                    <a class="md:p-4 py-2 block hover:text-bb text-purple-500" href="{{route('login')}}">Login</a>
                    @endguest
                    @auth
                    <a class="md:p-4 py-2 block hover:text-bb text-purple-500" href="{{route('dashboard')}}">Chada</a>

                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-800 hover:text-blue-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block text-gray-800 hover:text-blue-500 px-3 py-2">Home</a>
                <a href="#" class="block text-gray-800 hover:text-blue-500 px-3 py-2">About</a>

                <!-- Mobile Dropdown -->
                <div class="relative">
                    <button id="mobile-dropdown-button" class="w-full text-left text-gray-800 hover:text-blue-500 px-3 py-2 flex items-center justify-between">
                        Services
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Mobile Dropdown Menu -->
                    <div id="mobile-dropdown-menu" class="hidden pl-4">
                        <a href="#" class="block text-gray-800 hover:text-blue-500 px-3 py-2">Web Design</a>
                        <a href="#" class="block text-gray-800 hover:text-blue-500 px-3 py-2">SEO</a>
                        <a href="#" class="block text-gray-800 hover:text-blue-500 px-3 py-2">Marketing</a>
                    </div>
                </div>

                <a href="#" class="block text-gray-800 hover:text-blue-500 px-3 py-2">Contact</a>
            </div>
        </div>
    </nav>