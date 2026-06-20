<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ImportWpProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-products {file=produk.xml}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from WordPress XML export';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = base_path($this->argument('file'));

        if (!file_exists($filePath)) {
            $this->error("File XML tidak ditemukan di: {$filePath}");
            return Command::FAILURE;
        }

        $this->info("Membaca file XML...");
        
        $xmlData = file_get_contents($filePath);
        // Replace namespaces for easier parsing
        $xmlData = str_replace(array('<wp:', '</wp:'), array('<wp_', '</wp_'), $xmlData);
        $xmlData = str_replace(array('<content:', '</content:'), array('<content_', '</content_'), $xmlData);
        $xmlData = str_replace(array('<excerpt:', '</excerpt:'), array('<excerpt_', '</excerpt_'), $xmlData);
        
        $xml = simplexml_load_string($xmlData, 'SimpleXMLElement', LIBXML_NOCDATA);
        
        if (!$xml) {
            $this->error("Gagal mem-parsing XML.");
            return Command::FAILURE;
        }

        $this->info("Memetakan gambar / attachment...");
        $attachments = [];
        foreach ($xml->channel->item as $item) {
            if ((string)$item->wp_post_type === 'attachment') {
                $postId = (string)$item->wp_post_id;
                $url = (string)$item->wp_attachment_url;
                if ($url) {
                    $attachments[$postId] = $url;
                }
            }
        }

        $count = 0;
        $this->info("Memulai proses import...");

        foreach ($xml->channel->item as $item) {
            $postType = (string)$item->wp_post_type;
            $status = (string)$item->wp_status;
            
            if ($postType === 'product' && $status === 'publish') {
                $title = (string)$item->title;
                $slug = (string)$item->wp_post_name;
                $description = (string)$item->content_encoded;
                
                // Get Price, Stock, Thumbnail
                $price = 0;
                $stock = 0;
                $thumbnailId = null;
                
                foreach ($item->wp_postmeta as $meta) {
                    $key = (string)$meta->wp_meta_key;
                    if ($key === '_price' || $key === '_regular_price') {
                        $val = (float)$meta->wp_meta_value;
                        if ($val > 0) $price = $val;
                    }
                    if ($key === '_stock') {
                        $stockVal = (int)$meta->wp_meta_value;
                        if ($stockVal > 0) $stock = $stockVal;
                    }
                    if ($key === '_thumbnail_id') {
                        $thumbnailId = (string)$meta->wp_meta_value;
                    }
                }
                
                // Get Category
                $categoryName = 'Uncategorized';
                if (isset($item->category)) {
                    foreach ($item->category as $cat) {
                        $attributes = $cat->attributes();
                        if (isset($attributes['domain']) && (string)$attributes['domain'] === 'product_cat') {
                            $categoryName = (string)$cat;
                            break;
                        }
                    }
                }
                
                // Find or create category
                $category = Category::firstOrCreate(
                    ['slug' => Str::slug($categoryName)],
                    [
                        'name' => $categoryName,
                        'description' => $categoryName,
                        'is_active' => true
                    ]
                );
                
                // Insert or Update Product
                $product = Product::updateOrCreate(
                    ['slug' => $slug ?: Str::slug($title)],
                    [
                        'name' => $title,
                        'description' => $description,
                        'price' => $price,
                        'stock' => $stock,
                        'category_id' => $category->id,
                        'status' => 'published',
                        'is_featured' => false,
                    ]
                );
                
                // Process Image
                if ($thumbnailId && isset($attachments[$thumbnailId])) {
                    $imageUrl = $attachments[$thumbnailId];
                    $this->line("Mengunduh gambar untuk {$title}: {$imageUrl}");
                    
                    try {
                        $imageContents = file_get_contents($imageUrl);
                        if ($imageContents) {
                            $filename = basename(parse_url($imageUrl, PHP_URL_PATH));
                            $ext = pathinfo($filename, PATHINFO_EXTENSION) ?: 'jpg';
                            $name = pathinfo($filename, PATHINFO_FILENAME);
                            
                            $directory = 'media';
                            $path = $directory . '/' . $filename;
                            
                            \Illuminate\Support\Facades\Storage::disk('public')->put($path, $imageContents);
                            
                            $media = \Awcodes\Curator\Models\Media::create([
                                'disk' => 'public',
                                'directory' => $directory,
                                'visibility' => 'public',
                                'name' => $name,
                                'path' => $path,
                                'ext' => $ext,
                                'type' => \Illuminate\Support\Facades\File::mimeType(storage_path("app/public/{$path}")),
                            ]);
                            
                            $product->mediaImages()->syncWithoutDetaching([$media->id]);
                        }
                    } catch (\Exception $e) {
                        $this->error("Gagal mengunduh gambar untuk {$title}: " . $e->getMessage());
                    }
                }
                
                $count++;
                $this->line("Diimpor: {$title}");
            }
        }
        
        $this->info("Berhasil mengimpor {$count} produk.");
        return Command::SUCCESS;
    }
}
