<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
</head>

<body>
    <h1>I am breed create</h1>
    <form action="{{ route('breeds.store') }}" method="POST">
        @csrf
        <label for="name">Breed Name:</label>
        <input type="text" name="name" id="name" required>

        <br>

        <label for="category">Category (optional):</label>
        <select name="category_id" id="category">
            <option value="">-- Select a category --</option>
            @foreach ($categories as $category)
                @if (!empty($category->name))
                    <option value="{{ $category->id }}"
                        {{ old('category', $selectedCategory ?? '') == $category->name ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endif
            @endforeach
        </select>

        <br><br>
        <button type="submit">Create</button>
</body>

</html>
