@extends('layouts.app')
@section('title','Mausé Reserve — Freshly Roasted. Elegantly Crafted.')
@section('content')

@php
  $heroImg = file_exists(public_path('images/hero/hero.jpg')) ? asset('images/hero/hero.jpg') : asset('images/hero/hero.svg');
  $roasterImg = file_exists(public_path('images/story/roaster.jpg')) ? asset('images/story/roaster.jpg') : asset('images/hero/hero.svg');
  $placeholderMenu = file_exists(public_path('images/menu/placeholder.jpg')) ? asset('images/menu/placeholder.jpg') : asset('images/menu/placeholder.svg');
@endphp

  <!-- Premium Hero -->
  <section class="relative bg-cover bg-center flex items-center" style="background-image:url('{{ $heroImg }}');min-height:720px;">
    <div class="absolute inset-0 bg-gradient-to-b from-[rgba(11,8,6,0.72)] to-[rgba(11,8,6,0.48)]"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-6 py-36 text-center text-[var(--brand-cream)]">
      <h1 class="text-6xl md:text-8xl lg:text-9xl font-heading tracking-tight leading-tight">Freshly Roasted<br><span class="text-[var(--brand-gold)]">Elegantly</span> Crafted.</h1>
      <p class="mt-8 text-lg md:text-xl max-w-2xl mx-auto">Discover specialty coffee beans, signature blends, and an elevated café and roastery experience hand-crafted for every cup.</p>
      <div class="mt-12 flex justify-center gap-5">
        <a href="{{ route('menu.index') }}" class="px-10 py-4 rounded-md bg-[var(--brand-gold)] text-[var(--brand-espresso)] font-semibold shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-1">Shop Coffee</a>
        <a href="{{ route('reservation.index') }}" class="px-10 py-4 rounded-md border border-[var(--brand-cream)] text-[var(--brand-cream)] font-semibold hover:bg-white/5 transition">Reserve a Table</a>
      </div>
    </div>
  </section>

  <!-- Key Statistics -->
  <section class="-mt-12">
    <div class="max-w-6xl mx-auto px-4">
      <div class="bg-white/90 backdrop-blur-md rounded-xl shadow-xl px-8 py-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="text-center">
          <div class="text-3xl font-heading text-[var(--brand-brown)] font-semibold">15+</div>
          <div class="text-sm text-gray-600 mt-1">Coffee Origins</div>
        </div>
        <div class="text-center">
          <div class="text-3xl font-heading text-[var(--brand-brown)] font-semibold">5000+</div>
          <div class="text-sm text-gray-600 mt-1">Happy Guests</div>
        </div>
        <div class="text-center">
          <div class="text-3xl font-heading text-[var(--brand-brown)] font-semibold">10+</div>
          <div class="text-sm text-gray-600 mt-1">Years Roasting</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Signature Collection -->
  <section class="py-16 bg-[var(--brand-cream)]">
    <x-section-header title="Signature Coffee Collection" subtitle="Curated roasts for every palate" />
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @php
        // store base paths (without extension) so we can prefer JPG when present
        $promo = [
          ['name'=>'Ethiopian Single Origin','price'=>'18.90','image'=>'images/menu/coffee-1'],
          ['name'=>'House Reserve Blend','price'=>'16.50','image'=>'images/menu/coffee-2'],
          ['name'=>'Organic Espresso Roast','price'=>'19.90','image'=>'images/menu/coffee-3'],
        ];
      @endphp

      @if(!empty($featured) && count($featured))
        @foreach($featured as $item)
          @php
            $idx = $loop->index;
            $showName = $item->name;
            $showPrice = $item->price_formatted ?? '$0.00';
            // default from item or placeholder
            $showImg = $item->image_url ?? $placeholderMenu;
            if($idx < 3){
              $showName = $promo[$idx]['name'];
              $showPrice = '$'.number_format($promo[$idx]['price'],2);
              $base = $promo[$idx]['image'];
              $jpgPath = public_path($base.'.jpg');
              if(file_exists($jpgPath)){
                $showImg = asset($base.'.jpg');
              } else {
                $showImg = asset($base.'.svg');
              }
            }
          @endphp
          <div class="bg-white rounded-xl overflow-hidden transform transition-shadow transition-transform hover:shadow-2xl hover:-translate-y-1">
            <div class="relative">
              <img src="{{ $showImg }}" alt="{{ $showName }}" class="w-full h-64 object-cover" loading="lazy" decoding="async" onerror="this.src='{{ asset('images/menu/placeholder.svg') }}'">
              <div class="absolute top-4 left-4 px-3 py-1 rounded-full bg-[var(--brand-gold)] text-[var(--brand-espresso)] text-xs font-semibold">Premium</div>
            </div>
            <div class="p-5">
              <div class="flex items-start justify-between">
                <div class="space-y-1">
                  <h3 class="font-heading text-lg">{{ $showName }}</h3>
                  <p class="text-sm text-gray-600">{{ Str::limit($item->excerpt ?: 'Handcrafted roast with layered flavours and pronounced clarity.', 110) }}</p>
                  <div class="mt-2 text-xs text-gray-500 grid grid-cols-2 gap-2">
                    @if($idx == 0)
                      <div>Origin: Ethiopia</div>
                      <div>Roast: Medium</div>
                      <div>Process: Washed</div>
                      <div>Weight: 250g</div>
                    @elseif($idx == 1)
                      <div>Origin: Blend</div>
                      <div>Roast: Medium-Dark</div>
                      <div>Process: Blend</div>
                      <div>Weight: 250g</div>
                    @elseif($idx == 2)
                      <div>Origin: Various</div>
                      <div>Roast: Dark</div>
                      <div>Process: Natural</div>
                      <div>Weight: 250g</div>
                    @else
                      <div>Origin: {{ $item->origin ?? 'Various' }}</div>
                      <div>Roast: {{ $item->roast_level ?? 'Medium' }}</div>
                      <div>Process: {{ $item->process ?? 'Washed' }}</div>
                      <div>Weight: 250g</div>
                    @endif
                  </div>
                </div>
                <div class="text-lg font-semibold">{{ $showPrice }}</div>
              </div>

              <div class="mt-4 flex items-center justify-between">
                <div>
                  @if($idx == 0)
                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Single Origin</span>
                  @elseif($idx == 1)
                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">Reserve Blend</span>
                  @elseif($idx == 2)
                    <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-1 rounded">Organic</span>
                  @endif
                </div>
                <a href="{{ route('menu.show', $item->slug ?? $item->id) }}" class="px-4 py-2 bg-[var(--brand-brown)] text-[var(--brand-cream)] rounded">Select Options</a>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($promo as $p)
            <div class="bg-white rounded-xl overflow-hidden transform transition-shadow transition-transform hover:shadow-2xl hover:-translate-y-1">
              <div class="relative">
                @php
                  $base = $p['image'];
                  $jpg = public_path($base.'.jpg');
                  $imgUrl = file_exists($jpg) ? asset($base.'.jpg') : asset($base.'.svg');
                @endphp
                <img src="{{ $imgUrl }}" alt="{{ $p['name'] }}" class="w-full h-64 object-cover" loading="lazy" decoding="async" onerror="this.src='{{ asset('images/menu/placeholder.svg') }}'">
                <div class="absolute top-4 left-4 px-3 py-1 rounded-full bg-[var(--brand-gold)] text-[var(--brand-espresso)] text-xs font-semibold">Premium</div>
              </div>
              <div class="p-5">
                <div class="flex items-start justify-between">
                  <div class="space-y-1">
                    <h3 class="font-heading text-lg">{{ $p['name'] }}</h3>
                    <p class="text-sm text-gray-600">Handcrafted roast with layered flavours and pronounced clarity.</p>
                  </div>
                  <div class="text-lg font-semibold">${{ number_format($p['price'],2) }}</div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                  <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Featured</span>
                  <a href="{{ route('menu.index') }}" class="px-4 py-2 bg-[var(--brand-brown)] text-[var(--brand-cream)] rounded">Select Options</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <!-- Roaster Story -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <div>
        <h2 class="text-2xl font-heading">Our Roaster Story</h2>
        <p class="mt-4 text-gray-700">At Mausé Reserve we roast in small batches, profiling each lot to bring forward clarity, sweetness, and balance. We partner with trusted farms and roast to highlight the bean’s natural character.</p>
        <p class="mt-4 text-gray-700">Visit our café to taste single origin pours, signature blends, and learn about our craft in person.</p>
        <div class="mt-6"><a href="{{ route('about') }}" class="px-5 py-2 bg-[var(--brand-brown)] text-[var(--brand-cream)] rounded">Read Our Story</a></div>
      </div>
      <div>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
          <img src="{{ $roasterImg }}" alt="Roastery" class="w-full h-80 object-cover" onerror="this.src='{{ asset('images/menu/placeholder.svg') }}'">
        </div>
      </div>
    </div>
  </section>

  <!-- Premium Gallery -->
  <section class="py-12 bg-[var(--brand-cream)]">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-2xl font-heading mb-4">A Glimpse Inside</h2>
      <p class="text-sm text-gray-600 mb-6">Moments from our café and roastery.</p>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Gallery 1" class="w-full h-56 object-cover rounded-lg shadow" loading="lazy">
        <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Gallery 2" class="w-full h-56 object-cover rounded-lg shadow" loading="lazy">
        <img src="{{ asset('images/gallery/gallery-3.jpg') }}" alt="Gallery 3" class="w-full h-56 object-cover rounded-lg shadow" loading="lazy">
      </div>
    </div>
  </section>

  <!-- Coffee Categories -->
  <section class="py-12 bg-[var(--brand-cream)]">
    <x-section-header title="Coffee Categories" subtitle="Explore curated selections" />
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @php
        $cats = [
          ['title'=>'Signature Blends','desc'=>'Balanced blends','img'=>'images/menu/coffee-1.jpg'],
          ['title'=>'Single Origin','desc'=>'Distinct farm profiles','img'=>'images/menu/coffee-2.jpg'],
          ['title'=>'Espresso Roast','desc'=>'Roasts for espresso','img'=>'images/menu/coffee-3.jpg'],
          ['title'=>'Organic Selection','desc'=>'Sustainably sourced','img'=>'images/gallery/gallery-1.jpg'],
        ];
      @endphp
      @foreach($cats as $c)
        @php $imgUrl = file_exists(public_path($c['img'])) ? asset($c['img']) : asset(str_replace('.jpg','.svg',$c['img'])); @endphp
        <a href="{{ route('menu.index') }}" class="block bg-white rounded-xl shadow-md p-4 hover:shadow-lg transition flex items-center gap-4">
          <img src="{{ $imgUrl }}" alt="{{ $c['title'] }}" class="w-20 h-20 rounded-md object-cover flex-shrink-0">
          <div>
            <div class="font-semibold">{{ $c['title'] }}</div>
            <div class="mt-1 text-sm text-gray-600">{{ $c['desc'] }}</div>
          </div>
        </a>
      @endforeach
    </div>
  </section>

  <!-- Why Guests Love Mausé Reserve -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-heading">Why Guests Love Mausé Reserve</h2>
      <p class="text-sm text-gray-600 mt-2">Our commitment to craft, flavor and sustainability shines through every cup.</p>
      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow text-left">
          <div class="text-3xl text-[var(--brand-gold)]">☕</div>
          <div class="font-semibold mt-3">Fresh Roasted Daily</div>
          <div class="mt-2 text-sm text-gray-600">Small-batch roasts, daily profiles for peak freshness.</div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow text-left">
          <div class="text-3xl text-[var(--brand-gold)]">⭐</div>
          <div class="font-semibold mt-3">Specialty Grade Beans</div>
          <div class="mt-2 text-sm text-gray-600">Sourced from trusted farms and graded for excellence.</div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow text-left">
          <div class="text-3xl text-[var(--brand-gold)]">⚒️</div>
          <div class="font-semibold mt-3">Artisan Roasting</div>
          <div class="mt-2 text-sm text-gray-600">Handcrafted roast profiles tuned by our master roaster.</div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow text-left">
          <div class="text-3xl text-[var(--brand-gold)]">🌱</div>
          <div class="font-semibold mt-3">Sustainable Sourcing</div>
          <div class="mt-2 text-sm text-gray-600">Direct trade and practices that support farmers.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Final CTA -->
  <section class="py-16 bg-[var(--brand-brown)] text-[var(--brand-cream)]">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h3 class="text-2xl font-heading">Bring the Mausé Reserve experience to your cup.</h3>
      <div class="mt-6 flex justify-center gap-4">
        <a href="{{ route('menu.index') }}" class="px-5 py-3 bg-[var(--brand-cream)] text-[var(--brand-brown)] rounded">Explore Menu</a>
        <a href="{{ route('reservation.index') }}" class="px-5 py-3 border border-[var(--brand-cream)] rounded">Visit Our Café</a>
      </div>
    </div>
  </section>

@endsection
