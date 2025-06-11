@extends('tLayouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold mb-6">My Orders</h2>

        @if ($orders->isEmpty())
            <p class="text-gray-500">You have no orders yet.</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($orders as $order)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/PetImage/' . json_decode($order->pet->images)[0]) }}"
                            alt="{{ $order->pet->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-purple-700">{{ $order->pet->name }}</h3>
                            <p class="text-sm text-gray-600 mb-1">Breed: {{ $order->pet->breed }}</p>
                            <p class="text-sm text-gray-600 mb-1">Category: {{ $order->pet->category }}</p>
                            <p class="text-sm text-gray-600 mb-1">Status:
                                <span
                                    class="font-semibold capitalize {{ $order->status === 'pending' ? 'text-yellow-600' : 'text-green-600' }}">
                                    {{ $order->status }}
                                </span>
                            </p>
                            <hr class="my-2">
                            <p class="text-sm text-gray-600 mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                            <p class="text-sm text-gray-600 mb-1"><strong>Address:</strong> {{ $order->address }}</p>
                            <p class="text-sm text-gray-500  mt-2">Ordered at:
                                {{ $order->created_at->format('Y-m-d H:i') }}</p>
                              @if ($order->status == 'pending')
                                    <form action="{{ route('order.cancel', $order->pet->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="pet_id" value="{{ $order->pet->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button type="submit"
                                        class="flex items-center justify-center gap-2 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-700 hover:scale-105 transition-all duration-200 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Cancel Order
                                    </button>
                                </form>
                              @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
