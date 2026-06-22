<div class="filament-widget">
    <div class="text-sm text-muted">Recent Orders</div>
    <ul class="mt-2 space-y-2">
        @foreach ($this->orders as $order)
            <li class="flex justify-between">
                <div>
                    <div class="font-medium">Order #{{ $order->id }}</div>
                    <div class="text-xs text-muted">{{ $order->created_at->diffForHumans() }}</div>
                </div>
                <div class="text-right">
                    <div>${{ number_format($order->total, 2) }}</div>
                    <div class="text-xs text-muted">{{ ucfirst($order->status) }}</div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
