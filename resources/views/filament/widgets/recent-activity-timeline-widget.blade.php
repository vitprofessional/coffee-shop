<div class="bg-white rounded shadow p-4">
    <div class="text-sm font-medium mb-3">Recent Activity</div>
    <div class="divide-y">
        @forelse($this->items as $item)
            <div class="py-2">
                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item['time'])->diffForHumans() }}</div>
                <div class="font-medium">{{ $item['title'] }}</div>
                <div class="text-sm text-gray-600">{{ $item['meta'] }}</div>
            </div>
        @empty
            <div class="py-2 text-sm text-gray-500">No recent activity.</div>
        @endforelse
    </div>
</div>
