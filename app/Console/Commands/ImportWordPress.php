<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportWordPress extends Command
{
    protected $signature = 'import:wordpress {file} {--fresh : Truncate existing data before import} {--skip-images : Skip downloading images}';
    protected $description = 'Import WordPress WXR XML export into the Laravel database (categories, products, media)';

    private array $wpAttachments = []; // wp_post_id => attachment data
    private array $categoryMap = [];  // slug => laravel category id

    public function handle(): int
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        $this->info("📦 Parsing WordPress XML: {$file}");
        $this->newLine();

        // Parse XML
        $xml = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$xml) {
            $this->error('Failed to parse XML file.');
            return 1;
        }

        $channel = $xml->channel;
        $namespaces = $xml->getNamespaces(true);
        $wpNs = $namespaces['wp'] ?? 'http://wordpress.org/export/1.2/';
        $contentNs = $namespaces['content'] ?? 'http://purl.org/rss/1.0/modules/content/';
        $excerptNs = $namespaces['excerpt'] ?? 'http://wordpress.org/export/1.2/excerpt/';
        $dcNs = $namespaces['dc'] ?? 'http://purl.org/dc/elements/1.1/';

        // Truncate if --fresh
        if ($this->option('fresh')) {
            $this->warn('🗑️  Truncating existing data...');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('products')->truncate();
            DB::table('categories')->truncate();
            DB::table('curator')->truncate();
            DB::table('tags')->truncate();
            DB::table('product_tag')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // Classify items
        $products = [];
        $attachments = [];

        foreach ($channel->item as $item) {
            $wp = $item->children($wpNs);
            $postType = (string) $wp->post_type;

            if ($postType === 'attachment') {
                $attachments[] = $item;
            } elseif ($postType === 'product') {
                $products[] = $item;
            }
        }

        $this->info("Found: " . count($products) . " products, " . count($attachments) . " attachments");
        $this->newLine();

        // Step 1: Index all attachments by wp_post_id
        $this->info('📎 Indexing attachments...');
        foreach ($attachments as $item) {
            $wp = $item->children($wpNs);
            $wpId = (int) $wp->post_id;
            $url = (string) $wp->attachment_url;

            // Get file metadata
            $meta = $this->extractMeta($item, $wpNs);
            $attachedFile = $meta['_wp_attached_file'] ?? '';

            $this->wpAttachments[$wpId] = [
                'url' => $url,
                'file' => $attachedFile,
                'title' => (string) $item->title,
                'parent' => (int) $wp->post_parent,
            ];
        }
        $this->info("  Indexed " . count($this->wpAttachments) . " attachments");

        // Step 2: Extract and create categories
        $this->info('📂 Importing categories...');
        $categoryNames = [];
        foreach ($products as $item) {
            foreach ($item->category as $cat) {
                $domain = (string) $cat['domain'];
                if ($domain === 'product_cat') {
                    $slug = (string) $cat['nicename'];
                    $name = (string) $cat;

                    // Skip sub-types like UMKM-cap, UMKM-tulis (these are tags)
                    if (in_array($slug, ['UMKM-cap', 'UMKM-tulis', 'simple', 'variable', 'ready-to-wear'])) {
                        continue;
                    }

                    $categoryNames[$slug] = $name;
                }
            }
        }

        foreach ($categoryNames as $slug => $name) {
            $existing = DB::table('categories')->where('slug', $slug)->first();
            if (!$existing) {
                $id = DB::table('categories')->insertGetId([
                    'name' => $name,
                    'slug' => $slug,
                    'description' => null,
                    'image' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->categoryMap[$slug] = $id;
                $this->line("  ✅ Created category: {$name}");
            } else {
                $this->categoryMap[$slug] = $existing->id;
                $this->line("  ⏭️  Skipped (exists): {$name}");
            }
        }

        // Step 3: Import products
        $this->newLine();
        $this->info('🛍️  Importing products...');
        $bar = $this->output->createProgressBar(count($products));
        $bar->start();

        $importedCount = 0;
        $skippedCount = 0;

        foreach ($products as $item) {
            $wp = $item->children($wpNs);
            $content = $item->children($contentNs);
            $excerpt = $item->children($excerptNs);
            $meta = $this->extractMeta($item, $wpNs);

            $title = (string) $item->title;
            $slug = (string) $wp->post_name;
            $status = (string) $wp->status;

            // Skip if already exists
            if (DB::table('products')->where('slug', $slug)->exists()) {
                $skippedCount++;
                $bar->advance();
                continue;
            }

            // Get description - use content:encoded, fallback to excerpt
            $description = trim((string) $content->encoded);
            if (empty($description)) {
                $description = trim((string) $excerpt->encoded);
            }
            // Strip WordPress HTML cruft
            $description = strip_tags($description, '<p><br><strong><em><ul><ol><li><h2><h3><h4><blockquote>');
            if (empty($description)) {
                $description = $title; // Fallback
            }

            // Get category
            $categoryId = null;
            foreach ($item->category as $cat) {
                $domain = (string) $cat['domain'];
                if ($domain === 'product_cat') {
                    $catSlug = (string) $cat['nicename'];
                    if (isset($this->categoryMap[$catSlug])) {
                        $categoryId = $this->categoryMap[$catSlug];
                        break; // Use the first matching category
                    }
                }
            }

            if (!$categoryId) {
                // Assign to "Lainnya" (Others) if no category found
                if (!isset($this->categoryMap['lainnya'])) {
                    $id = DB::table('categories')->insertGetId([
                        'name' => 'Lainnya',
                        'slug' => 'lainnya',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $this->categoryMap['lainnya'] = $id;
                }
                $categoryId = $this->categoryMap['lainnya'];
            }

            // Get price
            $price = (float) ($meta['_regular_price'] ?? $meta['_price'] ?? 0);

            // Get stock
            $stock = (int) ($meta['_stock'] ?? 0);

            // Get views
            $viewsCount = (int) ($meta['ekit_post_views_count'] ?? 0);

            // Handle images — thumbnail + gallery
            $imageIds = [];
            if (!$this->option('skip-images')) {
                // Thumbnail
                $thumbnailWpId = (int) ($meta['_thumbnail_id'] ?? 0);
                if ($thumbnailWpId && isset($this->wpAttachments[$thumbnailWpId])) {
                    $curatorId = $this->downloadAndCreateMedia($this->wpAttachments[$thumbnailWpId], $title);
                    if ($curatorId) {
                        $imageIds[] = $curatorId;
                    }
                }

                // Gallery images
                $galleryIds = $meta['_product_image_gallery'] ?? '';
                if (!empty($galleryIds)) {
                    foreach (explode(',', $galleryIds) as $galleryWpId) {
                        $galleryWpId = (int) trim($galleryWpId);
                        // Skip if same as thumbnail
                        if ($galleryWpId === $thumbnailWpId) continue;
                        if (isset($this->wpAttachments[$galleryWpId])) {
                            $curatorId = $this->downloadAndCreateMedia($this->wpAttachments[$galleryWpId], $title);
                            if ($curatorId) {
                                $imageIds[] = $curatorId;
                            }
                        }
                    }
                }
            }

            // Insert product
            DB::table('products')->insert([
                'category_id' => $categoryId,
                'name' => $title,
                'slug' => $slug,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'images' => !empty($imageIds) ? json_encode($imageIds) : null,
                'is_featured' => false,
                'status' => $status === 'publish' ? 'published' : 'draft',
                'views_count' => $viewsCount,
                'created_at' => (string) $wp->post_date ?: now(),
                'updated_at' => (string) $wp->post_modified ?: now(),
            ]);

            $importedCount++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✅ Import selesai!");
        $this->table(
            ['Metric', 'Count'],
            [
                ['Categories', count($this->categoryMap)],
                ['Products imported', $importedCount],
                ['Products skipped', $skippedCount],
                ['Media created', DB::table('curator')->count()],
            ]
        );

        return 0;
    }

    /**
     * Extract all wp:postmeta key-value pairs from an item.
     */
    private function extractMeta(\SimpleXMLElement $item, string $wpNs): array
    {
        $meta = [];
        $wp = $item->children($wpNs);

        foreach ($wp->postmeta as $postmeta) {
            $key = (string) $postmeta->children($wpNs)->meta_key;
            $value = (string) $postmeta->children($wpNs)->meta_value;
            $meta[$key] = $value;
        }

        return $meta;
    }

    /**
     * Download image from WordPress URL and create a Curator media record.
     */
    private function downloadAndCreateMedia(array $attachment, string $productName): ?int
    {
        $url = $attachment['url'];
        $originalFile = $attachment['file']; // e.g. "2025/01/IMG_0255-1.webp"

        // Determine filename
        $filename = basename($url);
        $ext = pathinfo($filename, PATHINFO_EXTENSION) ?: 'webp';
        $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);

        // Check if already downloaded (by path)
        $storagePath = "products/{$filename}";
        $existing = DB::table('curator')->where('path', $storagePath)->first();
        if ($existing) {
            return $existing->id;
        }

        // Check if file already exists in local storage
        $disk = Storage::disk('public');
        if (!$disk->exists($storagePath)) {
            // Download the image
            try {
                $this->line("    ⬇️  Downloading: {$filename}");

                $context = stream_context_create([
                    'http' => [
                        'timeout' => 30,
                        'user_agent' => 'Mozilla/5.0 (compatible; LaravelImporter/1.0)',
                    ],
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);

                $imageData = @file_get_contents($url, false, $context);

                if ($imageData === false) {
                    // Try with https
                    $httpsUrl = str_replace('http://', 'https://', $url);
                    $imageData = @file_get_contents($httpsUrl, false, $context);
                }

                if ($imageData === false) {
                    $this->warn("    ⚠️  Failed to download: {$url}");
                    return null;
                }

                $disk->put($storagePath, $imageData);
            } catch (\Exception $e) {
                $this->warn("    ⚠️  Error downloading {$filename}: " . $e->getMessage());
                return null;
            }
        }

        // Get image dimensions
        $fullPath = $disk->path($storagePath);
        $imageInfo = @getimagesize($fullPath);
        $width = $imageInfo[0] ?? null;
        $height = $imageInfo[1] ?? null;
        $mimeType = $imageInfo['mime'] ?? "image/{$ext}";
        $size = $disk->size($storagePath);

        // Create Curator media record
        $id = DB::table('curator')->insertGetId([
            'disk' => 'public',
            'directory' => 'products',
            'visibility' => 'public',
            'name' => $nameWithoutExt,
            'path' => $storagePath,
            'width' => $width,
            'height' => $height,
            'size' => $size,
            'type' => $mimeType,
            'ext' => $ext,
            'alt' => $productName,
            'title' => $attachment['title'] ?: $nameWithoutExt,
            'description' => null,
            'caption' => null,
            'exif' => null,
            'curations' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $id;
    }
}
