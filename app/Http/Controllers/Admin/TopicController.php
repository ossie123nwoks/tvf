<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::withCount('sermons')->latest()->paginate(10);
        return view('admin.topics.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.topics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:topics',
            'slug' => 'nullable|string|max:255|unique:topics',
            'description' => 'nullable|string'
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Topic::create($validated);

        return redirect()->route('admin.topics.index')
                         ->with('success', 'Topic created successfully!');
    }

    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:topics,name,'.$topic->id,
            'slug' => 'nullable|string|max:255|unique:topics,slug,'.$topic->id,
            'description' => 'nullable|string'
        ]);

        $topic->update($validated);

        return redirect()->route('admin.topics.index')
                         ->with('success', 'Topic updated successfully!');
    }

    public function destroy(Topic $topic)
    {
        // Detach all sermons first
        $topic->sermons()->detach();
        $topic->delete();

        return redirect()->route('admin.topics.index')
                         ->with('success', 'Topic deleted successfully!');
    }
}