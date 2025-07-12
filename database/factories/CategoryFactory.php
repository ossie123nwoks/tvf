<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $name = $this->generateUniqueCategoryName();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    protected function generateUniqueCategoryName(): string
    {
        $name = $this->faker->unique()->words(
            $this->faker->numberBetween(1, 3),
            true
        );

        // Ensure first letter is uppercase
        return Str::title($name);
    }
}