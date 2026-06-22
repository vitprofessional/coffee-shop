@extends('layouts.app')
@section('title','Blog — Mausé Reserve')
@section('content')
    <section class="py-16">
        <x-section-header title="Journal" subtitle="Stories from Mausé Reserve" />
        <div class="max-w-7xl mx-auto px-4">
            @if(!empty($posts) && count($posts))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <x-blog-card :title="$post->title" :excerpt="$post->excerpt" :image="$post->image_url ?? asset('images/blog/placeholder.svg')" :date="optional($post->published_at)->format('M d, Y')" />
                    @endforeach
                </div>
            @else
                <x-empty-state title="No articles yet" description="Our journal is coming soon." />
            @endif
        </div>
    </section>
@endsection
@extends('layouts.app')
@section('content')
<h1>Blog</h1>
@foreach($posts as $p)
  <div class="p-2 bg-white my-2">{{ $p->title }}</div>
@endforeach
{{ $posts->links() }}
@endsection
