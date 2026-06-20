<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        // ============================================
        // 1. Admin User
        // ============================================
        User::updateOrCreate(
            ['email' => 'admin@umkm.local'],
            [
                'name' => 'Admin UMKM',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // ============================================
        // 2. Settings (Global Site Info)
        // ============================================
        $settings = [
            ['key' => 'site_name', 'value' => "D'Moroy"],
            ['key' => 'tagline', 'value' => 'Mahakarya Anyaman Serat Alam'],
            ['key' => 'whatsapp', 'value' => '6280000000000'],
            ['key' => 'email', 'value' => 'info@umkm.local'],
            ['key' => 'address', 'value' => "Jl. Contoh Alamat No. 1\nKota, Provinsi 12345\nIndonesia"],
            ['key' => 'office_hours', 'value' => 'Senin - Jumat, 08:00 - 17:00'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/umkm'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/umkm'],
            ['key' => 'tiktok', 'value' => 'https://tiktok.com/@umkm'],
            ['key' => 'hero_video_id', 'value' => ''], // YouTube Video ID
            ['key' => 'hero_title', 'value' => 'Koleksi Tas Anyaman Premium'],
            ['key' => 'hero_subtitle', 'value' => 'Sentuhan etnik berkelas dari serat pandan alami dan kulit pilihan.'],
            ['key' => 'hero_cta_text', 'value' => 'Lihat Katalog'],
            ['key' => 'hero_cta_link', 'value' => '/products'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }

        // ============================================
        // 3. Sliders (Home Hero)
        // ============================================
        Slider::truncate();
        $sliderData = [
            [
                'title' => 'Promo Spesial Produk A',
                'description' => 'Dapatkan penawaran menarik untuk produk unggulan kami.',
                'image' => null, // View will use fallback
                'link' => '/products',
                'order' => 1,
            ],
            [
                'title' => 'Koleksi Terbaru',
                'description' => 'Temukan inovasi terbaru dari produk-produk kami yang siap memenuhi kebutuhan Anda.',
                'image' => null,
                'link' => '/products',
                'order' => 2,
            ],
        ];

        foreach ($sliderData as $slider) {
            Slider::create($slider);
        }

        // ============================================
        // 4. Product Categories
        // ============================================
        Category::truncate();
        $categoryData = [
            ['name' => 'Tas Anyaman', 'description' => 'Koleksi tas eksklusif yang dianyam dari serat pandan alami dengan sentuhan kulit.'],
            ['name' => 'Aksesoris Anyaman', 'description' => 'Berbagai aksesoris pendukung bergaya etnik artisan.'],
        ];

        $categories = [];
        foreach ($categoryData as $cat) {
            $categories[$cat['name']] = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }

        // ============================================
        // 5. Products
        // ============================================
        Product::truncate();
        $products = [
            [
                'category' => 'Tas Anyaman',
                'name' => 'Seri Biaso Bae (Sedang)',
                'description' => '<p>Tote bag anyaman elegan dengan pola kotak-kotak natural. Dilengkapi tali bahu kulit premium yang kokoh untuk menemani aktivitas harian Anda.</p>',
                'price' => 250000,
                'is_featured' => true,
                'image_path' => 'bag_biaso_bae.png',
            ],
            [
                'category' => 'Tas Anyaman',
                'name' => 'Seri Biaso Bae Tali Panjang',
                'description' => '<p>Varian dari Seri Biaso Bae yang dilengkapi tali strap selempang kulit asli yang dapat disesuaikan. Sangat cocok untuk gaya kasual modern.</p>',
                'price' => 275000,
                'is_featured' => false,
                'image_path' => 'bag_biaso_bae.png',
            ],
            [
                'category' => 'Tas Anyaman',
                'name' => 'Seri Biaso Bae (Mini)',
                'description' => '<p>Versi mini dari tas best-seller kami. Ringkas, ringan, namun tetap memancarkan keanggunan kerajinan tangan lokal.</p>',
                'price' => 195000,
                'is_featured' => false,
                'image_path' => 'bag_biaso_bae.png',
            ],
            [
                'category' => 'Tas Anyaman',
                'name' => 'Sangkek Gdeh Kecik',
                'description' => '<p>Tas berbentuk kotak terstruktur (boxy) dengan ornamen anyaman sentral berbentuk kelopak bunga. Dikelilingi bingkai kulit halus yang memberikan kesan mewah.</p>',
                'price' => 350000,
                'is_featured' => true,
                'image_path' => 'bag_sangkek.png',
            ],
            [
                'category' => 'Tas Anyaman',
                'name' => 'Seri Canteek Manis (Pom-Pom)',
                'description' => '<p>Tas keranjang mini berstruktur kokoh dengan tekstur anyam diagonal. Memiliki aksen gantungan pom-pom berbulu lembut yang imut dan stylish.</p>',
                'price' => 185000,
                'is_featured' => true,
                'image_path' => 'bag_canteek.png',
            ],
            [
                'category' => 'Tas Anyaman',
                'name' => 'Seri Canteek Manis (Dasi)',
                'description' => '<p>Tas keranjang mini yang cantik, dihiasi dengan aksen kulit berbentuk dasi sebagai pemanis di bagian depan. Sempurna untuk acara santai.</p>',
                'price' => 185000,
                'is_featured' => false,
                'image_path' => 'bag_canteek.png',
            ],
        ];

        foreach ($products as $prod) {
            $productModel = Product::create([
                'category_id' => $categories[$prod['category']]->id,
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'description' => $prod['description'],
                'price' => $prod['price'],
                'stock' => 50,
                'is_featured' => $prod['is_featured'],
                'status' => 'published',
                'images' => null, // Default
            ]);
            
            // Try to assign image directly to model or let it be handled later.
            // As curator uses complex JSON arrays, we will just rely on the fallback images mapped by name.
        }

        // ============================================
        // 6. Post Categories (Nested)
        // ============================================
        PostCategory::truncate();
        
        $informasi = PostCategory::create(['name' => 'Informasi', 'slug' => 'informasi']);
        $berita = PostCategory::create(['name' => 'Berita', 'slug' => 'berita', 'parent_id' => $informasi->id]);

        // ============================================
        // 7. Posts (Articles)
        // ============================================
        Post::truncate();
        \Illuminate\Support\Facades\DB::table('post_post_category')->truncate();

        $posts = [
            [
                'title' => 'Artikel Pertama UMKM',
                'content' => '<p>Ini adalah artikel pertama yang membahas tentang perkembangan atau update terbaru dari UMKM ini.</p>',
                'cats' => [$berita->id]
            ],
        ];

        foreach ($posts as $p) {
            $post = Post::create([
                'title' => $p['title'],
                'slug' => Str::slug($p['title']),
                'content' => $p['content'],
                'status' => 'published',
                'image' => null,
            ]);
            $post->categories()->attach($p['cats']);
        }

        // ============================================
        // 8. Team Members
        // ============================================
        TeamMember::truncate();
        $team = [
            ['name' => 'Nama Anggota Tim', 'position' => 'Posisi / Jabatan', 'bio' => 'Deskripsi singkat mengenai anggota tim ini.'],
        ];

        foreach ($team as $m) {
            TeamMember::create($m);
        }

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $this->command->info('✅ Database UMKM Blueprint seeded with dummy data successfully!');
    }
}

