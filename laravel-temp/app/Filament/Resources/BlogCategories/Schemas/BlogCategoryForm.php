<?php

namespace App\Filament\Resources\BlogCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class BlogCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Card::make()->schema([
                    TextInput::make('name')->required()->maxLength(191),
                    TextInput::make('slug')->required()->maxLength(191),
                    Textarea::make('description')->rows(3),
                    Toggle::make('is_active')->label('Active')->default(true),
                ])
            ]);
    }
}
