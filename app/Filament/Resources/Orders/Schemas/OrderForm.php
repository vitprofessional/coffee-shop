<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Card::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('order_number')->disabled(),
                        TextInput::make('customer_name')->required()->maxLength(191),
                        TextInput::make('phone')->tel()->maxLength(20),
                        TextInput::make('email')->email()->maxLength(191),
                    ])->columns(2),
                    Textarea::make('address')->rows(3),
                    Grid::make()->schema([
                        TextInput::make('subtotal')->numeric()->disabled()->label('Subtotal')->formatStateUsing(fn($state)=> $state !== null ? number_format($state,2) : null),
                        TextInput::make('delivery_charge')->numeric()->disabled()->label('Delivery'),
                        TextInput::make('total')->numeric()->disabled()->label('Total'),
                    ])->columns(3),
                    Select::make('status')->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->required(),
                    Textarea::make('notes')->rows(3),
                ])
            ]);
    }
}
