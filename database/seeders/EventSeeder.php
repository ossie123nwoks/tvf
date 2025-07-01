<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample events
        Event::create([
            'title' => 'Community Picnic',
            'description' => 'Join us for a fun-filled community picnic at the park.',
            'location' => 'Central Park',
            'start_time' => Carbon::parse('2023-11-05 10:00:00'),
            'end_time' => Carbon::parse('2023-11-05 14:00:00'),
        ]);

        Event::create([
            'title' => 'Charity Run',
            'description' => 'Participate in our annual charity run to support local causes.',
            'location' => 'Downtown Square',
            'start_time' => Carbon::parse('2023-11-12 08:00:00'),
            'end_time' => Carbon::parse('2023-11-12 12:00:00'),
        ]);

        Event::create([
            'title' => 'Youth Camp',
            'description' => 'A weekend of fun, fellowship, and spiritual growth for our youth.',
            'location' => 'Church Grounds',
            'start_time' => Carbon::parse('2023-11-19 09:00:00'),
            'end_time' => Carbon::parse('2023-11-21 17:00:00'),
        ]);
    }
}
