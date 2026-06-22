<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Reservation;

class RecentReservationsWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-reservations-widget';

    public $reservations = [];

    public function mount(): void
    {
        $this->reservations = Reservation::orderBy('created_at', 'desc')->limit(6)->get();
    }
}
