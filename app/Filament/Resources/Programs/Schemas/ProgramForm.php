<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Program details')->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->alphaDash()->unique(ignoreRecord: true)->helperText('Used in the public program page URL.'),
                Textarea::make('overview')->required()->rows(4)->maxLength(1000)->columnSpanFull(),
                Textarea::make('laboratory_description')->required()->rows(5)->maxLength(1500)->columnSpanFull()->helperText('Describe the approved facilities without adding unverified claims.'),
            ])->columns(2),
            Section::make('Laboratory and campus images')->schema([
                FileUpload::make('image_paths')
                    ->label('Program images')
                    ->multiple()
                    ->reorderable()
                    ->minFiles(1)
                    ->maxFiles(5)
                    ->image()
                    ->disk('media')
                    ->directory('programs')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imageEditor()
                    ->columnSpanFull()
                    ->helperText('Upload 1–5 approved laboratory or campus images.'),
                Textarea::make('image_alts')
                    ->label('Image alternative text')
                    ->rows(5)
                    ->helperText('Enter one description per image, in the same order as the uploads.')
                    ->columnSpanFull(),
                Toggle::make('is_published')->label('Show on public site')->default(true),
            ])->columns(1),
        ]);
    }
}
