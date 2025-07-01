<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use App\Models\Series;
use App\Models\Topic;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function index(Request $request)
    {
        $query = Sermon::with(['series', 'topics'])
                    ->latest();
        
        // Search functionality
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('speaker', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }
        
        // Filter by series
        if ($request->has('series')) {
            $query->whereHas('series', function($q) use ($request) {
                $q->where('id', $request->series);
            });
        }
        
        // Filter by topic
        if ($request->has('topic')) {
            $query->whereHas('topics', function($q) use ($request) {
                $q->where('id', $request->topic);
            });
        }

        $sermons = $query->paginate(9);
        $series = Series::all();
        $topics = Topic::all();
        
        return view('sermons.index', compact('sermons', 'series', 'topics'));
    }

    public function show(Sermon $sermon)
    {
        // Get related sermons (same series or sharing topics)
        $relatedSermons = Sermon::where(function($query) use ($sermon) {
                                if ($sermon->series_id) {
                                    $query->where('series_id', $sermon->series_id)
                                          ->where('id', '!=', $sermon->id);
                                }
                                $query->orWhereHas('topics', function($q) use ($sermon) {
                                    $q->whereIn('id', $sermon->topics->pluck('id'));
                                });
                            })
                            ->with(['series', 'topics'])
                            ->latest()
                            ->take(4)
                            ->get();

        return view('sermons.show', [
            'sermon' => $sermon->load(['series', 'topics']),
            'relatedSermons' => $relatedSermons
        ]);
    }
}