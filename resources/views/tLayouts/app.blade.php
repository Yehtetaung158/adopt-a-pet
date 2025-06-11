<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'My App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">


    @include('tLayouts.navbar')
    <main>
        <div>
            @yield('header')
        </div>
        <div class="flex-grow mx-auto pb-6 gap-8 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
    <footer class="bg-purple-600 text-white py-4 mt-auto">

        <div class="container mx-auto flex flex-col gap-4 md:flex-row justify-start items-center space-y-4 md:space-y-0">
            <ul class="flex flex-col items-start gap-2">
                <li class="text-center mb-2 text-xl font-medium">
                    <a href="{{ route('home') }}" class="hover:underline">Pages</a>
                </li>
                <li class="text-center mb-2">
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                </li>
                <li class="text-center mb-2">
                    <a href="#" class="hover:underline">Pets</a>
                </li>
                <li class="text-center mb-2">
                    <a href="#" class="hover:underline">Favorites</a>
                </li>
                <li class="text-center mb-2">
                    <a href="#" class="hover:underline">About Us</a>
                </li>
            </ul>

            <ul>
                <li class="text-center mb-2">
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                </li>
                <li class="text-center mb-2">
                    <a href="#" class="hover:underline">Pets</a>
                </li>
                <li class="text-center mb-2">
                    <a href="#" class="hover:underline">Favorites</a>
                </li>
                <li class="text-center mb-2">
                    <a href="#" class="hover:underline">About Us</a>
                </li>
            </ul>
        </div>

        <div class="container mx-auto text-center">
            <p>&copy; 2023 Pet Adoption. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>
