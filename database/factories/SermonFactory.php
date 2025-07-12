<?php

namespace Database\Factories;

use App\Models\Sermon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SermonFactory extends Factory
{
    protected $model = Sermon::class;

    public function definition()
    {
        $title = $this->faker->sentence(4);
        $date = $this->faker->dateTimeBetween('-1 year', 'now');
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(3),
            'speaker' => $this->faker->name,
            'thumbnail' => $this->faker->imageUrl(640, 480, 'religious', true),
            'audio_url' => $this->faker->url.'/audio.mp3',
            'video_url' => $this->faker->url.'/video.mp4',
            'transcript_url' => $this->faker->optional(0.7)->url.'/transcript.pdf', // 70% chance of having transcript
            'date' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    // State for recent sermons
    public function recent()
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }

    // State for featured sermons (with thumbnail)
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'thumbnail' => $this->faker->imageUrl(800, 600, 'featured', true),
            ];
        });
    }
}