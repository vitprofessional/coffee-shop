<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;

class TotalRevenueWidget extends Widget
{
    protected string $view = 'filament.widgets.total-revenue-widget';

    public float $revenue = 0.0;

    public function mount(): void
    {
        // sum completed orders total; fallback to all orders
        $sum = Order::where('status', 'completed')->sum('total');
        if ($sum == 0) {
            $sum = Order::sum('total');
        }
        $this->revenue = (float) $sum;
    }
}
