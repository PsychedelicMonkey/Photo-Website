<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $id
 * @property string $name
 * @property string $gender
 * @property ?string $bio
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Model extends EloquentModel implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ModelFactory> */
    use HasFactory;
    use HasUlids;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'portfolio_models';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'gender',
        'bio',
    ];

    /** @return HasMany<Album, $this> */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'portfolio_model_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('model-avatars')
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
