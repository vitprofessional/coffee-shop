<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->rounded()->size(64),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('category')->label('Category')->sortable(),
                BadgeColumn::make('is_active')->enum([1=>'Active',0=>'Inactive'])->colors(['success'=>1,'secondary'=>0])->sortable(),
            ])
            ->filters([
                Filter::make('active')->query(fn($q)=>$q->where('is_active',true))->label('Active only'),
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
