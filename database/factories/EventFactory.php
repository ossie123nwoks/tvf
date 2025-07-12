<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        $startTime = $this->faker->dateTimeBetween('now', '+1 month');
        $endTime = Carbon::instance($startTime)->addHours(rand(1, 8));
        
        $isRecurring = $this->faker->boolean(30); // 30% chance of being recurring
        
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'location' => $this->faker->address,
            'is_recurring' => $isRecurring,
            'recurrence' => $isRecurring ? $this->faker->randomElement(['daily', 'weekly', 'monthly', 'yearly']) : null,
            'recurrence_interval' => $isRecurring ? $this->faker->numberBetween(1, 4) : null,
            'recurrence_count' => $isRecurring ? $this->faker->numberBetween(1, 12) : null,
            'recurrence_end_date' => $isRecurring ? Carbon::instance($startTime)->addMonths(rand(3, 12)) : null,
            'timezone' => $this->faker->timezone,
            'status' => $this->faker->randomElement(['scheduled', 'ongoing', 'completed', 'cancelled']),
            'next_occurrence' => $isRecurring ? Carbon::instance($startTime)->addWeek() : null,
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function recurring()
{
    return $this->state(function (array $attributes) {
        return [
            'is_recurring' => true,
            'recurrence' => 'weekly',
            'recurrence_interval' => 1,
            'recurrence_count' => 12,
        ];
    });
}

public function nonRecurring()
{
    return $this->state(function (array $attributes) {
        return [
            'is_recurring' => false,
            'recurrence' => null,
            'recurrence_interval' => 0,
            'recurrence_count' => 0,
            'recurrence_end_date' => null,
            'next_occurrence' => null
        ];
    });
}
}