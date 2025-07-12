<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'image',
        'is_recurring',
        'recurrence',
        'recurrence_interval',
        'recurrence_end_date',
        'timezone',
        'next_occurrence',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'recurrence_end_date' => 'datetime',
        'next_occurrence' => 'datetime',
        'is_recurring' => 'boolean',
    ];

    protected $appends = ['image_url', 'display_start_time', 'display_end_time'];

    // Boot method for model events
    protected static function booted()
    {
        static::saving(function ($event) {
            $event->updateStatus();
            if ($event->is_recurring) {
                $event->next_occurrence = $event->calculateNextOccurrence();
            }
        });

        static::deleted(function ($event) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
        });
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/event-placeholder.jpg');
        }
        return Storage::disk('public')->exists($this->image) 
            ? Storage::url($this->image) 
            : asset('images/event-placeholder.jpg');
    }

    // Status management
    public function updateStatus()
    {
        $timezone = $this->timezone ?? config('app.timezone');
        $now = now($timezone);
        
        $start = $this->is_recurring && $this->next_occurrence
            ? Carbon::parse($this->next_occurrence)->setTimezone($timezone)
            : $this->start_time->setTimezone($timezone);
        
        $end = $this->is_recurring && $this->next_occurrence
            ? $start->copy()->addSeconds($this->end_time->diffInSeconds($this->start_time))
            : $this->end_time->setTimezone($timezone);

        if ($start > $now) {
            $this->status = 'not_started';
        } elseif ($end >= $now) {
            $this->status = 'live';
        } else {
            $this->status = 'finished';
        }

        return $this;
    }

    // Recurrence calculations
    public function calculateNextOccurrence()
    {
        if (!$this->is_recurring) return null;

        $timezone = $this->timezone ?? config('app.timezone');
        $now = now($timezone);
        $start = $this->start_time->copy()->setTimezone($timezone);
        $interval = $this->recurrence_interval ?: 1;

        // Find next occurrence after current time
        while ($start <= $now) {
            $start = $this->addRecurrenceInterval($start, $interval);
            
            if ($this->shouldStopRecurrence($start)) {
                return null;
            }
        }

        return $start;
    }

    protected function addRecurrenceInterval(Carbon $date, int $interval): Carbon
    {
        return match($this->recurrence) {
            'daily' => $date->addDays($interval),
            'weekly' => $date->addWeeks($interval),
            'monthly' => $date->addMonthsNoOverflow($interval),
            'yearly' => $date->addYearsNoOverflow($interval),
            default => $date,
        };
    }

    protected function shouldStopRecurrence(Carbon $date): bool
    {
        if ($this->recurrence_end_date && $date > $this->recurrence_end_date) {
            return true;
        }
        return false;
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where(function($q) {
            $q->where('is_recurring', false)
              ->where('end_time', '>', now());
        })->orWhere(function($q) {
            $q->where('is_recurring', true)
              ->where(function($q2) {
                  $q2->whereNull('recurrence_end_date')
                     ->orWhere('recurrence_end_date', '>', now());
              })
              ->where(function($q2) {
                  $q2->whereNull('next_occurrence')
                     ->orWhere('next_occurrence', '>', now());
              });
        });
    }

    // For getting upcoming occurrences
    public function getUpcomingOccurrences(int $limit = 10): array
    {
        if (!$this->is_recurring) return [];

        $timezone = $this->timezone ?? config('app.timezone');
        $now = now($timezone);
        $start = $this->start_time->copy()->setTimezone($timezone);
        $interval = $this->recurrence_interval ?: 1;
        $occurrences = [];

        // Find first future occurrence
        while ($start <= $now) {
            $start = $this->addRecurrenceInterval($start, $interval);
            if ($this->shouldStopRecurrence($start)) break;
        }

        // Collect upcoming occurrences
        $count = 0;
        while ($count < $limit && !$this->shouldStopRecurrence($start)) {
            $occurrences[] = [
                'start' => $start->copy(),
                'end' => $start->copy()->addSeconds(
                    $this->end_time->diffInSeconds($this->start_time)
                )
            ];
            $start = $this->addRecurrenceInterval($start, $interval);
            $count++;
        }

        return $occurrences;
    }

    public function getDisplayStartTimeAttribute()
{
    if ($this->is_recurring && $this->next_occurrence) {
        return $this->next_occurrence;
    }
    return $this->start_time;
}

public function getDisplayEndTimeAttribute()
{
    if ($this->is_recurring && $this->next_occurrence) {
        return Carbon::parse($this->next_occurrence)
            ->addSeconds($this->end_time->diffInSeconds($this->start_time));
    }
    return $this->end_time;
}
}