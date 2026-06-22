@extends('layouts.app')
@section('title','Events — Mausé Reserve')
@section('content')
    <section class="py-16">
        <x-section-header title="Events" subtitle="Join tastings, workshops, and experiences" />
        <div class="max-w-7xl mx-auto px-4">
            @if(!empty($events) && count($events))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($events as $e)
                        <x-event-card :title="$e->title" :date="$e->event_date" :time="$e->event_time" :location="$e->location" :image="$e->image_url ?? asset('images/events/placeholder.svg')" />
                    @endforeach
                </div>
            @else
                <x-empty-state title="No upcoming events" description="We are scheduling new experiences. Stay tuned." />
            @endif
        </div>
    </section>
@endsection
