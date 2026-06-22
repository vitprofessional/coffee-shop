<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class OrdersChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Orders';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $period = 30;
        $labels = [];
        $data = [];
        for ($i = $period - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('M j');
            $count = Order::whereDate('created_at', $date)->count();
            $data[] = (int) $count;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data,
                ],
            ],
        ];
    }
}
