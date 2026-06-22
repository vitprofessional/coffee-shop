<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;

class RecentOrdersWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-orders-widget';

    public $orders = [];

    public function mount(): void
    {
        $this->orders = Order::orderBy('created_at', 'desc')->limit(6)->get();
    }
}
