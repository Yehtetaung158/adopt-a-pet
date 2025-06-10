<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $blog->title }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Typography plugin enable
    tailwind.config = {
      theme: {
        extend: {},
      },
      plugins: [require('@tailwindcss/typography')],
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
  <div class="min-h-screen flex flex-col">
    <!-- Optional: Navbar -->
    <nav class="bg-white shadow">
      <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('blogs') }}" class="text-xl font-bold text-indigo-600">MyBlog</a>
        <a href="{{ route('blogs') }}"
           class="text-gray-600 hover:text-indigo-600 transition">Back to all posts</a>
      </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow container mx-auto px-4 py-10">
      <article class="bg-white shadow-lg rounded-lg overflow-hidden">
        <header class="px-6 pt-6">
          <h1 class="text-4xl font-extrabold leading-tight mb-2">{{ $blog->title }}</h1>
          <p class="text-sm text-gray-500">Published on {{ $blog->created_at->format('F j, Y') }}</p>
        </header>

        @if($blog->image)
          <figure class="mt-4">
            <img src="{{ asset('storage/BlogImage/' . $blog->image) }}"
                 alt="{{ $blog->title }}"
                 class="w-full  md:max-w-[300px] h-96 object-cover">
          </figure>
        @endif

        <div class="prose lg:prose-xl px-6 py-8">
          {!! nl2br(e($blog->content)) !!}
        </div>

        <!-- Optional: Author / CTA Footer -->
        {{--
        <footer class="px-6 pb-6">
          <p class="text-sm text-gray-600">
            Written by <span class="font-semibold">{{ $blog->author->name }}</span>
          </p>
        </footer>
        --}}
      </article>
    </main>

    <!-- Optional: Footer -->
    <footer class="bg-white shadow-inner">
      <div class="container mx-auto px-4 py-4 text-center text-gray-500 text-sm">
        © {{ date('Y') }} MyBlog. All rights reserved.
      </div>
    </footer>
  </div>
</body>
</html>
