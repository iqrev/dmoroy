<?php

namespace database\seeders;

use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pameran
        $pameran = PostCategory::create([
            'name' => 'Stand/Pameran',
            'slug' => 'pameran',
        ]);

        $pameranLN = PostCategory::create([
            'name' => 'Luar Negeri',
            'slug' => 'pameran-luar-negeri',
            'parent_id' => $pameran->id,
        ]);

        $pameranDN = PostCategory::create([
            'name' => 'Dalam Negeri',
            'slug' => 'pameran-dalam-negeri',
            'parent_id' => $pameran->id,
        ]);

        // 2. Fashion Show
        $fashion = PostCategory::create([
            'name' => 'Fashion Show',
            'slug' => 'fashion-show',
        ]);

        $fashionLN = PostCategory::create([
            'name' => 'Luar Negeri',
            'slug' => 'fashion-show-luar-negeri',
            'parent_id' => $fashion->id,
        ]);

        $fashionDN = PostCategory::create([
            'name' => 'Dalam Negeri',
            'slug' => 'fashion-show-dalam-negeri',
            'parent_id' => $fashion->id,
        ]);

        // Seed some sample posts for each category
        $categories = [$pameranLN, $pameranDN, $fashionLN, $fashionDN];
        foreach ($categories as $cat) {
            Post::create([
                'title' => 'Kegiatan ' . $cat->name . ' di ' . $cat->parent->name,
                'slug' => Str::slug('Kegiatan ' . $cat->name . ' di ' . $cat->parent->name . '-' . rand(100, 999)),
                'content' => 'Ini adalah konten contoh untuk artikel di kategori ' . $cat->name . ' yang berada di bawah induk ' . $cat->parent->name . '. UMKM Jambi terus mendunia melalui berbagai ajang internasional maupun nasional.',
                'image' => null,
                'status' => 'published',
                'category_id' => $cat->id,
            ]);
        }
    }
}
