<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use App\Models\TeamMember;
use Awcodes\Curator\Models\Media;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Buat tabel pivot media_product
        Schema::create('media_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('curator')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 2. Migrasi data products.images -> media_product
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            if (empty($product->images)) continue;
            
            $images = json_decode($product->images, true);
            if (!is_array($images)) continue;

            foreach ($images as $index => $pathOrId) {
                // Cari media berdasarkan path jika dia berbentuk string teks
                if (is_string($pathOrId) && !is_numeric($pathOrId)) {
                    $media = Media::where('path', $pathOrId)
                        ->orWhere('path', str_replace('public/', '', $pathOrId))
                        ->first();
                        
                    if ($media) {
                        DB::table('media_product')->insert([
                            'product_id' => $product->id,
                            'media_id' => $media->id,
                            'order' => $index,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } elseif (is_numeric($pathOrId)) {
                    // Kalau sudah ID, langsung masukkan
                    DB::table('media_product')->insert([
                        'product_id' => $product->id,
                        'media_id' => $pathOrId,
                        'order' => $index,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 3. Migrasi single image: categories, posts, team_members
        $this->migrateSingleImageTable('categories', 'image');
        $this->migrateSingleImageTable('posts', 'image');
        $this->migrateSingleImageTable('team_members', 'photo');
    }

    private function migrateSingleImageTable(string $table, string $column): void
    {
        $records = DB::table($table)->whereNotNull($column)->get();
        foreach ($records as $record) {
            $pathOrId = $record->$column;
            if (is_string($pathOrId) && !is_numeric($pathOrId)) {
                $media = Media::where('path', $pathOrId)
                    ->orWhere('path', str_replace('public/', '', $pathOrId))
                    ->first();
                if ($media) {
                    DB::table($table)->where('id', $record->id)->update([
                        $column => (string) $media->id
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_product_pivot_and_migrate_data');
    }
};
