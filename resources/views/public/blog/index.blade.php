@extends('tLayouts.app')

@section('title', 'Home')


@section('content')

    <div class="bg-gray-100 text-gray-800">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h1 class="text-3xl font-bold">Blog Posts</h1>

                <!-- Filter buttons with active state tracking -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('blogs') }}"
                        class="px-4 py-2 rounded transition-colors {{ !request('type') ? 'bg-purple-600 text-white' : 'bg-purple-500 text-white hover:bg-purple-600' }}">
                        All Posts
                    </a>
                    <a href="{{ route('blogs', ['type' => 'dog']) }}"
                        class="px-4 py-2 rounded transition-colors {{ request('type') === 'dog' ? 'bg-purple-600 text-white' : 'bg-purple-500 text-white hover:bg-purple-600' }}">
                        Dogs
                    </a>
                    <a href="{{ route('blogs', ['type' => 'cat']) }}"
                        class="px-4 py-2 rounded transition-colors {{ request('type') === 'cat' ? 'bg-purple-600 text-white' : 'bg-purple-500 text-white hover:bg-purple-600' }}">
                        Cats
                    </a>
                </div>
            </div>

            @if ($blogs->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <h3 class="text-xl font-medium text-gray-700">No blog posts found</h3>
                    <p class="text-gray-500 mt-2">Try selecting a different category or check back later</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($blogs as $blog)
                        <a href="{{ route('blogs.detail', $blog->id) }}"
                            class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 block">
                            <!-- Image with default placeholder -->
                            @if ($blog->image)
                                <img src="{{ asset('storage/BlogImage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div
                                    class="bg-gray-200 border-2 border-dashed w-full h-48 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif

                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2 line-clamp-2">{{ $blog->title }}</h2>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <span>{{ $blog->created_at->format('F d, Y') }}</span>
                                    <!-- Category badge -->
                                    @if ($blog->type)
                                        <span
                                            class="ml-auto bg-{{ $blog->type === 'dog' ? 'purple' : 'orange' }}-100 text-{{ $blog->type === 'dog' ? 'purple' : 'orange' }}-800 text-xs px-2 py-1 rounded-full">
                                            {{ ucfirst($blog->type) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($blogs->hasPages())
                    <div class="mt-8">
                        {{ $blogs->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
