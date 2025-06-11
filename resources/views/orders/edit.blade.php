<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Order</h1>

        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">User</label>
                <input type="text" value="{{ $order->user->name ?? 'N/A' }}" disabled
                    class="w-full border-gray-300 rounded px-4 py-2 bg-gray-100">
            </div>

            <div>
                <label class="block font-medium mb-1">Pet</label>
                <input type="text" value="{{ $order->pet->name ?? 'N/A' }}" disabled
                    class="w-full border-gray-300 rounded px-4 py-2 bg-gray-100">
            </div>

            <div>
                <label for="phone" class="block font-medium mb-1">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $order->phone) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label for="address" class="block font-medium mb-1">Address</label>
                <textarea name="address" id="address" rows="3"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>{{ old('address', $order->address) }}</textarea>
            </div>

            <div>
                <label for="status" class="block font-medium mb-1">Status</label>
                <select name="status" id="status"
                    class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('orders.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
