<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\ContactMessage;

class ExecutiveOverviewWidget extends Widget
{
    protected string $view = 'filament.widgets.executive-overview-widget';

    public array $cards = [];

    public function mount(): void
    {
        $today = now()->startOfDay();
        $this->cards = [
            'today_revenue' => (float) Order::where('created_at', '>=', $today)->sum('total'),
            'monthly_revenue' => (float) Order::where('created_at', '>=', now()->startOfMonth())->sum('total'),
            'total_orders' => (int) Order::count(),
            'pending_orders' => (int) Order::where('status', 'pending')->count(),
            'active_reservations' => (int) Reservation::where('status', 'confirmed')->count(),
            'new_messages' => (int) ContactMessage::where('status', 'pending')->count(),
        ];
    }
}
