<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGallery extends Model
{
    protected $fillable = [
        'media_id',
        'title',
        'instagram_url',
        'sort_order',
        'is_active',
    ];

    public function media()
    {
        return $this->belongsTo(\Awcodes\Curator\Models\Media::class, 'media_id');
    }
}
