<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Pets List</h1>

        <div class="mb-4 flex space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Home</a>
            <a href="{{ route('pets.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Pet</a>
        </div>

        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Species</th>
                    <th class="border border-gray-300 px-4 py-2">Breed</th>
                    <th class="border border-gray-300 px-4 py-2">Birth Date</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $index => $pet)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $pet->name }}</td>
                        <td class="border px-4 py-2">{{ $pet->category }}</td>
                        <td class="border px-4 py-2">{{ $pet->breed ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $pet->birth_date ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $pet->description ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">
                            @if (count($pet->images))
                                <img src="{{ asset('storage/PetImage/' . $pet->images[0]) }}" alt="Pet Image"
                                    width="100" height="100" class="rounded">
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('pets.edit', $pet->id) }}"
                                class="text-indigo-600 hover:underline">Edit</a>
                            <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-10 flex justify-center">
            {{ $pets->links('vendor.pagination.custom') }}
        </div>
    </div>
</body>

</html>
