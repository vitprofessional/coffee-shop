<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
    <div class="bg-white p-4 rounded shadow flex flex-col">
        <div class="text-xs text-gray-500">Today's Revenue</div>
        <div class="text-xl font-semibold text-green-600">${{ number_format($this->cards['today_revenue'] ?? 0, 2) }}</div>
    </div>
    <div class="bg-white p-4 rounded shadow flex flex-col">
        <div class="text-xs text-gray-500">Monthly Revenue</div>
        <div class="text-xl font-semibold text-green-600">${{ number_format($this->cards['monthly_revenue'] ?? 0, 2) }}</div>
    </div>
    <div class="bg-white p-4 rounded shadow flex flex-col">
        <div class="text-xs text-gray-500">Total Orders</div>
        <div class="text-xl font-semibold">{{ $this->cards['total_orders'] ?? 0 }}</div>
    </div>
    <div class="bg-white p-4 rounded shadow flex flex-col">
        <div class="text-xs text-gray-500">Pending Orders</div>
        <div class="text-xl font-semibold text-yellow-600">{{ $this->cards['pending_orders'] ?? 0 }}</div>
    </div>
    <div class="bg-white p-4 rounded shadow flex flex-col">
        <div class="text-xs text-gray-500">Active Reservations</div>
        <div class="text-xl font-semibold">{{ $this->cards['active_reservations'] ?? 0 }}</div>
    </div>
    <div class="bg-white p-4 rounded shadow flex flex-col">
        <div class="text-xs text-gray-500">New Messages</div>
        <div class="text-xl font-semibold text-red-600">{{ $this->cards['new_messages'] ?? 0 }}</div>
    </div>
</div>
