<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sermon;


class SermonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample sermons
        Sermon::create([
            'title' => 'The Power of Faith',
            'description' => 'A sermon about the importance of faith in daily life.',
            'audio_url' => 'https://example.com/audio/power_of_faith.mp3',
            'video_url' => 'https://example.com/video/power_of_faith.mp4',
            'date' => '2023-10-01',
        ]);

        Sermon::create([
            'title' => 'Love Your Neighbor',
            'description' => 'A sermon on the significance of loving others as yourself.',
            'audio_url' => 'https://example.com/audio/love_your_neighbor.mp3',
            'video_url' => null, // No video for this sermon
            'date' => '2023-10-08',
        ]);

        Sermon::create([
            'title' => 'Overcoming Fear',
            'description' => 'A sermon about conquering fear through faith.',
            'audio_url' => null, // No audio for this sermon
            'video_url' => 'https://example.com/video/overcoming_fear.mp4',
            'date' => '2023-10-15',
        ]);

        // Add more sermons as needed
    }
}
