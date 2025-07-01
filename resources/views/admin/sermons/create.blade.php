<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Sermon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.sermons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        
                        <!-- Speaker -->
                        <div class="mb-4">
                            <label for="speaker" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Speaker</label>
                            <input type="text" name="speaker" id="speaker" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
                        </div>
                        
                        <!-- Series Dropdown -->
                        <div class="mb-4">
                            <label for="series_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Series</label>
                            <select name="series_id" id="series_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">-- Select a Series --</option>
                                @foreach($series as $seriesItem)
                                    <option value="{{ $seriesItem->id }}">{{ $seriesItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Topics Multi-select -->
                        <div class="mb-4">
                            <label for="topics" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Topics</label>
                            <select name="topics[]" id="topics" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Hold Ctrl/Cmd to select multiple topics</p>
                        </div>
                        
                        <!-- Thumbnail Upload -->
                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail Image</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900 dark:file:text-blue-100
                              hover:file:bg-blue-100 dark:hover:file:bg-blue-800">
                        </div>
                        
                        <!-- Audio URL -->
                        <div class="mb-4">
                            <label for="audio_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Audio URL</label>
                            <input type="url" name="audio_url" id="audio_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        
                        <!-- Video URL -->
                        <div class="mb-4">
                            <label for="video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Video URL (YouTube)</label>
                            <input type="url" name="video_url" id="video_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        
                        <!-- Transcript Upload -->
                        <div class="mb-4">
                            <label for="transcript" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transcript (PDF)</label>
                            <input type="file" name="transcript" id="transcript" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900 dark:file:text-blue-100
                              hover:file:bg-blue-100 dark:hover:file:bg-blue-800">
                        </div>
                        
                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                Save Sermon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Initialize Select2 for better multi-select UI (optional) -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#topics').select2({
                    placeholder: "Select topics",
                    allowClear: true
                });
            });
        </script>
    @endpush
    
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
</x-app-layout>