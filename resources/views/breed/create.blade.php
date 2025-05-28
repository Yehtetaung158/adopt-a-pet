<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Breed</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind CSS --}}
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Create New Breed</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('breeds.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Breed Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                    value="{{ old('name') }}">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category (optional)</label>
                <select name="category_id" id="category_id"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        @if (!empty($category->name))
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4 justify-end">
                <a href="{{ route('breeds.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    Create
                </button>
            </div>
        </form>
    </div>
</body>

</html>
