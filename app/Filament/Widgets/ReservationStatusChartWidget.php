<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Reservation;

class ReservationStatusChartWidget extends ChartWidget
{
    protected ?string $heading = 'Reservation Status';
    protected int|string|array $columnSpan = 1;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $upcoming = Reservation::whereDate('reservation_date', '>=', now()->toDateString())->count();
        $confirmed = Reservation::where('status', 'confirmed')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        return [
            'labels' => ['Upcoming', 'Confirmed', 'Cancelled'],
            'datasets' => [[
                'label' => 'Reservations',
                'data' => [$upcoming, $confirmed, $cancelled],
            ]],
        ];
    }
}
