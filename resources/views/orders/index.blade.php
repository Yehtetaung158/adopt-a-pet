<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Orders</h1>

        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">User</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Pet</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Phone</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Address</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->pet->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->address }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="@if($order->status == 'approved') text-green-600
                                         @elseif($order->status == 'rejected') text-red-600
                                         @else text-yellow-600 @endif font-semibold">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : 'N/A' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ route('orders.edit', $order->id) }}"
                                class="text-indigo-600 hover:underline">Edit</a>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($orders->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center px-4 py-6 text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
