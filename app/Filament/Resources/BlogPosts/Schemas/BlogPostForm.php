<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('title')->required()->maxLength(191),
                    TextInput::make('slug')->required()->maxLength(191),
                    Select::make('blog_category_id')->relationship('category','name')->preload()->searchable()->required(),
                    TextInput::make('excerpt')->maxLength(500),
                    RichEditor::make('content')->required(),
                    FileUpload::make('image')->image()->disk('public')->directory('blog')->maxSize(2048),
                    Toggle::make('is_published')->label('Published')->default(false),
                    DateTimePicker::make('published_at')->label('Publish At'),
                ])
            ]);
    }
}
