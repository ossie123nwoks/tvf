<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Create 50 regular posts
        Post::factory()
            ->count(50)
            ->create();

        // Create 10 featured posts
        Post::factory()
            ->count(10)
            ->featured()
            ->create();

        // Create 5 unpublished posts
        Post::factory()
            ->count(5)
            ->unpublished()
            ->create();

        // Create specific example posts
        Post::factory()->create([
            'title' => 'Getting Started with Laravel',
            'slug' => 'getting-started-with-laravel',
            'user_id' => 1, // Admin user
            'category_id' => 1, // Main category
            'featured_image' => 'https://source.unsplash.com/random/1200x630/?laravel',
            'published_at' => now(),
        ]);
    }
}