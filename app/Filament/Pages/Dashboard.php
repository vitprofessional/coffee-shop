<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\OrderStatusChartWidget;
use App\Filament\Widgets\ReservationStatusChartWidget;
use App\Filament\Widgets\RecentOrdersWidget;
use App\Filament\Widgets\RecentReservationsWidget;
use App\Filament\Widgets\RecentMessagesWidget;
use App\Filament\Widgets\DashboardActionsWidget;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            DashboardStatsWidget::class,
            RevenueChartWidget::class,
            OrderStatusChartWidget::class,
            ReservationStatusChartWidget::class,
            RecentOrdersWidget::class,
            RecentReservationsWidget::class,
            RecentMessagesWidget::class,
            DashboardActionsWidget::class,
        ];
    }
}
