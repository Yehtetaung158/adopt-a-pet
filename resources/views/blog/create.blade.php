<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Create New Blog</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                    value="{{ old('title') }}">
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content <span class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="4" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">{{ old('content') }}</textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" id="image"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type <span class="text-red-500">*</span></label>
                <select name="type" id="type" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Select type --</option>
                    <option value="other" >Other</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>

                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4 justify-end">
                <a href="{{ route('blogs.index') }}"
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
