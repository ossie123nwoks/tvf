<x-app-layout>
    <div class="bg-white text-navy">
        <div class="container mx-auto px-4 py-10">
            <!-- Page Header -->
            <div class="max-w-4xl mx-auto">
                <div class="text-left mb-8">
                    <h1 class="text-4xl font-bold mb-2">Sermons Library</h1>
                    <div class="w-24 h-1 bg-gold mb-6"></div>
                </div>
            </div>

            {{-- Search & Filters --}}
<div class="max-w-4xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
    <form method="GET" class="w-full md:w-1/3 flex gap-2">
        <input 
            type="text" 
            name="search"
            placeholder="Search sermons..." 
            value="{{ request('search') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold"
        />
        @if(request('search') || request('series') || request('topic'))
            <a 
                href="{{ route('sermons.index') }}" 
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition whitespace-nowrap"
            >
                Reset
            </a>
        @endif
    </form>

    <div class="flex flex-wrap gap-2 items-center">
        {{-- Series Filter --}}
        <select 
            name="series" 
            onchange="window.location.href = this.value"
            class="px-4 py-2 text-sm rounded-full border border-gold text-navy hover:bg-gold hover:text-white transition cursor-pointer"
        >
            <option value="{{ route('sermons.index') }}" {{ !request('series') ? 'selected' : '' }}>All Series</option>
            @foreach($series as $s)
                <option 
                    value="{{ route('sermons.index', ['series' => $s->id]) }}" 
                    {{ request('series') == $s->id ? 'selected' : '' }}
                >
                    {{ $s->name }}
                </option>
            @endforeach
        </select>

        {{-- Topics Filter --}}
        <select 
            name="topic" 
            onchange="window.location.href = this.value"
            class="px-4 py-2 text-sm rounded-full border border-gold text-navy hover:bg-gold hover:text-white transition cursor-pointer"
        >
            <option value="{{ route('sermons.index') }}" {{ !request('topic') ? 'selected' : '' }}>All Topics</option>
            @foreach($topics as $topic)
                <option 
                    value="{{ route('sermons.index', ['topic' => $topic->id]) }}" 
                    {{ request('topic') == $topic->id ? 'selected' : '' }}
                >
                    {{ $topic->name }}
                </option>
            @endforeach
        </select>

        {{-- Reset Button (Alternative Position) --}}
        @if(request('search') || request('series') || request('topic'))
            <a 
                href="{{ route('sermons.index') }}" 
                class="px-4 py-2 text-sm rounded-full border border-red-300 text-red-600 hover:bg-red-50 transition cursor-pointer whitespace-nowrap"
            >
                Clear All
            </a>
        @endif
    </div>
</div>

{{-- Sermons Grid --}}
<div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($sermons as $sermon)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
            {{-- Thumbnail with Default Image Fallback --}}
            <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-50">
                <img 
                    src="{{ $sermon->thumbnail ? asset('storage/' . $sermon->thumbnail) : asset('images/default-sermon-cover.png') }}" 
                    alt="{{ $sermon->title }}"
                    class="h-full w-full object-contain"
                    loading="lazy"
                >
            </div>

            {{-- Rest of your card content remains the same --}}
            <div class="p-6">
                @if($sermon->series)
                    <span class="inline-block px-3 py-1 mb-2 text-xs font-semibold text-navy bg-gold/20 rounded-full">
                        {{ $sermon->series->name }}
                    </span>
                @endif

                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $sermon->title }}</h2>
                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($sermon->description, 100) }}</p>
                
                <div class="flex justify-between text-sm text-gray-500 mb-4">
                    <span>{{ $sermon->speaker ?? 'Guest Speaker' }}</span>
                    <span>{{ $sermon->date->format('M d, Y') }}</span>
                </div>

                @if($sermon->topics->count())
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach($sermon->topics as $topic)
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                {{ $topic->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <a href="{{ route('sermons.show', $sermon) }}" 
                    class="inline-block px-4 py-2 text-white bg-gold hover:bg-gold-dark rounded-lg transition">
                    View Sermon
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No sermons available</h3>
            <p class="mt-1 text-gray-500">Check back later for new sermons.</p>
        </div>
    @endforelse
</div>

            {{-- Pagination --}}
            <div class="max-w-4xl mx-auto mt-10">
                {{ $sermons->links() }}
            </div>
        </div>
    </div>
</x-app-layout>