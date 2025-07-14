@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <div class="bg-white text-navy">
        <div class="container mx-auto px-4 py-12">
            <!-- Page Header -->
            <div class="max-w-4xl mx-auto">
                <div class="text-left mb-12">
                    <h1 class="text-4xl font-bold mb-2">Upcoming Programs</h1>
                    <div class="w-24 h-1 bg-gold mb-6"></div>
                    <p class="text-xl max-w-3xl">
                        Stay connected to our life-changing events.
                    </p>
                </div>
            </div>

            <!-- Events Grid -->
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @if($events->count())
                    @foreach($events as $event)
                    <div class="event-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <!-- Event Image -->
                        <div class="relative h-48 overflow-hidden">
                            @if($event->image)
                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Recurring Badge -->
                            @if($event->is_recurring)
                                <div class="absolute top-2 right-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    Recurring
                                </div>
                            @endif
                        </div>
                        
                        <!-- Event Details -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                            
                    <!-- Update the time display section -->
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-gray-700">
                        @if($event->is_recurring)
                            Next: {{ $event->next_occurrence?->format('M j, Y \a\t h:i A') }}
                            <div class="text-xs text-gray-500">{{ $event->timezone ?? 'UTC' }}</div>
                        @else
                            {{ $event->start_time->format('M j, Y \a\t h:i A') }}
                            <div class="text-xs text-gray-500">{{ $event->timezone ?? 'UTC' }}</div>
                        @endif
                    </span>
                </div>
                            
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-700">
                                    Duration: {{ $event->start_time->format('h:i A') }} - {{ $event->end_time->format('h:i A') }}
                                </span>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span class="text-gray-700">{{ $event->location }}</span>
                            </div>
                            
                            @if($event->is_recurring)
                                <div class="mb-4 text-sm text-gray-600">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                      Repeats {{ $event->recurrence_interval > 1 ? 'every '.$event->recurrence_interval.' '.Str::plural($event->recurrence) : $event->recurrence }}          
                                </div>
                            @endif
                            
                            <a href="{{ route('events.show', $event) }}" 
                               class="inline-block bg-gold text-navy font-medium py-2 px-4 rounded hover:bg-gold-dark transition">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No upcoming events</h3>
                        <p class="mt-1 text-gray-500">Check back later for scheduled programs.</p>
                    </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if($events->hasPages())
                <div class="max-w-4xl mx-auto mt-8">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>