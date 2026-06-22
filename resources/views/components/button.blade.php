@props(['type'=>'primary'])
@php
    $base = 'inline-flex items-center px-4 py-2 rounded-md font-medium transition-smooth focus-ring';
    $classes = $type === 'primary'
        ? $base . ' bg-[var(--brand-brown)] text-[var(--brand-cream)] shadow-sm hover:opacity-95'
        : $base . ' border border-gray-200 text-[var(--brand-espresso)] bg-white hover:bg-gray-50';
@endphp
<button {{ $attributes->merge(['class'=>$classes]) }}>
    {{ $slot }}
</button>
