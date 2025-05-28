<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Category</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind CSS --}}
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Create New Category</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium text-gray-700">Category Name <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                    value="{{ old('name') }}">
            </div>

            <div class="flex space-x-4 justify-end">
                <a href="{{ route('categories.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                    Create
                </button>
            </div>
        </form>
    </div>
</body>

</html>
