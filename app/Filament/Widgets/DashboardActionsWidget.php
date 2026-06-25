<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DashboardActionsWidget extends Widget
{
    protected ?string $heading = 'Dashboard Actions';
    protected int|string|array $columnSpan = 'full';

    /** @var view-string */
    protected string $view = 'filament.widgets.dashboard-actions-widget';

    protected function getViewData(): array
    {
        return [
            'items' => [
                ['label' => 'Add Menu Item', 'value' => 'Create', 'url' => '/admin/menu-items/create'],
                ['label' => 'Create Event', 'value' => 'Create', 'url' => '/admin/events/create'],
                ['label' => 'Write Journal Post', 'value' => 'Create', 'url' => '/admin/blog-posts/create'],
                ['label' => 'Upload Gallery Image', 'value' => 'Create', 'url' => '/admin/galleries/create'],
                ['label' => 'View Orders', 'value' => 'Open', 'url' => '/admin/orders'],
                ['label' => 'View Reservations', 'value' => 'Open', 'url' => '/admin/reservations'],
            ],
        ];
    }
}
