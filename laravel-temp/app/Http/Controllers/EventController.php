<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::active()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }
}
