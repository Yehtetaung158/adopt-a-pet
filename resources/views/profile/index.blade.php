<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">User Profile</h1>

        <div class="mb-4 flex space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Home</a>
            {{-- <a href="{{ route('profiles.edit', $profile->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Profile</a> --}}
        </div>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <tbody>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left w-1/3">Name</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $profile->user->name }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $profile->user->email }}</td>
                </tr>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $profile->phone ?? 'Not Yet Provided' }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Address</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $profile->address ?? 'Not Yet provided' }}</td>
                </tr>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($profile->user->is_admin)
                            <span class="text-green-600 font-semibold">Admin</span>
                        @else
                            <span class="text-blue-600 font-semibold">User</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Created At</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $profile->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
