<div class="filament-widget">
    <div class="text-sm text-muted">Recent Reservations</div>
    <ul class="mt-2 space-y-2">
        @foreach ($this->reservations as $r)
            <li class="flex justify-between">
                <div>
                    <div class="font-medium">{{ $r->name ?? 'Reservation' }}</div>
                    <div class="text-xs text-muted">{{ $r->created_at->diffForHumans() }}</div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-muted">{{ ucfirst($r->status) }}</div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
