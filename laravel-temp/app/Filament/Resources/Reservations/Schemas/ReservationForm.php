<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Card::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('name')->required()->maxLength(191),
                        TextInput::make('phone')->required()->maxLength(20),
                        TextInput::make('email')->email()->maxLength(191),
                    ])->columns(3),
                    Grid::make()->schema([
                        DatePicker::make('reservation_date')->required(),
                        TimePicker::make('reservation_time')->required(),
                        TextInput::make('guests')->numeric()->required()->minValue(1),
                    ])->columns(3),
                    Select::make('seating_preference')->options(['indoor'=>'Indoor','outdoor'=>'Outdoor','bar'=>'Bar'])->nullable(),
                    Textarea::make('special_request')->rows(3),
                    Select::make('status')->options(['pending'=>'Pending','confirmed'=>'Confirmed','cancelled'=>'Cancelled'])->required()->default('pending'),
                ])
            ]);
    }
}
