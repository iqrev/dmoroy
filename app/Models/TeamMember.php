<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position', 'photo', 'bio'];

    public function mediaImage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Awcodes\Curator\Models\Media::class, 'photo', 'id');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->mediaImage?->url;
    }
}
