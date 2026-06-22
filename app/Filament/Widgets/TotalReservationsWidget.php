<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Reservation;

class TotalReservationsWidget extends Widget
{
    protected string $view = 'filament.widgets.total-reservations-widget';

    public int $count = 0;

    public function mount(): void
    {
        $this->count = Reservation::count();
    }
}
