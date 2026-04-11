<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

        'images',
        'is_featured',
        'status',
        'workshop_location',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getMediaUrlsAttribute(): array
    {
        if (!$this->images || !is_array($this->images)) return [];
        
        $urls = [];
        $mediaRecords = \Awcodes\Curator\Models\Media::whereIn('id', $this->images)->get()->keyBy('id');
        
        // Preserve order
        foreach ($this->images as $id) {
            if (isset($mediaRecords[$id])) {
                $urls[] = $mediaRecords[$id]->url;
            } else if (is_string($id) && !is_numeric($id)) {
                // Fallback if string path somehow remains
                $urls[] = str_starts_with($id, 'images/') ? asset($id) : asset('storage/' . $id);
            }
        }
        
        return $urls;
    }
}
