<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            The Vine Journal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Category Filter -->
            <div class="mb-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <form action="{{ route('blog.index') }}" method="GET">
                            <div class="relative">
                                <input type="text" name="search" placeholder="Search posts..." 
                                       value="{{ request('search') }}"
                                       class="w-full pl-4 pr-10 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto">
                        <select onchange="window.location.href=this.value" 
                                class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                            <option value="{{ route('blog.index') }}">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ route('blog.index', ['category' => $category->slug]) }}" 
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Featured Post -->
            @if($featuredPost)
            <div class="mb-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        @if($featuredPost->featured_image)
                        <div class="md:w-1/3">
                            <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" 
                                 alt="{{ $featuredPost->title }}" 
                                 class="w-full h-64 object-cover rounded-lg">
                        </div>
                        @endif
                        <div class="{{ $featuredPost->featured_image ? 'md:w-2/3' : 'w-full' }}">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span>{{ $featuredPost->category?->name ?? 'General' }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $featuredPost->published_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">
                                <a href="{{ route('blog.show', $featuredPost->slug) }}" class="hover:text-indigo-600 transition">
                                    {{ $featuredPost->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ $featuredPost->excerpt }}</p>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('blog.show', $featuredPost->slug) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 font-medium">
                                    Read more
                                </a>
                                <span class="text-sm text-gray-500">By {{ $featuredPost->author->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Blog Posts Grid -->
        <!-- Three Column Grid with Background Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <div class="relative rounded-lg overflow-hidden shadow-md h-64 hover:shadow-lg transition-all duration-300">
                    <!-- Background Image Container -->
                    <div class="absolute inset-0 bg-gray-200">
                        @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    </div>

                    <!-- Content Overlay -->
                    <div class="relative h-full flex flex-col justify-end p-5">
                        <div class="mb-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-indigo-600 rounded-full">
                                {{ $post->category?->name ?? 'General' }}
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-white mb-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <div class="flex items-center text-xs text-gray-200">
                            <span>{{ $post->published_at->format('M d, Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $post->author->name }}</span>
                        </div>
                        
                        <a href="{{ route('blog.show', $post->slug) }}" class="absolute inset-0 z-10" aria-label="Read {{ $post->title }}"></a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>