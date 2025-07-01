@props(['series' => null])

<div class="space-y-6">
    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Series Name*</label>
        <input type="text" name="name" id="name" value="{{ old('name', $series?->name) }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
        <textarea name="description" id="description" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $series?->description) }}</textarea>
    </div>

    <!-- Image -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cover Image</label>
        <input type="file" name="image" id="image"
               class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900 dark:file:text-blue-100
                      hover:file:bg-blue-100 dark:hover:file:bg-blue-800">
        
        @if($series?->image)
            <div class="mt-2 flex items-center">
                <img src="{{ asset('storage/' . $series->image) }}" alt="Current cover" class="h-16 w-16 rounded-md object-cover">
                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">Current image</span>
            </div>
        @endif
    </div>
</div>