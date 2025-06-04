@extends('tLayouts.app')

@section('title', 'Home')

@section('content')
 <section class="py-10 bg-gray-100">
        <h2 class="text-center mb-8 text-4xl md:text-5xl font-bold">Available Pets for Adoption</h2>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach ($pets as $pet)
                <x-pet-card :image="'storage/PetImage/' . $pet['images'][0]" :name="$pet['name']" petId="{{ $pet['id'] }}" :is_fav="$pet['is_fav']" />
            @endforeach
        </div>
    </section>
@endsection;
