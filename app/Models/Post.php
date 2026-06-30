<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'image', 'status', 'created_at'];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'post_post_category');
    }

    public function mediaImage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Awcodes\Curator\Models\Media::class, 'image', 'id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->mediaImage?->url;
    }
}
