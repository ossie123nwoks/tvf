<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topic extends Model
{
    
    protected $fillable = ['name', 'slug'];

    protected $withCount = ['sermons'];

    public function sermons(): BelongsToMany
    {
        return $this->belongsToMany(Sermon::class);
    }
}