<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateEventStatuses extends Command
{
    protected $signature = 'events:update-statuses';
    protected $description = 'Update statuses for all events based on current time';

    public function handle()
    {
        $now = Carbon::now();
        $updatedCount = 0;

        // Process all events (both one-time and recurring)
        Event::chunk(200, function ($events) use ($now, &$updatedCount) {
            foreach ($events as $event) {
                $originalStatus = $event->status;
                $originalNextOccurrence = $event->next_occurrence;

                // For one-time events
                if (!$event->is_recurring) {
                    $event->updateStatus();
                    
                    // Only save if status changed
                    if ($originalStatus !== $event->status) {
                        $event->save();
                        $updatedCount++;
                        $this->info("Updated one-time event {$event->id} to {$event->status}");
                    }
                    continue;
                }

                // For recurring events
                $event->updateStatus();
                
                // Calculate next occurrence if event finished
                if ($event->status === 'finished') {
                    $event->next_occurrence = $event->calculateNextOccurrence();
                    
                    // If there's a next occurrence, reset status
                    if ($event->next_occurrence) {
                        $event->updateStatus();
                    }
                }

                // Save if anything changed
                if ($originalStatus !== $event->status || 
                    $originalNextOccurrence != $event->next_occurrence) {
                    $event->save();
                    $updatedCount++;
                    $this->info("Updated recurring event {$event->id} to {$event->status}");
                }
            }
        });

        $this->info("Completed status updates. {$updatedCount} events were updated.");
    }

}