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
                <a class="md:p-4 py-2 block hover:text-bb" href="{{route('notices.index')}}">ITC Reports</a>
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
