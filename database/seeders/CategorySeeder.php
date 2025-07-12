<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create 10 random categories
        Category::factory()
            ->count(10)
            ->create();

        // Create specific common categories
        $commonCategories = [
            'Technology',
            'Health',
            'Business',
            'Lifestyle',
            'Education'
        ];

        foreach ($commonCategories as $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category]
            );
        }
    }
}