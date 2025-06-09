<div class="relative">
        {{-- Header --}}
        <div class="w-full mx-auto border-b-2 border-purple-600">
            <img class="w-full object-cover h-[500px]" src="{{ asset('homeImg/cover1.png') }}" alt="">
            {{-- Overlay for better text contrast --}}
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        {{-- Text & Cards --}}
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <div class="text-white space-y-4 drop-shadow-md">
                <h1 class="text-4xl md:text-5xl font-bold">Bring Joy Home—Adopt Today!</h1>
                <p class="text-base md:text-lg max-w-xl mx-auto">
                    Find your perfect companion and give a loving home to a pet in need.
                </p>
            </div>

            {{-- Cards --}}
            <div class="mt-10 flex flex-wrap gap-6 items-center justify-center">
                <div
                    class="w-36 h-36 md:w-40 md:h-40 bg-white border border-gray-300 rounded-xl flex flex-col items-center justify-center shadow-lg hover:shadow-2xl transition">
                    <img width="55px" src="{{ asset('homeImg/dog-icon1.svg') }}" alt="">
                    <h1 class="mt-2 text-gray-700 font-medium">Dogs</h1>
                </div>
                <div
                    class="w-36 h-36 md:w-40 md:h-40 bg-white border border-gray-300 rounded-xl flex flex-col items-center justify-center shadow-lg hover:shadow-2xl transition">
                    <img width="60px" src="{{ asset('homeImg/cat-icon.svg') }}" alt="">
                    <h1 class="mt-2 text-gray-700 font-medium">Cats</h1>
                </div>
                <div
                    class="w-36 h-36 md:w-40 md:h-40 bg-white border border-gray-300 rounded-xl flex flex-col items-center justify-center shadow-lg hover:shadow-2xl transition">
                    <img width="70px" src="{{ asset('homeImg/other-pet.svg') }}" alt="">
                    <h1 class="mt-2 text-gray-700 font-medium">Other</h1>
                </div>
            </div>
        </div>
    </div>
