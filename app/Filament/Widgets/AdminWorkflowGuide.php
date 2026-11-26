<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\Widget;

class AdminWorkflowGuide extends Widget
{
    protected string $view = 'filament.widgets.admin-workflow-guide';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -2;

    protected function getViewData(): array
    {
        $user = auth()->user();

        return [
            'isContributor' => $user?->isContributor() ?? false,
            'submittedCount' => Article::query()
                ->when($user?->isContributor(), fn ($query) => $query->where('author_id', $user->id))
                ->where('status', Article::STATUS_SUBMITTED)
                ->count(),
            'changesRequestedCount' => Article::query()
                ->when($user?->isContributor(), fn ($query) => $query->where('author_id', $user->id))
                ->where('status', Article::STATUS_CHANGES_REQUESTED)
                ->count(),
            'submittedArticlesUrl' => route('filament.admin.resources.articles.index', [
                'tableFilters[status][value]' => Article::STATUS_SUBMITTED,
            ]),
            'changesRequestedArticlesUrl' => route('filament.admin.resources.articles.index', [
                'tableFilters[status][value]' => Article::STATUS_CHANGES_REQUESTED,
            ]),
        ];
    }
}
