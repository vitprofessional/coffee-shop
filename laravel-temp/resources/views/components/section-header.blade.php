@props(['title','subtitle'=>null])
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="text-center">
        <h2 class="text-3xl md:text-4xl font-heading tracking-tight text-[var(--brand-espresso)]">{{ $title }}</h2>
        @if($subtitle)
            <p class="mt-2 text-sm text-gray-600 font-body">{{ $subtitle }}</p>
        @endif
    </div>
</div>
