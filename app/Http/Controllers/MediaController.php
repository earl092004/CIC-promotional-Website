<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\MediaAsset;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function show(Request $request, string $path): StreamedResponse
    {
        abort_if(str_contains($path, '..') || str_starts_with($path, '/') || str_contains($path, '\\'), 404);

        $disk = Storage::disk('media');
        abort_unless($disk->exists($path), 404);

        abort_unless($this->isPublicPath($path), 404);

        $stream = $disk->readStream($path);
        abort_unless(is_resource($stream), 404);

        return response()->stream(static function () use ($stream): void {
            try {
                fpassthru($stream);
            } finally {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $disk->mimeType($path) ?: 'application/octet-stream',
            'Cache-Control' => 'public, max-age=3600',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    private function isPublicPath(string $path): bool
    {
        $article = Article::query()
            ->where('cover_image_path', $path)
            ->first();

        if ($article && ($article->status === Article::STATUS_PUBLISHED
            || auth()->user()?->isAdministrator()
            || $article->author_id === auth()->id())) {
            return true;
        }

        $asset = MediaAsset::query()
            ->where('file_path', $path)
            ->first();

        if ($asset && ($asset->is_gallery_item
            || auth()->user()?->isAdministrator()
            || $asset->uploaded_by === auth()->id())) {
            return true;
        }

        $inlineArticle = Article::query()
            ->where('content', 'like', '%'.$path.'%')
            ->get(['id', 'content', 'status', 'author_id'])
            ->first(fn (Article $article): bool => $this->articleReferencesImage($article->content, $path));

        if ($inlineArticle && ($inlineArticle->status === Article::STATUS_PUBLISHED
            || auth()->user()?->isAdministrator()
            || $inlineArticle->author_id === auth()->id())) {
            return true;
        }

        $program = Program::query()
            ->whereJsonContains('image_paths', $path)
            ->first();

        return $program && ($program->is_published || auth()->user()?->isAdministrator());
    }

    private function articleReferencesImage(string $content, string $path): bool
    {
        preg_match_all('/<img\b[^>]*>/i', $content, $images);

        foreach ($images[0] as $image) {
            preg_match('/\bsrc\s*=\s*(["\'])(.*?)\1/i', $image, $srcMatch);
            $src = html_entity_decode($srcMatch[2] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $imageUrl = parse_url($src);
            $applicationUrl = parse_url(config('app.url'));

            if ($imageUrl === false || ! isset($imageUrl['path'])) {
                continue;
            }

            if (isset($imageUrl['host']) || isset($imageUrl['scheme'])) {
                if (
                    ! isset($imageUrl['host'], $applicationUrl['host'])
                    || strtolower($imageUrl['scheme'] ?? '') !== strtolower($applicationUrl['scheme'] ?? '')
                    || strtolower($imageUrl['host']) !== strtolower($applicationUrl['host'])
                    || ($imageUrl['port'] ?? null) !== ($applicationUrl['port'] ?? null)
                ) {
                    continue;
                }
            }

            if ($imageUrl['path'] === '/media/'.$path || $imageUrl['path'] === '/storage/'.$path) {
                return true;
            }
        }

        return false;
    }
}
