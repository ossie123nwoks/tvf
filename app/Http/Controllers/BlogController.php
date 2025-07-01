<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['storeComment', 'deleteComment']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categorySlug = $request->input('category');

        $posts = Post::with(['author', 'category', 'comments.user'])
            ->published()
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                      ->orWhere('content', 'like', "%$search%");
                });
            })
            ->when($categorySlug, function ($query, $categorySlug) {
                return $query->whereHas('category', function($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->withCount(['comments' => function($query) {
                $query->where('is_approved', true);
            }])
            ->latest('published_at')
            ->paginate(9);

        $featuredPost = Post::with(['author', 'category'])
            ->published()
            ->latest('published_at')
            ->first();

        $categories = Category::all();

        return view('blog.index', compact('posts', 'featuredPost', 'categories'));
    }

    public function show(Post $post)
    {
        abort_unless($post->exists && $post->isPublished(), 404);

        $post->load(['comments' => function($query) {
            $query->where('is_approved', true)
                  ->with(['user' => function($q) {
                      $q->select('id', 'name');
                  }])
                  ->latest();
        }, 'author', 'category']);

        $wordCount = str_word_count(strip_tags($post->content));
        $readingTime = max(1, ceil($wordCount / 200));

        return view('blog.show', compact('post', 'readingTime'));
    }

    public function storeComment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => [
                'required',
                'string',
                'min:'.config('blog.comments.min_length', 10),
                'max:'.config('blog.comments.max_length', 1000)
            ]
        ]);

        try {
            $comment = $post->comments()->create([
                'content' => $validated['content'],
                'user_id' => Auth::id(),
                'is_approved' => config('blog.comments.auto_approve', false)
            ]);

            return back()
                ->with('success', config('blog.comments.auto_approve', false) 
                    ? 'Comment posted successfully!'
                    : 'Your comment is awaiting approval.')
                ->with('comment_added', $comment->id);

        } catch (\Exception $e) {
            Log::error('Comment creation failed: '.$e->getMessage());
            return back()->with('error', 'Failed to post comment. Please try again.');
        }
    }

    public function deleteComment(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        try {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully');
        } catch (\Exception $e) {
            Log::error('Comment deletion failed: '.$e->getMessage());
            return back()->with('error', 'Failed to delete comment');
        }
    }
}