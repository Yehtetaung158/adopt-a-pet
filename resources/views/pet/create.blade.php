{{-- <!DOCTYPE html>
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

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pet</title>
    <style>
        /* အနည်းငယ် basic styling */
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input[type=text],
        form input[type=date],
        form input[type=file],
        form select,
        form textarea {
            width: 300px;
            padding: 5px;
            margin-top: 5px;
        }

        .error {
            color: red;
            font-size: 0.9rem;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Create a New Pet</h1>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
            @if (session('shareableLink'))
                <br>
                <small>
                    Shareable Link:
                    <a href="{{ session('shareableLink') }}" target="_blank">
                        {{ session('shareableLink') }}
                    </a>
                </small>
            @endif
        </div>
    @endif

    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <label for="name">Name <span style="color: red;">*</span>:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        {{-- Category --}}
        <select name="category" id="category" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category');
                const breedSelect = document.getElementById('breed');

                categorySelect.addEventListener('change', function() {
                    const selectedCategoryName = this.value;
                    breedSelect.innerHTML = '<option value="">Select a breed</option>';

                    if (selectedCategoryName) {
                        fetch("/dashboard/breeds-by-name?category_name=" + encodeURIComponent(
                                selectedCategoryName))
                            .then(response => response.json())
                            .then(breeds => {
                                breeds.forEach(breed => {
                                    const option = document.createElement('option');
                                    option.value = breed.name;
                                    option.textContent = breed.name;
                                    breedSelect.appendChild(option);
                                });
                            });
                    }
                });
            });
        </script>

        {{-- Breed --}}
        <select name="breed" id="breed" required>
            <option value="">Select a breed</option>
            @if (old('category'))
                @php
                    $oldBreeds = App\Models\Breed::whereHas('category', function ($q) {
                        $q->where('name', old('category'));
                    })->get();
                @endphp
                @foreach ($oldBreeds as $breed)
                    <option value="{{ $breed->name }}" {{ old('breed') == $breed->name ? 'selected' : '' }}>
                        {{ $breed->name }}
                    </option>
                @endforeach
            @endif
        </select>

        {{-- AJAX Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category');
                const breedSelect = document.getElementById('breed');

                categorySelect.addEventListener('change', function() {
                    const selectedCategoryId = this.value;
                    // Breed select ကို reset
                    breedSelect.innerHTML = '<option value="">Select a breed</option>';

                    if (selectedCategoryId) {
                        // AJAX call to fetch breeds
                        fetch("{{ url('pets/breeds-by-category') }}/" + selectedCategoryId)
                            .then(response => response.json())
                            .then(breeds => {
                                breeds.forEach(breed => {
                                    const option = document.createElement('option');
                                    option.value = breed.id;
                                    option.textContent = breed.name;
                                    breedSelect.appendChild(option);
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching breeds:', error);
                            });
                    }
                });
            });
        </script>

        {{-- Birth Date --}}
        <label for="birth_date">Birth Date:</label>
        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
        @error('birth_date')
            <div class="error">{{ $message }}</div>
        @enderror

        {{-- Image Upload --}}
        <label for="image">Image:</label>
        <input type="file" name="images[]" id="images" accept="image/*" multiple>

        @error('image')
            <div class="error">{{ $message }}</div>
        @enderror

        {{-- Description --}}
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" cols="50">{{ old('description') }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        {{-- Status --}}
        <label for="status">Adoption Status <span style="color: red;">*</span>:</label>
        <select name="status" id="status" required>
            <option value="">Select status</option>
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="adopted" {{ old('status') == 'adopted' ? 'selected' : '' }}>Adopted</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror

        <br><br>
        <button type="submit">Create Pet</button>
    </form>
</body>

</html>
