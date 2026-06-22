<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('name')->required()->maxLength(191)->columnSpan('full'),
                        TextInput::make('slug')->required()->maxLength(191),
                        Select::make('menu_category_id')->relationship('category','name')->searchable()->preload()->required(),
                        TextInput::make('price')->numeric()->required()->minValue(0)->step(0.01)->label('Price'),
                    ])->columns(2),
                    Textarea::make('description')->rows(4)->columnSpan('full'),
                    FileUpload::make('image')->image()->disk('public')->directory('menu_items')->visibility('public')->imagePreviewHeight('150')->maxSize(2048),
                    Toggle::make('is_available')->label('Available')->default(true),
                    Toggle::make('is_featured')->label('Featured')->default(false),
                    Toggle::make('is_popular')->label('Popular')->default(false),
                    TextInput::make('sort_order')->numeric()->default(0)->label('Sort Order'),
                ])
            ]);
    }
}
