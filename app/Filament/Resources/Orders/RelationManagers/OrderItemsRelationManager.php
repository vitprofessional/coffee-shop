<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'item_name';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_name')->label('Item')->searchable()->sortable(),
                TextColumn::make('quantity')->label('Qty')->sortable(),
                TextColumn::make('price')->label('Unit Price')->formatStateUsing(fn($state) => $state !== null ? number_format($state,2) : null)->sortable(),
                TextColumn::make('subtotal')->label('Subtotal')->formatStateUsing(fn($state) => $state !== null ? number_format($state,2) : null)->sortable(),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
