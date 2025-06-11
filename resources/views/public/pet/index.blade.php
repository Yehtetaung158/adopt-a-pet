@extends('tLayouts.app')

@section('title', 'Pets')


@section('content')
    <div class="py-10 bg-gray-100 flex flex-col items-center">
        {{-- Header --}}
        <h2 class="text-center mb-8 text-4xl md:text-5xl font-bold">Available Pets for Adoption</h2>

        <form method="GET" action="{{ route('pets') }}" class="max-w-4xl mx-auto mb-8 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 w-full">
                {{-- Category --}}
                <div>
                    <label for="category" class="block font-medium text-gray-700">Category</label>
                    <select name="category" id="category"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-purple-300">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->name }}" {{ request('category') === $cat->name ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Breed --}}
                <div>
                    <label for="breed" class="block font-medium text-gray-700">Breed</label>
                    <select name="breed" id="breed"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-purple-300">
                        <option value="">All Breeds</option>
                        @if (request('category'))
                            @php
                                $oldBreeds = App\Models\Breed::whereHas('category', function ($q) {
                                    $q->where('name', request('category'));
                                })->get();
                            @endphp
                            @foreach ($oldBreeds as $breed)
                                <option value="{{ $breed->name }}"
                                    {{ request('breed') === $breed->name ? 'selected' : '' }}>
                                    {{ $breed->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                {{-- Search --}}
                <div>
                    <label for="search" class="block font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Pet name..."
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-purple-300" />
                </div>
            </div>

            <div class="flex justify-between items-center mt-4">
                <div class="flex items-center gap-4">
                    <span class="bg-purple-100  text-purple-700 px-3 py-1 rounded-full text-sm flex items-center">
                        {{ $pets->total() }} Pets
                    </span>
                    @if (request()->hasAny(['category', 'breed', 'search']))
                        <div class="flex flex-wrap gap-2">
                            @if (request('category'))
                                <span
                                    class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm flex items-center">
                                    Category: {{ request('category') }}
                                    <a href="{{ route('pets', array_merge(request()->except('category'))) }}"
                                        class="ml-2 text-red-500 hover:text-red-700 font-bold">&times;</a>
                                </span>
                            @endif
                            @if (request('breed'))
                                <span
                                    class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm flex items-center">
                                    Breed: {{ request('breed') }}
                                    <a href="{{ route('pets', array_merge(request()->except('breed'))) }}"
                                        class="ml-2 text-red-500 hover:text-red-700 font-bold">&times;</a>
                                </span>
                            @endif
                            @if (request('search'))
                                <span
                                    class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm flex items-center">
                                    Search: {{ request('search') }}
                                    <a href="{{ route('pets', array_merge(request()->except('search'))) }}"
                                        class="ml-2 text-red-500 hover:text-red-700 font-bold">&times;</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">Filter</button>
                </div>
            </div>
        </form>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            @foreach ($pets as $pet)
                <x-pet-card :pet="$pet" :image="'storage/PetImage/' . $pet['images'][0]" :name="$pet['name']" petId="{{ $pet['id'] }}"
                    :is_fav="$pet['is_fav']" />
            @endforeach
        </div>
    </div>
    <div class="mt-10 flex justify-center">
        {{ $pets->links('vendor.pagination.custom') }}
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const breedSelect = document.getElementById('breed');
        const categoryLabel = document.getElementById('categoryLabel');

        categorySelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            breedSelect.innerHTML = '<option value="">All Breeds</option>';

            if (selectedCategory) {
                fetch(`/dashboard/breeds-by-name?category_name=${encodeURIComponent(selectedCategory)}`)
                    .then(res => res.json())
                    .then(breeds => {
                        breeds.forEach(breed => {
                            const option = document.createElement('option');
                            option.value = breed.name;
                            option.textContent = breed.name;
                            breedSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error loading breeds:', err));
            }
        });
    });
</script>
