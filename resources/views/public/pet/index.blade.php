@extends('tLayouts.app')

@section('title', 'Home')

@section('content')

    <section class="py-10 bg-gray-100">
        <h2 class="text-center mb-8 text-4xl md:text-5xl font-bold">Available Pets for Adoption</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            @foreach ($pets as $pet)
                <x-pet-card :pet="$pet" :image="'storage/PetImage/' . $pet['images'][0]" :name="$pet['name']" petId="{{ $pet['id'] }}"
                    :is_fav="$pet['is_fav']" />
            @endforeach
        </div>
    </section>
    <div class="mt-10 flex justify-center">
        {{ $pets->links('vendor.pagination.custom') }}
    </div>


@endsection;
