<div class="bg-white rounded shadow p-4">
    <div class="text-sm font-medium mb-3">Revenue Summary</div>
    <div class="grid grid-cols-3 gap-4">
        <div class="p-3 bg-gray-50 rounded text-center">
            <div class="text-xs text-gray-600">Today</div>
            <div class="font-semibold">${{ number_format($this->today, 2) }}</div>
        </div>
        <div class="p-3 bg-gray-50 rounded text-center">
            <div class="text-xs text-gray-600">This Month</div>
            <div class="font-semibold">${{ number_format($this->month, 2) }}</div>
        </div>
        <div class="p-3 bg-gray-50 rounded text-center">
            <div class="text-xs text-gray-600">All Time</div>
            <div class="font-semibold">${{ number_format($this->total, 2) }}</div>
        </div>
    </div>
</div>
