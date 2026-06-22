<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\Order;
use Filament\Tables\Columns\BadgeColumn;

class RecentOrdersTableWidget extends TableWidget
{
    protected static ?string $heading = 'Recent Orders';

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(Order::query()->latest()->limit(6))
            ->columns([
                TextColumn::make('order_number')->label('Order #'),
                TextColumn::make('customer_name'),
                TextColumn::make('total')->money('USD'),
                TextColumn::make('created_at')->label('When')->since(),
                BadgeColumn::make('status'),
            ])
            ;
    }
}
