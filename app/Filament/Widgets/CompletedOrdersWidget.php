<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;

class CompletedOrdersWidget extends Widget
{
    protected string $view = 'filament.widgets.completed-orders-widget';

    public int $count = 0;

    public function mount(): void
    {
        $this->count = Order::where('status', 'completed')->count();
    }
}
