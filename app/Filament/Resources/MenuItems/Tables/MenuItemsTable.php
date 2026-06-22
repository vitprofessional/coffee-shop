<?php

namespace App\Filament\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Image')->rounded()->size(48),
                TextColumn::make('name')->searchable()->sortable()->label('Name'),
                TextColumn::make('category.name')->label('Category')->searchable()->sortable(),
                TextColumn::make('price')->label('Price')->formatStateUsing(fn($state) => $state !== null ? number_format($state,2) : null)->sortable(),
                TextColumn::make('is_available')
                    ->label('Available')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    ->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                SelectFilter::make('menu_category_id')->relationship('category','name')->label('Category'),
                Filter::make('featured')->query(fn($query)=>$query->where('is_featured',true))->label('Featured'),
                Filter::make('popular')->query(fn($query)=>$query->where('is_popular',true))->label('Popular'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
