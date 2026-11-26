<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->limit(50)->wrap(),
                TextColumn::make('type')->badge()->formatStateUsing(fn (string $state): string => str($state)->headline()),
                TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    Article::STATUS_PUBLISHED => 'success',
                    Article::STATUS_SUBMITTED => 'info',
                    Article::STATUS_CHANGES_REQUESTED => 'warning',
                    Article::STATUS_ARCHIVED => 'gray',
                    Article::STATUS_UNPUBLISHED => 'warning',
                    default => 'gray',
                }),
                TextColumn::make('author.name')->label('Author')->searchable(),
                TextColumn::make('published_at')->label('Published')->dateTime()->sortable()->toggleable(),
                TextColumn::make('featured_until')->label('Featured until')->date()->sortable()->toggleable(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    Article::STATUS_DRAFT => 'Draft',
                    Article::STATUS_SUBMITTED => 'Submitted',
                    Article::STATUS_CHANGES_REQUESTED => 'Changes requested',
                    Article::STATUS_PUBLISHED => 'Published',
                    Article::STATUS_ARCHIVED => 'Archived',
                    Article::STATUS_UNPUBLISHED => 'Unpublished',
                ]),
                SelectFilter::make('type')->options([
                    Article::TYPE_ANNOUNCEMENT => 'Announcement',
                    Article::TYPE_NEWS => 'News',
                    Article::TYPE_BLOG => 'Blog',
                    Article::TYPE_ACHIEVEMENT => 'Achievement',
                ]),
                Filter::make('needs_review')
                    ->label('Needs review')
                    ->query(fn ($query) => $query->where('status', Article::STATUS_SUBMITTED)),
                Filter::make('active_featured')
                    ->label('Featured and active')
                    ->query(fn (Builder $query): Builder => $query->activeFeatured()),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('submit')
                    ->label('Submit for review')
                    ->icon('heroicon-m-paper-airplane')
                    ->visible(fn (Article $record): bool => auth()->user()?->can('submit', $record) ?? false)
                    ->requiresConfirmation()
                    ->action(function (Article $record): void {
                        Gate::authorize('submit', $record);
                        self::transition($record, Article::STATUS_SUBMITTED, ['submitted_at' => now()]);
                    }),
                Action::make('requestChanges')
                    ->label('Request changes')
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning')
                    ->visible(fn (Article $record): bool => auth()->user()?->can('requestChanges', $record) ?? false)
                    ->schema([
                        Textarea::make('revision_notes')->required()->maxLength(2000),
                    ])
                    ->action(function (Article $record, array $data): void {
                        Gate::authorize('requestChanges', $record);
                        self::transition($record, Article::STATUS_CHANGES_REQUESTED, [
                            'reviewer_id' => auth()->id(),
                            'revision_notes' => $data['revision_notes'],
                        ]);
                    }),
                Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->visible(fn (Article $record): bool => auth()->user()?->can('publish', $record) ?? false)
                    ->requiresConfirmation()
                    ->action(function (Article $record): void {
                        Gate::authorize('publish', $record);
                        self::transition($record, Article::STATUS_PUBLISHED, [
                            'reviewer_id' => auth()->id(),
                            'published_at' => now(),
                            'revision_notes' => null,
                        ]);
                    }),
                Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon('heroicon-m-x-circle')
                    ->color('warning')
                    ->visible(fn (Article $record): bool => auth()->user()?->can('unpublish', $record) ?? false)
                    ->requiresConfirmation()
                    ->action(function (Article $record): bool {
                        Gate::authorize('unpublish', $record);

                        return self::transition($record, Article::STATUS_UNPUBLISHED, [
                            'published_at' => null,
                        ]);
                    }),
                Action::make('archive')
                    ->label('Archive')
                    ->icon('heroicon-m-archive-box')
                    ->color('danger')
                    ->visible(fn (Article $record): bool => auth()->user()?->can('archive', $record) ?? false)
                    ->requiresConfirmation()
                    ->action(function (Article $record): bool {
                        Gate::authorize('archive', $record);

                        return self::transition($record, Article::STATUS_ARCHIVED);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    private static function transition(Article $article, string $status, array $attributes = []): bool
    {
        $article->update(['status' => $status, ...$attributes]);

        Notification::make()
            ->title(str($status)->headline())
            ->success()
            ->send();

        return true;
    }
}
