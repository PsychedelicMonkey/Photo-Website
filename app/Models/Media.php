<?php

namespace App\Models;

use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasTags;
    use HasUlids;
}
