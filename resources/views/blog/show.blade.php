@extends('layouts.app')
@section('title',$post->title ?? 'Article')
@section('content')
@php
        $hero = $post->image_url ?? (file_exists(public_path('images/gallery/gallery-3.jpg')) ? asset('images/gallery/gallery-3.jpg') : asset('images/hero/hero.jpg'));
        $reading = max(1, floor(str_word_count(strip_tags($post->content ?? ''))/200));
        $related = \App\Models\BlogPost::where('id','!=',$post->id)->latest()->take(3)->get();
@endphp

<section class="bg-gray-50">
    <header class="bg-cover bg-center" style="background-image:url('{{ $hero }}')">
        <div class="bg-black/50">
            <div class="container mx-auto px-6 py-24 text-white">
                <div class="max-w-3xl">
                    <div class="text-sm text-amber-600 font-medium">{{ $post->category->name ?? 'Article' }}</div>
                    <h1 class="text-4xl md:text-5xl font-serif mt-2">{{ $post->title }}</h1>
                    <div class="text-sm text-gray-200 mt-3">{{ optional($post->published_at)->format('M d, Y') }} · {{ $reading }} min read</div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="max-w-3xl mx-auto">
            <article class="bg-white rounded-2xl shadow p-8">
                @if(!empty($post->excerpt))
                    <blockquote class="border-l-4 border-amber-600 pl-4 italic text-lg text-gray-700">{{ $post->excerpt }}</blockquote>
                @endif

                <div class="prose mt-6 text-lg">{!! $post->content ?? '' !!}</div>
            </article>

            <section class="mt-12">
                <h3 class="text-2xl font-semibold mb-6">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($related as $r)
                        <article class="bg-white rounded-lg shadow p-4">
                            <div class="h-36 bg-cover bg-center rounded" style="background-image:url('{{ $r->image_url ?? asset('images/blog/placeholder.svg') }}')"></div>
                            <h4 class="mt-3 font-semibold">{{ $r->title }}</h4>
                            <div class="text-sm text-gray-500">{{ optional($r->published_at)->format('M d, Y') }} · {{ max(1, floor(str_word_count(strip_tags($r->content ?? ''))/200)) }} min read</div>
                            <div class="mt-3"><a href="{{ route('blog.show', $r->slug ?? $r->id) }}" class="text-amber-600 hover:underline">Read</a></div>
                        </article>
                    @endforeach
                </div>
            </section>

            <div class="mt-12 bg-white rounded-2xl shadow p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-2xl font-semibold">Explore Coffee Collection</h3>
                    <p class="text-sm text-gray-600">Discover single origin coffees and seasonal lots.</p>
                </div>
                <div class="flex gap-4">
                    <a href="/menu" class="inline-flex items-center justify-center rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-6 shadow-md">Explore Coffee Collection</a>
                    <a href="/reservation" class="inline-flex items-center justify-center rounded-lg border border-gray-200 hover:shadow-md text-gray-800 font-medium py-3 px-6">Reserve A Table</a>
                </div>
            </div>
        </div>
    </main>
</section>

@endsection
