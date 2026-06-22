<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->searchable()->sortable()->label('Order #'),
                TextColumn::make('customer_name')->searchable()->sortable()->label('Customer'),
                TextColumn::make('total')->label('Total')->formatStateUsing(fn($s)=> $s !== null ? number_format($s,2) : null)->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('_', ' ', (string) $state)))
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'preparing' => 'info',
                        'approved' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')->options(['pending'=>'Pending','preparing'=>'Preparing','completed'=>'Completed','cancelled'=>'Cancelled']),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
