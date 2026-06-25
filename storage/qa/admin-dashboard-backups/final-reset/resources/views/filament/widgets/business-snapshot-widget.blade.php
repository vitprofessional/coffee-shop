<!-- ACTIVE BUSINESS SNAPSHOT WIDGET -->
<div class="bg-white rounded shadow p-4">
    <div class="flex items-center justify-between mb-3">
        <div>
            <div class="text-sm font-medium">Business Snapshot</div>
            <div class="text-xs text-gray-500">Key business highlights</div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="p-4 rounded-xl border bg-white">
            <div class="text-xs text-gray-600">Top Selling Coffee</div>
            <div class="font-semibold">{{ $this->topSelling->item_name ?? '-' }}</div>
            <div class="text-sm text-gray-500">Units: {{ $this->topSelling->qty ?? 0 }}</div>
        </div>

        <div class="p-4 rounded-xl border bg-white">
            <div class="text-xs text-gray-600">Featured Products</div>
            <div class="font-semibold">{{ $this->featuredCount }}</div>
            <div class="text-sm text-gray-500">Highlighted items</div>
        </div>

        <div class="p-4 rounded-xl border bg-white">
            <div class="text-xs text-gray-600">Upcoming Events</div>
            <div class="font-semibold">{{ $this->upcomingEvents }}</div>
            <div class="text-sm text-gray-500">Events booked</div>
        </div>

        <div class="p-4 rounded-xl border bg-white">
            <div class="text-xs text-gray-600">Published Articles</div>
            <div class="font-semibold">{{ $this->publishedArticles }}</div>
            <div class="text-sm text-gray-500">Knowledge base</div>
        </div>
    </div>
</div>
