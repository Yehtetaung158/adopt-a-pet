<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Pet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-2xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Pet - {{ $pet->name }}</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium">Name <span class="text-red-500">*</span>:</label>
                <input type="text" name="name" id="name"
                    value="{{ old('name') ?? $pet->name }}"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required>
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="category" class="block font-medium">Category <span class="text-red-500">*</span>:</label>
                <select name="category" id="category"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ (old('category') ?? $pet->category) == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="breed" class="block font-medium">Breed <span class="text-red-500">*</span>:</label>
                <select name="breed" id="breed"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required>
                    <option value="">Select a breed</option>
                    @foreach ($breeds as $breed)
                        <option value="{{ $breed->name }}"
                            {{ (old('breed') ?? $pet->breed) == $breed->name ? 'selected' : '' }}>
                            {{ $breed->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="birth_date" class="block font-medium">Birth Date:</label>
                <input type="date" name="birth_date" id="birth_date"
                    value="{{ old('birth_date') ?? $pet->birth_date }}"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                @error('birth_date')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="image" class="block font-medium">Image(s):</label>
                <input type="file" name="images[]" id="image" accept="image/*" multiple
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @error('image')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror

                @if ($pet->images)
                    <div class="mt-2">
                        <small class="text-gray-500">Current Images:</small>
                        <div class="flex flex-wrap gap-3 mt-2">
                            @foreach ($pet->images as $image)
                                <img src="{{ asset('storage/PetImage/' . $image) }}" alt="Pet Image"
                                    class="w-24 h-24 object-cover rounded border border-gray-300">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div>
                <label for="description" class="block font-medium">Description:</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">{{ old('description') ?? $pet->description }}</textarea>
                @error('description')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="status" class="block font-medium">Adoption Status <span class="text-red-500">*</span>:</label>
                <select name="status" id="status"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required>
                    <option value="">Select status</option>
                    <option value="available" {{ (old('status') ?? $pet->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="adopted" {{ (old('status') ?? $pet->status) == 'adopted' ? 'selected' : '' }}>Adopted</option>
                </select>
                @error('status')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

             <div class="flex space-x-4 justify-end">
                <a href="{{ route('pets.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                    Update Pet
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category');
            const breedSelect = document.getElementById('breed');

            categorySelect.addEventListener('change', function () {
                const selectedCategory = this.value;
                breedSelect.innerHTML = '<option value="">Select a breed</option>';

                if (selectedCategory) {
                    fetch("/dashboard/breeds-by-name?category_name=" + encodeURIComponent(selectedCategory))
                        .then(response => response.json())
                        .then(breeds => {
                            breeds.forEach(breed => {
                                const option = document.createElement('option');
                                option.value = breed.name;
                                option.textContent = breed.name;
                                breedSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching breeds:', error));
                }
            });
        });
    </script>
</body>

</html>
