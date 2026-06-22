@props(['title'=>null,'excerpt'=>null,'image'=>null,'date'=>null])
<article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover transition-smooth">
    <img src="{{ $image ?? '/images/blog-placeholder.jpg' }}" alt="{{ $title }}" class="w-full h-44 object-cover" loading="lazy" decoding="async">
    <div class="p-4">
        <div class="text-xs text-gray-500">{{ $date }}</div>
        <h3 class="font-heading mt-2 text-lg">{{ $title }}</h3>
        <p class="mt-2 text-sm text-gray-700 font-body">{{ $excerpt }}</p>
        <div class="mt-3"><a href="#" class="text-[var(--brand-brown)] font-semibold">Read more</a></div>
    </div>
</article>
