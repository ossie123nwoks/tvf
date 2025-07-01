<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Series extends Model
{
    protected $fillable = ['name', 'image', 'description'];

    protected $withCount = ['sermons'];
    
    public function sermons(): HasMany
    {
        return $this->hasMany(Sermon::class);
    }
}