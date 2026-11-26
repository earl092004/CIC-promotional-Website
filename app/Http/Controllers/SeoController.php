<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Program;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /articles/*/preview\nSitemap: ".rtrim(config('app.url'), '/')."/sitemap.xml\n", 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    public function sitemap(): Response
    {
        $urls = collect([
            route('home'),
            route('about.index'),
            route('mission-vision.index'),
            route('admissions.index'),
            route('contact.index'),
            route('articles.index'),
            route('gallery.index'),
            route('programs.index'),
        ])->merge(
            Article::published()
                ->where(function ($query): void {
                    $query->where('type', '!=', Article::TYPE_ANNOUNCEMENT)
                        ->orWhereNull('featured_until')
                        ->orWhereDate('featured_until', '>=', now()->toDateString());
                })
                ->get(['slug', 'updated_at'])
                ->map(fn (Article $article): array => [
                    'loc' => route('articles.show', $article),
                    'lastmod' => $article->updated_at?->toAtomString(),
                ])
        )->merge(
            Program::query()
                ->where('is_published', true)
                ->get(['slug', 'updated_at'])
                ->map(fn (Program $program): array => [
                    'loc' => route('programs.show', $program),
                    'lastmod' => $program->updated_at?->toAtomString(),
                ])
        )->map(fn (string|array $url): array => is_string($url)
            ? ['loc' => $url, 'lastmod' => null]
            : $url);

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
