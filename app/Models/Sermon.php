<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Sermon extends Model
{
    
    
    protected $fillable = [
        'title', 'speaker', 'description', 'date', 
        'thumbnail', 'audio_url', 'video_url', 'transcript_url', 'series_id'
    ];


    protected $casts = [
        'date' => 'datetime',
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }

     /**
     * Automatically extract YouTube ID when setting video_url
     */
    public function setVideoUrlAttribute($value)
    {
        $this->attributes['video_url'] = $this->extractYoutubeId($value);
    }

    /**
     * Extract YouTube ID from URL (supports multiple formats)
     */
    public function extractYoutubeId($url)
    {
        if (empty($url)) return null;

        // Match YouTube URLs (including youtu.be and embed links)
        $pattern = '~
            (?:https?://)?    # Optional protocol
            (?:www\.)?        # Optional www
            (?:               # Group host alternatives
                youtube\.com  # Main domain
            | youtu\.be       # Short URL
            )/?
            (?:               # Path alternatives
                watch\?v=     # Watch page
            | embed/          # Embed URL
            | v/              # Short URL
            | .*?[&?]v=       # URL with extra params
            )?
            ([^"&?/\s]{11})   # Capture video ID (11 chars)
        ~xi';

        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Generate an embed-friendly YouTube URL
     */
    public function getEmbedUrlAttribute()
    {
        return $this->video_url 
            ? "https://www.youtube.com/embed/{$this->video_url}?rel=0&modestbranding=1"
            : null;
    }

    /**
     * Check if URL is a valid YouTube link (without API)
     */
    public function isValidYoutubeUrl($url)
    {
        if (empty($url)) return false;

        $patterns = [
            '~^(https?://)?(www\.)?(youtube\.com|youtu\.be)/~i',
            '~^https?://(www\.)?youtube\.com/embed/~i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }

        return false;
    }
}
