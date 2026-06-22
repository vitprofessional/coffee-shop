@extends('layouts.app')
@section('title','Menu — Mausé Reserve')
@section('content')
    <section class="pt-6 pb-12">
      @php
        $heroImg = file_exists(public_path('images/hero/hero.jpg')) ? asset('images/hero/hero.jpg') : asset('images/hero/hero.svg');
      @endphp
      <!-- Shop Hero -->
      <div class="relative w-full overflow-hidden rounded-lg mb-8">
        <img src="{{ $heroImg }}" alt="Curated Specialty Coffee" class="w-full h-72 md:h-80 object-cover">
        <div class="absolute inset-0 bg-black/45 flex items-center">
          <div class="max-w-7xl mx-auto px-4 text-white">
            <h1 class="text-2xl md:text-3xl font-heading">Curated Specialty Coffee</h1>
            <p class="mt-2 text-sm md:text-base">Small-batch roasted coffees crafted for every brewing style.</p>
          </div>
        </div>
      </div>

      <x-section-header title="Shop" subtitle="All Coffees" class="mb-6" />
      <div class="max-w-7xl mx-auto px-4">
        @php
          $collection = (
            isset($items) && method_exists($items, 'getCollection')
          ) ? $items->getCollection() : collect($items ?? []);
          $counts = $collection->map(function($i){ return data_get($i, 'category.name') ?? 'Uncategorized'; })->countBy()->toArray();
          $allCount = isset($items) && method_exists($items, 'total') ? $items->total() : count($collection);
          $imagePool = [
            'images/menu/coffee-1.jpg','images/menu/coffee-2.jpg','images/menu/coffee-3.jpg',
            'images/gallery/gallery-1.jpg','images/gallery/gallery-2.jpg','images/gallery/gallery-3.jpg'
          ];
          $poolCount = count($imagePool);
          $filters = ['All Coffees','Blends','Single Origin','Espresso','Strong','Organic','Decaf'];
        @endphp
        <div class="mb-6">
          <div class="md:sticky md:top-20 bg-transparent">
            <div class="flex items-center gap-3 flex-wrap">
              @foreach($filters as $f)
                @php
                  $displayCount = 0;
                  if($f === 'All Coffees') { $displayCount = $allCount; }
                  else { $key = $f; $displayCount = $counts[$key] ?? 0; }
                @endphp
                <button
                  @click="$root.selectedMenu='{{ $f }}'"
                  :aria-pressed="$root.selectedMenu==='{{ $f }}'"
                  :class="$root.selectedMenu==='{{ $f }}' ? 'bg-[var(--brand-brown)] text-[var(--brand-cream)]' : 'bg-white text-gray-700'"
                  class="px-4 py-2 rounded-full border border-gray-200 shadow-sm hover:shadow-md transition-colors text-sm focus:outline-none focus:ring-2 focus:ring-[var(--brand-brown)]"
                  aria-label="Filter {{ $f }}"
                  tabindex="0"
                >
                  {{ $f }} @if($displayCount) <span class="text-xs text-gray-500">({{ $displayCount }})</span>@endif
                </button>
              @endforeach
            </div>
          </div>
          <div class="mt-3 text-sm text-gray-600">Showing {{ $allCount }} seasonal roasts</div>
        </div>

        <!-- Featured collection (premium) -->
        <div class="mb-12">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-2xl font-heading">Featured Collection</h3>
              <p class="text-sm text-gray-300">Curated selections from our latest micro-lots.</p>
            </div>
            <div class="text-sm text-gray-400">Hand-picked seasonal coffees</div>
          </div>
          <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach(($items ?? collect())->take(3) as $fitem)
              @php
                $fb = 'images/menu/coffee-'.((($loop->index % 3)+1));
                $fimg = $fitem->image_url ?? (file_exists(public_path($fb.'.jpg')) ? asset($fb.'.jpg') : asset($fb.'.svg'));
                $prices = ['16.90','18.90','21.50'];
                $fprice = $fitem->price_formatted ?? '$'.$prices[$loop->index % 3];
              @endphp
              <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <div class="relative group">
                  <img src="{{ $fimg }}" alt="{{ $fitem->name }}" class="w-full h-56 sm:h-72 object-cover transition-transform duration-500 group-hover:scale-105">
                  <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/50"></div>
                  <div class="absolute top-4 left-4 bg-[var(--brand-gold)] text-[var(--brand-brown)] px-3 py-1 rounded-full text-xs font-semibold">Premium</div>
                  <div class="absolute bottom-4 left-4 right-4 text-white">
                    <div class="flex items-center justify-between">
                      <div class="font-semibold text-lg leading-tight">{{ $fitem->name }}</div>
                      <div class="text-lg font-semibold">{{ $fprice }}</div>
                    </div>
                    <div class="mt-2 text-sm text-white/90">{{ $fitem->excerpt ?? ($fitem->tasting_notes ?? 'Rich, balanced and aromatic.') }}</div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @if(!empty($items) && count($items))
            @foreach($items as $item)
              @php
                $catName = $item->category->name ?? 'Uncategorized';
                // Choose image: prefer item image, else rotate through pool for variety
                if(!empty($item->image_url)){
                  $imgUrl = $item->image_url;
                } else {
                  $pick = $imagePool[$loop->index % $poolCount];
                  $imgUrl = file_exists(public_path($pick)) ? asset($pick) : asset(str_replace('.jpg','.svg',$pick));
                }
                $prices = ['16.90','18.90','21.50'];
                $price = $item->price_formatted ?? ('$'.$prices[$loop->index % 3]);
                $notes = $item->tasting_notes ?? $item->excerpt ?? 'Notes: chocolate, citrus, caramel.';
                $origin = $item->origin ?? ($item->region ?? 'Various Origins');
                $roast = $item->roast_level ?? ($item->roast ?? 'Medium');
                $weight = $item->weight ?? '250g';
              @endphp
              <article data-category="{{ $catName }}" x-show="$root.selectedMenu==='All' || $root.selectedMenu==='{{ addslashes($catName) }}' || $root.selectedMenu==='$item->tag'" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="overflow-hidden group">
                  @php $loading = $loop->index < 3 ? 'eager' : 'lazy'; @endphp
                  <img src="{{ $imgUrl }}" alt="{{ $item->name }}" loading="{{ $loading }}" class="w-full h-36 sm:h-44 lg:h-48 object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="p-5">
                  <h4 class="font-heading text-xl leading-tight">{{ $item->name }}</h4>
                  <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $notes }}</p>

                  <div class="mt-3 text-sm text-gray-700">
                    <span class="text-gray-500 text-xs">{{ $origin }}</span>
                    <span class="mx-2">•</span>
                    <span class="text-gray-500 text-xs">{{ $roast }} Roast</span>
                    <span class="mx-2">•</span>
                    <span class="text-gray-500 text-xs">{{ $weight }}</span>
                  </div>

                  <div class="mt-4 flex items-center justify-between">
                    <div class="text-lg font-bold text-[var(--brand-brown)]">{{ $price }}</div>
                      <div class="flex items-center gap-3">
                        <form method="POST" action="{{ route('cart.add') }}" class="inline-block">
                          @csrf
                          <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                          <input type="hidden" name="quantity" value="1">
                          <button type="submit" aria-label="Add {{ $item->name }} to cart" class="px-4 py-2 bg-[var(--brand-brown)] text-[var(--brand-cream)] rounded-lg font-medium shadow-sm hover:shadow-md transition focus:outline-none focus:ring-2 focus:ring-[var(--brand-brown)]">Add To Cart</button>
                        </form>
                        <a href="#" class="text-sm text-gray-600 hover:underline" aria-label="View details for {{ $item->name }}">View Details</a>
                      </div>
                  </div>
                </div>
              </article>
            @endforeach
          @else
            <x-empty-state title="Shop is being prepared" description="Our roastery is updating offerings. Check back soon." />
          @endif
        </div>
        <div class="mt-10 flex justify-center">
          <nav aria-label="Page navigation" class="bg-white rounded-md shadow-sm px-4 py-3">
            {{ $items->links() }}
          </nav>
        </div>
      </div>
    </section>
@endsection
