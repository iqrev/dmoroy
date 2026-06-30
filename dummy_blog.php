<?php
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;

$post1 = Post::create([
    'title' => 'Panduan Lengkap Merawat Produk Anyaman Pandan Dmoroy Agar Awet',
    'slug' => Str::slug('Panduan Lengkap Merawat Produk Anyaman Pandan Dmoroy Agar Awet'),
    'content' => '<h2>Kenapa Anyaman Pandan Perlu Perawatan Khusus?</h2><p>Produk anyaman pandan dari Dmoroy dibuat dengan bahan alami yang ramah lingkungan. Untuk memastikan tas, dompet, atau dekorasi anyaman Anda tetap indah dan awet hingga bertahun-tahun, ada beberapa langkah perawatan sederhana yang bisa Anda ikuti.</p><h3>1. Jauhkan dari Tempat Lembap</h3><p>Musuh utama bahan alami adalah kelembapan yang bisa memicu jamur. Simpan produk Dmoroy Anda di tempat yang kering dan bersirkulasi udara baik. Jika Anda menyimpannya di dalam lemari, pastikan untuk menggunakan <em>silica gel</em> atau penyerap kelembapan lainnya.</p><h3>2. Bersihkan Secara Rutin dengan Sikat Halus</h3><p>Debu bisa menempel di sela-sela anyaman. Gunakan sikat berbulu halus (seperti kuas cat atau sikat gigi bayi yang kering) untuk menyapu debu secara perlahan mengikuti alur anyaman. Jangan menggunakan kain basah yang terlalu berair.</p><h3>3. Keringkan Jika Terkena Air</h3><p>Jika produk anyaman Anda tidak sengaja terkena cipratan air, segera keringkan dengan kain bersih atau handuk kertas dengan cara ditepuk-tepuk lembut (jangan digosok). Setelah itu, angin-anginkan di tempat teduh. Hindari menjemur langsung di bawah terik matahari yang terlalu panas karena bisa membuat serat pandan menjadi rapuh dan memudar warnanya.</p><h3>4. Pertahankan Bentuknya</h3><p>Jika itu adalah tas, masukkan gumpalan kertas koran atau kertas tisu tanpa tinta ke dalamnya saat sedang tidak digunakan. Ini akan membantu tas mempertahankan bentuk aslinya dan tidak penyok.</p><p>Dengan perawatan yang tepat, produk Dmoroy Anda akan menemani gaya hidup berkelanjutan Anda dalam waktu yang sangat lama!</p>',
    'image' => 1,
    'status' => 'published',
]);
$post1->categories()->attach([1, 2]);

$post2 = Post::create([
    'title' => 'Seni Menganyam: Menjaga Tradisi Leluhur Melalui Dmoroy',
    'slug' => Str::slug('Seni Menganyam Menjaga Tradisi Leluhur Melalui Dmoroy'),
    'content' => '<h2>Mengenal Seni Anyaman Pandan</h2><p>Menganyam bukan sekadar merangkai daun menjadi barang fungsional; ini adalah kesabaran, ketelitian, dan warisan budaya yang diturunkan dari generasi ke generasi. Di Dmoroy, kami percaya bahwa setiap anyaman memiliki jiwa dan ceritanya masing-masing.</p><h3>Proses Panjang Sebuah Karya</h3><p>Tahukah Anda bahwa proses pembuatan satu tas anyaman pandan bisa memakan waktu berhari-hari? Prosesnya dimulai dari pemilihan daun pandan berduri (pandan samak) yang sudah cukup tua. Daun-daun ini kemudian dibuang durinya, disayat menjadi helaian kecil, direbus untuk mematikan hama, dan dijemur hingga kering sempurna di bawah sinar matahari.</p><p>Setelah itu, helaian pandan akan diwarnai menggunakan pewarna dan kemudian dijemur kembali. Barulah setelah itu proses penganyaman dimulai oleh tangan-tangan terampil para pengrajin lokal kami.</p><h3>Pemberdayaan Pengrajin Lokal</h3><p>Setiap produk Dmoroy yang Anda beli secara langsung berkontribusi pada kesejahteraan para pengrajin perempuan di desa-desa. Kami memastikan mereka mendapatkan kompensasi yang adil untuk keterampilan luar biasa mereka. Dengan memadukan desain modern dan teknik tradisional, Dmoroy berusaha membawa seni menganyam agar tetap relevan di era modern.</p><blockquote>"Setiap helai pandan yang dianyam adalah doa dan harapan dari pengrajinnya."</blockquote><p>Mari bersama-sama melestarikan budaya dan mendukung UMKM lokal bersama Dmoroy.</p>',
    'image' => 2,
    'status' => 'published',
]);
$post2->categories()->attach([1]);
echo "Posts created!\n";
