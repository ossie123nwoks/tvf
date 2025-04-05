<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    protected $fillable = [
        'title', 'description', 'audio_url', 'video_url', 'date'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
