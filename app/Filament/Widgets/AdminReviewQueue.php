<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\Widget;

class AdminReviewQueue extends Widget
{
    protected string $view = 'filament.widgets.admin-review-queue';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -1;

    public static function canView(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    protected function getViewData(): array
    {
        $articles = Article::query()->with('author:id,name');

        return [
            'submittedArticles' => (clone $articles)
                ->where('status', Article::STATUS_SUBMITTED)
                ->latest('submitted_at')
                ->limit(5)
                ->get(),
            'revisionRequests' => (clone $articles)
                ->where('status', Article::STATUS_CHANGES_REQUESTED)
                ->latest('updated_at')
                ->limit(5)
                ->get(),
            'expiringAnnouncements' => (clone $articles)
                ->activeFeatured()
                ->whereDate('featured_until', '<=', now()->addDays(7)->toDateString())
                ->orderBy('featured_until')
                ->limit(5)
                ->get(),
        ];
    }
}
