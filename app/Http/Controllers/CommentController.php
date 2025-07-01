<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Only authenticated users can comment
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:10|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(), // Use authenticated user's ID
            'parent_id' => $validated['parent_id'] ?? null,
            'is_approved' => config('blog.comments.auto_approve', false),
        ]);

        return back()
            ->with('success', 'Comment submitted successfully!')
            ->with('comment_added', $comment->id);
    }

    public function reply(Request $request, Comment $comment)
{
    $request->validate([
        'content' => 'required|string|max:1000'
    ]);

    $reply = new Comment();
    $reply->content = $request->content;
    $reply->user_id = Auth::id();
    $reply->post_id = $comment->post_id;
    $reply->parent_id = $comment->id;
    $reply->is_approved = true; // Or set based on your approval system
    $reply->save();

    return back()->with('success', 'Reply posted successfully!');
}
}