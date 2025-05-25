<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets List</title>
</head>

<body>
    <h1>I am category</h1>
    <a href="{{ route('pets.create') }}">Create Category</a>
    {{-- <ul>
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
    </ul> --}}
</body>

</html>
