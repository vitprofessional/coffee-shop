<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Reservation;

class ReservationsStatusChartWidget extends ChartWidget
{
    protected ?string $heading = 'Reservations Status';
    protected int|string|array $columnSpan = 1;

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        $upcoming = Reservation::whereDate('reservation_date', '>=', now()->toDateString())->count();
        $confirmed = Reservation::where('status', 'confirmed')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        return [
            'labels' => ['Upcoming', 'Confirmed', 'Cancelled'],
            'datasets' => [
                [
                    'label' => 'Reservations',
                    'data' => [$upcoming, $confirmed, $cancelled],
                ],
            ],
        ];
    }
}
