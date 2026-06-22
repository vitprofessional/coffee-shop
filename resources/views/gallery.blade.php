@extends('layouts.app')
@section('title','Gallery — Mausé Reserve')
@section('content')
    <section class="py-16">
        <x-section-header title="Gallery" subtitle="Moments at Mausé Reserve" />
        <div class="max-w-7xl mx-auto px-4">
            @php
                $alpineImages = collect($gallery ?? [])->map(fn($g)=>[ 'url'=>$g->url ?? '#', 'title'=>$g->title ?? '' ])->values();
            @endphp
            <div x-data="{ images: @json($alpineImages), index: null, open(i){ this.index = i; this.$nextTick(()=>{ if(this.$refs?.close) this.$refs.close.focus(); }); }, close(){ this.index = null }, next(){ if(this.index === null) return; this.index = (this.index + 1) % this.images.length }, prev(){ if(this.index === null) return; this.index = (this.index - 1 + this.images.length) % this.images.length } }"
                 x-on:keydown.window.escape="close()" x-on:keydown.window.arrow-right="next()" x-on:keydown.window.arrow-left="prev()">
                @if(!empty($gallery) && count($gallery))
                    <div class="columns-2 md:columns-4 gap-3 space-y-3">
                        @foreach($gallery as $img)
                            <figure class="break-inside">
                                <a href="{{ $img->url ?? '#' }}" @click.prevent="open({{ $loop->index }})" rel="noopener">
                                    <img src="{{ $img->url ?? asset('images/gallery/placeholder.svg') }}" alt="{{ $img->title ?? 'Gallery image' }}" class="w-full rounded-lg object-cover img-fade" loading="lazy" decoding="async">
                                </a>
                            </figure>
                        @endforeach
                    </div>
                @else
                    <x-empty-state title="No images yet" description="Our gallery is being curated. Check back soon." />
                @endif

                <!-- Lightbox Modal -->
                <div x-show="index !== null" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/70" style="backdrop-filter:blur(4px);">
                    <div class="relative max-w-4xl w-full mx-4">
                        <button x-ref="close" @click="close()" class="absolute top-3 right-3 text-white bg-black/40 rounded-full p-2 focus-ring" aria-label="Close lightbox">✕</button>
                        <button @click.stop="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 text-white bg-black/30 rounded-full p-2 focus-ring" aria-label="Previous">‹</button>
                        <button @click.stop="next()" class="absolute right-3 top-1/2 -translate-y-1/2 text-white bg-black/30 rounded-full p-2 focus-ring" aria-label="Next">›</button>
                        <div @click.outside="close()" class="bg-transparent">
                            <img :src="images[index].url" :alt="images[index].title" class="w-full h-[60vh] object-contain mx-auto" loading="lazy">
                            <div class="mt-3 text-center text-white font-body">{{-- title via Alpine binding --}}<span x-text="images[index].title"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
