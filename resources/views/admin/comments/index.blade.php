<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Comments ({{ $comments->total() }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Bulk Actions Form - Fixed method to POST -->
                    <form action="{{ route('admin.comments.bulk-actions') }}" method="POST" id="bulk-actions-form">
                        @csrf
                        <input type="hidden" name="action" id="bulk-action-input">
                        
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-4">
                                <select id="bulk-action-select" 
                                        class="rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Bulk Actions</option>
                                    <option value="approve">Approve Selected</option>
                                    <option value="delete">Delete Selected</option>
                                </select>
                                <button type="button" onclick="submitBulkForm()" 
                                        class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                                    Apply
                                </button>
                            </div>
                            <a href="{{ route('admin.comments.pending') }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                View Pending ({{ \App\Models\Comment::pending()->count() }})
                            </a>
                        </div>

                        <!-- Comments Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($comments as $comment)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" 
                                                   class="comment-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs">{{ Str::limit($comment->content, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" 
                                                         src="{{ $comment->user?->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                                                         alt="{{ $comment->user?->name ?? 'Deleted User' }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $comment->user?->name ?? 'Deleted User' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $comment->user?->email ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('blog.show', $comment->post) }}" class="text-sm text-blue-600 hover:underline">
                                                {{ Str::limit($comment->post->title, 30) }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $comment->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $comment->is_approved ? 'Approved' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-4">
                                                <a href="{{ route('admin.comments.edit', $comment) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Delete this comment permanently?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            No comments found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced bulk actions form submission
        function submitBulkForm() {
            const action = document.getElementById('bulk-action-select').value;
            const selectedComments = document.querySelectorAll('.comment-checkbox:checked');
            
            // Validation
            if (!action) {
                alert('Please select an action');
                return;
            }
            
            if (selectedComments.length === 0) {
                alert('Please select at least one comment');
                return;
            }
            
            if (!confirm(`Are you sure you want to ${action} ${selectedComments.length} comment(s)?`)) {
                return;
            }
            
            // Ensure we're using POST method
            const form = document.getElementById('bulk-actions-form');
            form.method = 'POST';
            
            // Set the action and submit
            document.getElementById('bulk-action-input').value = action;
            form.submit();
        }
        
        // Select all checkboxes
        document.getElementById('select-all').addEventListener('change', function(e) {
            document.querySelectorAll('.comment-checkbox').forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });

        // Visual feedback for selected rows
        document.querySelectorAll('.comment-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                if (this.checked) {
                    row.classList.add('bg-gray-50');
                } else {
                    row.classList.remove('bg-gray-50');
                }
            });
        });
    </script>
</x-app-layout>