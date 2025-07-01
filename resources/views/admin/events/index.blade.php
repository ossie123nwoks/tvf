<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('admin.events.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    + Add New Event
                </a>
                
                @if($events->count())
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        Showing {{ $events->firstItem() }}-{{ $events->lastItem() }} of {{ $events->total() }} events
                    </span>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($events->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Start</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">End</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Recurrence</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Next</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($events as $event)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $event->title }}
                                                    @if($event->is_recurring)
                                                        <span class="ml-1 text-xs bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-1 rounded-full">Recurring</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                {{ $event->location }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                                    {{ $event->start_time->format('Y-m-d H:i') }}
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $event->timezone }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                {{ $event->end_time->format('Y-m-d H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($event->is_recurring)
                                                    <div class="text-sm text-gray-700 dark:text-gray-300">
                                                        <span class="font-medium">{{ ucfirst($event->recurrence) }}</span>
                                                        @if($event->recurrence_interval > 1)
                                                            <span class="text-xs">(every {{ $event->recurrence_interval }})</span>
                                                        @endif
                                                        @if($event->recurrence_end_date)
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                until {{ $event->recurrence_end_date->format('M j, Y') }}
                                                            </div>
                                                        @elseif($event->recurrence_count)
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                {{ $event->recurrence_count }} occurrences
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">One-time</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($event->is_recurring && $event->next_occurrence)
                                                    <div class="text-sm text-gray-700 dark:text-gray-300">
                                                        {{ $event->next_occurrence->format('Y-m-d H:i') }}
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $event->timezone }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">N/A</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="{{ route('admin.events.edit', $event) }}" 
                                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('Delete this event?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($events->hasPages())
                            <div class="mt-4">
                                {{ $events->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No events</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Get started by creating a new event.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    + New Event
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>