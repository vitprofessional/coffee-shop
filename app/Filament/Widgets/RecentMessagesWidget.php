<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\ContactMessage;

class RecentMessagesWidget extends TableWidget
{
    protected static ?string $heading = 'Recent Messages';
    protected int|string|array $columnSpan = 1;

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->limit(8))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('subject')->limit(50),
                TextColumn::make('created_at')->since(),
            ]);
    }
}
