<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display all comments (approved and pending)
     */
    public function index()
    {
        $comments = Comment::with(['user', 'post'])
            ->latest()
            ->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show only pending comments
     */
    public function pending()
    {
        $comments = Comment::with(['user', 'post'])
            ->where('is_approved', false)
            ->latest()
            ->paginate(15);

        return view('admin.comments.pending', compact('comments'));
    }



    /**
     * Show a single comment
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Edit comment form
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update comment content
     */
    public function update(Request $request, Comment $comment)
{
    $validated = $request->validate([
        'content' => 'required|string|min:10|max:1000',
        'is_approved' => 'sometimes|boolean' // Add this validation
    ]);

    // Ensure is_approved is set (checkbox workaround)
    $validated['is_approved'] = $request->has('is_approved');

    $comment->update($validated);

    return redirect()->route('admin.comments.index')
        ->with('success', "Comment #{$comment->id} updated successfully");
}

    /**
     * Delete a comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()
            ->with('success', "Comment #{$comment->id} deleted successfully");
    }

    public function approve(Comment $comment)
{
    $this->authorize('approve', $comment);
    
    $comment->update(['is_approved' => true]);
    
    return back()
        ->with('success', "Comment #{$comment->id} approved successfully");
}

public function bulkActions(Request $request)
    {
        $validated = $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comments,id',
            'action' => 'required|in:approve,delete'
        ]);

        switch ($validated['action']) {
            case 'approve':
                Comment::whereIn('id', $validated['comment_ids'])
                    ->update(['is_approved' => true]);
                $message = count($validated['comment_ids']) . ' comments approved';
                break;
                
            case 'delete':
                Comment::whereIn('id', $validated['comment_ids'])->delete();
                $message = count($validated['comment_ids']) . ' comments deleted';
                break;
        }

        return back()->with('success', $message);
    }

    
}