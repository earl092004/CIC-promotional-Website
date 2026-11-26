<?php

namespace App\Support;

use App\Models\Article;
use App\Models\MediaAsset;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

class MediaStorage
{
    public static function deleteIfUnreferenced(?string $path): void
    {
        if (blank($path) || self::isReferenced($path)) {
            return;
        }

        Storage::disk('media')->delete($path);
    }

    private static function isReferenced(string $path): bool
    {
        if (Article::query()->where('cover_image_path', $path)->exists()) {
            return true;
        }

        if (Article::query()->where('content', 'like', '%'.$path.'%')->exists()) {
            return true;
        }

        if (MediaAsset::query()->where('file_path', $path)->exists()) {
            return true;
        }

        return Program::query()
            ->whereJsonContains('image_paths', $path)
            ->exists();
    }
}
