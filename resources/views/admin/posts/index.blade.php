<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h1 class="text-2xl font-bold">Blog Posts</h1>
            <a 
                href="{{ route('admin.posts.create') }}" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition w-full sm:w-auto text-center"
            >
                Create New Post
            </a>
        </div>

        <!-- Mobile Cards View -->
        <div class="sm:hidden space-y-4">
            @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $post->title }}</h3>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <span class="mr-2">{{ $post->published_at?->format('M d, Y') ?? 'Not published' }}</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $post->published_at && $post->published_at <= now() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $post->published_at && $post->published_at <= now() ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Desktop Table View -->
        <div class="hidden sm:block bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($posts as $post)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $post->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $post->published_at && $post->published_at <= now() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $post->published_at && $post->published_at <= now() ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $post->published_at?->format('M d, Y') ?? 'Not published' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>