@extends('layouts.app')

@section('content')
  <section class="py-12">
    <div class="text-center">
      <h1 class="text-4xl font-bold text-[#4B2E2B]">Mausé Reserve</h1>
      <p class="mt-2 text-lg text-gray-700">Crafted Beyond Seasons</p>
    </div>
  </section>

  <section class="mt-8">
    <h2 class="text-2xl font-semibold">Featured</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
      @foreach($featured as $item)
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold">{{ $item->name }}</h3>
          <p class="text-sm">{{ $item->description }}</p>
          <p class="mt-2 font-bold">${{ number_format($item->price,2) }}</p>
        </div>
      @endforeach
    </div>
  </section>

  <section class="mt-12">
    <h2 class="text-2xl font-semibold">Testimonials</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
      @foreach($testimonials as $t)
        <div class="bg-white p-4 rounded shadow">{{ $t->review }} — <strong>{{ $t->customer_name }}</strong></div>
      @endforeach
    </div>
  </section>

@endsection
