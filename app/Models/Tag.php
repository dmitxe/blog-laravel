<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug) && !empty($tag->title)) {
                $tag->slug = Str::slug($tag->title);
            }

            if (empty($tag->weight)) {
                $tag->weight = 1;
            }
        });
    }
}
