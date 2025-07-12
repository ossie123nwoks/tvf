<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\SermonController as PublicSermonController;
use App\Http\Controllers\EventController as PublicEventController;
use App\Http\Controllers\ContactController as PublicContactController;
use App\Http\Controllers\GalleryController as PublicGalleryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/sermons', [PublicSermonController::class, 'index'])->name('sermons.index');
Route::get('/sermons/{sermon}', [PublicSermonController::class, 'show'])->name('sermons.show');
Route::get('/events', [PublicEventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [PublicEventController::class, 'show'])->name('events.show');
Route::get('/gallery', [PublicGalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [PublicContactController::class, 'index'])->name('contact');

// Blog Routes
Route::controller(BlogController::class)->group(function() {
    Route::get('/blog', 'index')->name('blog.index');
    Route::get('/blog/{post:slug}', 'show')->name('blog.show');
    Route::post('/blog/{post}/comments', 'storeComment')->name('blog.comments.store')->middleware('auth');
    Route::delete('/comments/{comment}', 'deleteComment')->name('comments.destroy');
});

// Authentication Routes
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])
        ->name('comments.reply');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('sermons', AdminSermonController::class);
        Route::resource('events', EventController::class);
        Route::resource('gallery', AdminGalleryController::class);
        Route::resource('posts', PostController::class);
        
        // Comment Routes
        Route::resource('comments', AdminCommentController::class)->except(['create', 'store']);
        Route::get('/pending', [AdminCommentController::class, 'pending'])
            ->name('comments.pending');
        Route::post('/bulk-actions', [AdminCommentController::class, 'bulkActions'])
            ->name('comments.bulk-actions');
        Route::patch('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])
            ->name('comments.approve');
        
        // Other Admin Resources
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('series', \App\Http\Controllers\Admin\SeriesController::class)->except(['show']);
        Route::resource('topics', \App\Http\Controllers\Admin\TopicController::class)->except(['show']);
    });
});