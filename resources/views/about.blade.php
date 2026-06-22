@extends('layouts.app')
@section('title','About — Mausé Reserve')
@section('content')
    @php
        $heroImg = file_exists(public_path('images/story/roaster.jpg')) ? asset('images/story/roaster.jpg') : asset('images/hero/hero.jpg');
    @endphp

    <!-- Hero -->
    <section class="relative w-full overflow-hidden mb-8">
        <img src="{{ $heroImg }}" alt="Our Story" class="w-full h-[340px] md:h-[460px] object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/35 via-black/20 to-black/65 flex items-center">
            <div class="max-w-7xl mx-auto px-4 text-white">
                <div class="text-sm uppercase tracking-wider text-[var(--brand-gold)]">Our Story</div>
                <h1 class="text-3xl md:text-5xl font-heading leading-tight mt-2">Our Story</h1>
                <p class="mt-3 text-sm md:text-base text-white/90">Crafted Beyond Seasons</p>
            </div>
        </div>
    </section>

    <section class="pb-12">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Brand story two-column -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mb-10">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $heroImg }}" alt="Roastery" class="w-full h-80 object-cover">
                </div>
                <div class="prose max-w-none text-gray-800 font-body">
                    <h2 class="font-heading text-2xl">A Small-Batch Roastery</h2>
                    <p>Mausé Reserve began as a pursuit of the perfect expression of origin, roast, and hospitality. We roast in small batches to preserve clarity and highlight each lot's unique character.</p>
                    <h3 class="mt-4 font-heading">Direct Trade & Seasonal Origins</h3>
                    <p>We work directly with growers, prioritizing traceability, fair pricing, and seasonal offerings sourced from trusted regions around the world.</p>
                    <h3 class="mt-4 font-heading">Café Hospitality</h3>
                    <p>In our café, hospitality is central: welcoming service, attentive brewing, and spaces designed for conversation.</p>
                </div>
            </div>

            <!-- Values -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white rounded-lg p-6 shadow-md text-center hover:shadow-lg transition-smooth">
                    <div class="flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3"/></svg>
                    </div>
                    <div class="font-heading text-lg">Fresh Roasting</div>
                    <div class="text-sm text-gray-600 mt-2">Daily small-batch roasts for peak flavor.</div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md text-center hover:shadow-lg transition-smooth">
                    <div class="flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 6h18M3 14h18M3 18h18"/></svg>
                    </div>
                    <div class="font-heading text-lg">Sustainable Sourcing</div>
                    <div class="text-sm text-gray-600 mt-2">Direct partnerships and ethical practices.</div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md text-center hover:shadow-lg transition-smooth">
                    <div class="flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v18"/></svg>
                    </div>
                    <div class="font-heading text-lg">Artisan Craft</div>
                    <div class="text-sm text-gray-600 mt-2">Handcrafted roasts and precise brewing.</div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md text-center hover:shadow-lg transition-smooth">
                    <div class="flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="font-heading text-lg">Community First</div>
                    <div class="text-sm text-gray-600 mt-2">Events, education, and local partnerships.</div>
                </div>
            </div>

            <!-- Bean to Cup Journey -->
            <div class="mb-10">
                <h3 class="font-heading text-2xl mb-4">Bean to Cup Journey</h3>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-center">
                    @foreach(['Source','Roast','Brew','Serve'] as $step)
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="font-heading text-lg">{{ $step }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Stats -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-4 gap-6 text-center mb-10">
                <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
                    <div class="text-2xl font-heading leading-none">15+</div>
                    <div class="text-sm text-gray-700">Coffee Origins</div>
                </div>
                <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
                    <div class="text-2xl font-heading leading-none">10+</div>
                    <div class="text-sm text-gray-700">Years Experience</div>
                </div>
                <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
                    <div class="text-2xl font-heading leading-none">5K+</div>
                    <div class="text-sm text-gray-700">Happy Guests</div>
                </div>
                <div class="bg-white rounded-lg py-6 px-6 shadow-md flex flex-col items-center gap-2 min-h-[6rem]">
                    <div class="text-2xl font-heading leading-none">100+</div>
                    <div class="text-sm text-gray-700">Specialty Recipes</div>
                </div>
            </div>

            <!-- CTA -->
            <div class="-mx-4 px-4">
                <div class="relative overflow-hidden rounded-lg">
                    <img src="{{ asset('images/story/roaster.jpg') }}" alt="Experience" class="w-full h-64 md:h-72 object-cover">
                    <div class="absolute inset-0 bg-black/55 flex items-center">
                        <div class="max-w-5xl mx-auto px-4 text-center text-white py-10">
                            <h3 class="text-2xl md:text-3xl font-heading">Experience Mausé Reserve</h3>
                            <div class="text-sm md:text-base mt-3 text-white/90">Experience specialty coffee, artisan roasting, and handcrafted brewing.</div>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <a href="{{ route('menu.index') }}" class="px-6 py-3 bg-[var(--brand-gold)] text-white rounded shadow">Explore Menu</a>
                                <a href="{{ route('reservation.index') }}" class="px-6 py-3 border border-white/30 text-white rounded">Reserve A Table</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

