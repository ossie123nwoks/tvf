<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController ;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactController;
use App\Http\Controllers\SermonController as PublicSermonController;
use App\Http\Controllers\EventController as PublicEventController;
use App\Http\Controllers\ContactController as PublicContactController;
use App\Http\Controllers\GalleryController as PublicGalleryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
//Route::get('/about',  [AboutController::class, 'index'])->name('about');
Route::get('/sermons', [PublicSermonController::class, 'index'])->name('sermons.index');
Route::get('/sermons/{sermon}', [PublicSermonController::class, 'show'])->name('sermons.show');
Route::get('/events', [PublicEventController::class, 'index'])->name('events.index');
//Route::get('/sermons/{event}', [PublicEventController::class, 'show'])->name('events.show');
Route::get('/gallery', [PublicGalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [PublicContactController::class, 'index'])->name('contact');
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/search', [\App\Http\Controllers\BlogController::class, 'search'])->name('blog.search');

// Authentication Routes (Added by Laravel Breeze)
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Default Dashboard Route (Required by Laravel Breeze)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes (Protected by Auth and IsAdmin Middleware)
    Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Sermons
        Route::resource('sermons', AdminSermonController::class);

        // Events
        Route::resource('events', EventController::class);

        // Gallery
        Route::resource('gallery', AdminGalleryController::class);

        // Contact Messages
        Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages');
        Route::delete('messages/{id}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        Route::resource('posts', PostController::class);
    });
});
