<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'excerpt' => 'required',
        'content' => 'required',
        'featured_image' => 'nullable|image|max:2048',
        'published_at' => 'nullable|date',
    ]);

    // Handle image upload
    if ($request->hasFile('featured_image')) {
        $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
    }

    // Create post through the user relationship
    $post = auth()->user()->posts()->create([
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']),
        'excerpt' => $validated['excerpt'],
        'content' => $validated['content'],
        'featured_image' => $validated['featured_image'] ?? null,
        'published_at' => $validated['published_at'] ?? null,
    ]);

    return redirect()->route('admin.posts.index')
                   ->with('success', 'Post created successfully');
}

    public function edit(Post $post)
{
    return view('admin.posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'excerpt' => 'required',
        'content' => 'required',
        'featured_image' => 'nullable|image|max:2048',
        'published_at' => 'nullable|date',
    ]);

    // Handle image upload
    if ($request->hasFile('featured_image')) {
        // Delete old image if exists
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
    }

    // Only update slug if title changed
    if ($request->title !== $post->title) {
        $validated['slug'] = Str::slug($request->title);
    }

    $post->update($validated);

    return redirect()->route('admin.posts.index')
                    ->with('success', 'Post updated successfully');
}

public function destroy(Post $post)
{
    // Delete associated image if exists
    if ($post->featured_image) {
        Storage::disk('public')->delete($post->featured_image);
    }

    $post->delete();

    return redirect()->route('admin.posts.index')
                    ->with('success', 'Post deleted successfully');
}

}