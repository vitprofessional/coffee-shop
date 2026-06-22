@props(['author'=>null,'image'=>null,'rating'=>5])
<div class="p-4 bg-white rounded-lg shadow-sm transition-smooth card-hover">
    <div class="flex items-start gap-4">
        <img src="{{ $image ?? asset('images/placeholders/avatar.svg') }}" alt="{{ $author }}" class="w-12 h-12 rounded-full object-cover img-fade" loading="lazy" decoding="async">
        <div>
            <div class="font-semibold font-body">{{ $author }}</div>
            <div class="text-xs text-gray-500">{{ str_repeat('★', $rating) }}</div>
            <div class="mt-2 text-sm text-gray-700 font-body">{{ $slot }}</div>
        </div>
    </div>
</div>
