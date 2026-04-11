<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'link', 'order'];

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
