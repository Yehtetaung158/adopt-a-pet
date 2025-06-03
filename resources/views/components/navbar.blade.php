<nav class="w-full bg-gray-800 text-green-400 p-4">
    <ul class="flex space-x-4">
        @auth
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</nav>
