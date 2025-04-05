<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sermons = Sermon::latest()->take(3)->get();
        $events = Event::latest()->take(3)->get();
       // $gallery = Gallery::latest()->take(6)->get();

        return view('home', compact('sermons', 'events',));
    }
}
    //remember to add the gallery variable