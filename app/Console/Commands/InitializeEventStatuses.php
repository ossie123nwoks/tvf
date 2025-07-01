<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class InitializeEventStatuses extends Command
{
    protected $signature = 'events:initialize-statuses';
    protected $description = 'Initialize statuses for all existing events';

    public function handle()
    {
        $this->info('Initializing event statuses...');
        
        Event::chunk(100, function ($events) {
            foreach ($events as $event) {
                $event->updateStatus();
                $event->save();
                $this->info("Updated status for event: {$event->id} - {$event->title}");
            }
        });
        
        $this->info('All event statuses initialized successfully!');
    }
}