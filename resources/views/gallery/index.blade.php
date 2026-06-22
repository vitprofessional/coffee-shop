@extends('layouts.app')
@section('content')
  <section class="pt-8 pb-6">
    <div class="relative w-full overflow-hidden mb-8">
      <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Gallery hero" class="w-full h-[320px] md:h-[420px] object-cover">
      <div class="absolute inset-0 bg-gradient-to-b from-black/35 via-black/25 to-black/65 flex items-center">
        <div class="max-w-7xl mx-auto px-4 text-white">
          <div class="text-sm uppercase tracking-wider text-[var(--brand-gold)]">Mausé Reserve Moments</div>
          <h1 class="text-3xl md:text-5xl font-heading leading-tight mt-2">Gallery</h1>
          <p class="mt-3 text-sm md:text-base text-white/90">Moments from our café, roastery and community.</p>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
      @php
        $gallery = [];
        if(!empty($items) && count($items)){
          foreach($items as $it){
            $raw = $it->url ?? $it->image_url ?? null;
            $url = null;
            if($raw){
              if(preg_match('/^https?:\/\//', $raw)){
                $url = $raw;
              } elseif(file_exists(public_path($raw))){
                $url = asset($raw);
              } elseif(file_exists(public_path('storage/'.ltrim($raw,'/')))){
                $url = asset('storage/'.ltrim($raw,'/'));
              }
            }
            if($url) $gallery[] = $url;
          }
        }

        // Ensure at least 8 images for demo presentation using local assets
        $demoPool = [
          'images/gallery/gallery-1.jpg',
          'images/gallery/gallery-2.jpg',
          'images/gallery/gallery-3.jpg',
          'images/menu/coffee-1.jpg',
          'images/menu/coffee-2.jpg',
          'images/menu/coffee-3.jpg',
          'images/hero/hero.jpg',
          'images/story/roaster.jpg'
        ];

        foreach($demoPool as $p){
          if(count($gallery) >= 8) break;
          if(file_exists(public_path($p))){
            $candidate = asset($p);
            if(!in_array($candidate, $gallery)) $gallery[] = $candidate;
          }
        }

        if(count($gallery) === 0){ $gallery[] = asset('images/gallery/placeholder.svg'); }

        $captions = ['Morning Espresso','Latte Art Ritual','Roastery Session','Hand Brew Bar','Café Interior','Seasonal Pour','Coffee Craft','Reserve Experience'];
      @endphp

      <div x-data="{ images: {{ json_encode($gallery) }}, captions: {{ json_encode($captions) }}, isOpen:false, index:0, filter:'All', open(i){ this.index = i; this.isOpen = true }, close(){ this.isOpen = false; this.index = 0 }, prev(){ this.index = (this.index - 1 + this.images.length) % this.images.length }, next(){ this.index = (this.index + 1) % this.images.length } }">

        <!-- Filter pills (visual only) -->
        <div class="flex gap-3 flex-wrap mb-4">
          @php $pills = ['All','Cafe','Coffee','Roastery','Events']; @endphp
          @foreach($pills as $p)
            <button
              @click.prevent="$root.filter='{{ $p }}'"
              :class="$root.filter==='{{ $p }}' ? 'bg-[var(--brand-gold)] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-50'"
              class="transition-colors duration-200 px-4 py-2 rounded-full border border-gray-200 shadow-sm text-sm">
              {{ $p }}
            </button>
          @endforeach
        </div>

        <div class="flex items-center justify-between mb-6">
          <div class="text-sm text-gray-600">Showing {{ count($gallery) }} images</div>
          <div class="text-sm text-gray-700 font-medium"> <span class="inline-block bg-white/80 text-gray-800 px-3 py-1 rounded-full shadow">{{ count($gallery) }} Gallery Moments</span> </div>
        </div>

        <!-- Editorial grid -->
        <div class="relative">
          <div class="relative">
            <div class="absolute top-0 right-0 hidden md:block mt-2 mr-2 z-20">
              <div class="bg-white/95 text-gray-800 px-3 py-2 rounded-full shadow text-sm">{{ count($gallery) }} Gallery Moments</div>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 auto-rows-[12rem]">
          @foreach($gallery as $g)
            @php
              $i = $loop->index;
              $caption = $captions[$i % count($captions)];
              // editorial sizing: first image very tall, selected others taller for variation
              $rowSpan = 1;
              if($i === 0) $rowSpan = 3;
              elseif(in_array($i, [3,5])) $rowSpan = 2;
            @endphp
            <div class="relative rounded-lg overflow-hidden shadow-lg" style="grid-row: span {{ $rowSpan }};">
              <button class="w-full h-full block group focus:outline-none" @click.prevent="open({{ $i }})" aria-label="Open image {{ $i+1 }}">
                <div class="w-full h-full relative overflow-hidden">
                  <img src="{{ $g }}" alt="{{ $caption }}" loading="lazy" decoding="async" class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105">
                  <div class="absolute inset-0 bg-black/10 group-hover:bg-black/40 transition-colors duration-300"></div>
                  <div class="absolute bottom-3 left-3 text-white text-sm bg-black/50 px-2 py-1 rounded">{{ $caption }}</div>
                </div>
              </button>
            </div>
          @endforeach
        </div>

        <!-- Lightbox -->
        <div x-show="isOpen" x-cloak @click.self="close()" x-transition.opacity.duration.300ms class="fixed inset-0 z-50 flex items-center justify-center bg-black/90">
          <div class="max-w-5xl w-full px-4" role="dialog" aria-modal="true">
            <div class="relative">
              <button @click="close()" class="absolute top-4 right-4 text-white text-2xl bg-black/40 rounded-full w-10 h-10 flex items-center justify-center" aria-label="Close">✕</button>
              <div class="absolute top-4 left-4 text-white text-sm"> <span x-text="index+1"></span> / <span x-text="images.length"></span> </div>
              <button x-show="isOpen" @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl" aria-label="Previous">‹</button>
              <button x-show="isOpen" @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl" aria-label="Next">›</button>
              <img x-show="isOpen" :src="images[index]" alt="Gallery image" class="w-full h-[70vh] object-contain mx-auto rounded">
              <div class="mt-4 text-center text-white text-sm" x-text="captions[index % captions.length]"></div>
            </div>
          </div>
        </div>

        <!-- Stats -->
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
          <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v4a4 4 0 004 4h10"/></svg>
            <div class="text-2xl font-heading leading-none">25+</div>
            <div class="text-sm text-gray-700">Gallery Moments</div>
          </div>
          <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2v-7H3v7a2 2 0 002 2z"/></svg>
            <div class="text-2xl font-heading leading-none">12+</div>
            <div class="text-sm text-gray-700">Coffee Events</div>
          </div>
          <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
            <div class="text-2xl font-heading leading-none">5K+</div>
            <div class="text-sm text-gray-700">Happy Guests</div>
          </div>
        </div>

        <!-- CTA: full width background -->
        <div class="mt-8 -mx-4 px-4">
          <div class="relative overflow-hidden rounded-lg">
            <img src="{{ asset('images/story/roaster.jpg') }}" alt="Roaster" class="w-full h-64 md:h-80 object-cover">
            <div class="absolute inset-0 bg-black/50 flex items-center">
              <div class="max-w-5xl mx-auto px-4 text-center text-white py-10">
                <h3 class="text-2xl md:text-3xl font-heading">Visit Mausé Reserve</h3>
                <p class="text-sm md:text-base mt-3 text-white/90">Experience specialty coffee, artisan roasting, and handcrafted brewing.</p>
                <div class="mt-6 flex items-center justify-center gap-4">
                  <a href="{{ route('reservation.index') }}" class="px-6 py-3 bg-[var(--brand-gold)] text-white rounded shadow">Reserve A Table</a>
                  <a href="{{ route('menu.index') }}" class="px-6 py-3 border border-white/30 text-white rounded">Explore Menu</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
