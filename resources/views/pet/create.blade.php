<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pet</title>
</head>

<body>
    <h1>Create a New Pet</h1>

    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        <br><br>

        {{-- <label for="category">Category:</label>
        <select name="category_id" id="category" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const categorySelect = document.getElementById('category');
                categorySelect.addEventListener('change', function () {
                    const selectedCategoryId = this.value;
                    console.log('Selected category ID:', selectedCategoryId);
                });
            });
        </script>

        <label for="breed">Breed:</label>
        <select name="breed_id" id="breed" required>
            <option value="">Select a breed</option>
            @foreach ($breeds as $breed)
                <option value="{{ $breed->id }}" {{ old('breed_id') == $breed->id ? 'selected' : '' }}>
                    {{ $breed->name }}
                </option>
            @endforeach
        </select> --}}

        <label for="category">Category:</label>
        <select name="category_id" id="category" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="breed">Breed:</label>
        <select name="breed_id" id="breed" required>
            <option value="">Select a breed</option>
        </select>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category');
                const breedSelect = document.getElementById('breed');

                categorySelect.addEventListener('change', function() {
                    const selectedCategoryId = this.value;
                    breedSelect.innerHTML = '<option value="">Select a breed</option>';

                    if (selectedCategoryId) {
                        fetch(`/dashboard/breeds-by-category/${selectedCategoryId}`)
                            .then(response => response.json())
                            .then(breeds => {
                                breeds.forEach(breed => {
                                    const option = document.createElement('option');
                                    option.value = breed.id;
                                    option.textContent = breed.name;
                                    breedSelect.appendChild(option);
                                });
                            });
                    }
                });
            });
        </script>


        <br><br>

        <label for="birth_date">Birth Date:</label>
        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
        <br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
        <br><br>

        <label for="status">Adoption Status:</label>
        <select name="status" id="status" required>
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="adopted" {{ old('status') == 'adopted' ? 'selected' : '' }}>Adopted</option>
        </select>
        <br><br>

        <button type="submit">Create Pet</button>
    </form>
</body>

</html>
