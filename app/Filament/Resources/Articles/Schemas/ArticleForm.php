<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, callable $set): void {
                                if (filled($state)) {
                                    $set('slug', str()->slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->alphaDash()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('The readable web address for this article. It is generated from the title and can be adjusted.'),
                        Select::make('type')
                            ->options([
                                Article::TYPE_ANNOUNCEMENT => 'Announcement',
                                Article::TYPE_NEWS => 'News',
                                Article::TYPE_BLOG => 'Blog',
                                Article::TYPE_ACHIEVEMENT => 'Achievement',
                            ])
                            ->required(),
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('A short summary shown on story cards and search results. Aim for one or two sentences.')
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->required()
                            ->fileAttachmentsDisk('media')
                            ->fileAttachmentsDirectory('article-content')
                            ->helperText('Use the editor toolbar to upload photos into the article body. They appear with the article, below its cover image.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
                Section::make('Cover image')
                    ->schema([
                        FileUpload::make('cover_image_path')
                            ->label('Cover image')
                            ->image()
                            ->disk('media')
                            ->directory('article-covers')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->imageEditor()
                            ->columnSpanFull(),
                        TextInput::make('cover_image_alt')
                            ->label('Alternative text')
                            ->required(fn (Get $get): bool => filled($get('cover_image_path')))
                            ->maxLength(255)
                            ->helperText('Required when a cover image is uploaded. Describe the image for visitors using assistive technology.'),
                    ])
                    ->columns(1),
                Section::make('Publishing')
                    ->schema([
                        DatePicker::make('featured_until')
                            ->label('Featured until')
                            ->helperText('Administrators can use this for time-limited announcements.'),
                    ])
                    ->columns(2),
            ]);
    }
}
