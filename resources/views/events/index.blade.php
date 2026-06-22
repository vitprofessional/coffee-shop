@extends('layouts.app')
@section('content')
@php
    $hero = file_exists(public_path('images/gallery/gallery-2.jpg'))
        ? asset('images/gallery/gallery-2.jpg')
        : (file_exists(public_path('images/story/roaster.jpg')) ? asset('images/story/roaster.jpg') : asset('images/hero/hero.jpg'));
    $featured = [
        ['title'=>'Coffee Tasting Evening','img'=>asset('images/gallery/gallery-1.jpg'), 'subtitle'=>'An evening of curated tastings'],
        ['title'=>'Latte Art Workshop','img'=>asset('images/gallery/gallery-2.jpg'), 'subtitle'=>'Hands-on latte art with our baristas'],
        ['title'=>'Roastery Tour','img'=>asset('images/gallery/gallery-3.jpg'), 'subtitle'=>'Behind-the-scenes at the roastery'],
    ];
@endphp

<section class="bg-gray-50">
  <header class="bg-cover bg-center" style="background-image: url('{{ $hero }}')">
    <div class="bg-black/45">
      <div class="container mx-auto px-6 py-20 text-white">
        <h1 class="text-4xl md:text-5xl font-serif mb-3">Coffee Events & Experiences</h1>
        <p class="text-lg max-w-2xl">Workshops, tastings and seasonal gatherings at Mausé Reserve</p>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-6 py-12">
    <!-- Featured events -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
      @foreach($featured as $f)
        <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
          <div class="h-48 bg-cover bg-center" style="background-image:url('{{ $f['img'] }}')"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold">{{ $f['title'] }}</h3>
            <p class="text-sm text-gray-600 mt-2">{{ $f['subtitle'] }}</p>
            <div class="mt-4 flex items-center justify-between">
              <div class="text-sm text-gray-500">June 25 · 6:30 PM</div>
              <a href="#" class="text-amber-600 hover:underline">Reserve Spot</a>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <!-- Categories -->
    <div class="mb-8">
      <div class="flex flex-wrap gap-3">
        @foreach(['Tastings','Workshops','Roastery Tours','Community Nights'] as $cat)
          <span class="px-4 py-2 rounded-full bg-white shadow text-sm font-medium">{{ $cat }}</span>
        @endforeach
      </div>
    </div>

    <!-- Events grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($events as $e)
        <article class="bg-white rounded-2xl shadow hover:shadow-md overflow-hidden">
          <div class="relative">
            @php
              $img = file_exists(public_path('images/gallery/'.$e->image ?? '')) ? asset('images/gallery/'.$e->image) : asset('images/gallery/gallery-1.jpg');
            @endphp
            <div class="h-40 bg-cover bg-center" style="background-image:url('{{ $img }}')"></div>
            <div class="absolute top-3 left-3 bg-amber-600 text-white px-3 py-1 rounded-full text-sm font-medium">{{ 
              
              
              
              
              
            \Carbon\Carbon::parse($e->event_date)->format('M d') ?? 'TBD' }}</div>
          </div>
          <div class="p-4">
            <h4 class="font-semibold">{{ $e->title }}</h4>
            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($e->excerpt ?? $e->description ?? 'Join us for a special coffee experience.', 100) }}</p>
            <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
              <div>{{ $e->time ?? '6:30 PM' }}</div>
              <div>{{ $e->location ?? 'Mausé Reserve' }}</div>
            </div>
            <div class="mt-4">
              <a href="{{ route('events.show', $e->slug) }}" class="inline-block rounded-md bg-amber-600 hover:bg-amber-700 text-white py-2 px-4">View Details</a>
            </div>
          </div>
        </article>
      @empty
        <div class="col-span-full text-center text-gray-600">No upcoming events. Check back soon.</div>
      @endforelse
    </div>

    <!-- CTA -->
    <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 flex flex-col md:flex-row items-center justify-between gap-6">
      <div>
        <h3 class="text-2xl font-semibold">Host Your Moment at Mausé Reserve</h3>
        <p class="text-sm text-gray-600">We'd love to help you plan an event tailored to your needs.</p>
      </div>
      <div class="flex gap-4">
        <a href="/reservation" class="inline-flex items-center justify-center rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-6 shadow-md">Reserve A Table</a>
        <a href="/contact" class="inline-flex items-center justify-center rounded-lg border border-gray-200 hover:shadow-md text-gray-800 font-medium py-3 px-6">Contact Us</a>
      </div>
    </div>
  </main>
</section>

@endsection
