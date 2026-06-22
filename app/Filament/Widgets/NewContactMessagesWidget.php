<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\ContactMessage;

class NewContactMessagesWidget extends Widget
{
    protected string $view = 'filament.widgets.new-contact-messages-widget';

    public int $count = 0;

    public function mount(): void
    {
        // status 'pending' considered new
        $this->count = ContactMessage::where('status', 'pending')->count();
    }
}
