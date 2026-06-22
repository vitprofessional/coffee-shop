@extends('layouts.app')
@section('title','Mausé Reserve — Every Cup Tells a Story')
@section('content')
    <section class="relative bg-cover bg-center" style="background-image:url('{{ asset('images/hero/hero.svg') }}');min-height:60vh;">
        <div class="bg-gradient-to-b from-black/25 to-transparent min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-4 py-28 text-center text-white">
                <h1 class="text-4xl md:text-6xl font-heading tracking-tight">Every Cup Tells a Story</h1>
                <p class="mt-4 text-lg font-body">Crafted Beyond Seasons</p>
                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('menu') }}" class="px-6 py-3 rounded-md bg-[var(--brand-brown)] text-[var(--brand-cream)] transition-smooth">Explore Menu</a>
                    <a href="{{ route('reservation') }}" class="px-6 py-3 rounded-md border transition-smooth" style="color:var(--brand-brown)">Reserve a Table</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16">
        <x-section-header title="Featured Coffees" subtitle="Curated seasonal selections" />
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(!empty($featured) && count($featured))
                    @foreach($featured as $item)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="{{ $item->image_url ?? asset('images/menu/placeholder.svg') }}" alt="{{ $item->name ?? 'Coffee' }}" class="w-full h-48 object-cover img-fade" loading="lazy" decoding="async">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold">{{ $item->name ?? 'Special' }}</h3>
                            <div class="text-sm text-gray-700">{{ $item->price_formatted ?? '$0.00' }}</div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ $item->excerpt ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            @else
                <x-empty-state title="No featured coffees" description="We are updating our seasonal selections. Check back soon." />
            @endif
        </div>
    </section>

    <section class="py-16 bg-[var(--brand-cream)]">
        <x-section-header title="Why Choose Us" subtitle="Craft, quality, and hospitality" />
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <h4 class="font-semibold">Premium Beans</h4>
                <p class="mt-2 text-sm text-gray-700">Sourced ethically from top estates.</p>
            </div>
            <div class="text-center">
                <h4 class="font-semibold">Master Roasting</h4>
                <p class="mt-2 text-sm text-gray-700">Profiled for balance and character.</p>
            </div>
            <div class="text-center">
                <h4 class="font-semibold">Hospitality</h4>
                <p class="mt-2 text-sm text-gray-700">An experience for every occasion.</p>
            </div>
        </div>
    </section>

    <section class="py-16">
        <x-section-header title="Gallery" subtitle="A glimpse into Mausé Reserve" />
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach($galleryPreview ?? [] as $img)
                <img src="{{ $img->url ?? '/images/placeholder.jpg' }}" alt="gallery" class="w-full h-40 object-cover rounded" loading="lazy" decoding="async">
            @endforeach
        </div>
        <div class="max-w-7xl mx-auto px-4 text-center mt-6"><a href="{{ route('gallery') }}" class="underline">View full gallery</a></div>
    </section>

    <section class="py-16 bg-gray-50">
        <x-section-header title="Testimonials" subtitle="What our guests say" />
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials ?? [] as $t)
                <x-testimonial :author="$t->customer_name" :image="$t->customer_image_url" :rating="$t->rating">{{ $t->review }}</x-testimonial>
            @endforeach
        </div>
    </section>

    <section class="py-16 bg-[var(--brand-brown)] text-[var(--brand-cream)]">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-2xl font-display">Reserve your table</h3>
            <p class="mt-2">Experience Mausé Reserve — book a table or visit us.</p>
            <div class="mt-4"><a href="{{ route('reservation') }}" class="px-6 py-3 rounded-md bg-[var(--brand-cream)] text-[var(--brand-brown)]">Reserve Now</a></div>
        </div>
    </section>

@endsection
