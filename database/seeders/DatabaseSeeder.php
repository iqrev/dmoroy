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
        // ============================================
        // 1. Admin User
        // ============================================
        User::updateOrCreate(
            ['email' => 'admin@websitejambi.com'],
            [
                'name' => 'Admin Website Jambi',
                'password' => Hash::make('AmdinPutin123'),
                'email_verified_at' => now(),
            ]
        );

        // ============================================
        // 2. Settings (Global Site Info)
        // ============================================
        $settings = [
            ['key' => 'site_name', 'value' => 'Batik Jambi Berkah Group'],
            ['key' => 'tagline', 'value' => 'Pusat Batik Jambi Autentik & Berkualitas'],
            ['key' => 'whatsapp', 'value' => '6281234567890'],
            ['key' => 'email', 'value' => 'info@batikjambiberkah.com'],
            ['key' => 'address', 'value' => "Jl. Kolonel Abunjani No. 88\nSipin, Kota Jambi 36122\nIndonesia"],
            ['key' => 'office_hours', 'value' => 'Senin - Sabtu, 08:00 - 17:00'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/batikjambiberkah'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/batikjambiberkah'],
            ['key' => 'tiktok', 'value' => 'https://tiktok.com/@batikjambiberkah'],
            ['key' => 'hero_video_id', 'value' => 'pIq4P9rJM0o'], // Batik process video
            ['key' => 'hero_title', 'value' => 'Warisan Luhur Batik Jambi'],
            ['key' => 'hero_subtitle', 'value' => 'Menghadirkan keindahan motif tradisional Jambi yang sarat akan makna dan sejarah ke dalam setiap helai kain.'],
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
                'title' => 'Keindahan Warisan Batik Jambi',
                'description' => 'Temukan koleksi eksklusif batik tulis dan cetak dengan motif tradisional yang kaya akan makna.',
                'image' => null, // View will use fallback
                'link' => '/products',
                'order' => 1,
            ],
            [
                'title' => 'Koleksi Eksklusif Ramadhan',
                'description' => 'Sambut hari raya dengan keanggunan busana batik Jambi modern yang nyaman dan berkelas.',
                'image' => null,
                'link' => '/products',
                'order' => 2,
            ],
            [
                'title' => 'Workshop Membatik Jambi',
                'description' => 'Ikuti kelas workshop kami dan rasakan pengalaman membuat motif batik Jambi Anda sendiri.',
                'image' => null,
                'link' => '/about',
                'order' => 3,
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
            ['name' => 'Kain Batik', 'description' => 'Koleksi kain batik tulis dan cap premium dengan berbagai motif asli Jambi.'],
            ['name' => 'Busana Pria', 'description' => 'Kemeja, kemeja lengan panjang, dan busana pria bergaya formal & kasual.'],
            ['name' => 'Busana Wanita', 'description' => 'Dress, tunik, kebaya, dan bawahan wanita dengan motif batik Jambi yang anggun.'],
            ['name' => 'Aksesoris', 'description' => 'Tas, dompet, syal, dan aksesoris batik lainnya sebagai pelengkap busana.'],
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
                'category' => 'Kain Batik',
                'name' => 'Batik Tulis Biji Timun Premium',
                'description' => '<p>Motif <strong>Biji Timun</strong> melambangkan kemakmuran dan kesuburan. Dikerjakan manual dengan tangan.</p><ul><li>Bahan: Sutra ATBM</li><li>Ukuran: 230 x 110 cm</li></ul>',
                'price' => 1250000,
                'is_featured' => true,
            ],
            [
                'category' => 'Kain Batik',
                'name' => 'Batik Tulis Durian Pecah',
                'description' => '<p>Motif <strong>Durian Pecah</strong> melambangkan kejujuran dan keterbukaan hati masyarakat Jambi.</p>',
                'price' => 950000,
                'is_featured' => true,
            ],
            [
                'category' => 'Busana Pria',
                'name' => 'Kemeja Slimfit Motif Kuaub Berhias',
                'description' => '<p>Kemeja batik pria dengan potongan slimfit modern dan motif Kuaub Berhias yang elegan.</p>',
                'price' => 385000,
                'is_featured' => true,
            ],
            [
                'category' => 'Busana Wanita',
                'name' => 'Tunik Batik Modern Motif Angso Duo',
                'description' => '<p>Tunik wanita dengan desain kontemporer yang memadukan keindahan motif Angso Duo Jambi.</p>',
                'price' => 320000,
                'is_featured' => false,
            ],
            [
                'category' => 'Aksesoris',
                'name' => 'Tas Tote Batik Eksklusif',
                'description' => '<p>Tas tote fungsional dengan lapisan kain batik tulis asli Jambi yang artistik.</p>',
                'price' => 185000,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $prod) {
            Product::create([
                'category_id' => $categories[$prod['category']]->id,
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'description' => $prod['description'],
                'price' => $prod['price'],
                'stock' => rand(5, 50),
                'is_featured' => $prod['is_featured'],
                'status' => 'published',
                'images' => null,
            ]);
        }

        // ============================================
        // 6. Post Categories (Nested)
        // ============================================
        PostCategory::truncate();
        
        $pameran = PostCategory::create(['name' => 'Stand/Pameran', 'slug' => 'pameran']);
        $pameranLN = PostCategory::create(['name' => 'Luar Negeri', 'slug' => 'pameran-luar-negeri', 'parent_id' => $pameran->id]);
        $pameranDN = PostCategory::create(['name' => 'Dalam Negeri', 'slug' => 'pameran-dalam-negeri', 'parent_id' => $pameran->id]);

        $fashion = PostCategory::create(['name' => 'Fashion Show', 'slug' => 'fashion-show']);
        $fashionLN = PostCategory::create(['name' => 'Luar Negeri', 'slug' => 'fashion-show-luar-negeri', 'parent_id' => $fashion->id]);
        
        $edukasi = PostCategory::create(['name' => 'Edukasi Batik', 'slug' => 'edukasi-batik']);

        // ============================================
        // 7. Posts (Articles)
        // ============================================
        Post::truncate();
        \Illuminate\Support\Facades\DB::table('post_post_category')->truncate();

        $posts = [
            [
                'title' => 'Filosofi Motif Biji Timun Batik Jambi',
                'content' => '<p>Motif Biji Timun melambangkan kemakmuran dan harapan akan masa depan. Digunakan sejak abad ke-17...</p>',
                'cats' => [$edukasi->id]
            ],
            [
                'title' => 'Pameran Batik Jambi di Paris Fashion Week',
                'content' => '<p>Membawa warisan budaya Jambi ke panggung internasional. Sambutan hangat dari kolektor Eropa...</p>',
                'cats' => [$pameranLN->id, $fashionLN->id]
            ],
            [
                'title' => 'Cara Merawat Batik Tulis Agar Tetap Awet',
                'content' => '<p>Batik tulis adalah karya seni. Gunakan sabun lerak atau shampo bayi untuk mencuci...</p>',
                'cats' => [$edukasi->id]
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
            ['name' => 'Hj. Siti Aisyah', 'position' => 'Pendiri & Pengrajin Utama', 'bio' => 'Telah berkarya selama 30 tahun dalam melestarikan motif asli batik Jambi.'],
            ['name' => 'Ahmad Fauzi', 'position' => 'Direktur Pemasaran', 'bio' => 'Membawa Batik Jambi Berkah ke kancah nasional dan internasional.'],
            ['name' => 'Rini Marlina', 'position' => 'Kepala Pengrajin', 'bio' => 'Mengawasi kualitas produksi setiap helai kain batik yang kami hasilkan.'],
        ];

        foreach ($team as $m) {
            TeamMember::create($m);
        }

        $this->command->info('✅ Database Batik Jambi Berkah seeded with dummy data successfully!');
    }
}
