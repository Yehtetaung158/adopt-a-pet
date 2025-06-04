@props(['image', 'name', 'petId' => null, 'is_fav' => false ,'pet' => null])

{{-- Ensure the image is a valid path --}}

{{-- Ensure the image path is valid --}}

@php
    $userId = Auth::id();
@endphp

<div class="max-w-xs bg-white rounded-2xl overflow-hidden shadow-md hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-purple-600 transition">
    {{-- Default image if none provided --}}
    {{-- Check if image exists --}}
    <!-- Image Section -->
    <div class="relative">
        <img src="{{ asset($image) }}" alt="{{ $name }}" class="w-[200px] h-48 object-cover" />

        <!-- Heart Icon Overlay -->
        <form action="{{ route('pets.favorite', $petId) }}" method="POST" data-pet-id="{{ $petId }}" class="favorite-toggle">
            @csrf
            <button type="submit" class="absolute top-2 right-2 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition">
                {{-- Solid heart (favorited) --}}
                @if ($petId && $is_fav)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-600">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3c3.08 0 5.5 2.42 5.5 5.5
                            0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                {{-- Empty heart (not favorited) --}}
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3c3.08 0 5.5 2.42 5.5 5.5
                            0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>

                @endif
            </button>
        </form>
    </div>

    <!-- Name Section -->
    <div class="px-4 py-3 text-center">
        <h3 class="text-purple-600 text-lg font-semibold">{{ $name }}</h3>
        <h3 class="text-purple-600 text-lg font-semibold">{{ $pet['breed'] }}</h3>

    </div>
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.favorite-toggle').forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const petId = form.dataset.petId;
                const csrf = document.querySelector('meta[name="csrf-token"]').content;

                try {
                    const res = await fetch(`/pets/${petId}/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        },
                    });

                    if (res.ok) {
                        // toggle heart icon color
                        const svg = form.querySelector('svg');
                        const isRed = svg.classList.contains('text-red-600');
                        svg.classList.toggle('text-red-600', !isRed);
                        svg.classList.toggle('text-gray-400', isRed);
                    } else {
                        console.error('Failed to favorite pet');
                    }
                } catch (error) {
                    console.error(error);
                }
            });
        });
    });
</script> --}}

