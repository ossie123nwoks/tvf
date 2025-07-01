<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'category_id',
        'user_id'
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Scope for published posts
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function isPublished()
{
    return $this->published_at && $this->published_at <= now();
}

    // Automatically generate slug
    protected static function boot()
{
    parent::boot();

    static::creating(function ($post) {
        $originalSlug = Str::slug($post->title);
        $post->slug = $originalSlug;
        
        $count = 1;
        while (static::where('slug', $post->slug)->exists()) {
            $post->slug = $originalSlug . '-' . $count++;
        }
    });

    static::updating(function ($post) {
        if ($post->isDirty('title')) {
            $originalSlug = Str::slug($post->title);
            $post->slug = $originalSlug;
            
            $count = 1;
            while (static::where('slug', $post->slug)
                      ->where('id', '!=', $post->id)
                      ->exists()) {
                $post->slug = $originalSlug . '-' . $count++;
            }
        }
    });
}
}