<?php

namespace Database\Seeders;

use App\Models\Sermon;
use Illuminate\Database\Seeder;

class SermonSeeder extends Seeder
{
    public function run()
    {
        // Create 30 regular sermons
        Sermon::factory()
            ->count(5)
            ->create();

        // Create 10 recent sermons
        Sermon::factory()
            ->count(4)
            ->recent()
            ->create();

        // Create 5 featured sermons
        Sermon::factory()
            ->count(2)
            ->featured()
            ->create();

        // Create specific example sermons
        Sermon::factory()->create([
            'title' => 'The Power of Faith',
            'speaker' => 'Dr. James Anderson',
            'date' => now()->subDays(7),
            'video_url' => 'https://example.com/sermons/power-of-faith/video',
            'thumbnail' => 'https://example.com/images/power-of-faith.jpg'
        ]);
    }
}