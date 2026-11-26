<?php

namespace App\Filament\Resources\MediaAssets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MediaAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Image asset')->schema([
                FileUpload::make('file_path')
                    ->label('Image')
                    ->required()
                    ->image()
                    ->disk('media')
                    ->directory('gallery')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('A short internal and public-facing name for this image.'),
                TextInput::make('alt_text')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Describe the image for visitors using assistive technology.'),
                Textarea::make('caption')->rows(3)->maxLength(500),
                Toggle::make('is_gallery_item')->label('Show in public gallery')->default(true),
            ])->columns(1),
        ]);
    }
}
