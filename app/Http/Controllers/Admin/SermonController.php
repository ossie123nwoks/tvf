<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\Series;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Rules\ValidYouTubeUrl;

class SermonController extends Controller
{
    /**
     * Display a listing of sermons
     */
    public function index()
    {
        $sermons = Sermon::with(['series', 'topics'])
                    ->latest()
                    ->paginate(10);

        return view('admin.sermons.index', compact('sermons'));
    }

    /**
     * Show the form for creating a new sermon
     */
    public function create()
    {
        $series = Series::all();
        $topics = Topic::all();

        return view('admin.sermons.create', compact('series', 'topics'));
    }

    /**
     * Store a newly created sermon
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'description' => 'required|string',
            'series_id' => 'nullable|exists:series,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'audio_url' => 'nullable|url',
            'video_url' => ['nullable', new ValidYouTubeUrl],
            'transcript' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
            'date' => 'required|date',
            'topics' => 'nullable|array',
            'topics.*' => 'exists:topics,id'
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('sermons/thumbnails', 'public');
        }

        if ($request->hasFile('transcript')) {
            $validated['transcript_url'] = $request->file('transcript')->store('sermons/transcripts', 'public');
        }

        // Create sermon
        $sermon = Sermon::create([
            'title' => $validated['title'],
            'speaker' => $validated['speaker'],
            'description' => $validated['description'],
            'series_id' => $validated['series_id'],
            'thumbnail' => $validated['thumbnail'] ?? null,
            'audio_url' => $validated['audio_url'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'transcript_url' => $validated['transcript_url'] ?? null,
            'date' => $validated['date']
        ]);

        // Attach topics
        if (isset($validated['topics'])) {
            $sermon->topics()->attach($validated['topics']);
        }

        return redirect()->route('admin.sermons.index')
                        ->with('success', 'Sermon created successfully!');
    }

    /**
     * Show the form for editing a sermon
     */
    public function edit(Sermon $sermon)
    {
        $series = Series::all();
        $topics = Topic::all();

        return view('admin.sermons.edit', compact('sermon', 'series', 'topics'));
    }

    /**
     * Update the specified sermon
     */
    public function update(Request $request, Sermon $sermon)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'description' => 'required|string',
            'series_id' => 'nullable|exists:series,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'audio_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'transcript' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
            'date' => 'required|date',
            'topics' => 'nullable|array',
            'topics.*' => 'exists:topics,id'
        ]);

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($sermon->thumbnail) {
                Storage::disk('public')->delete($sermon->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('sermons/thumbnails', 'public');
        }

        // Handle transcript update
        if ($request->hasFile('transcript')) {
            // Delete old transcript if exists
            if ($sermon->transcript_url) {
                Storage::disk('public')->delete($sermon->transcript_url);
            }
            $validated['transcript_url'] = $request->file('transcript')->store('sermons/transcripts', 'public');
        }

        // Update sermon
        $sermon->update([
            'title' => $validated['title'],
            'speaker' => $validated['speaker'],
            'description' => $validated['description'],
            'series_id' => $validated['series_id'],
            'thumbnail' => $validated['thumbnail'] ?? $sermon->thumbnail,
            'audio_url' => $validated['audio_url'] ?? $sermon->audio_url,
            'video_url' => $validated['video_url'] ?? $sermon->video_url,
            'transcript_url' => $validated['transcript_url'] ?? $sermon->transcript_url,
            'date' => $validated['date']
        ]);

        // Sync topics
        if (isset($validated['topics'])) {
            $sermon->topics()->sync($validated['topics']);
        } else {
            $sermon->topics()->detach();
        }

        return redirect()->route('admin.sermons.index')
                        ->with('success', 'Sermon updated successfully!');
    }

    /**
     * Remove the specified sermon
     */
    public function destroy(Sermon $sermon)
    {
        // Delete associated files
        if ($sermon->thumbnail) {
            Storage::disk('public')->delete($sermon->thumbnail);
        }
        if ($sermon->transcript_url) {
            Storage::disk('public')->delete($sermon->transcript_url);
        }

        // Detach topics
        $sermon->topics()->detach();

        // Delete sermon
        $sermon->delete();

        return redirect()->route('admin.sermons.index')
                        ->with('success', 'Sermon deleted successfully!');
    }
}