<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
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
                BadgeColumn::make('status')->enum(['pending'=>'Pending','processing'=>'Processing','completed'=>'Completed','cancelled'=>'Cancelled'])->colors(['warning'=>'pending','primary'=>'processing','success'=>'completed','danger'=>'cancelled'])->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')->options(['pending'=>'Pending','processing'=>'Processing','completed'=>'Completed','cancelled'=>'Cancelled']),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
