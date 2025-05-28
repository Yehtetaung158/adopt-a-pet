{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
</head>

<body>
    <h1>I am category</h1>
    <a href="{{ route('categories.create') }}">Create Category</a>
    <ul>
        @foreach ($category as $category)
            <li>
                <strong>Name:</strong> {{ $category->name }} <br>
                <strong>Breed:</strong> {{ $category->breed ?? 'N/A' }}
                <div>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <button type="submit">Delete</button>
                    </form>
                </div>
                <div>
                    <a href="{{ route('categories.edit', $category->id) }}" >Edit</a>
                </div>
            </li>
        @endforeach
    </ul>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Category List</h1>
        <div class="mb-4 flex space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Home</a>
            <a href="{{ route('categories.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Category</a>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Breed</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $index => $category)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->breed ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="text-indigo-600 hover:underline">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
