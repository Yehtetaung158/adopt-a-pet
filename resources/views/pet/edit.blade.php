<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
    <style>
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
    <h1>Edit Pet - {{ $pet->name }}</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name <span style="color: red;">*</span>:</label>
        <input type="text" name="name" id="name" value="{{ old('name') ?? $pet->name }}" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="category">Category <span style="color: red;">*</span>:</label>
        <select name="category" id="category" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}"
                    {{ (old('category') ?? $pet->category) == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="breed">Breed <span style="color: red;">*</span>:</label>
        <select name="breed" id="breed" required>
            <option value="">Select a breed</option>
            @php
                $selectedCategory = old('category') ?? $pet->category;
                $breeds = App\Models\Breed::whereHas('category', function ($q) use ($selectedCategory) {
                    $q->where('name', $selectedCategory);
                })->get();
            @endphp
            @foreach ($breeds as $breed)
                <option value="{{ $breed->name }}"
                    {{ (old('breed') ?? $pet->breed) == $breed->name ? 'selected' : '' }}>
                    {{ $breed->name }}
                </option>
            @endforeach
        </select>

        <label for="birth_date">Birth Date:</label>
        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') ?? $pet->birth_date }}">
        @error('birth_date')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="image">Image:</label>
        <input type="file" name="images[]" id="image" accept="image/*" multiple>

        @if ($pet->images)
            <div>
                <small>Current Images:</small><br>
            </div>
            @foreach ($pet->images as $image)
                <img src="{{ asset('storage/PetImage/' . $image) }}" alt="Pet Image" width="200" height="200">
            @endforeach
        @endif
        @error('image')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" cols="50">{{ old('description') ?? $pet->description }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="status">Adoption Status <span style="color: red;">*</span>:</label>
        <select name="status" id="status" required>
            <option value="">Select status</option>
            <option value="available" {{ (old('status') ?? $pet->status) == 'available' ? 'selected' : '' }}>Available
            </option>
            <option value="adopted" {{ (old('status') ?? $pet->status) == 'adopted' ? 'selected' : '' }}>Adopted
            </option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror

        <br><br>
        <button type="submit">Update Pet</button>
    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const categorySelect = document.getElementById('category');
                    const breedSelect = document.getElementById('breed');

                    categorySelect.addEventListener('change', function() {
                            const selectedCategory = this.value;
                            breedSelect.innerHTML = '<option value="">Select a breed</option>';

                            if (selectedCategory) {
                                // FIXED: Removed extra parenthesis after selectedCategory
                                fetch("/dashboard/breeds-by-name?category_name=" + encodeURIComponent(selectedCategory)
                                    .then(response => response.json())
                                    .then(breeds => {
                                        breeds.forEach(breed => {
                                            const option = document.createElement('option');
                                            option.value = breed.name;
                                            option.textContent = breed.name;
                                            breedSelect.appendChild(option);
                                        });
                                    })
                                    .catch(error => console.error('Error fetching breeds:', error));
                                }
                            });
                    });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const breedSelect = document.getElementById('breed');

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;
                breedSelect.innerHTML = '<option value="">Select a breed</option>';

                if (selectedCategory) {
                    fetch("/dashboard/breeds-by-name?category_name=" + encodeURIComponent(selectedCategory))
                        .then(response => response.json())
                        .then(breeds => {
                            breeds.forEach(breed => {
                                const option = document.createElement('option');
                                option.value = breed.name;
                                option.textContent = breed.name;
                                breedSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching breeds:', error));
                }
            });
        });
    </script> --}}
</body>

</html>
