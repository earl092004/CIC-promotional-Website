<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Preview article')
                ->icon('heroicon-o-eye')
                ->url(fn (Article $record): string => route('articles.preview', $record))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
