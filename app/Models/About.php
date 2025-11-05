<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'video',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'social_media_updates',
        'videos',
        'press_coverage',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'social_media_updates' => 'array',
        'videos' => 'array',
        'press_coverage' => 'array',
        'is_active' => 'boolean',
    ];
}
