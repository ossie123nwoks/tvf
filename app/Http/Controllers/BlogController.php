<?php

// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);
                    
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $posts = Post::whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->where(function($q) use ($query) {
                        $q->where('title', 'LIKE', "%$query%")
                          ->orWhere('content', 'LIKE', "%$query%");
                    })
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);
                    
        return view('blog.index', compact('posts', 'query'));
    }
}