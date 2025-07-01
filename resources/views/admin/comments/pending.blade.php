<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pending Comments ({{ $comments->total() }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($comments->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No pending comments</h3>
                            <p class="mt-1 text-sm text-gray-500">All comments have been moderated.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.comments.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    View All Comments
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Author
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Comment
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Post
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Date
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($comments as $comment)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                            <img 
                                                                class="h-10 w-10 rounded-full" 
                                                                src="{{ $comment->user?->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                                                                alt="{{ $comment->user?->name ?? 'Anonymous' }}"
                                                                >                                                            
                                                            </div>
                                                            <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $comment->user?->name ?? 'Deleted User' }}</div>
                                                            <div class="text-sm text-gray-500">{{ $comment->user?->email ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm text-gray-900 max-w-xs truncate">{{ $comment->content }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <a href="{{ route('blog.show', $comment->post) }}" class="text-sm text-blue-600 hover:underline">
                                                            {{ Str::limit($comment->post->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <div class="flex justify-end space-x-2">
                                                            <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Approve this comment?')">
                                                                    Approve
                                                                </button>
                                                            </form>
                                                            <span class="text-gray-300">|</span>
                                                            <a href="{{ route('admin.comments.edit', $comment) }}" class="text-indigo-600 hover:text-indigo-900">
                                                                Edit
                                                            </a>
                                                            <span class="text-gray-300">|</span>
                                                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this comment permanently?')">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            {{ $comments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>