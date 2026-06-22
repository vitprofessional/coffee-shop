@extends('layouts.app')
@section('title','Menu — Mausé Reserve')
@section('content')
  <section class="py-12">
    <x-section-header title="Our Menu" subtitle="Seasonal selections & signature beverages" />
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-center gap-4 mb-6 flex-wrap">
        <div class="flex gap-2">
          <button @click="$root.selectedMenu='All'" :class="$root.selectedMenu==='All' ? 'bg-[var(--brand-brown)] text-[var(--brand-cream)]' : ''" class="px-3 py-1 rounded-full border transition-smooth">All</button>
          @if(!empty($categories) && count($categories))
            @foreach($categories as $cat)
              <button @click="$root.selectedMenu='{{ addslashes($cat->name) }}'" :class="$root.selectedMenu==='{{ addslashes($cat->name) }}' ? 'bg-[var(--brand-brown)] text-[var(--brand-cream)]' : ''" class="px-3 py-1 rounded-full border transition-smooth">{{ $cat->name }}</button>
            @endforeach
          @endif
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(!empty($items) && count($items))
          @foreach($items as $item)
            @php $catName = $item->category->name ?? 'Uncategorized'; @endphp
            <article data-category="{{ $catName }}" x-show="$root.selectedMenu==='All' || $root.selectedMenu==='{{ addslashes($catName) }}'" x-cloak class="bg-white rounded-lg shadow-sm overflow-hidden card-hover transition-smooth">
              <img src="{{ $item->image_url ?? asset('images/menu/placeholder.svg') }}" alt="{{ $item->name }}" class="w-full h-44 object-cover img-fade" loading="lazy" decoding="async">
              <div class="p-4">
                <div class="flex items-center justify-between">
                  <h4 class="font-heading">{{ $item->name }}</h4>
                  <div class="text-sm font-medium">{{ $item->price_formatted ?? '$0.00' }}</div>
                </div>
                <p class="mt-2 text-sm text-gray-600 font-body">{{ $item->excerpt ?? '' }}</p>
              </div>
            </article>
          @endforeach
        @else
          <x-empty-state title="Menu is being prepared" description="Our menu is being updated. Please check back soon." />
        @endif
      </div>

      <div class="mt-8">
        {{ $items->links() }}
      </div>
    </div>
  </section>
@endsection
