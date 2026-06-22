<?php

namespace App\Filament\Resources\MenuCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class MenuCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(191)
                            ->placeholder('Category name')
                            ->columnSpan('full')
                            ->reactive()
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', \Str::slug($state ?? ''))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(191),
                        Textarea::make('description')
                            ->rows(3)
                            ->maxLength(65535),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
            ]);
    }
}
