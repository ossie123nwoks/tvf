<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accessor for profile photo URL
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/'.$this->avatar);
        }
        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
    }

    // Relationship with posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relationship with comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}