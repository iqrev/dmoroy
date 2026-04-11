function convertToMedia($path) {
    if (!$path || is_numeric($path)) return $path;
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        if (str_starts_with($path, 'images/')) {
           $fullPath = public_path($path);
           if(!file_exists($fullPath)) return $path;
           // save to storage
           $newPath = 'imported/' . basename($path);
           \Illuminate\Support\Facades\Storage::disk('public')->put($newPath, file_get_contents($fullPath));
           $path = $newPath;
           $fullPath = storage_path('app/public/' . $path);
        } else {
             return $path;
        }
    }
    
    $media = \Awcodes\Curator\Models\Media::where('path', $path)->first();
    if ($media) return $media->id;
    
    $media = \Awcodes\Curator\Models\Media::create([
        'disk' => 'public',
        'directory' => dirname($path) == '.' ? 'media' : dirname($path),
        'visibility' => 'public',
        'name' => pathinfo($path, PATHINFO_FILENAME),
        'path' => $path,
        'width' => null,
        'height' => null,
        'size' => filesize($fullPath),
        'type' => mime_content_type($fullPath),
        'ext' => pathinfo($path, PATHINFO_EXTENSION),
        'alt' => pathinfo($path, PATHINFO_FILENAME),
        'title' => pathinfo($path, PATHINFO_FILENAME),
    ]);
    return $media->id;
}

// 1. Settings
foreach(\App\Models\Setting::where('key', 'about_hero_image')->get() as $setting) {
    $val = $setting->value;
    $newVal = convertToMedia($val);
    $setting->value = $newVal;
    $setting->save();
}

// 2. Sliders
foreach(\App\Models\Slider::all() as $slider) {
    if($slider->image) {
        $slider->image = convertToMedia($slider->image);
        $slider->save();
    }
}

// 3. Team
foreach(\App\Models\TeamMember::all() as $team) {
    if($team->photo) {
        $team->photo = convertToMedia($team->photo);
        $team->save();
    }
}

// 4. Category
foreach(\App\Models\Category::all() as $cat) {
    if($cat->image) {
        $cat->image = convertToMedia($cat->image);
        $cat->save();
    }
}

// 5. Post
foreach(\App\Models\Post::all() as $post) {
    if($post->image) {
        $post->image = convertToMedia($post->image);
        $post->save();
    }
}

// 6. Product
foreach(\App\Models\Product::all() as $prod) {
    if(is_array($prod->images)) {
        $newImages = [];
        foreach($prod->images as $img) {
            $newImages[] = convertToMedia($img);
        }
        $prod->images = array_map('strval', $newImages); // ensure it's string IDs if needed or leave as int
        $prod->save();
    }
}

echo "Migrasi ke Media Library selesai.\n";
