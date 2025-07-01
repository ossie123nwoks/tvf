<div class="comment" id="comment-{{ $comment->id }}">
    <div class="flex">
        <div class="flex-shrink-0 mr-3">
            <img class="h-10 w-10 rounded-full" 
                 src="{{ $comment->user->profile_photo_url }}" 
                 alt="{{ $comment->user->name }}">
        </div>
        <div class="flex-1 min-w-0">
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-medium text-gray-900">
                        {{ $comment->user->name }}
                    </h4>
                    <div class="flex items-center space-x-2">
                        <span class="text-xs text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                        @if(auth()->id() === $comment->user_id || auth()->user()->is_admin ?? false)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                <p class="mt-1 text-sm text-gray-700">
                    {{ $comment->content }}
                </p>
                
                <!-- Reply button and form -->
                @auth
                <div class="mt-3">
                    <button type="button" 
                            class="reply-button text-xs text-indigo-600 hover:text-indigo-800"
                            data-target="reply-form-{{ $comment->id }}">
                        Reply
                    </button>
                    
                    <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                        <form action="{{ route('comments.reply', $comment) }}" method="POST">
                            @csrf
                            <textarea name="content" rows="2" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" 
                                placeholder="Write your reply..." required></textarea>
                            <button type="submit" class="mt-2 px-3 py-1 bg-indigo-600 text-white text-xs rounded-md hover:bg-indigo-700">
                                Post Reply
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Replies -->
    @if($comment->replies->count() > 0)
        <div class="ml-12 mt-4 space-y-4">
            @foreach($comment->replies as $reply)
                @include('comments._comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>