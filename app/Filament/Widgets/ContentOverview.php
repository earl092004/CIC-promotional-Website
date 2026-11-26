<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\MediaAsset;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        if ($user?->isContributor()) {
            $articles = Article::query()->where('author_id', $user->id);
            $media = MediaAsset::query()->where('uploaded_by', $user->id);

            return [
                Stat::make('My published articles', (clone $articles)->published()->count())
                    ->description('Visible on the public site')
                    ->color('success'),
                Stat::make('My drafts', (clone $articles)->where('status', Article::STATUS_DRAFT)->count())
                    ->description('Continue working before submission')
                    ->color('info')
                    ->url(route('filament.admin.resources.articles.index', ['tableFilters[status][value]' => Article::STATUS_DRAFT])),
                Stat::make('My submitted articles', (clone $articles)->where('status', Article::STATUS_SUBMITTED)->count())
                    ->description('Awaiting administrator review')
                    ->color('warning')
                    ->url(route('filament.admin.resources.articles.index', ['tableFilters[status][value]' => Article::STATUS_SUBMITTED])),
                Stat::make('My gallery assets', $media->where('is_gallery_item', true)->count())
                    ->description('Available for public gallery use')
                    ->color('gray'),
            ];
        }

        return [
            Stat::make('Published articles', Article::query()->published()->count())
                ->description('Visible on the public site')
                ->color('success')
                ->url(route('filament.admin.resources.articles.index', ['tableFilters[status][value]' => Article::STATUS_PUBLISHED])),
            Stat::make('Awaiting review', Article::query()->where('status', Article::STATUS_SUBMITTED)->count())
                ->description('Need administrator attention')
                ->color('warning')
                ->url(route('filament.admin.resources.articles.index', ['tableFilters[status][value]' => Article::STATUS_SUBMITTED])),
            Stat::make('Changes requested', Article::query()->where('status', Article::STATUS_CHANGES_REQUESTED)->count())
                ->description('Waiting for contributor updates')
                ->color('danger')
                ->url(route('filament.admin.resources.articles.index', ['tableFilters[status][value]' => Article::STATUS_CHANGES_REQUESTED])),
            Stat::make('Expiring soon', Article::query()
                ->activeFeatured()
                ->whereDate('featured_until', '<=', now()->addDays(7)->toDateString())
                ->count())
                ->description('Featured announcements in the next 7 days')
                ->color('warning')
                ->url(route('filament.admin.resources.articles.index', ['tableFilters[active_featured]' => true])),
            Stat::make('Gallery assets', MediaAsset::query()->where('is_gallery_item', true)->count())
                ->description('Available for public gallery use')
                ->color('info')
                ->url(route('filament.admin.resources.media-assets.index')),
        ];
    }
}
