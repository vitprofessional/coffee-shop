<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('customer_name')->required()->maxLength(191),
                    FileUpload::make('customer_image')->image()->disk('public')->directory('testimonials')->maxSize(2048),
                    TextInput::make('rating')->numeric()->minValue(1)->maxValue(5),
                    Textarea::make('review')->rows(4),
                    Toggle::make('is_active')->label('Active')->default(true),
                ])
            ]);
    }
}
