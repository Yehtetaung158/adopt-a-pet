<nav x-data="{ open: false }" class="w-full bg-zinc-50 relative border-b border-purple-600">
    <div class="flex w-full max-w-[1200px] mx-auto justify-between space-x-4 py-4">
        <div class="flex items-center space-x-4">
            <!-- Logo -->
            <a href="{{ url('/') }}">
                <x-application-logo class="h-8 w-auto fill-current text-purple-600" />
            </a>
            <button @click="open = !open"
                class="flex items-center space-x-2 border border-purple-600 px-3 py-1 text-purple-600 hover:bg-purple-100 hover:text-purple-700 transition rounded-md">
                <span>Menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 transform transition-transform duration-300"
                    :class="{ 'rotate-180': open }">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>

        <div x-data="{ open: false }" class="relative flex items-center space-x-4">

            <a href="{{ route('favorites') }}" class=" border-r-2 pr-2 border-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-500">
                    <path
                        d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                </svg>
            </a>

            <button @click="open = !open"
                class="flex items-center space-x-2 border border-purple-600 bg-purple-600 px-4 py-1 rounded-2xl text-white hover:bg-purple-700 focus:outline-none transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 py-2 border border-gray-200"
                style="display: none;">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 text-sm text-slate-800 hover:bg-purple-100">Dashboard</a>
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-slate-800 hover:bg-purple-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-slate-800 hover:bg-purple-100">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-sm text-slate-800 hover:bg-purple-100">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-sm text-slate-800 hover:bg-purple-100">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Dropdown menu for small screens -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="text-sm text-white w-full bg-purple-600 absolute top-full left-0 right-0 z-10">
        <div class="py-4 w-full max-w-[1200px] mx-auto">
            <ul class="flex flex-wrap gap-3 justify-between px-2">
                <li><a class="hover:text-amber-400" href="{{ url('/') }}">Home</a></li>
                <li><a class="hover:text-amber-400" href="{{ url('/pets') }}">Pets</a></li>
                <li><a class="hover:text-amber-400" href="{{ url('/blogs') }}">Blog</a></li>
                <li><a class="hover:text-amber-400" href="{{ url('/orders') }}">Order</a></li>
            </ul>
        </div>
    </div>
</nav>
