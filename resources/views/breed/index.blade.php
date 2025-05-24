<!DOCTYPE html>
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
    {{-- <div>
        {{ $breeds->links() }}
    </div>
    <div>
        <a href="{{ route('categories.index') }}">Go to Categories</a>
    </div>
    <div>
        <a href="{{ route('home') }}">Go to Home</a>
    </div>
    <div>
        <a href="{{ route('animals.index') }}">Go to Animals</a>
    </div>
    <div>
        <a href="{{ route('animals.create') }}">Create Animal</a>
    </div>
    <div>
        <a href="{{ route('animals.show', 1) }}">Show Animal</a>
    </div>
    <div>
        <a href="{{ route('animals.edit', 1) }}">Edit Animal</a>
    </div>
    <div>
        <a href="{{ route('animals.destroy', 1) }}">Delete Animal</a>
    </div>
    <div>
        <a href="{{ route('animals.create') }}">Create Animal</a>
    </div>
    <div>
        <a href="{{ route('animals.index') }}">Go to Animals</a>
    </div> --}}
</body>
</html>
