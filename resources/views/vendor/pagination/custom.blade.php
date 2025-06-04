@if ($paginator->hasPages())
    <nav class="flex justify-center mt-4">
        <ul class="inline-flex items-center space-x-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li><span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Prev</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">Prev</a></li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="px-3 py-1 text-gray-500">...</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="px-3 py-1 bg-purple-800 text-white rounded">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">Next</a></li>
            @else
                <li><span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next</span></li>
            @endif
        </ul>
    </nav>
@endif
