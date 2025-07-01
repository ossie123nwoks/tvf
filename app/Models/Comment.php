<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'is_approved'
    ];

    // 🔁 A comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // 🔁 A comment optionally belongs to a user (nullable for guests)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id');
}

public function parent()
{
    return $this->belongsTo(Comment::class, 'parent_id');
}

protected $casts = [
    'is_approved' => 'boolean'
];

public function scopeApproved($query)
{
    return $query->where('is_approved', true);
}

public function scopePending($query)
{
    return $query->where('is_approved', false);
}
}
