<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\ContactMessage;

class ExecutiveStatsWidget extends BaseStatsOverviewWidget
{
    protected ?string $heading = 'Mausé Reserve Administration';
    protected ?string $description = 'Coffee Business Management Dashboard';

    protected function getStats(): array
    {
        $today = now()->startOfDay();
        $todayRevenue = Order::where('created_at', '>=', $today)->sum('total');
        $monthlyRevenue = Order::where('created_at', '>=', now()->startOfMonth())->sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $activeReservations = Reservation::where('status', 'confirmed')->count();
        $newMessages = ContactMessage::where('status', 'pending')->count();

        return [
            Stat::make("Today's Revenue", '$' . number_format($todayRevenue, 2))
                ->icon('heroicon-o-currency-dollar')
                ->description('Since midnight')
                ->descriptionColor('success'),

            Stat::make('Monthly Revenue', '$' . number_format($monthlyRevenue, 2))
                ->icon('heroicon-o-calendar')
                ->description('This month')
                ->descriptionColor('success'),

            Stat::make('Total Orders', $totalOrders)
                ->icon('heroicon-o-shopping-bag')
                ->description('All time')
                ->descriptionColor('primary'),

            Stat::make('Pending Orders', $pendingOrders)
                ->icon('heroicon-o-clock')
                ->description('Awaiting fulfillment')
                ->descriptionColor('warning'),

            Stat::make('Active Reservations', $activeReservations)
                ->icon('heroicon-o-user-group')
                ->description('Confirmed')
                ->descriptionColor('primary'),

            Stat::make('New Messages', $newMessages)
                ->icon('heroicon-o-chat-bubble-oval-left')
                ->description('Unread')
                ->descriptionColor('danger'),
        ];
    }
}
