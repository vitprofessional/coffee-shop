<div class="filament-widget-cards">
    <style>
        .filament-widget-cards .fi-section { border-radius: 0.75rem; border: 1px solid #e5e7eb; background: #ffffff; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.04); }
        .filament-widget-cards .fi-section:hover { box-shadow: 0 6px 18px rgba(0,0,0,0.06); }
        .filament-widget-cards .fi-section .fi-section-content { padding: 0; background: transparent; }
    </style>
    <div>
    <div class="text-sm font-medium mb-3">Business Intelligence</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-600">Best Selling Coffee</div>
            <div class="font-semibold">{{ $this->bestSelling->item_name ?? '-' }}</div>
            <div class="text-sm text-gray-500">Units: {{ $this->bestSelling->qty ?? 0 }}</div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-600">Lowest Selling Coffee</div>
            <div class="font-semibold">{{ $this->lowestSelling->item_name ?? '-' }}</div>
            <div class="text-sm text-gray-500">Units: {{ $this->lowestSelling->qty ?? 0 }}</div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-600">Most Reserved Day</div>
            <div class="font-semibold">{{ $this->mostReservedDay ? \Illuminate\Support\Carbon::parse($this->mostReservedDay)->format('M d, Y') : '-' }}</div>
            <div class="text-sm text-gray-500">Date with highest reservations</div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-600">Most Popular Category</div>
            <div class="font-semibold">{{ $this->topCategory ?? '-' }}</div>
            <div class="text-sm text-gray-500">Category by units sold</div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-600">Upcoming Events</div>
            <div class="font-semibold">{{ $this->upcomingEvents }}</div>
            <div class="text-sm text-gray-500">Events booked</div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="text-xs text-gray-600">Published Articles</div>
            <div class="font-semibold">{{ $this->publishedArticles }}</div>
            <div class="text-sm text-gray-500">Knowledge base</div>
        </div>
    </div>
</div>
