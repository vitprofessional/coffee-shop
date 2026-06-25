<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\ContactMessage;

class DashboardStatsWidget extends BaseStatsOverviewWidget
{
    protected ?string $heading = 'Dashboard Stats';
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $today = now()->startOfDay();

        $todayRevenue = Order::where('created_at', '>=', $today)->sum('total');
        $totalRevenue = Order::sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $upcomingReservations = Reservation::whereDate('reservation_date', '>=', now()->toDateString())->count();
        $unreadMessages = ContactMessage::where('status', 'pending')->count();

        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('All time'),

            Stat::make("Today's Revenue", '$' . number_format($todayRevenue, 2))
                ->description('Since midnight'),

            Stat::make('Total Orders', $totalOrders)
                ->description('All time'),

            Stat::make('Pending Orders', $pendingOrders)
                ->description('Awaiting fulfillment'),

            Stat::make('Upcoming Reservations', $upcomingReservations)
                ->description('Confirmed/Upcoming'),

            Stat::make('Unread Messages', $unreadMessages)
                ->description('New messages'),
        ];
    }
}
