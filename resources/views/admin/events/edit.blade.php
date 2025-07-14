<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>{{ old('description', $event->description) }}</textarea>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time</label>
                            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                        </div>

                        <!-- End Time -->
                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                        </div>

                        <!-- Current Image -->
                    @if($event->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                        <img src="{{ $event->image_url }}" alt="Event image" class="mt-2 h-32 object-cover rounded">
                    </div>
                    @endif

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ $event->image ? 'Change Image' : 'Upload Image' }}
                        </label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPEG, PNG, JPG, or GIF (Max: 2MB)</p>
                    </div>

                    <!-- Remove Image Checkbox -->
                    @if($event->image)
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Remove current image</span>
                        </label>
                    </div>
                    @endif

                        <!-- Recurrence Section -->
                        <div class="mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recurrence</h3>

                            <!-- Recurrence Type -->
                            <div class="mb-4">
                                <label for="recurrence" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Repeat</label>
                                <select name="recurrence" id="recurrence" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                                    <option value="" {{ old('recurrence', $event->recurrence) === null ? 'selected' : '' }}>None</option>
                                    <option value="daily" {{ old('recurrence', $event->recurrence) === 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ old('recurrence', $event->recurrence) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ old('recurrence', $event->recurrence) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                </select>
                            </div>

                            <!-- Interval -->
                            <div class="mb-4">
                                <label for="recurrence_interval" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Repeat Every</label>
                                <input type="number" name="recurrence_interval" id="recurrence_interval" min="1" value="{{ old('recurrence_interval', $event->recurrence_interval) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>

                            <!-- Occurrence Count -->
                            <div class="mb-4">
                                <label for="recurrence_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Occurrences</label>
                                <input type="number" name="recurrence_count" id="recurrence_count" min="1" value="{{ old('recurrence_count', $event->recurrence_count) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>

                            <!-- End Date -->
                            <div class="mb-4">
                                <label for="recurrence_end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recurrence End Date</label>
                                <input type="date" name="recurrence_end_date" id="recurrence_end_date" value="{{ old('recurrence_end_date', optional($event->recurrence_end_date)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                Update Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
