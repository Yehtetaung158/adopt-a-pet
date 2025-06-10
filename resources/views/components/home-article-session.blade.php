
<div class="flex flex-col items-center justify-center w-full mx-auto bg-white bg-transparent-white border-b-2 py-16 mb-6 ">
    {{-- Header --}}
    <h1 class="text-4xl md:text-5xl font-medium text-gray-800 mb-4 text-center px-4">PLANNING TO ADOPT A PET?</h1>

    <div id="blog-cards-container" class="flex flex-wrap gap-12 items-stretch justify-center mt-10">
        <!-- Loading state -->
        <div class="text-center py-12">
            <svg class="animate-spin h-8 w-8 text-purple-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <p class="mt-4 text-gray-600">Loading adoption resources...</p>
        </div>

    </div>

    <div class="text-center py-8">
        {{-- <p class="text-gray-600">No adoption resources available at the moment</p> --}}
        <a href="{{ route('blogs') }}"
            class="mt-4 inline-block px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition">
            Browse All Articles
        </a>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('blog-cards-container');

        fetch('{{ route('home.blogs') }}')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(blogs => {
                // Clear loading state
                container.innerHTML = '';

                if (blogs.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-8">
                            <p class="text-gray-600">No adoption resources available at the moment</p>
                            <a href="{{ route('blogs') }}" class="mt-4 inline-block px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition">
                                Browse All Articles
                            </a>
                        </div>
                    `;
                    return;
                }

                blogs.forEach(blog => {
                    const card = document.createElement('div');
                    card.className =
                        'flex flex-col items-center justify-between text-center px-4 w-full md:max-w-[300px]';
                    card.innerHTML = `
                        <div>
                            <h2 class="text-xl text-purple-600 mb-4 line-clamp-2 min-h-[3rem]">${blog.title}</h2>
                            <p class="text-gray-600 line-clamp-3">${blog.content.substring(0, 100)}${blog.content.length > 100 ? '...' : ''}</p>
                        </div>
                        <a href="/blogs/${blog.id}"
                           class="mt-6 px-6 py-2 outline outline-1 outline-purple-600 text-purple-600 hover:text-white rounded-full hover:bg-purple-700 transition w-full">
                            LEARN MORE
                        </a>
                    `;
                    container.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Error fetching blogs:', error);
                container.innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-red-500">Failed to load resources. Please try again later.</p>
                        <button onclick="window.location.reload()" class="mt-4 px-6 py-2 bg-gray-200 rounded-full hover:bg-gray-300 transition">
                            Retry
                        </button>
                    </div>
                `;
            });
    });
</script>
