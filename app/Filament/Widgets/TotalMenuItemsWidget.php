<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\MenuItem;

class TotalMenuItemsWidget extends Widget
{
    protected string $view = 'filament.widgets.total-menu-items-widget';

    public int $count = 0;

    public function mount(): void
    {
        $this->count = MenuItem::count();
    }
}
