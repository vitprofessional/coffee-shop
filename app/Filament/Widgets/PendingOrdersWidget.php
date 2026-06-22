<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;

class PendingOrdersWidget extends Widget
{
    protected string $view = 'filament.widgets.pending-orders-widget';

    public int $count = 0;

    public function mount(): void
    {
        $this->count = Order::where('status', 'pending')->count();
    }
}
