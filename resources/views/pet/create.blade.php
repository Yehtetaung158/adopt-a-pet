<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Pet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Ensure Tailwind is loaded --}}
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl space-y-6">
        <h1 class="text-2xl font-bold text-center text-gray-800">Create a New Pet</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded">
                {{ session('success') }}
                @if (session('shareableLink'))
                    <div class="mt-2 text-sm">
                        Shareable Link:
                        <a href="{{ session('shareableLink') }}" class="text-blue-600 underline" target="_blank">
                            {{ session('shareableLink') }}
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block font-medium text-gray-700">Name <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category" class="block font-medium text-gray-700">Category <span
                        class="text-red-500">*</span></label>
                <select name="category" id="category" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ old('category') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Breed --}}
            <div>
                <label for="breed" class="block font-medium text-gray-700">Breed <span
                        class="text-red-500">*</span></label>
                <select name="breed" id="breed" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    <option value="">Select a breed</option>
                    @if (old('category'))
                        @php
                            $oldBreeds = App\Models\Breed::whereHas('category', function ($q) {
                                $q->where('name', old('category'));
                            })->get();
                        @endphp
                        @foreach ($oldBreeds as $breed)
                            <option value="{{ $breed->name }}" {{ old('breed') == $breed->name ? 'selected' : '' }}>
                                {{ $breed->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- Birth Date --}}
            <div>
                <label for="birth_date" class="block font-medium text-gray-700">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('birth_date') }}">
                @error('birth_date')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image Upload --}}
            <div>
                <label for="images" class="block font-medium text-gray-700">Image</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                @error('image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block font-medium text-gray-700">Adoption Status <span
                        class="text-red-500">*</span></label>
                <select name="status" id="status" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    <option value="">Select status</option>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="adopted" {{ old('status') == 'adopted' ? 'selected' : '' }}>Adopted</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex space-x-4 justify-end">
                <a href="{{ route('pets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition">
                    Create Pet
                </button>
            </div>
        </form>
    </div>

    {{-- AJAX Category-Breed Dynamic Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const breedSelect = document.getElementById('breed');

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;
                breedSelect.innerHTML = '<option value="">Select a breed</option>';

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
</body>

</html>
