<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(4);
        $publishedAt = $this->faker->optional(0.7)->dateTimeBetween('-1 year', '+1 month');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->generatePostContent(),
            'featured_image' => $this->faker->optional(0.8)->imageUrl(1200, 630, 'nature', true),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'published_at' => $publishedAt,
            'meta_title' => $this->faker->optional(0.5)->sentence,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    private function generatePostContent(): string
    {
        $content = '';
        
        // Add 3-6 paragraphs
        for ($i = 0; $i < $this->faker->numberBetween(3, 6); $i++) {
            $content .= '<p>' . $this->faker->paragraph(6) . '</p>';
            
            // 50% chance to add a heading
            if ($this->faker->boolean(50)) {
                $content .= '<h2>' . $this->faker->sentence . '</h2>';
            }
            
            // 30% chance to add an image
            if ($this->faker->boolean(30)) {
                $content .= '<img src="' . $this->faker->imageUrl(800, 400) . '" alt="' . $this->faker->sentence . '">';
            }
        }
        
        return $content;
    }

    // State for featured posts
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                
                'featured_image' => $this->faker->imageUrl(1200, 630, 'featured', true),
            ];
        });
    }

    // State for unpublished posts
    public function unpublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => null,
            ];
        });
    }
}