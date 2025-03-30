<?php

namespace App\Models\Portfolio;

use App\Models\Portfolio\Model as PortfolioModel;
use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Album extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Portfolio\AlbumFactory> */
    use HasFactory;
    use HasTags;
    use HasUlids;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'portfolio_albums';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'portfolio_model_id',
        'title',
        'slug',
        'description',
        'location',
        'shooting_date',
        'is_visible',
        'is_featured',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'shooting_date' => 'date',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    /** @return BelongsTo<PortfolioModel, $this> */
    public function model(): BelongsTo
    {
        return $this->belongsTo(PortfolioModel::class, 'portfolio_model_id');
    }

    public function isVisible(): bool
    {
        return $this->is_visible;
    }

    public function getShootingDate(): string
    {
        return $this->shooting_date->format('F jS, Y');
    }

    public function getUploadedDate(): string
    {
        return $this->created_at->format('F jS, Y');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('album-photos');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->nonQueued()
            ->fit(Fit::Crop, 80, 80)
            ->sharpen(10);

        $this->addMediaConversion('grid')
            ->fit(Fit::Crop, 300, 300);

        $this->addMediaConversion('public')
            ->nonOptimized()
            ->fit(Fit::Contain, 1200, 1200);
    }
}
