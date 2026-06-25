<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class OrdersStatusChartWidget extends ChartWidget
{
    protected ?string $heading = 'Orders Status';
    protected int|string|array $columnSpan = 1;

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        $pending = Order::where('status', 'pending')->count();
        $preparing = Order::where('status', 'preparing')->count();
        $completed = Order::where('status', 'completed')->count();

        return [
            'labels' => ['Pending', 'Preparing', 'Completed'],
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => [$pending, $preparing, $completed],
                ],
            ],
        ];
    }
}
