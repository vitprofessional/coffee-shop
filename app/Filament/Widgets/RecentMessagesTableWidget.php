<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\ContactMessage;

class RecentMessagesTableWidget extends TableWidget
{
    protected static ?string $heading = 'Recent Messages';

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->limit(6))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('subject')->limit(50),
                TextColumn::make('created_at')->since(),
            ])
            ;
    }
}
