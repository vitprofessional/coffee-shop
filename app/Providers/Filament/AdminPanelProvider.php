<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\ExecutiveStatsWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\OrdersChartWidget;
use App\Filament\Widgets\ReservationsChartWidget;
use App\Filament\Widgets\RecentOrdersTableWidget;
use App\Filament\Widgets\RecentReservationsTableWidget;
use App\Filament\Widgets\RecentMessagesTableWidget;
use App\Filament\Widgets\BusinessSnapshotWidget;
use App\Filament\Widgets\QuickActionsWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                // Executive overview (6 stats)
                ExecutiveStatsWidget::class,

                // Analytics charts
                RevenueChartWidget::class,
                OrdersChartWidget::class,

                // Reservations chart + snapshot
                ReservationsChartWidget::class,
                BusinessSnapshotWidget::class,

                // Quick actions
                QuickActionsWidget::class,

                // Recent activity tables
                RecentOrdersTableWidget::class,
                RecentReservationsTableWidget::class,
                RecentMessagesTableWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
