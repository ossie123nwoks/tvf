<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admin.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Add New Event
                    </a>
                    <div class="mt-6">
                        @foreach ($events as $event)
                            <div class="mb-4">
                                <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                                <p>{{ $event->description }}</p>
                                <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
                                <p><strong>End Time:</strong> {{ $event->end_time }}</p>
                                <p><strong>Location:</strong> {{ $event->location }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>