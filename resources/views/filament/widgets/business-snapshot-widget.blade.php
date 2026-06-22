<div class="bg-white rounded shadow p-4">
    <div class="text-sm font-medium mb-2">Business Snapshot</div>
    <div class="grid grid-cols-1 gap-3">
        <div class="flex justify-between"><span>Top Selling</span><strong>{{ $this->topSelling->item_name ?? '-' }} ({{ $this->topSelling->qty ?? 0 }})</strong></div>
        <div class="flex justify-between"><span>Featured Products</span><strong>{{ $this->featuredCount }}</strong></div>
        <div class="flex justify-between"><span>Upcoming Events</span><strong>{{ $this->upcomingEvents }}</strong></div>
        <div class="flex justify-between"><span>Published Articles</span><strong>{{ $this->publishedArticles }}</strong></div>
    </div>
</div>
