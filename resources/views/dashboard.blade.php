@php
    $user = Auth::user();
    $profile = $user->profile;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div>
            <h1>Welcome, {{ Auth::user()->name }}</h1>
        </div>
    </x-slot>

    {{-- <div class="mt-6 bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Your Profile</h3>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->is_admin ? 'Admin' : 'User' }}</p>

        @if ($profile)
            <p><strong>Phone:</strong> {{ $profile->phone }}</p>
            <p><strong>Address:</strong> {{ $profile->address }}</p>
        @else
            <p class="text-red-500">No profile information found.</p>
        @endif
    </div> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div> --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center justify-center">
                    <a class="text-white text-center px-6 py-4 bg-green-500 rounded-lg hover:bg-green-600 transition"
                        href="{{ route('categories.index') }}">
                        Categories
                    </a>
                    <a class="text-white text-center px-6 py-4 bg-blue-500 rounded-lg hover:bg-blue-600 transition"
                        href="{{ route('breeds.index') }}">
                        Breeds
                    </a>
                    <a class="text-white text-center px-6 py-4 bg-purple-500 rounded-lg hover:bg-purple-600 transition"
                        href="{{ route('pets.index') }}">
                        Pets
                    </a>
                    @if (Auth::user() && Auth::user()->is_admin)
                        <a class="text-white text-center px-6 py-4 bg-red-500 rounded-lg hover:bg-red-600 transition"
                            href="{{ route('users.index') }}">
                            Registered Users
                        </a>
                    @endif
                    <a class="text-white text-center px-6 py-4 bg-yellow-500 rounded-lg hover:bg-yellow-600 transition"
                        href="{{ route('orders.index') }}">
                        Orders
                    </a>
                    <a class="text-white text-center px-6 py-4 bg-pink-500 rounded-lg hover:bg-pink-600 transition"
                        href="{{ route('profile.show') }}">
                        Profile
                    </a>
                </div>

                <form class=" flex items-center justify-end mt-6 gap-2" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <p class=" text-slate-500">Just one click to logout</p>
                    <button type="submit" class="text-red-500  px-2 py-1 rounded-lg bg-red-200  hover:underline">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
