<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8">All Events</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($events as $event)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">{{ $event->title }}</h2>
                    <p class="text-gray-700 mb-4"><strong>Date:</strong> {{ $event->start_time->format('F j, Y') }}</p>
                    <p class="text-gray-700 mb-4"><strong>Time:</strong> {{ $event->start_time->format('h:i A') }}</p>
                    <p class="text-gray-700 mb-4"><strong>Location:</strong> {{ $event->location }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>