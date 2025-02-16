<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Profile extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    use HasUlids;
    use InteractsWithMedia;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'bio',
        'is_public',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the profile's avatar object.
     */
    public function getAvatar(): ?Media
    {
        return $this->getFirstMedia('profile-avatars');
    }

    /**
     * Get the profile's avatar URL.
     */
    public function getAvatarUrl(string $conversionName = ''): ?string
    {
        return $this->getFirstMediaUrl('profile-avatars', $conversionName);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile-avatars')
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
