<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.events.store') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required></textarea>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- End Time -->
                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                            <input type="datetime-local" name="end_time" id="end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                            <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- Recurrence Section -->
                        <div class="mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recurrence (Optional)</h3>

                            <!-- Recurrence Type -->
                            <div class="mb-4">
                                <label for="recurrence" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Repeat</label>
                                <select name="recurrence" id="recurrence" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                                    <option value="">None</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>

                            <!-- Interval -->
                            <div class="mb-4">
                                <label for="recurrence_interval" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Repeat Every</label>
                                <input type="number" name="recurrence_interval" id="recurrence_interval" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>

                            <!-- Occurrence Count -->
                            <div class="mb-4">
                                <label for="recurrence_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Occurrences</label>
                                <input type="number" name="recurrence_count" id="recurrence_count" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>

                            <!-- End Date -->
                            <div class="mb-4">
                                <label for="recurrence_end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recurrence End Date</label>
                                <input type="date" name="recurrence_end_date" id="recurrence_end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                Save Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
