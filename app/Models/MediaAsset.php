<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Support\MediaStorage;

class MediaAsset extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::updated(function (self $asset): void {
            $originalPath = $asset->getOriginal('file_path');

            if ($originalPath !== $asset->file_path) {
                MediaStorage::deleteIfUnreferenced($originalPath);
            }
        });

        static::deleted(function (self $asset): void {
            MediaStorage::deleteIfUnreferenced($asset->file_path);
        });
    }

    protected $fillable = [
        'file_path',
        'title',
        'alt_text',
        'caption',
        'is_gallery_item',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'is_gallery_item' => 'boolean',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
