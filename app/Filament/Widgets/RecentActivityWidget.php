<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\ContactMessage;

class RecentActivityWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-activity-widget';

    public $orders;
    public $reservations;
    public $messages;

    public function mount(): void
    {
        $this->orders = Order::latest()->limit(5)->get();
        $this->reservations = Reservation::latest()->limit(5)->get();
        $this->messages = ContactMessage::latest()->limit(5)->get();
    }
}
