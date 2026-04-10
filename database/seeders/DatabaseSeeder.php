<?php

namespace Database\Seeders;

use App\Models\Category;
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
        User::firstOrCreate(
            ['email' => 'admin@batikjambiberkah.com'],
            [
                'name' => 'Admin Batik Jambi',
                'password' => Hash::make('password'),
            ]
        );

        // ============================================
        // 2. Categories
        // ============================================
        $categoryData = [
            ['name' => 'Kain Batik', 'description' => 'Koleksi kain batik tulis dan cap premium dengan berbagai motif asli Jambi.'],
            ['name' => 'Busana Pria', 'description' => 'Kemeja, kemeja lengan panjang, dan busana pria bergaya formal & kasual bermotif batik.'],
            ['name' => 'Busana Wanita', 'description' => 'Dress, tunik, kebaya, dan bawahan wanita dengan motif batik Jambi yang anggun.'],
            ['name' => 'Aksesoris', 'description' => 'Tas, dompet, syal, dan aksesoris batik lainnya sebagai pelengkap busana.'],
        ];

        $categories = [];
        foreach ($categoryData as $cat) {
            $categories[$cat['name']] = Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                ]
            );
        }

        // ============================================
        // 3. Products
        // ============================================
        $productData = [
            // Kain Batik
            [
                'category' => 'Kain Batik',
                'name' => 'Batik Tulis Biji Timun Premium',
                'description' => '<p>Motif <strong>Biji Timun</strong> merupakan salah satu motif tertua dan paling ikonik dari Batik Jambi. Motif ini melambangkan <em>kemakmuran, kesuburan, dan keberlanjutan</em> hidup.</p><p>Dikerjakan secara tulis tangan oleh pengrajin berpengalaman dengan menggunakan malam berkualitas tinggi dan pewarna alami pilihan.</p><ul><li>Bahan: Sutra ATBM</li><li>Ukuran: 230 x 110 cm</li><li>Teknik: Batik Tulis</li></ul>',
                'price' => 1250000,
                'stock' => 5,
                'is_featured' => true,
            ],
            [
                'category' => 'Kain Batik',
                'name' => 'Batik Tulis Durian Pecah',
                'description' => '<p>Motif <strong>Durian Pecah</strong> adalah motif ikonik khas Jambi yang terinspirasi dari buah durian yang pecah, melambangkan <em>kebulatan tekad dan kejujuran</em>.</p><p>Setiap lembar dikerjakan manual dengan penuh kesabaran oleh pengrajin senior kami.</p><ul><li>Bahan: Primissima</li><li>Ukuran: 230 x 110 cm</li><li>Teknik: Batik Tulis</li></ul>',
                'price' => 950000,
                'stock' => 3,
                'is_featured' => true,
            ],
            [
                'category' => 'Kain Batik',
                'name' => 'Batik Cap Angso Duo',
                'description' => '<p>Motif <strong>Angso Duo</strong> menggambarkan dua ekor angsa yang berhadapan, melambangkan <em>persatuan dan keharmonisan</em>. Motif ini sangat populer untuk acara pernikahan dan seremoni resmi.</p><ul><li>Bahan: Katun Prima</li><li>Ukuran: 230 x 110 cm</li><li>Teknik: Batik Cap</li></ul>',
                'price' => 450000,
                'stock' => 15,
                'is_featured' => false,
            ],
            [
                'category' => 'Kain Batik',
                'name' => 'Batik Tulis Kalung Berhias',
                'description' => '<p>Motif <strong>Kalung Berhias</strong> terinspirasi dari perhiasan tradisional masyarakat Jambi. Motif ini melambangkan <em>keindahan, keanggunan, dan status sosial</em>.</p><ul><li>Bahan: Sutra</li><li>Ukuran: 230 x 110 cm</li><li>Teknik: Batik Tulis</li></ul>',
                'price' => 1500000,
                'stock' => 2,
                'is_featured' => true,
            ],
            // Busana Pria
            [
                'category' => 'Busana Pria',
                'name' => 'Kemeja Slimfit Motif Kuaub Berhias',
                'description' => '<p>Kemeja pria slimfit dengan motif <strong>Kuaub Berhias</strong> yang elegan. Cocok untuk acara formal, pesta, maupun pertemuan bisnis.</p><ul><li>Bahan: Katun Voile</li><li>Ukuran: S, M, L, XL, XXL</li><li>Tersedia dengan lengan panjang dan pendek</li></ul>',
                'price' => 385000,
                'stock' => 20,
                'is_featured' => true,
            ],
            [
                'category' => 'Busana Pria',
                'name' => 'Kemeja Regular Motif Biji Timun',
                'description' => '<p>Kemeja pria regular fit dengan motif <strong>Biji Timun</strong> klasik. Desain yang bersih dan elegan untuk menghadirkan kesan profesional namun tetap berbudaya.</p><ul><li>Bahan: Katun Premium</li><li>Ukuran: S, M, L, XL, XXL</li></ul>',
                'price' => 295000,
                'stock' => 18,
                'is_featured' => false,
            ],
            // Busana Wanita
            [
                'category' => 'Busana Wanita',
                'name' => 'Tunik Batik Modern Motif Durian Pecah',
                'description' => '<p>Tunik wanita modern dengan sentuhan motif <strong>Durian Pecah</strong> yang dipadukan dengan potongan kontemporer. Nyaman dan stylish untuk berbagai kesempatan.</p><ul><li>Bahan: Rayon Soft</li><li>Ukuran: S, M, L, XL</li><li>Panjang: 80cm</li></ul>',
                'price' => 320000,
                'stock' => 12,
                'is_featured' => true,
            ],
            [
                'category' => 'Busana Wanita',
                'name' => 'Dress Midi Batik Angso Duo',
                'description' => '<p>Dress midi wanita dengan motif <strong>Angso Duo</strong> yang anggun. Potongan A-line yang flattering untuk berbagai bentuk tubuh, cocok untuk acara formal maupun semi-formal.</p><ul><li>Bahan: Katun Satin</li><li>Ukuran: S, M, L, XL</li><li>Panjang: 110cm</li></ul>',
                'price' => 495000,
                'stock' => 8,
                'is_featured' => true,
            ],
            // Aksesoris
            [
                'category' => 'Aksesoris',
                'name' => 'Tas Tote Batik Premium',
                'description' => '<p>Tas tote dengan motif batik Jambi yang artistik. Terbuat dari kanvas berkualitas tinggi dengan lapisan dalam yang kuat. Fungsional sekaligus menjadi statement fashion yang unik.</p><ul><li>Bahan: Canvas Premium</li><li>Ukuran: 40 x 35 x 10 cm</li><li>Dilengkapi resleting dalam</li></ul>',
                'price' => 185000,
                'stock' => 25,
                'is_featured' => false,
            ],
            [
                'category' => 'Aksesoris',
                'name' => 'Dompet Lipat Batik Motif Biji Timun',
                'description' => '<p>Dompet lipat pria/wanita dengan motif <strong>Biji Timun</strong> yang klasik. Terbuat dari kulit sintetis premium dengan permukaan batik yang indah.</p><ul><li>Bahan: Kulit Sintetis + Kain Batik</li><li>Ukuran: 11 x 9 cm (saat terlipat)</li><li>8 slot kartu, 2 kantong uang</li></ul>',
                'price' => 145000,
                'stock' => 30,
                'is_featured' => false,
            ],
        ];

        foreach ($productData as $prod) {
            $cat = $categories[$prod['category']];
            Product::firstOrCreate(
                ['slug' => Str::slug($prod['name'])],
                [
                    'category_id' => $cat->id,
                    'name' => $prod['name'],
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'stock' => $prod['stock'],
                    'is_featured' => $prod['is_featured'],
                    'status' => 'published',
                    'images' => null,
                ]
            );
        }

        // ============================================
        // 4. Posts
        // ============================================
        $postData = [
            [
                'title' => 'Filosofi di Balik Motif Biji Timun Batik Jambi',
                'content' => '<p>Motif <strong>Biji Timun</strong> adalah salah satu motif tua dalam khazanah Batik Jambi yang penuh dengan makna filosofis. Motif ini menggambarkan biji-biji timun yang tersebar, melambangkan <em>kemakmuran, kesuburan, dan harapan akan masa depan yang lebih baik</em>.</p>
<h2>Sejarah Motif Biji Timun</h2>
<p>Konon, motif ini pertama kali muncul pada abad ke-17 ketika Kesultanan Jambi sedang berjaya. Para pengrajin batik terinspirasi dari tanaman timun yang melambangkan kelimpahan hasil bumi. Setiap titik dalam motif ini diharapkan menjadi simbol berkah yang melimpah bagi pemakainya.</p>
<h2>Teknik Pembuatan</h2>
<p>Pembuatan batik tulis dengan motif Biji Timun memerlukan kesabaran dan keahlian tinggi. Pengrajin harus menggambar satu per satu titik dengan canting berisi malam panas. Proses ini bisa memakan waktu hingga dua minggu untuk satu lembar kain berukuran standar.</p>
<h2>Makna Filosofis</h2>
<p>Dalam tradisi masyarakat Jambi, kain batik bermotif Biji Timun sering dipakai dalam upacara adat seperti pernikahan dan perayaan panen. Konon, memakainya akan membawa keberuntungan dan kemakmuran bagi pemakainya.</p>',
            ],
            [
                'title' => 'Cara Merawat Batik Tulis Agar Tetap Awet dan Indah',
                'content' => '<p>Batik tulis adalah karya seni yang memerlukan perawatan khusus. Dengan perawatan yang tepat, kain batik tulis Anda bisa bertahan puluhan tahun bahkan menjadi warisan yang tak ternilai.</p>
<h2>Cara Mencuci yang Benar</h2>
<ul>
<li>Cuci batik tulis dengan tangan menggunakan air dingin atau suam-suam kuku</li>
<li>Gunakan sabun yang lembut atau shampo, bukan deterjen keras</li>
<li>Jangan digosok atau dipelintir terlalu keras</li>
<li>Bilas dengan air bersih hingga sabun benar-benar hilang</li>
</ul>
<h2>Cara Menyimpan</h2>
<ul>
<li>Simpan dalam posisi terlipat rapi di tempat yang tidak lembab</li>
<li>Gunakan kertas tisu untuk membungkus kain sebelum dilipat</li>
<li>Jangan menyimpan dalam plastik tertutup rapat terlalu lama</li>
<li>Beri kapur barus alami untuk mencegah ngengat</li>
</ul>
<h2>Tips Tambahan</h2>
<p>Hindari menjemur batik di bawah sinar matahari langsung karena dapat membuat warna cepat memudar. Sebaiknya jemur di tempat teduh yang berangin. Setrika batik di bagian dalam dengan suhu rendah.</p>',
            ],
            [
                'title' => 'Mengenal 7 Motif Batik Jambi yang Paling Populer',
                'content' => '<p>Batik Jambi memiliki ratusan motif yang kaya akan simbolisme dan sejarah. Dari sekian banyak motif yang ada, berikut adalah 7 motif yang paling populer dan sering dijumpai dalam koleksi batik Jambi.</p>
<h2>1. Motif Biji Timun</h2>
<p>Motif dengan titik-titik beraturan yang melambangkan kemakmuran dan kesuburan. Salah satu motif tertua dalam tradisi batik Jambi.</p>
<h2>2. Motif Durian Pecah</h2>
<p>Terinspirasi dari buah durian yang terbelah, motif ini melambangkan kejujuran dan keterbukaan hati. Sangat populer di kalangan masyarakat Jambi.</p>
<h2>3. Motif Angso Duo</h2>
<p>Menggambarkan dua ekor angsa berhadapan yang melambangkan persatuan dan keharmonisan. Menjadi ikon budaya Jambi dan bahkan digunakan sebagai logo Pemerintah Kota Jambi.</p>
<h2>4. Motif Kuaub Berhias</h2>
<p>Motif yang menggambarkan payung yang dihiasi ornamen indah. Melambangkan perlindungan dan kemewahan.</p>
<h2>5. Motif Kalung Berhias</h2>
<p>Terinspirasi dari perhiasan tradisional, motif ini melambangkan keindahan dan keanggunan.</p>
<h2>6. Motif Tampuk Manggis</h2>
<p>Terinspirasi dari kelopak buah manggis, motif ini melambangkan kelembutan dan kesuburan.</p>
<h2>7. Motif Bungo Tanjung</h2>
<p>Motif bunga tanjung yang harum, melambangkan keharuman nama dan kejayaan leluhur Jambi.</p>',
            ],
        ];

        foreach ($postData as $post) {
            Post::firstOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'content' => $post['content'],
                    'status' => 'published',
                ]
            );
        }

        // ============================================
        // 5. Team Members
        // ============================================
        $teamData = [
            ['name' => 'Hj. Siti Aisyah', 'position' => 'Pendiri & Pengrajin Utama', 'bio' => 'Lebih dari 30 tahun berpengalaman dalam membatik, penjaga tradisi motif asli Jambi.'],
            ['name' => 'Ahmad Fauzi', 'position' => 'Direktur Pemasaran', 'bio' => 'Memimpin strategi pemasaran dan pengembangan bisnis ke pasar nasional & internasional.'],
            ['name' => 'Rini Marlina', 'position' => 'Kepala Pengrajin', 'bio' => 'Mengawasi kualitas produksi dan pelatihan pengrajin baru di workshop.'],
            ['name' => 'Budi Santoso', 'position' => 'Desainer Motif', 'bio' => 'Lulusan ISI dengan passion mendalam dalam melestarikan dan mengembangkan motif batik Jambi.'],
        ];

        foreach ($teamData as $index => $member) {
            TeamMember::firstOrCreate(
                ['name' => $member['name']],
                [
                    'position' => $member['position'],
                    'bio' => $member['bio'],
                    'photo' => null, // Will use UI-Avatars fallback in view
                ]
            );
        }

        // ============================================
        // 6. Sliders
        // ============================================
        $sliderData = [
            [
                'title' => 'Keindahan Warisan Batik Jambi',
                'description' => 'Temukan koleksi eksklusif batik tulis dan cetak dengan motif tradisional yang kaya akan makna dan sejarah.',
                'image' => 'sliders/hero-1.jpg',
                'link' => '/products',
                'order' => 1,
            ],
            [
                'title' => 'Koleksi Ramadhan 2026',
                'description' => 'Sambut hari raya dengan keanggunan busana batik Jambi modern. Diskon hingga 20% untuk koleksi pilihan.',
                'image' => 'sliders/hero-2.jpg',
                'link' => '/products?category=busana-pria',
                'order' => 2,
            ],
            [
                'title' => 'Workshop Batik Jambi',
                'description' => 'Ingin belajar membatik? Ikuti kelas workshop kami dan bawa pulang karya seni Anda sendiri.',
                'image' => 'sliders/hero-3.jpg',
                'link' => '/about',
                'order' => 3,
            ],
        ];

        foreach ($sliderData as $slider) {
            Slider::firstOrCreate(
                ['title' => $slider['title']],
                $slider
            );
        }

        // Create dummy slider files to avoid 404/403
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('sliders')) {
            \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('sliders');
        }

        // ============================================
        // 7. Settings
        // ============================================
        $settings = [
            ['key' => 'site_name', 'value' => 'Batik Jambi Berkah Group'],
            ['key' => 'tagline', 'value' => 'Melestarikan Warisan Budaya Melalui Karya Batik'],
            ['key' => 'whatsapp', 'value' => '6281234567890'],
            ['key' => 'email', 'value' => 'info@batikjambiberkah.com'],
            ['key' => 'address', 'value' => 'Jl. Batik Lama No. 88, Jambi 36122'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/batikjambiberkah'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/batikjambiberkah'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('👤 Admin: admin@batikjambiberkah.com / password');
    }
}
