<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('customer_image')->rounded()->size(48),
                TextColumn::make('customer_name')->searchable()->sortable(),
                TextColumn::make('rating')->sortable(),
                TextColumn::make('review')->limit(50),
                BadgeColumn::make('is_active')->enum([1=>'Active',0=>'Inactive'])->colors(['success'=>1,'secondary'=>0]),
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
