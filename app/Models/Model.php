<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $gender
 * @property ?string $bio
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Model extends EloquentModel
{
    /** @use HasFactory<\Database\Factories\ModelFactory> */
    use HasFactory;
    use HasUlids;

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
}
