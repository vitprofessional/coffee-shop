<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="bg-white rounded shadow p-4">
        <div class="text-sm font-medium mb-2">Recent Orders</div>
        <ul class="text-sm space-y-2">
            @foreach($this->orders as $order)
                <li class="flex justify-between"><span>#{{ $order->order_number ?? $order->id }} — {{ $order->customer_name }}</span><span class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</span></li>
            @endforeach
        </ul>
    </div>
    <div class="bg-white rounded shadow p-4">
        <div class="text-sm font-medium mb-2">Recent Reservations</div>
        <ul class="text-sm space-y-2">
            @foreach($this->reservations as $r)
                <li class="flex justify-between"><span>{{ $r->name }} — {{ $r->guests }}p</span><span class="text-xs text-gray-500">{{ $r->created_at->diffForHumans() }}</span></li>
            @endforeach
        </ul>
    </div>
    <div class="bg-white rounded shadow p-4">
        <div class="text-sm font-medium mb-2">Recent Messages</div>
        <ul class="text-sm space-y-2">
            @foreach($this->messages as $m)
                <li class="flex justify-between"><span>{{ $m->name }} — {{ Str::limit($m->subject ?? $m->message, 40) }}</span><span class="text-xs text-gray-500">{{ $m->created_at->diffForHumans() }}</span></li>
            @endforeach
        </ul>
    </div>
</div>
