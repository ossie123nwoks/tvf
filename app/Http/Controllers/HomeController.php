<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use App\Models\Event;
use App\Models\Post;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    // app/Http/Controllers/HomeController.php

public function index()
{
    $sermons = Sermon::latest()->take(3)->get();
    
    $events = Event::query()
        ->where('is_active', true)
        ->where(function($query) {
            $query->where(function($q) {
                // One-time events that haven't ended
                $q->where('is_recurring', false)
                  ->where('end_time', '>=', now());
            })
            ->orWhere(function($q) {
                // Recurring events that have future occurrences
                $q->where('is_recurring', true)
                  ->where(function($q2) {
                      $q2->whereNull('recurrence_end_date')
                         ->orWhere('recurrence_end_date', '>=', now());
                  });
            });
        })
        ->orderByRaw("
            CASE 
                WHEN is_recurring THEN next_occurrence 
                ELSE start_time 
            END
        ")
        ->paginate(6);
    
    $posts = Post::latest()->take(3)->get();

    return view('home', compact('sermons', 'events', 'posts'));
}
}
    //remember to add the gallery variable