<?php

namespace App\Filament\Resources\BlogPosts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;

class BlogPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->rounded()->size(64),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                BadgeColumn::make('is_published')->enum([1=>'Published',0=>'Draft'])->colors(['success'=>1,'secondary'=>0])->sortable(),
                TextColumn::make('published_at')->dateTime()->label('Published At'),
            ])
            ->filters([
                SelectFilter::make('blog_category_id')->relationship('category','name')->label('Category'),
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
