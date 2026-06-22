@extends('layouts.app')
@section('title','Coffee Journal — Mausé Reserve')
@section('content')
@php
        $hero = file_exists(public_path('images/gallery/gallery-3.jpg'))
                ? asset('images/gallery/gallery-3.jpg')
                : asset('images/hero/hero.jpg');
        $featured = $posts->first();
@endphp

<section class="bg-gray-50">
    <header class="bg-cover bg-center" style="background-image: url('{{ $hero }}')">
        <div class="bg-black/45">
            <div class="container mx-auto px-6 py-20 text-white">
                <h1 class="text-4xl md:text-5xl font-serif mb-3">Coffee Journal</h1>
                <p class="text-lg max-w-2xl">Stories, brewing guides and seasonal notes from Mausé Reserve</p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <!-- Featured article -->
        @if($featured)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-10">
                <div class="md:flex">
                    <div class="md:w-1/2 h-64 bg-cover bg-center" style="background-image:url('{{ $featured->image_url ?? asset('images/blog/placeholder.svg') }}')"></div>
                    <div class="md:w-1/2 p-8">
                        <div class="text-sm text-amber-600 font-medium">{{ $featured->category->name ?? 'Feature' }}</div>
                        <h2 class="text-3xl font-semibold mt-2">{{ $featured->title }}</h2>
                        <p class="text-gray-600 mt-4">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content ?? ''), 180) }}</p>
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-500">{{ optional($featured->published_at)->format('M d, Y') }} · {{ max(1, floor(str_word_count(strip_tags($featured->content ?? ''))/200)) }} min read</div>
                            <a href="{{ route('blog.show', $featured->slug ?? $featured->id) }}" class="text-amber-600 hover:underline">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        @if($featured && $post->id == $featured->id) @continue @endif
                        <article class="bg-white rounded-2xl shadow hover:shadow-md overflow-hidden">
                            <div class="h-44 bg-cover bg-center" style="background-image:url('{{ $post->image_url ?? asset('images/blog/placeholder.svg') }}')"></div>
                            <div class="p-4">
                                <div class="text-sm text-amber-600 font-medium">{{ $post->category->name ?? 'Article' }}</div>
                                <h3 class="mt-2 font-semibold">{{ $post->title }}</h3>
                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($post->excerpt ?? strip_tags($post->content ?? ''), 120) }}</p>
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                    <div>{{ optional($post->published_at)->format('M d, Y') }}</div>
                                    <div>{{ max(1, floor(str_word_count(strip_tags($post->content ?? ''))/200)) }} min read</div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('blog.show', $post->slug ?? $post->id) }}" class="text-amber-600 hover:underline">Read More</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">{{ $posts->links() }}</div>
            </div>

            <aside class="lg:col-span-1 flex flex-col gap-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <h4 class="font-semibold mb-3">Topics</h4>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>Coffee Guides</li>
                        <li>Roasting Notes</li>
                        <li>Café Stories</li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h4 class="font-semibold mb-3">About the Journal</h4>
                    <p class="text-sm text-gray-600">Curated stories from our roasters, baristas, and guests.</p>
                </div>
            </aside>
        </div>
    </main>
</section>

@endsection
