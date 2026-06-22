@extends('layouts.app')
@section('title','Menu — Backup (legacy)')
@section('content')
    <section class="py-12">
        <x-section-header title="Our Menu (legacy backup)" subtitle="Legacy template moved to legacy/menu.blade.php" />
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(!empty($menuItems) && count($menuItems))
                    @foreach($menuItems as $item)
                        @php $catName = $item->category->name ?? 'Uncategorized'; @endphp
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover transition-smooth">
                            <img src="{{ $item->image_url ?? asset('images/menu/placeholder.svg') }}" alt="{{ $item->name }}" class="w-full h-44 object-cover" loading="lazy" decoding="async">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-heading">{{ $item->name }}</h4>
                                    <div class="text-sm font-medium">{{ $item->price_formatted ?? '$0.00' }}</div>
                                </div>
                                <p class="mt-2 text-sm text-gray-600 font-body">{{ $item->excerpt ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <x-empty-state title="Menu is being prepared" description="Our menu is being updated. Please check back soon." />
                @endif
            </div>
        </div>
    </section>
@endsection
