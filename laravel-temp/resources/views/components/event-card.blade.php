@props(['title'=>null,'date'=>null,'time'=>null,'location'=>null,'image'=>null])
<article class="rounded-lg overflow-hidden shadow-sm bg-white card-hover transition-smooth">
    <div class="relative">
        <img src="{{ $image ?? '/images/events-placeholder.jpg' }}" alt="{{ $title }}" class="w-full h-48 object-cover img-fade" loading="lazy" decoding="async">
        <div class="absolute top-3 left-3 bg-[var(--brand-gold)] text-[var(--brand-espresso)] px-3 py-1 rounded text-xs font-semibold">{{ $date }}</div>
    </div>
    <div class="p-4">
        <h3 class="font-heading text-lg">{{ $title }}</h3>
        <div class="text-sm text-gray-600 mt-1 font-body">{{ $time }} · {{ $location }}</div>
        <div class="mt-3"><a href="#" class="text-[var(--brand-brown)] font-semibold">Register</a></div>
    </div>
</article>
