<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'image', 'status'];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'post_post_category');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (is_numeric($this->image)) {
            $media = \Awcodes\Curator\Models\Media::find($this->image);
            if ($media) return $media->url;
        }
        return asset('storage/' . $this->image);
    }
}
