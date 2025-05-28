<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
        <h1 class="text-2xl font-semibold mb-6 text-center">Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-gray-700 font-medium">Category Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="breed" class="block text-gray-700 font-medium">Breed (optional)</label>
                <input type="text" name="breed" id="breed" value="{{ $category->breed }}"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex space-x-4 justify-end">
                <a href="{{ route('categories.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html>
