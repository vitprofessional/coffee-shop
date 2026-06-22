<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $period = 30;
        $labels = [];
        $data = [];
        for ($i = $period - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('M j');
            $sum = Order::whereDate('created_at', $date)->sum('total');
            $data[] = (float) $sum;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data,
                    'fill' => true,
                ],
            ],
        ];
    }
}
