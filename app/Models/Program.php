<?php

namespace App\Models;

use App\Support\MediaStorage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::updated(function (self $program): void {
            $originalPaths = $program->getOriginal('image_paths') ?: [];
            $currentPaths = $program->image_paths ?: [];

            foreach (array_diff($originalPaths, $currentPaths) as $path) {
                MediaStorage::deleteIfUnreferenced($path);
            }
        });

        static::deleted(function (self $program): void {
            foreach ($program->image_paths ?: [] as $path) {
                MediaStorage::deleteIfUnreferenced($path);
            }
        });
    }

    protected $fillable = [
        'name',
        'slug',
        'overview',
        'laboratory_description',
        'image_paths',
        'image_alts',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'image_paths' => 'array',
            'image_alts' => 'array',
            'is_published' => 'boolean',
        ];
    }
}
