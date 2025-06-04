<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>I am favorites</h1>
    @foreach ( $favorites as $favorite )
        <div>
            <h2>{{ $favorite->name }}</h2>
            <p>Breed: {{ $favorite->breed->name ?? 'N/A' }}</p>
            <p>Birth Date: {{ $favorite->birth_date ?? 'N/A' }}</p>
            <p>Description: {{ $favorite->description ?? 'N/A' }}</p>
            {{-- @if (count($favorite->pet->images))
                <img src="{{ asset('storage/PetImage/' . $favorite->pet->images[0]) }}" alt="Pet Image" width="100" height="100" class="rounded">
            @else --}}
                {{-- <span class="text-gray-400">No image</span>
            @endif --}}
        </div>
    @endforeach
</body>

</html>
