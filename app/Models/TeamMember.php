<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position', 'photo', 'bio'];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) return null;
        if (is_numeric($this->photo)) {
            $media = \Awcodes\Curator\Models\Media::find($this->photo);
            if ($media) return $media->url;
        }
        return asset('storage/' . $this->photo);
    }
}
