<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'user_id',
        'published_at'
    ];

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
