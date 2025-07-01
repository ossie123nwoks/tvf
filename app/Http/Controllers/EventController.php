<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{

public function index()
{
    $events = Event::where('is_active', true)
        ->where(function($query) {
            $query->where('end_time', '>=', now())
                ->orWhere('is_recurring', true);
        })
        ->orderByRaw("CASE WHEN is_recurring THEN next_occurrence ELSE start_time END")
        ->paginate(5);
    
    return view('events.index', compact('events'));
}

    public function show(Event $event)
{
    return view('events.show', [
        'event' => $event,
        'occurrences' => $event->getUpcomingOccurrences(5),
        'main_occurrence' => $event->next_occurrence ?? $event->start_time
    ]);
}

}