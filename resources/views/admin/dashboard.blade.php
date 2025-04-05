<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sidebar -->
            <nav class="w-1/4 bg-gray-100 dark:bg-gray-800 p-6 mr-6 rounded-lg">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Navigation</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Dashboard</a></li>
                    <li><a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Blog Posts</a></li>
                    <li><a href="{{ route('admin.sermons.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Sermons</a></li>
                    <li><a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Events</a></li>
                    <li><a href="{{ route('admin.gallery.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Gallery</a></li>
                    <li><a href="{{ route('admin.messages') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Messages</a></li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="w-3/4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Posts Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Blog Posts</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $postsCount }} Posts</p>
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                        <a href="{{ route('admin.posts.create') }}" class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 dark:hover:bg-blue-500">New Post</a>
                    </div>
                </div>

                <!-- Sermons Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Sermons</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $sermonsCount }} Sermons</p>
                    <a href="{{ route('admin.sermons.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View Sermons</a>
                </div>

                <!-- Events Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Events</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $eventsCount }} Events</p>
                    <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View Events</a>
                </div>

                <!-- Gallery Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Gallery</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $galleryCount }} Images</p>
                    <a href="{{ route('admin.gallery.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View Gallery</a>
                </div>

                <!-- Messages Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Messages</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $messagesCount }} Messages</p>
                    <a href="{{ route('admin.messages') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">View Messages</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>