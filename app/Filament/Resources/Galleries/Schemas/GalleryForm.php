<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('title')->required()->maxLength(191),
                    FileUpload::make('image')->image()->disk('public')->directory('galleries')->required()->imagePreviewHeight('150')->maxSize(2048),
                    TextInput::make('category')->maxLength(191),
                    Toggle::make('is_active')->label('Active')->default(true),
                ])
            ]);
    }
}
