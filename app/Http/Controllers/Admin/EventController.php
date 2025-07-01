<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create', [
            'recurrenceOptions' => [
                '' => 'None',
                'daily' => 'Daily',
                'weekly' => 'Weekly',
                'monthly' => 'Monthly',
                'yearly' => 'Yearly'
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateEventRequest($request);
        $validated['is_recurring'] = !empty($validated['recurrence']);
        $validated['timezone'] = $request->input('timezone', 'UTC');
        
        if ($validated['is_recurring']) {
            if (empty($validated['recurrence_end_date']) && empty($validated['recurrence_count'])) {
                $validated['recurrence_count'] = 100;
            }
            $validated['recurrence_interval'] = $validated['recurrence_interval'] ?? 1;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($validated);

        if ($event->is_recurring) {
            $event->update([
                'next_occurrence' => $this->calculateNextOccurrence($event)
            ]);
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $occurrences = $event->is_recurring 
            ? $event->getUpcomingOccurrences(5) 
            : [];
            
        return view('admin.events.show', compact('event', 'occurrences'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', [
            'event' => $event,
            'recurrenceOptions' => [
                '' => 'None',
                'daily' => 'Daily',
                'weekly' => 'Weekly',
                'monthly' => 'Monthly',
                'yearly' => 'Yearly'
            ]
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $this->validateEventRequest($request);
        $validated['is_recurring'] = !empty($validated['recurrence']);
        
        if ($request->has('timezone')) {
            $validated['timezone'] = $request->input('timezone');
        }

        if ($validated['is_recurring']) {
            if (!$event->is_recurring) {
                if (empty($validated['recurrence_end_date']) && empty($validated['recurrence_count'])) {
                    $validated['recurrence_count'] = 100;
                }
            }
            $validated['recurrence_interval'] = $validated['recurrence_interval'] ?? 1;
        }

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        } elseif (isset($validated['remove_image'])) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = null;
        }

        $event->update($validated);

        if ($event->is_recurring) {
            $event->update([
                'next_occurrence' => $this->calculateNextOccurrence($event)
            ]);
        } else {
            $event->update(['next_occurrence' => null]);
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    protected function validateEventRequest(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
            'timezone' => 'nullable|timezone',
            'recurrence' => 'nullable|in:daily,weekly,monthly,yearly',
            'recurrence_interval' => 'nullable|required_with:recurrence|integer|min:1|max:365',
            'recurrence_count' => 'nullable|integer|min:1|max:1000',
            'recurrence_end_date' => 'nullable|date|after_or_equal:start_time',
        ];

        $validated = $request->validate($rules, [
            'recurrence_interval.required_with' => 'The recurrence interval is required when recurrence is selected.',
            'end_time.after' => 'The end time must be after the start time.',
        ]);

        if (!empty($validated['recurrence']) && empty($validated['recurrence_interval'])) {
            $validated['recurrence_interval'] = 1;
        }

        return $validated;
    }

    protected function calculateNextOccurrence(Event $event)
    {
        if (!$event->is_recurring) return null;

        $now = Carbon::now();
        $start = $event->start_time->copy();
        $interval = $event->recurrence_interval ?: 1;

        if ($start <= $now && $event->end_time >= $now) {
            return $start;
        }

        $passedIntervals = $this->calculatePassedIntervals($start, $now, $event->recurrence, $interval);
        $nextStart = $this->addRecurrenceInterval($start, $event->recurrence, $passedIntervals * $interval);

        if ($this->hasRecurrenceEnded($event, $nextStart)) {
            return null;
        }

        return $nextStart;
    }

    protected function calculateUpcomingOccurrences(Event $event, $limit = 5)
    {
        return $event->getUpcomingOccurrences($limit);
    }

    protected function hasRecurrenceEnded(Event $event, Carbon $currentStart): bool
    {
        if ($event->recurrence_end_date && $currentStart > $event->recurrence_end_date) {
            return true;
        }

        if ($event->recurrence_count) {
            $occurrences = $this->calculateOccurrenceCount($event);
            return $occurrences >= $event->recurrence_count;
        }

        return false;
    }

    protected function calculateOccurrenceCount(Event $event): int
    {
        return $event->countPastOccurrences();
    }

    protected function addRecurrenceInterval(Carbon $date, string $recurrence, int $interval): Carbon
    {
        switch ($recurrence) {
            case 'daily': return $date->addDays($interval);
            case 'weekly': return $date->addWeeks($interval);
            case 'monthly': return $date->addMonthsNoOverflow($interval);
            case 'yearly': return $date->addYearsNoOverflow($interval);
            default: return $date;
        }
    }

    protected function calculatePassedIntervals(Carbon $start, Carbon $now, string $recurrence, int $interval): int
    {
        switch ($recurrence) {
            case 'daily': return (int) ($start->diffInDays($now) / $interval);
            case 'weekly': return (int) ($start->diffInWeeks($now) / $interval);
            case 'monthly': return (int) ($start->diffInMonths($now) / $interval);
            case 'yearly': return (int) ($start->diffInYears($now) / $interval);
            default: return 0;
        }
    }
}