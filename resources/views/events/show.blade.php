@extends('layouts.app')
@section('content')
@php
    $hero = file_exists(public_path('images/gallery/'.$event->image ?? '')) ? asset('images/gallery/'.$event->image) : (file_exists(public_path('images/hero/hero.jpg')) ? asset('images/hero/hero.jpg') : asset('images/hero/hero.svg'));
@endphp

<section class="bg-gray-50">
  <header class="bg-cover bg-center" style="background-image: url('{{ $hero }}')">
    <div class="bg-black/45">
      <div class="container mx-auto px-6 py-20 text-white">
        <h1 class="text-4xl md:text-5xl font-serif mb-3">{{ $event->title }}</h1>
        <p class="text-lg max-w-2xl">{{ $event->subtitle ?? Str::limit($event->description, 120) }}</p>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
        <div class="mb-4 text-sm text-gray-600">{{ optional($event->event_date)->format('F j, Y') ?? 'TBD' }} · {{ $event->event_time ?? '' }} · {{ $event->location ?? '' }}</div>
        <div class="prose max-w-none">{!! $event->description ?? '<p>Details coming soon.</p>' !!}</div>
        <div class="mt-6">
          <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-6">Register / Enquire</a>
        </div>
      </div>

      <aside class="flex flex-col gap-6">
        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Event Details</h3>
          <ul class="text-sm text-gray-700 space-y-2">
            <li><strong>Date:</strong> {{ optional($event->event_date)->format('F j, Y') ?? 'TBD' }}</li>
            <li><strong>Time:</strong> {{ $event->event_time ?? 'TBD' }}</li>
            <li><strong>Location:</strong> {{ $event->location ?? 'Mausé Reserve' }}</li>
            <li><strong>Price:</strong> @if($event->price) ${{ number_format($event->price,2) }} @else Free @endif</li>
          </ul>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Share</h3>
          <p class="text-sm text-gray-700">Share this event with friends.</p>
        </div>
      </aside>
    </div>
  </main>
</section>

@endsection
