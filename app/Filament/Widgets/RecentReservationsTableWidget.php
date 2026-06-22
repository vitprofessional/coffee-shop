<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\Reservation;

class RecentReservationsTableWidget extends TableWidget
{
    protected static ?string $heading = 'Recent Reservations';

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(Reservation::query()->latest()->limit(6))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('guests')->label('Guests'),
                TextColumn::make('reservation_date')->date(),
                TextColumn::make('created_at')->since(),
            ])
            ;
    }
}
