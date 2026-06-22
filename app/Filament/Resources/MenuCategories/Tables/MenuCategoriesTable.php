<?php

namespace App\Filament\Resources\MenuCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\Filter;

class MenuCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->label('Name'),
                TextColumn::make('slug')->searchable()->sortable()->label('Slug'),
                BadgeColumn::make('is_active')->label('Active')->enum([1 => 'Active', 0 => 'Inactive'])->colors(['success' => 1, 'secondary' => 0])->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                Filter::make('active')->label('Active')->query(fn($query) => $query->where('is_active', true)),
                TrashedFilter::make(),
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
