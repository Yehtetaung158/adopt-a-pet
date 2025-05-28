{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets List</title>
</head>

<body>
    <h1>I am pet</h1>
    <a href="{{ route('pets.create') }}">Create Pet</a>
    <ul>
        @foreach ($pets as $category)
            <li>
                <strong>Name:</strong> {{ $category->name }} <br>
                <strong>Breed:</strong> {{ $category->breed ?? 'N/A' }}
                <strong>Birthdate:</strong> {{ $category->birth_date ?? 'N/A' }} <br>
                <strong>Description:</strong> {{ $category->description ?? 'N/A' }} <br>
                <pre>{{ $category->image }}</pre>
                <img src="{{ $category->image }}" alt="image" width="200px" height="200px">

                <img width="200px" height="200px"
                    src="https://drive.google.com/file/d/1WHfRoEGQK24atgj5ubFonUFbrJVf7Jge/view?usp=drivesdk"
                    alt="image">
                <img width="200px" height="200px"
                    src="https://drive.google.com/file/d/1WHfRoEGQK24atgj5ubFonUFbrJVf7Jge/preview" alt="image">
                <img src="https://drive.google.com/uc?export=view&id=1WHfRoEGQK24atgj5ubFonUFbrJVf7Jge" alt="image"
                    width="200px" height="200px">
                <img width="200px" height="200px"
                    src="https://drive.google.com/uc?export=view&id=1WHfRoEGQK24atgj5ubFonUFbrJVf7Jge" alt="image">
                <img src="https://drive.google.com/uc?export=view&id=1WHfRoEGQK24atgj5ubFonUFbrJVf7Jge" alt="image"
                    width="200" height="200">
                <div>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <button type="submit">Delete</button>
                    </form>
                </div>
                <div>
                    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
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
    <title>Pets List</title>
</head>

<body>
    <h1>Pets List</h1>
    <a href="{{ route('dashboard') }}">Home</a>
    <a href="{{ route('pets.create') }}">Create Pet</a>
    <ul>
        @foreach ($pets as $pet)
            <li>
                <strong>Name:</strong> {{ $pet->name }} <br>
                <strong>Breed:</strong> {{ $pet->breed ?? 'N/A' }} <br>
                <strong>Birthdate:</strong> {{ $pet->birth_date ?? 'N/A' }} <br>
                <strong>Description:</strong> {{ $pet->description ?? 'N/A' }} <br>

                @foreach ($pet->images as $image)
                    <img src="{{ asset('storage/PetImage/' . $image) }}" alt="Pet Image" width="200"
                        height="200">
                @endforeach

                {{-- <img src="{{ asset('storage/PetImage/' . $pet->image) }}" alt="" width="200" height="200"> --}}

                <!-- Delete & Edit Forms -->
                <div>
                    <form action="{{ route('pets.destroy', $pet->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                    <a href="{{ route('pets.edit', $pet->id) }}">Edit</a>
                </div>
            </li>
        @endforeach
    </ul>
</body>

</html>
