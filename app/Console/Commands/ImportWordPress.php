<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImportWordPress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wordpress {file} {--fresh : Truncate products and posts before importing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products and posts from a WordPress WXR XML file with hierarchy support';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        if ($this->option('fresh')) {
            $this->warn("Truncating existing data (Products and Posts)...");
            
            DB::statement('PRAGMA foreign_keys = OFF;');
            Product::query()->delete();
            Category::query()->delete();
            Post::query()->delete();
            PostCategory::query()->delete();
            DB::table('post_post_category')->delete();
            DB::statement('PRAGMA foreign_keys = ON;');
            
            $this->info("Database cleaned!");
        }

        $this->info("Parsing XML file: {$filePath}");
        $xml = simplexml_load_file($filePath, "SimpleXMLElement", LIBXML_NOCDATA);
        $namespaces = $xml->getNamespaces(true);

        // Pre-collect attachments
        $this->info("Mapping attachments...");
        $attachments = [];
        foreach ($xml->channel->item as $item) {
            $wp = $item->children($namespaces['wp']);
            if ((string)$wp->post_type === 'attachment') {
                $attachments[(string)$wp->post_id] = (string)$wp->attachment_url;
            }
        }

        // Pre-parse Categories if present in wp:category tags
        $categoryMapping = []; // slug -> parent_slug
        foreach ($xml->channel->xpath('//wp:category') as $cat) {
            $slug = (string)$cat->children($namespaces['wp'])->category_nicename;
            $parentSlug = (string)$cat->children($namespaces['wp'])->category_parent;
            $name = (string)$cat->children($namespaces['wp'])->cat_name;
            
            $dbCat = PostCategory::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
            
            if ($parentSlug) {
                $categoryMapping[$slug] = $parentSlug;
            }
        }

        // Set parents for categories
        foreach ($categoryMapping as $slug => $parentSlug) {
            $cat = PostCategory::where('slug', $slug)->first();
            $parent = PostCategory::where('slug', $parentSlug)->first();
            if ($cat && $parent) {
                $cat->update(['parent_id' => $parent->id]);
            }
        }

        $this->info("Processing items...");
        $productCount = 0;
        $postCount = 0;

        foreach ($xml->channel->item as $item) {
            $wp = $item->children($namespaces['wp']);
            $type = (string)$wp->post_type;
            
            if ($type !== 'product' && $type !== 'post') {
                continue;
            }

            if (!in_array((string)$wp->status, ['publish', 'private'])) {
                continue;
            }

            $name = (string)$item->title;
            $slug = (string)$wp->post_name ?: Str::slug($name);
            $content = $item->children($namespaces['content'])->encoded;
            $excerpt = $item->children($namespaces['excerpt'])->encoded;
            $description = $content ?: $excerpt;

            // Extract Metadata
            $thumbnailId = null;
            $galleryIds = [];
            $price = 0;
            $stock = 0;

            foreach ($wp->postmeta as $meta) {
                $key = (string)$meta->meta_key;
                $value = (string)$meta->meta_value;
                if ($key === '_thumbnail_id') $thumbnailId = $value;
                if ($key === '_product_image_gallery') $galleryIds = array_filter(explode(',', $value));
                if ($key === '_price' || $key === '_regular_price') $price = (float)$value;
                if ($key === '_stock') $stock = (int)$value;
            }

            if ($type === 'product') {
                $this->importProduct($item, $name, $slug, $description, $price, $stock, $thumbnailId, $galleryIds, $attachments, $namespaces);
                $productCount++;
            } else {
                $this->importPost($item, $name, $slug, $description, $thumbnailId, $attachments, $namespaces);
                $postCount++;
            }
        }

        $this->info("Successfully imported {$productCount} products and {$postCount} posts!");
        return 0;
    }

    private function importProduct($item, $name, $slug, $description, $price, $stock, $thumbnailId, $galleryIds, $attachments, $namespaces)
    {
        $categoryName = 'Lainnya';
        foreach ($item->category as $cat) {
            if ((string)$cat['domain'] === 'product_cat') {
                $categoryName = (string)$cat;
                break;
            }
        }

        $category = Category::firstOrCreate(
            ['slug' => Str::slug($categoryName)],
            ['name' => $categoryName]
        );

        $imageUrls = [];
        if ($thumbnailId && isset($attachments[$thumbnailId])) $imageUrls[] = $attachments[$thumbnailId];
        foreach ($galleryIds as $id) if (isset($attachments[$id])) $imageUrls[] = $attachments[$id];

        $localImages = $this->downloadImages($imageUrls, 'products', $name);

        Product::updateOrCreate(
            ['slug' => $slug],
            [
                'category_id' => $category->id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock ?: rand(5, 20),
                'images' => $localImages,
                'status' => 'published',
                'is_featured' => false,
            ]
        );
    }

    private function importPost($item, $name, $slug, $content, $thumbnailId, $attachments, $namespaces)
    {
        $categoryIds = [];
        foreach ($item->category as $cat) {
            if ((string)$cat['domain'] === 'category' && (string)$cat !== 'Uncategorized') {
                $catName = (string)$cat;
                $catSlug = (string)$cat['nicename'] ?: Str::slug($catName);
                
                $dbCat = PostCategory::updateOrCreate(
                    ['slug' => $catSlug],
                    ['name' => $catName]
                );
                $categoryIds[] = $dbCat->id;
            }
        }

        $imagePath = null;
        if ($thumbnailId && isset($attachments[$thumbnailId])) {
            $local = $this->downloadImages([$attachments[$thumbnailId]], 'posts', $name);
            $imagePath = $local[0] ?? null;
        }

        $post = Post::updateOrCreate(
            ['slug' => $slug],
            [
                'title' => $name,
                'content' => $content,
                'image' => $imagePath,
                'status' => 'published',
            ]
        );

        if (!empty($categoryIds)) {
            $post->categories()->sync($categoryIds);
        }
    }

    private function downloadImages(array $urls, string $folder, string $itemName): array
    {
        $localPaths = [];
        foreach ($urls as $url) {
            $fileName = $folder . '/' . basename($url);
            if (Storage::disk('public')->exists($fileName)) {
                $localPaths[] = $fileName;
                continue;
            }

            try {
                $this->info("Downloading image for {$itemName}: " . basename($url));
                $response = Http::timeout(30)->get($url);
                if ($response->successful()) {
                    Storage::disk('public')->put($fileName, $response->body());
                    $localPaths[] = $fileName;
                }
            } catch (\Exception $e) {
                $this->warn("Failed to download image: {$url}");
            }
        }
        return $localPaths;
    }
}
