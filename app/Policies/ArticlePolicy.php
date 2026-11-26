<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdministrator() || $user->isContributor();
    }

    public function view(User $user, Article $article): bool
    {
        return $user->isAdministrator() || $article->author_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator() || $user->isContributor();
    }

    public function update(User $user, Article $article): bool
    {
        return $user->isAdministrator()
            || ($article->author_id === $user->id
                && in_array($article->status, [
                    Article::STATUS_DRAFT,
                    Article::STATUS_CHANGES_REQUESTED,
                ], true));
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->isAdministrator()
            || ($article->author_id === $user->id && $article->status === Article::STATUS_DRAFT);
    }

    public function restore(User $user, Article $article): bool
    {
        return $user->isAdministrator();
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return $user->isAdministrator();
    }

    public function submit(User $user, Article $article): bool
    {
        return $user->isContributor()
            && $article->author_id === $user->id
            && in_array($article->status, [
                Article::STATUS_DRAFT,
                Article::STATUS_CHANGES_REQUESTED,
            ], true);
    }

    public function requestChanges(User $user, Article $article): bool
    {
        return $user->isAdministrator() && $article->status === Article::STATUS_SUBMITTED;
    }

    public function publish(User $user, Article $article): bool
    {
        return $user->isAdministrator()
            && in_array($article->status, [
                Article::STATUS_DRAFT,
                Article::STATUS_SUBMITTED,
                Article::STATUS_UNPUBLISHED,
            ], true);
    }

    public function unpublish(User $user, Article $article): bool
    {
        return $user->isAdministrator() && $article->status === Article::STATUS_PUBLISHED;
    }

    public function archive(User $user, Article $article): bool
    {
        return $user->isAdministrator()
            && in_array($article->status, [
                Article::STATUS_DRAFT,
                Article::STATUS_PUBLISHED,
                Article::STATUS_UNPUBLISHED,
            ], true);
    }
}
