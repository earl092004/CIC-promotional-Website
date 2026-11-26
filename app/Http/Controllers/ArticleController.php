<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $types = [
            Article::TYPE_ANNOUNCEMENT,
            Article::TYPE_NEWS,
            Article::TYPE_BLOG,
            Article::TYPE_ACHIEVEMENT,
        ];
        $type = $request->string('type')->toString();
        $search = trim($request->string('q')->toString());
        $featured = null;
        $featuredLabel = 'Latest story';

        if ($search === '' && $type === '') {
            $featured = Article::query()
                ->activeFeatured()
                ->with('author')
                ->latest('published_at')
                ->first();

            if ($featured) {
                $featuredLabel = 'Featured story';
            } else {
                $featured = Article::query()
                    ->publiclyVisible()
                    ->with('author')
                    ->latest('published_at')
                    ->first();
            }
        }

        $articles = Article::query()
            ->publiclyVisible()
            ->when($featured, fn ($query) => $query->whereKeyNot($featured->getKey()))
            ->when(in_array($type, $types, true), fn ($query) => $query->where('type', $type))
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search): void {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            }))
            ->with('author')
            ->latest('published_at')
            ->paginate(8)
            ->withQueryString();

        $displayFeatured = $featured !== null && $request->integer('page', 1) === 1;

        return view('articles.index', compact('articles', 'displayFeatured', 'featured', 'featuredLabel', 'search', 'type'));
    }

    public function show(Article $article): View
    {
        abort_unless($article->status === Article::STATUS_PUBLISHED, 404);

        return $this->renderArticle($article, false);
    }

    public function preview(Article $article): View
    {
        Gate::authorize('view', $article);

        return $this->renderArticle($article, true);
    }

    private function renderArticle(Article $article, bool $isPreview): View
    {
        $article->content = $this->sanitizeContent($article->content);

        $relatedArticles = Article::query()
            ->publiclyVisible()
            ->whereKeyNot($article->getKey())
            ->where('type', $article->type)
            ->latest('published_at')
            ->limit(3)
            ->get();

        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::query()
                ->publiclyVisible()
                ->whereKeyNot($article->getKey())
                ->latest('published_at')
                ->limit(3)
                ->get();
        }

        return view('articles.show', compact('article', 'isPreview', 'relatedArticles'));
    }

    private function sanitizeContent(string $content): string
    {
        $content = strip_tags($content, '<p><br><strong><em><ul><ol><li><h2><h3><blockquote><img>');

        return preg_replace_callback('/<img\b([^>]*)>/i', function (array $matches): string {
            preg_match('/\bsrc\s*=\s*(["\'])(.*?)\1/i', $matches[1], $srcMatch);
            preg_match('/\balt\s*=\s*(["\'])(.*?)\1/i', $matches[1], $altMatch);
            $src = html_entity_decode($srcMatch[2] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $alt = html_entity_decode($altMatch[2] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $path = $this->allowedImagePath($src);

            return $path === null ? '' : '<img src="'.e($path).'" alt="'.e($alt).'">';
        }, $content) ?? '';
    }

    private function allowedImagePath(string $src): ?string
    {
        $imageUrl = parse_url($src);
        $applicationUrl = parse_url(config('app.url'));

        if ($imageUrl === false || ! isset($imageUrl['path'])) {
            return null;
        }

        if (isset($imageUrl['host']) || isset($imageUrl['scheme'])) {
            if (
                ! isset($imageUrl['host'], $applicationUrl['host'])
                || strtolower($imageUrl['scheme'] ?? '') !== strtolower($applicationUrl['scheme'] ?? '')
                || strtolower($imageUrl['host']) !== strtolower($applicationUrl['host'])
                || ($imageUrl['port'] ?? null) !== ($applicationUrl['port'] ?? null)
                || isset($imageUrl['user'])
                || isset($imageUrl['pass'])
            ) {
                return null;
            }
        }

        $decodedPath = rawurldecode($imageUrl['path']);

        if (
            (! str_starts_with($decodedPath, '/storage/') && ! str_starts_with($decodedPath, '/media/'))
            || preg_match('#(?:^|/)\.\.?(/|$)#', $decodedPath)
            || str_contains($decodedPath, '\\')
        ) {
            return null;
        }

        $storagePath = str_starts_with($decodedPath, '/storage/')
            ? substr($imageUrl['path'], strlen('/storage/'))
            : substr($imageUrl['path'], strlen('/media/'));

        if (Storage::disk('media')->exists($storagePath)) {
            return '/media/'.$storagePath;
        }

        if (str_starts_with($decodedPath, '/storage/') && Storage::disk('public')->exists($storagePath)) {
            return '/storage/'.$storagePath;
        }

        return null;
    }
}
