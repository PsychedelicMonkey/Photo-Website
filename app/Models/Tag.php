<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    use HasUlids;
}
