<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function index()
    {
        $sermons = Sermon::orderBy('date', 'desc')->get();
        return view('sermons.index', compact('sermons'));
    }

    public function show(Sermon $sermon)
    {
        return view('sermons.show', compact('sermon'));
    }
}