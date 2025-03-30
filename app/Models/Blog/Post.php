<?php

namespace App\Models\Blog;

use App\Enums\PostStatus;
use App\Traits\HasTags;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $id
 * @property string $blog_author_id
 * @property ?string $blog_category_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property ?CarbonInterface $published_at
 * @property PostStatus $status
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property ?CarbonInterface $deleted_at
 * @property Author $author
 * @property Category $category
 */
class Post extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Blog\PostFactory> */
    use HasFactory;
    use HasTags;
    use HasUlids;
    use InteractsWithMedia;
    use MassPrunable;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'blog_author_id',
        'blog_category_id',
        'title',
        'slug',
        'content',
        'published_at',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'status' => PostStatus::class,
        ];
    }

    /** @return BelongsTo<Author, $this> */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'blog_author_id');
    }

    /** @return BelongsTo<Category, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }

    /**
     * Get the prunable model query.
     *
     * @return Builder<Post>
     */
    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }

    /**
     * Determine if the post is published.
     */
    public function isPublished(): bool
    {
        return $this->status === PostStatus::Published && $this->published_at?->isPast();
    }

    /**
     * Return a preview of the post's content.
     */
    public function getShortBody(int $words = 30): string
    {
        return Str::words(strip_tags($this->content), $words);
    }

    /**
     * Return the post's media object.
     */
    public function getImage(): ?Media
    {
        return $this->getFirstMedia('post-images');
    }

    /**
     * Return the post's image URL.
     */
    public function getImageUrl(string $conversionName = ''): ?string
    {
        return $this->getFirstMediaUrl('post-images', $conversionName);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('post-images')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->nonQueued()
            ->fit(Fit::Crop, 80, 80)
            ->sharpen(10);
    }
}
