<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Comment #{{ $comment->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Comment Details -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center mb-4">
                            <img class="h-12 w-12 rounded-full mr-4" 
                                 src="{{ $comment->user?->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                                 alt="{{ $comment->user?->name ?? 'Deleted User' }}">
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ $comment->user?->name ?? 'Deleted User' }}
                                    <span class="text-sm text-gray-500 ml-2">
                                        {{ $comment->created_at->format('M j, Y \a\t g:i a') }}
                                    </span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    On: <a href="{{ route('blog.show', $comment->post) }}" class="text-blue-600 hover:underline">
                                        {{ $comment->post->title }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 text-xs font-semibold rounded 
                                {{ $comment->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $comment->is_approved ? 'Approved' : 'Pending Approval' }}
                            </span>
                            @if($comment->is_approved)
                                <span class="text-sm text-gray-500">
                                    Approved {{ $comment->updated_at->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Form -->
                    <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Comment Content
                            </label>
                            <textarea name="content" id="content" rows="6"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                required>{{ old('content', $comment->content) }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <button type="submit" 
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Comment
                                </button>
                                <a href="{{ route('admin.comments.index') }}" 
                                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                    Cancel
                                </a>
                            </div>

                            @if(!$comment->is_approved)
                            <div class="mb-6">
                        <div class="flex items-center">
                            <input type="hidden" name="is_approved" value="0">
                            <input type="checkbox" id="is_approved" name="is_approved" value="1"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                {{ $comment->is_approved ? 'checked' : '' }}>
                            <label for="is_approved" class="ml-2 block text-sm text-gray-900">
                                Approve this comment
                            </label>
                        </div>
                    </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>