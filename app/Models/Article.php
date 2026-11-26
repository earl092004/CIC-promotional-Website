<?php

namespace App\Models;

use App\Support\MediaStorage;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        static::updated(function (self $article): void {
            $originalPath = $article->getOriginal('cover_image_path');

            if ($originalPath !== $article->cover_image_path) {
                MediaStorage::deleteIfUnreferenced($originalPath);
            }
        });

        static::deleted(function (self $article): void {
            MediaStorage::deleteIfUnreferenced($article->cover_image_path);
        });
    }

    public const TYPE_ANNOUNCEMENT = 'announcement';

    public const TYPE_NEWS = 'news';

    public const TYPE_BLOG = 'blog';

    public const TYPE_ACHIEVEMENT = 'achievement';

    public const STATUS_DRAFT = 'draft';

    public const STATUS_SUBMITTED = 'submitted';

    public const STATUS_CHANGES_REQUESTED = 'changes_requested';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_ARCHIVED = 'archived';

    public const STATUS_UNPUBLISHED = 'unpublished';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'content',
        'cover_image_path',
        'cover_image_alt',
        'status',
        'author_id',
        'reviewer_id',
        'revision_notes',
        'featured_until',
        'submitted_at',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'featured_until' => 'date',
            'submitted_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeActiveFeatured(Builder $query): Builder
    {
        return $query->published()
            ->whereNotNull('featured_until')
            ->whereDate('featured_until', '>=', now()->toDateString());
    }

    public function scopePubliclyVisible(Builder $query): Builder
    {
        return $query->published()
            ->where(function (Builder $query): void {
                $query->where('type', '!=', self::TYPE_ANNOUNCEMENT)
                    ->orWhereNull('featured_until')
                    ->orWhereDate('featured_until', '>=', now()->toDateString());
            });
    }

    public function readingTimeMinutes(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($this->content)) / 200));
    }
}
