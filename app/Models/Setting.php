<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function getMediaUrl(string $key, mixed $default = null): ?string
    {
        $val = static::get($key);
        if (!$val) return $default ? asset($default) : null;
        
        if (is_numeric($val)) {
            $media = \Awcodes\Curator\Models\Media::find($val);
            if ($media) return $media->url;
        }
        
        return str_starts_with($val, 'images/') ? asset($val) : asset('storage/' . $val);
    }
}
