@props(['topic' => null])

<div class="space-y-6">
    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Topic Name*</label>
        <input type="text" name="name" id="name" value="{{ old('name', $topic?->name) }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>

    <!-- Slug -->
    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $topic?->slug) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave blank to auto-generate</p>
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
        <textarea name="description" id="description" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $topic?->description) }}</textarea>
    </div>
</div>