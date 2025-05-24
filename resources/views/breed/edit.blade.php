<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Breed</title>
</head>

<body>
    <h1>Edit Breed</h1>
    <form action="{{ route('breeds.update', $breed->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Breed Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $breed->name) }}" required>

        <br>

        <label for="category">Category (optional):</label>
        <select name="category_id" id="category">
            <option value="">-- Select a category --</option>
            @foreach ($categories as $category)
                @if (!empty($category->name))
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $breed->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endif
            @endforeach
        </select>

        <br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>
