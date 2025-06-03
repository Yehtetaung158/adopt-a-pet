@props([
    'image',
    'name',
])

<div class="max-w-xs bg-white rounded-2xl overflow-hidden shadow-md">
    <!-- Image Section -->
    <div class="relative">
        <img
            src="{{ asset($image) }}"
            alt="{{ $name }}"
            class="w-full h-48 object-cover"
        />
        <!-- Heart Icon Overlay -->
        <button
            class="absolute top-2 right-2 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-red-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"
                />
            </svg>
        </button>
    </div>

    <!-- Name Section -->
    <div class="px-4 py-3">
        <h3 class="text-center text-purple-600 text-lg font-semibold">{{ $name }}</h3>
    </div>
</div>
