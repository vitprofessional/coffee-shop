@extends('layouts.app')
@section('content')
@php
    $hero = file_exists(public_path('images/hero/reservation.jpg'))
        ? asset('images/hero/reservation.jpg')
        : (file_exists(public_path('images/hero/hero.jpg')) ? asset('images/hero/hero.jpg') : asset('images/hero/hero.svg'));
@endphp

<section class="bg-gray-50">
  <header class="relative bg-cover bg-center" style="background-image: url('{{ $hero }}')">
    <div class="bg-black/40">
      <div class="container mx-auto px-6 py-20 text-white">
        <h1 class="text-4xl md:text-5xl font-serif mb-4">Reserve Your Experience</h1>
        <p class="max-w-2xl text-lg opacity-90">We recommend booking at least 24 hours in advance.</p>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left: Reservation form (spans 2 cols on large screens) -->
      <div class="lg:col-span-2">
        <div class="form-card">
          <h2 class="text-2xl font-semibold mb-2">Reserve Your Experience</h2>
          <p class="text-sm text-gray-600 mb-6">Please provide your details and we'll confirm availability shortly.</p>

          @if(session('success'))
            <div class="form-success mb-4">{{ session('success') }}</div>
          @endif

          <form method="post" action="{{ route('reservation.store') }}" class="form-grid cols-2">@csrf
            <div class="form-group">
              <label for="res_name" class="form-label">Full Name <span class="form-required">*</span></label>
              <input id="res_name" name="name" type="text" value="{{ old('name') }}" required aria-required="true" class="form-input" />
              @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="res_email" class="form-label">Email Address <span class="form-required">*</span></label>
              <input id="res_email" name="email" type="email" value="{{ old('email') }}" required aria-required="true" class="form-input" />
              @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="res_phone" class="form-label">Phone Number <span class="form-required">*</span></label>
              <input id="res_phone" name="phone" type="tel" value="{{ old('phone') }}" required aria-required="true" class="form-input" />
              @error('phone')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="res_date" class="form-label">Reservation Date <span class="form-required">*</span></label>
              <input id="res_date" name="reservation_date" type="date" value="{{ old('reservation_date') }}" required aria-required="true" class="form-input" />
              @error('reservation_date')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="res_time" class="form-label">Reservation Time <span class="form-required">*</span></label>
              <input id="res_time" name="reservation_time" type="time" value="{{ old('reservation_time') }}" required aria-required="true" class="form-input" />
              @error('reservation_time')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="res_guests" class="form-label">Number of Guests <span class="form-required">*</span></label>
              <select id="res_guests" name="guests" required class="form-select">
                @for($i=1;$i<=12;$i++)
                  <option value="{{ $i }}" {{ old('guests')==$i? 'selected': '' }}>{{ $i }} {{ $i==1? 'guest' : 'guests' }}</option>
                @endfor
              </select>
              @error('guests')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="res_seating" class="form-label">Seating Preference</label>
              <select id="res_seating" name="seating_preference" class="form-select">
                <option value="any" {{ old('seating_preference')=='any' ? 'selected' : '' }}>Any</option>
                <option value="indoors" {{ old('seating_preference')=='indoors' ? 'selected' : '' }}>Indoors</option>
                <option value="outdoors" {{ old('seating_preference')=='outdoors' ? 'selected' : '' }}>Outdoors</option>
                <option value="bar" {{ old('seating_preference')=='bar' ? 'selected' : '' }}>Bar</option>
              </select>
              @error('seating_preference')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group md:col-span-2">
              <label for="res_special" class="form-label">Special Request</label>
              <textarea id="res_special" name="special_request" rows="4" class="form-textarea" placeholder="Dietary needs, celebrations...">{{ old('special_request') }}</textarea>
              @error('special_request')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
              <p class="form-help">We recommend booking at least 24 hours in advance.</p>
              <div class="mt-4">
                <button type="submit" class="form-submit w-full md:w-auto" aria-label="Reserve now">Reserve Now</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Right: Info column -->
      <aside class="flex flex-col gap-6">
        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Opening Hours</h3>
          <ul class="text-sm text-gray-700 space-y-1">
            <li><strong class="font-medium">Mon–Fri:</strong> 7:00 AM — 8:00 PM</li>
            <li><strong class="font-medium">Sat:</strong> 8:00 AM — 9:00 PM</li>
            <li><strong class="font-medium">Sun:</strong> 8:00 AM — 6:00 PM</li>
          </ul>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Location</h3>
          <p class="text-sm text-gray-700">123 Artisan Row, Luxury District</p>
          <a href="https://www.google.com/maps" target="_blank" class="mt-3 inline-block text-amber-600 hover:underline">View on map</a>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Contact</h3>
          <p class="text-sm text-gray-700">Phone: (555) 123-4567</p>
          <p class="text-sm text-gray-700">Email: hello@mause-reserve.test</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Guest Notes</h3>
          <p class="text-sm text-gray-700">We do our best to accommodate requests. For large parties, please call ahead.</p>
        </div>
      </aside>
    </div>
  </main>
</section>

@endsection
