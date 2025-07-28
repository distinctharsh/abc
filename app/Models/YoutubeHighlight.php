<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'thumbnail',
        'video_url',
        'youtube_id',
        'published_date',
        'tags',
        'views',
        'likes',
        'is_featured'
    ];

    protected $casts = [
        'published_date' => 'date',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'likes' => 'integer'
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_date', 'desc');
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_date->format('d M Y');
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset($this->thumbnail);
        }
        return asset('images/b.jpg'); // Default image
    }
}
