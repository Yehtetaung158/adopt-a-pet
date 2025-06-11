@extends('tLayouts.app')

@section('title', 'Home')

@section('content')
    <div class="py-10 bg-gray-100 flex flex-col items-center">
        {{-- Header --}}
        <h2 class="text-center text-4xl md:text-5xl font-bold  flex items-end mb-12"><span>Your Fav </span><svg
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-600">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3c3.08 0 5.5 2.42 5.5 5.5
                                    0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg><span>rite Pets</span></h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            @foreach ($favorites as $pet)
                <x-pet-card :pet="$pet" :image="'storage/PetImage/' . $pet['images'][0]" :name="$pet['name']" petId="{{ $pet['id'] }}"
                    :is_fav="$pet['is_fav']" />
            @endforeach
        </div>
        <div class="mt-10 flex justify-center">
            {{ $favorites->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
