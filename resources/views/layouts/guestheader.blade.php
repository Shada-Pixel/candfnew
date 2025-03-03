<nav class="flex flex-wrap items-center justify-between max-w-7xl mx-auto py-4 md:py-0 px-4 text-lg text-gray-700 bg-white">
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
            <li>
                <a class="md:p-4 py-2 block hover:text-bb" href="{{route('notices.index')}}">Notices</a>
            </li>
            <li>
                <a class="md:p-4 py-2 block hover:text-bb" href="#">Pricing</a>
            </li>
            <li>
                <a class="md:p-4 py-2 block hover:text-bb" href="#">Customers</a>
            </li>
            <li>
                <a class="md:p-4 py-2 block hover:text-bb" href="#">Blog</a>
            </li>
            <li>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="md:p-4 py-2 hover:text-bb text-center flex items-center" type="button">
                    <span>Dropdown button</span>
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                    </li>
                    </ul>
                </div>
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
