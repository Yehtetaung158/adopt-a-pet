<!-- resources/views/categories/create.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Create Category</title>
</head>

<body>
    <h1>Create New Category</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required>

        <br>

        <br><br>
        <button type="submit">Create</button>
    </form>
</body>

</html>
