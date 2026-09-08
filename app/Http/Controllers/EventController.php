<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function welcome()
    {
        $event = Event::with('packages')
            ->where('is_active', true)
            ->whereDate('event_date', today())
            ->first();

        if ($event && $event->logo) {
            $event->logo_url = asset('storage/' . $event->logo);
        }

        return Inertia::render('welcome', [
            'event' => $event,
        ]);
    }
}
