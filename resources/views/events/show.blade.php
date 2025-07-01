<x-app-layout>
    <div class="bg-white text-navy">
        <div class="container mx-auto px-4 py-12 max-w-4xl">
            <!-- Event Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold mb-2">{{ $event->title }}</h1>
                <div class="w-24 h-1 bg-gold mb-4"></div>
                
                @if($event->is_recurring)
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full mb-4">
                        Recurring Event
                    </span>
                @endif
            </div>

            <!-- Main Content -->
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Left Column -->
                <div class="md:w-2/3">
                    <!-- Update the image section -->
                    <div class="rounded-lg overflow-hidden mb-6">
                        <img src="{{ $event->image_url }}" 
                            alt="{{ $event->title }}" 
                            class="w-full h-auto max-h-96 object-cover"
                            loading="lazy">
                    </div>

                    <!-- Event Description -->
                    <div class="prose max-w-none mb-8 whitespace-pre-line">
                        {{ $event->description }}
                    </div>
                </div>

                <!-- Right Column -->
                <div class="md:w-1/3">
                    <!-- Event Details Card -->
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm border border-gray-200">
                        <h3 class="text-xl font-bold mb-4">Event Details</h3>
                        
                        <div class="space-y-4">
                            <!-- Date & Time -->
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="font-medium">When</p>
                                    <p>
                                        {{ $event->start_time->format('l, F j, Y') }}<br>
                                        {{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}<br>
                                        <span class="text-sm text-gray-500">{{ $event->timezone ?? 'UTC' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="font-medium">Where</p>
                                    <p>{{ $event->location }}</p>
                                </div>
                            </div>

                            <!-- Share Button -->
                            <button onclick="try{navigator.clipboard.writeText(window.location.href);alert('Event link copied!');}catch(e){prompt('Copy this link:', window.location.href)}"
                                class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded flex items-center justify-center"
                                aria-label="Share this event">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                </svg>
                                Share Event
                            </button>
                        </div>
                    </div>

                    <!-- Upcoming Occurrences -->
                    @if($event->is_recurring && count($occurrences) > 1)
                        <div class="mt-6 bg-gray-50 rounded-lg p-6 shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold mb-4">Upcoming Dates</h3>
                            <ul class="space-y-3">
                                @foreach($occurrences as $occurrence)
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $occurrence['start']->format('M j, Y') }} 
                                        ({{ $occurrence['start']->format('g:i A') }} - {{ $occurrence['end']->format('g:i A') }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('events.index') }}" class="inline-flex items-center text-gold hover:text-gold-dark" aria-label="Back to all events">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to All Events
                </a>
            </div>
        </div>
    </div>
</x-app-layout>