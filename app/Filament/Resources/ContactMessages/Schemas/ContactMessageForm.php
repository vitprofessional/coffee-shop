<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')->required()->maxLength(191),
                    TextInput::make('email')->email()->required()->maxLength(191),
                    TextInput::make('phone')->maxLength(20),
                    TextInput::make('subject')->maxLength(191),
                    Textarea::make('message')->rows(4)->required(),
                    Select::make('status')->options(['pending'=>'Pending','read'=>'Read','archived'=>'Archived'])->default('pending'),
                ])
            ]);
    }
}
