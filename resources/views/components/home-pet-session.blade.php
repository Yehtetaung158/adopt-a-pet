

<section class="py-10 bg-gray-100 max-w-[1200px] mx-auto">
        <h2 class="text-center mb-8 text-4xl md:text-5xl font-medium text-purple-600">Available Pets for Adoption</h2>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach ($pets as $pet)
                <x-pet-card :pet="$pet" :image="'storage/PetImage/' . $pet['images'][0]" :name="$pet['name']" petId="{{ $pet['id'] }}"
                    :is_fav="$pet['is_fav']" />
            @endforeach
            <a href="{{ route('pets') }}"
                class="max-w-xs bg-purple-600 hover:bg-purple-700 rounded-2xl overflow-hidden shadow-md">
                <div class="relative">
                    <img src="{{ asset('homeImg/seemorepet.svg') }}" alt="" class="w-[200px] h-48 object-cover" />
                </div>
                <div class="px-4 py-3 text-center border-t-2 border-white">
                    <h3 class="text-white text-lg font-semibold">See More</h3>

                </div>
            </a>
        </div>
    </section>
