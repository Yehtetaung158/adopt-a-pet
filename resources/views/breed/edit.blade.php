<!-- resources/views/breeds/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Breed</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
        <h1 class="text-2xl font-semibold mb-6 text-center">Edit Breed</h1>

        <form action="{{ route('breeds.update', $breed->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Breed Name -->
            <div>
                <label for="name" class="block text-gray-700 font-medium">Breed Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $breed->name) }}"
                    required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <!-- Category Select -->
            <div>
                <label for="category" class="block text-gray-700 font-medium">Category (optional)</label>
                <select
                    name="category_id"
                    id="category"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        @if (!empty($category->name))
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $breed->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
             <div class="flex space-x-4 justify-end">
                <a href="{{ route('breeds.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html>
