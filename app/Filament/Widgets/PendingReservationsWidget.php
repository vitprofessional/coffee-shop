<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Reservation;

class PendingReservationsWidget extends Widget
{
    protected string $view = 'filament.widgets.pending-reservations-widget';

    public int $count = 0;

    public function mount(): void
    {
        $this->count = Reservation::where('status', 'pending')->count();
    }
}
