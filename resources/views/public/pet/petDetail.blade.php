@extends('tLayouts.app')

@section('title', $pet['name'] . ' - Pet Detail')

@section('content')
    @if (session('success'))
        <div
            class="mt-4 p-4 fixed top-0  left-0 right-0  flex justify-between items-center bg-green-100 text-green-800 rounded-md max-w-md mx-auto">
            <p>{{ session('success') }}</p>
            <button type="button" class=" text-red-600" onclick="this.parentElement.remove()">x</button>
        </div>
    @endif
    {{-- Header --}}
    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Pet Image --}}
            <div>
                <img src="{{ asset('storage/PetImage/' . $pet['images'][0]) }}" alt="{{ $pet['name'] }}"
                    class="rounded-xl w-full h-80 object-cover shadow" />
            </div>

            {{-- Pet Info --}}
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-purple-700">{{ $pet['name'] }}</h1>

                <div class="text-gray-700 space-y-2">
                    <p><strong>Category:</strong> {{ $pet['category'] }}</p>
                    <p><strong>Breed:</strong> {{ $pet['breed'] }}</p>
                    <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($pet['birth_date'])->format('F d, Y') }}
                    </p>
                    <p><strong>Status:</strong>
                        <span
                            class="inline-block px-3 py-1 rounded-full text-white
                            {{ $pet['status'] === 'available' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($pet['status']) }}
                        </span>
                    </p>
                </div>

                <div class="mt-4">
                    <p class="text-gray-600"><strong>Description:</strong></p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $pet['description'] }}</p>
                </div>

                {{-- Favorite button --}}
                <form method="POST" action="{{ route('pets.favorite', $pet['id']) }}">
                    @csrf
                    <button type="submit"
                        class="mt-6 flex items-center gap-2 px-4 py-2 rounded-full  transition
                               {{ $pet['is_fav'] ? ' border  border-red-600 hover:border-red-700 text-red-600' : 'bg-gray-400 text-white hover:bg-gray-500' }}">
                        @if ($pet['is_fav'])
                            ❤️ Remove from Favorites
                        @else
                            🤍 Add to Favorites
                        @endif
                    </button>
                </form>


            </div>
        </div>
    </div>



    {{-- cancel order --}}

    @if ($pet->order_status === 'pending' && $user_id === Auth::id())
        <div class="max-w-5xl mx-auto px-4 py-10">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6">Cancel Order</h2>
            <form action="{{ route('pets.order.cancel', $pet['id']) }}" method="POST" class="space-y-4">
                @csrf
                @method('DELETE')
                <input type="text" name="pet_id" value="{{ $pet['id'] }}" hidden>
                <input type="text" name="user_id" value="{{ $user_id }}" hidden>

                <p class="text-red-600">Are you sure you want to cancel this order?</p>

                <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Yes,
                    Cancel
                    Order</button>
            </form>
        </div>
    @elseif ($pet->order_status === 'cancelled' && $user_id === Auth::id() || $pet->orders->isEmpty())
        {{-- order pet  --}}

        <div class="max-w-5xl mx-auto px-4 py-10">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6">Adopt This Pet</h2>
            <form action="{{ route('pets.order', $pet['id']) }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="pet_id" value="{{ $pet['id'] }}" hidden>
                <input type="text" name="user_id" value="{{ $user_id }}" hidden>

                <div>
                    <label for="phone" class="block text-gray-700">Phone</label>
                    <input type="tel" id="phone" name="phone" required placeholder="09 XXXXXXXXX"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-purple-300">
                </div>

                <div>
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-purple-300">
                </div>

                <button type="submit"
                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Order
                    Now</button>
            </form>
        </div>

        )
    @endif

    {{-- Pet Comments --}}


@endsection
