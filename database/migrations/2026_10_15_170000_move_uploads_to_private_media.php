<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        $source = Storage::disk('public');
        $destination = Storage::disk('media');

        foreach ($source->allFiles() as $path) {
            if (! $destination->exists($path)) {
                $destination->put($path, $source->get($path));
            }

            $source->delete($path);
        }

        DB::table('articles')->whereNotNull('cover_image_path')->eachById(function (object $article): void {
            DB::table('articles')
                ->where('id', $article->id)
                ->update(['cover_image_path' => self::privatePath($article->cover_image_path)]);
        });

        DB::table('media_assets')->eachById(function (object $asset): void {
            DB::table('media_assets')
                ->where('id', $asset->id)
                ->update(['file_path' => self::privatePath($asset->file_path)]);
        });

        DB::table('programs')->eachById(function (object $program): void {
            $paths = json_decode($program->image_paths ?: '[]', true);

            DB::table('programs')
                ->where('id', $program->id)
                ->update(['image_paths' => json_encode(array_map(self::privatePath(...), $paths))]);
        });

        DB::table('articles')->whereNotNull('content')->eachById(function (object $article): void {
            $content = preg_replace_callback(
                '/((?:https?:\/\/[^"\']+)?\/)storage\/([^"\']+)/i',
                fn (array $matches): string => $matches[1].'media/'.$matches[2],
                $article->content,
            );

            DB::table('articles')
                ->where('id', $article->id)
                ->update(['content' => $content]);
        });

        File::ensureDirectoryExists(storage_path('app/private/media'));
    }

    public function down(): void
    {
        // Upload bytes remain in the private disk; reversing this move could expose private media.
    }

    private static function privatePath(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return $path;
        }

        return str_starts_with($path, 'media/') ? substr($path, 6) : $path;
    }
};
