<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    // Index - List all series
    public function index()
    {
        $series = Series::latest()->paginate(10);
        return view('admin.series.index', compact('series'));
    }

    // Create - Show form
    public function create()
    {
        return view('admin.series.create');
    }

    // Store - Save new series
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('series', 'public');
        }

        Series::create($validated);

        return redirect()->route('admin.series.index')
                         ->with('success', 'Series created successfully!');
    }

    // Edit - Show edit form
    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    // Update - Save changes
    public function update(Request $request, Series $series)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($series->image) {
                Storage::disk('public')->delete($series->image);
            }
            $validated['image'] = $request->file('image')->store('series', 'public');
        }

        $series->update($validated);

        return redirect()->route('admin.series.index')
                         ->with('success', 'Series updated successfully!');
    }

    // Destroy - Delete series
    public function destroy(Series $series)
    {
        if ($series->image) {
            Storage::disk('public')->delete($series->image);
        }
        
        $series->delete();
        
        return redirect()->route('admin.series.index')
                         ->with('success', 'Series deleted successfully!');
    }
}