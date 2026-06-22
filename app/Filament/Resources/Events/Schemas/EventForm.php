<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Card::make()->schema([
                    TextInput::make('title')->required()->maxLength(191),
                    TextInput::make('slug')->required()->maxLength(191),
                    Textarea::make('description')->rows(4),
                    FileUpload::make('image')->image()->disk('public')->directory('events')->maxSize(2048),
                    DatePicker::make('event_date')->required(),
                    TimePicker::make('event_time')->required(),
                    TextInput::make('location')->maxLength(191),
                    TextInput::make('price')->numeric()->minValue(0)->step(0.01)->label('Price'),
                    Toggle::make('is_active')->label('Active')->default(true),
                ])
            ]);
    }
}
