@extends('layouts.app')
@section('title',$post->title ?? 'Article')
@section('content')
    <section class="py-16">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-3xl font-heading">{{ $post->title }}</h1>
            <div class="text-sm text-gray-500 mt-2 font-body">{{ optional($post->published_at)->format('M d, Y') }}</div>
            <img src="{{ $post->image_url ?? asset('images/blog/placeholder.svg') }}" class="w-full h-64 object-cover rounded mt-6 img-fade" loading="lazy" decoding="async">
            <div class="prose mt-6 font-body">{!! $post->content ?? '' !!}</div>
        </div>
    </section>
@endsection
