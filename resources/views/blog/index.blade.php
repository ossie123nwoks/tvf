<x-app-layout>

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Search Bar -->
        <div class="mb-8">
            <form action="{{ route('blog.search') }}" method="GET">
                <div class="flex">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Search blog posts..." 
                        value="{{ request('query') }}"
                        class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition"
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Results Info -->
        @if(request()->has('query'))
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Search Results for "{{ request('query') }}"</h2>
                <p class="text-gray-600">{{ $posts->total() }} results found</p>
            </div>
        @endif

        <!-- Blog Posts -->
        <div class="space-y-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($post->featured_image)
                        <img 
                            src="{{ Storage::url($post->featured_image) }}" 
                            alt="{{ $post->title }}" 
                            class="w-full h-64 object-cover"
                        >
                    @endif
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600 transition">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-500 mb-4">
                            Published on {{ $post->published_at->format('F j, Y') }} by {{ $post->author->name }}
                        </p>
                        <p class="text-gray-700 mb-4">{{ $post->excerpt }}</p>
                        <a 
                            href="{{ route('blog.show', $post->slug) }}" 
                            class="text-blue-600 font-medium hover:text-blue-800 transition"
                        >
                            Read more →
                        </a>
                    </div>
                </article>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-600 text-lg">No blog posts found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection

</x-app-layout>