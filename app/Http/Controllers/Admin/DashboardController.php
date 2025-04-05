<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\ContactMessage;
use App\Models\Post;

class DashboardController extends Controller
{
    // Display the admin dashboard
    public function index()
    {
        $sermonsCount = Sermon::count();
        $eventsCount = Event::count();
        $galleryCount = Gallery::count();
        $messagesCount = ContactMessage::count();
        $postsCount = Post::count();

        return view('admin.dashboard', compact('sermonsCount','postsCount', 'eventsCount', 'galleryCount', 'messagesCount'));
    }
}