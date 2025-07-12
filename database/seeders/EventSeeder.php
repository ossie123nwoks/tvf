<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        // 1. Create non-recurring events (with proper null handling)
        Event::factory()
            ->count(30)
            ->create([
                'is_recurring' => false,
                'recurrence' => null,
                'recurrence_interval' => 0,  // or whatever default your DB accepts
                'recurrence_count' => 0,
                'recurrence_end_date' => null,
                'next_occurrence' => null
            ]);

        // 2. Create recurring events
        Event::factory()
            ->count(20)
            ->create([
                'is_recurring' => true,
                'recurrence' => 'weekly',
                'recurrence_interval' => 1,
                'recurrence_count' => 12,
                'recurrence_end_date' => Carbon::now()->addYear(),
                'next_occurrence' => Carbon::now()->addWeek()
            ]);

        // 3. Specific example events
        Event::factory()->create([
            'title' => 'Weekly Team Sync',
            'is_recurring' => true,
            'recurrence' => 'weekly',
            'recurrence_interval' => 1,
            'start_time' => Carbon::now()->next('Monday')->setTime(10, 0),
            'end_time' => Carbon::now()->next('Monday')->setTime(11, 0),
            'next_occurrence' => Carbon::now()->next('Monday')->setTime(10, 0)
        ]);
    }
}