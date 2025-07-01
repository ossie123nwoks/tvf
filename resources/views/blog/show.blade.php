<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Post Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <!-- Post Header -->
                <div class="p-6 border-b">
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        @isset($post->category)
                            <span class="font-medium text-indigo-600">{{ $post->category->name }}</span>
                            <span class="mx-2">•</span>
                        @endisset
                        <span>Published {{ $post->published_at->diffForHumans() }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $readingTime }} min read</span>
                    </div>
                    
                    @if($post->featured_image)
                    <div class="mb-6 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-auto max-h-96 object-cover">
                    </div>
                    @endif
                    
                    <div class="flex items-center mb-6">
                        <img class="h-10 w-10 rounded-full" 
                             src="{{ $post->author->profile_photo_url }}" 
                             alt="{{ $post->author->name }}">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $post->author->name }}</p>
                            <p class="text-sm text-gray-500">{{ $post->author->role ?? 'Author' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Post Content -->
                <div class="p-6 prose max-w-none">
                    {!! $post->content !!}
                </div>
            </div>

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
            @endif

            <!-- Comments Section -->
            <div id="comments-section" data-new-comment="{{ session('comment_added') }}"></div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">
                        Comments ({{ $post->comments()->whereNull('parent_id')->where('is_approved', true)->withCount('replies')->get()->sum('replies_count') + $post->comments()->whereNull('parent_id')->where('is_approved', true)->count() }})
                    </h3>
                    
                    <!-- Comment Form (Logged In Users Only) -->
                    @auth
                    <div class="mb-8">
                        <form action="{{ route('blog.comments.store', $post) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="sr-only">Your Comment</label>
                                <textarea name="content" id="content" rows="4" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                    placeholder="Write your comment..." required></textarea>
                                @error('content')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Post Comment
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="mb-6 p-4 bg-gray-50 rounded-md text-center">
                        <p class="text-gray-600">
                            Please <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">log in</a> to post a comment.
                        </p>
                    </div>
                    @endauth

                    <!-- Comments List with Replies -->
                    <div class="space-y-6">
                        @forelse($post->comments()->whereNull('parent_id')->where('is_approved', true)->with('replies')->get() as $comment)
                            @include('comments._comment', ['comment' => $comment, 'post' => $post])
                        @empty
                            <p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to new comment
            const commentsSection = document.getElementById('comments-section');
            const newCommentId = commentsSection.dataset.newComment;
            
            if (newCommentId) {
                const commentElement = document.getElementById('comment-' + newCommentId);
                if (commentElement) {
                    commentElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    
                    // Add highlight effect
                    commentElement.classList.add('bg-blue-50', 'transition', 'duration-300');
                    setTimeout(() => {
                        commentElement.classList.remove('bg-blue-50');
                    }, 3000);
                }
            }

            // Toggle reply forms
            document.querySelectorAll('.reply-button').forEach(button => {
                button.addEventListener('click', function() {
                    const formId = this.dataset.target;
                    const form = document.getElementById(formId);
                    form.classList.toggle('hidden');
                    
                    // Smooth scroll to form if opening
                    if (!form.classList.contains('hidden')) {
                        form.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>