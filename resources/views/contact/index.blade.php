@extends('layouts.app')
@section('content')
@php
    $hero = file_exists(public_path('images/hero/contact.jpg'))
        ? asset('images/hero/contact.jpg')
        : (file_exists(public_path('images/hero/hero.jpg')) ? asset('images/hero/hero.jpg') : asset('images/hero/hero.svg'));
@endphp

<section class="relative bg-gray-50">
  <header class="relative bg-cover bg-center" style="background-image: url('{{ $hero }}')">
    <div class="bg-black/45">
      <div class="container mx-auto px-6 py-20 text-white">
        <h1 class="text-4xl md:text-5xl font-serif mb-3">Contact Us</h1>
        <p class="text-lg max-w-2xl">We'd love to hear from you</p>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left: Contact form (spans 2 cols) -->
      <div class="lg:col-span-2">
        <div class="form-card">
          <h2 class="text-2xl font-semibold mb-2">Get In Touch</h2>
          <p class="text-sm text-gray-600 mb-6">Send us a message and we'll respond as soon as possible.</p>

          @if(session('success'))
            <div class="form-success mb-4">{{ session('success') }}</div>
          @endif

          <form method="post" action="{{ route('contact.store') }}" class="form-grid cols-2">@csrf
            <div class="form-group">
              <label for="full_name" class="form-label">Full Name <span class="form-required">*</span></label>
              <input id="full_name" name="name" type="text" value="{{ old('name') }}" required aria-required="true" aria-label="Full name" class="form-input" />
              @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="email" class="form-label">Email Address <span class="form-required">*</span></label>
              <input id="email" name="email" type="email" value="{{ old('email') }}" required aria-required="true" aria-label="Email address" class="form-input" />
              @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="phone" class="form-label">Phone Number</label>
              <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" aria-label="Phone number" class="form-input" />
              @error('phone')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
              <label for="subject" class="form-label">Subject</label>
              <input id="subject" name="subject" type="text" value="{{ old('subject') }}" aria-label="Subject" class="form-input" />
              @error('subject')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group md:col-span-2">
              <label for="message" class="form-label">Message <span class="form-required">*</span></label>
              <textarea id="message" name="message" rows="6" required aria-required="true" aria-label="Message" class="form-textarea">{{ old('message') }}</textarea>
              @error('message')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2 mt-2">
              <div class="flex items-center gap-4">
                <button type="submit" class="form-submit w-full md:w-auto" aria-label="Send message">Send Message</button>
                <p class="form-help">We aim to respond within 48 hours.</p>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Right: Contact info and cards -->
      <aside class="flex flex-col gap-6">
        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Contact Information</h3>
          <p class="text-sm text-gray-700"><strong>Address:</strong> Luxury Coffee House</p>
          <p class="text-sm text-gray-700 mt-2"><strong>Phone:</strong> +1 (555) 123-4567</p>
          <p class="text-sm text-gray-700 mt-2"><strong>Email:</strong> <a href="mailto:hello@mause-reserve.test" class="text-amber-600 hover:underline">hello@mause-reserve.test</a></p>

          <div class="mt-4">
            <h4 class="text-sm font-semibold">Opening Hours</h4>
            <p class="text-sm text-gray-700">Mon–Fri: 7AM – 8PM</p>
            <p class="text-sm text-gray-700">Sat–Sun: 8AM – 10PM</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Services</h3>
          <div class="grid grid-cols-1 gap-4">
            <div class="p-4 rounded-lg border border-gray-100 hover:shadow-md"> 
              <h4 class="font-medium">Reservations</h4>
              <p class="text-sm text-gray-600">Book a table for your next visit.</p>
            </div>
            <div class="p-4 rounded-lg border border-gray-100 hover:shadow-md"> 
              <h4 class="font-medium">Private Events</h4>
              <p class="text-sm text-gray-600">Host tastings and private gatherings.</p>
            </div>
            <div class="p-4 rounded-lg border border-gray-100 hover:shadow-md"> 
              <h4 class="font-medium">Wholesale Coffee</h4>
              <p class="text-sm text-gray-600">Partner with us for roasted beans.</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Find Us</h3>
          <div class="h-40 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">Map placeholder</div>
        </div>
      </aside>
    </div>

    <!-- CTA -->
    <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 flex flex-col md:flex-row items-center justify-between gap-6">
      <div>
        <h3 class="text-2xl font-semibold">Visit Mausé Reserve</h3>
        <p class="text-sm text-gray-600">Experience specialty coffee and warm hospitality.</p>
      </div>
      <div class="flex gap-4">
        <a href="/reservation" class="inline-flex items-center justify-center rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-6 shadow-md">Reserve A Table</a>
        <a href="/menu" class="inline-flex items-center justify-center rounded-lg border border-gray-200 hover:shadow-md text-gray-800 font-medium py-3 px-6">Explore Menu</a>
      </div>
    </div>
  </main>
</section>

@endsection
