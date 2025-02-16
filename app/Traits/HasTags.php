<?php

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    use \Spatie\Tags\HasTags;

    /**
     * @return class-string<Model>
     */
    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    /** @return MorphToMany<Model, $this> */
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }
}
