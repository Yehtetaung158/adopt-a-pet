{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>I am breed</h1>
     <a href="{{ route('breeds.create') }}">Create Breeds</a>
    <ul>
        @foreach ($breeds as $breed)
            <li>
                <strong>Name:</strong> {{ $breed->name }} <br>
                <strong>Category:</strong> {{ $breed->category->name ?? 'N/A' }}
                <div>
                    <form action="{{ route('breeds.destroy', $breed->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="breed_id" value="{{ $breed->id }}">
                        <button type="submit">Delete</button>
                    </form>
                </div>
                <div>
                    <a href="{{ route('breeds.edit', $breed->id) }}">Edit</a>
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
    <title>Breed List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Breed List</h1>
        <div class="mb-4 flex space-x-4">
             <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Home</a>
            <a href="{{ route('breeds.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Breed</a>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Breed Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($breeds as $index => $breed)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $breed->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $breed->category->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ route('breeds.edit', $breed->id) }}" class="text-indigo-600 hover:underline">Edit</a>

                            <form action="{{ route('breeds.destroy', $breed->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
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
