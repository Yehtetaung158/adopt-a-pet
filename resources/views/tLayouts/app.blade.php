<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'My App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Navbar --}}
    @include('tLayouts.navbar')
    {{-- Main content --}}
    <main class="">
        @yield('content')
    </main>

    {{-- Footer --}}
    {{-- @include('components.footer') --}}

</body>
</html>
