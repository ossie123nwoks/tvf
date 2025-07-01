<x-app-layout>
    <div class="container mx-auto px-4 py-10 bg-white"> <!-- Added bg-white here -->
        <div class="max-w-4xl mx-auto">
            {{-- Back Button --}}
            <a href="{{ route('sermons.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Sermons
            </a>

            {{-- Sermon Header --}}
            <div class="mb-8">
                @if($sermon->series)
                    <span class="inline-block px-3 py-1 mb-4 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                        {{ $sermon->series->name }}
                    </span>
                @endif

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $sermon->title }}</h1>
                
                <div class="flex items-center space-x-4 text-gray-600 mb-6">
                    <span>{{ $sermon->speaker ?? 'Guest Speaker' }}</span>
                    <span>•</span>
                    <span>{{ $sermon->date->format('F j, Y') }}</span>
                </div>

                {{-- Topics --}}
                @if($sermon->topics->count())
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($sermon->topics as $topic)
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800">
                                {{ $topic->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Media Player --}}
            <div class="mb-8 rounded-xl overflow-hidden bg-white"> <!-- Added bg-white -->
                @if($sermon->video_url)
                    <div class="aspect-w-16 aspect-h-9 my-6">
                        <iframe 
                            src="{{ $sermon->embed_url }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full h-96 rounded-lg shadow-md bg-white"> <!-- Added bg-white -->
                        </iframe>
                    </div>
                @elseif($sermon->audio_url)
                    <div class="bg-gray-100 p-6">
                        <audio controls class="w-full bg-white"> <!-- Added bg-white -->
                            <source src="{{ $sermon->audio_url }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif
            </div>

            {{-- Description --}}
            <div class="prose max-w-none mb-8 bg-white p-4 rounded-lg"> <!-- Added bg-white and padding -->
                {!! nl2br(e($sermon->description)) !!}
            </div>

            {{-- Transcript --}}
            @if($sermon->transcript_url)
                <div class="mb-8">
                    <a 
                        href="{{ asset('storage/' . $sermon->transcript_url) }}" 
                        download
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download Transcript
                    </a>
                </div>
            @endif

            {{-- Related Sermons --}}
            @if($relatedSermons->count())
                <div class="mt-12 bg-white p-6 rounded-lg"> <!-- Added bg-white and padding -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Sermons</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($relatedSermons as $related)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('sermons.show', $related) }}" class="hover:text-blue-600 transition">
                                            {{ $related->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ $related->date->format('M d, Y') }}</p>
                                    <a href="{{ route('sermons.show', $related) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View Sermon →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>