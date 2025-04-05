<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Display a listing of gallery images
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    // Show the form for creating a new gallery image
    public function create()
    {
        return view('admin.gallery.create');
    }

    // Store a newly created gallery image
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload the image
        $imagePath = $request->file('image_url')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image added successfully!');
    }

    // Display the specified gallery image
    public function show(Gallery $gallery)
    {
        return view('admin.gallery.show', compact('gallery'));
    }

    // Show the form for editing the specified gallery image
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    // Update the specified gallery image
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            // Upload the new image
            $imagePath = $request->file('image_url')->store('gallery', 'public');
            $gallery->image_url = $imagePath;
        }

        $gallery->title = $request->title;
        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Image updated successfully!');
    }

    // Remove the specified gallery image
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted successfully!');
    }
}
