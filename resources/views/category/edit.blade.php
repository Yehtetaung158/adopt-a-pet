<!-- resources/views/categories/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>


    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" required>

        <br><br>

        <label for="breed">Breed (optional):</label>
        <input type="text" name="breed" id="breed" value="{{ $category->breed }}">

        <br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
