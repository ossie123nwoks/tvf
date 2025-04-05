<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    // Display a listing of sermons
    public function index()
    {
        $sermons = Sermon::latest()->get();
        return view('admin.sermons.index', compact('sermons'));
    }

    // Show the form for creating a new sermon
    public function create()
    {
        return view('admin.sermons.create');
    }

    // Store a newly created sermon
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'audio_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'date' => 'required|date',
        ]);

        Sermon::create($request->all());

        return redirect()->route('admin.sermons.index')->with('success', 'Sermon created successfully!');
    }

    // Display the specified sermon
    public function show(Sermon $sermon)
    {
        return view('admin.sermons.show', compact('sermon'));
    }

    // Show the form for editing the specified sermon
    public function edit(Sermon $sermon)
    {
        return view('admin.sermons.edit', compact('sermon'));
    }

    // Update the specified sermon
    public function update(Request $request, Sermon $sermon)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'audio_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'date' => 'required|date',
        ]);

        $sermon->update($request->all());

        return redirect()->route('admin.sermons.index')->with('success', 'Sermon updated successfully!');
    }

    // Remove the specified sermon
    public function destroy(Sermon $sermon)
    {
        $sermon->delete();
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon deleted successfully!');
    }
}
