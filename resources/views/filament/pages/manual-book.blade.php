<x-filament-panels::page>
    <div class="space-y-8">
        
        <!-- Pengantar -->
        <x-filament::section icon="heroicon-o-home">
            <x-slot name="heading">
                Pendahuluan & Dashboard
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300">
                <p>Selamat datang di Panel Admin Dmoroy. Panduan ini akan membantu Anda mengelola seluruh konten website selangkah demi selangkah.</p>
                <p>Saat Anda login, halaman pertama yang Anda lihat adalah <strong>Dashboard</strong>. Di sini Anda dapat melihat ringkasan data dan menemukan widget <strong>Maintenance Mode</strong> (Mode Perbaikan).</p>
                <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-lg mt-2">
                    <strong>💡 Tips:</strong> Menu navigasi berada di sebelah kiri layar Anda. Jika Anda menggunakan HP/Tablet, klik ikon garis tiga (hamburger menu) di pojok kiri atas untuk memunculkan menu.
                </div>
            </div>
        </x-filament::section>

        <!-- Katalog Produk -->
        <x-filament::section icon="heroicon-o-shopping-bag">
            <x-slot name="heading">
                1. Cara Mengelola Katalog Produk
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 space-y-4">
                <p>Bagian <strong>Katalog</strong> berfungsi untuk menampilkan produk dagangan Anda di website. Pengunjung nantinya dapat memesan produk ini langsung melalui WhatsApp.</p>
                
                <h4>A. Membuat Kategori Produk</h4>
                <p>Sebelum menambah produk, pastikan Anda sudah membuat kategori (misal: "Tas Jinjing", "Tas Selempang").</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Klik menu <strong>Categories</strong> di grup Katalog.</li>
                    <li>Klik tombol <strong>New Category</strong> di kanan atas.</li>
                    <li>Isi <strong>Name</strong> (Nama Kategori). Kolom Slug akan terisi otomatis.</li>
                    <li>Klik <strong>Create</strong> untuk menyimpan.</li>
                </ol>

                <h4>B. Menambah Produk Baru</h4>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Klik menu <strong>Products</strong>.</li>
                    <li>Klik tombol <strong>New Product</strong>.</li>
                    <li>Isi bagian <strong>General</strong>: Nama Produk, Harga (isi angka saja tanpa titik/koma, misal: 150000), dan Deskripsi Produk.</li>
                    <li>Pada bagian <strong>Media</strong>, klik kotak gambar untuk memilih atau mengunggah foto produk menggunakan <em>Media Manager</em>.</li>
                    <li>Pilih <strong>Kategori</strong> dan <strong>Tag</strong> (label) yang sesuai di panel sebelah kanan.</li>
                    <li>Klik <strong>Create</strong> (atau <em>Create & Create Another</em> jika ingin langsung lanjut menambah produk lain).</li>
                </ol>
                <div class="p-4 bg-amber-50 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 rounded-lg mt-2 border border-amber-200 dark:border-amber-700/50">
                    <strong>Penting:</strong> Pastikan Anda telah mengatur nomor WhatsApp di menu <strong>Settings</strong> agar tombol pemesanan di website mengarah ke kontak yang benar.
                </div>
            </div>
        </x-filament::section>

        <!-- Berita & Edukasi -->
        <x-filament::section icon="heroicon-o-document-text">
            <x-slot name="heading">
                2. Cara Menulis Artikel (Berita & Edukasi)
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 space-y-4">
                <p>Menu ini digunakan untuk publikasi artikel, tips, berita kegiatan, atau edukasi terkait anyaman.</p>

                <h4>A. Menambah Kategori Artikel</h4>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Buka menu <strong>Post Categories</strong>.</li>
                    <li>Klik <strong>New Post Category</strong>, ketik namanya (misal: "Tips Merawat Anyaman" atau "Event"), lalu klik <strong>Create</strong>.</li>
                </ol>

                <h4>B. Membuat Artikel Baru</h4>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Buka menu <strong>Posts</strong> lalu klik <strong>New Post</strong>.</li>
                    <li>Isi <strong>Title</strong> (Judul Artikel).</li>
                    <li>Isi <strong>Tanggal Dibuat (Created at)</strong> jika Anda ingin mengatur tanggal rilis artikel (opsional, jika dikosongkan akan otomatis menggunakan tanggal dan jam saat ini).</li>
                    <li>Di kotak teks <strong>Content</strong>, ketik isi tulisan Anda. Anda bisa mempertebal teks, membuat *list*, atau menyisipkan *link* menggunakan *toolbar* yang tersedia (seperti menggunakan Microsoft Word).</li>
                    <li>Pilih gambar kover artikel (<em>Featured Image</em>) di kolom bagian kanan, lalu pilih kategori artikelnya.</li>
                    <li>Klik <strong>Create</strong> untuk mempublikasikan.</li>
                </ol>
                <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-lg mt-2">
                    <strong>💡 Tips:</strong> Untuk melihat tampilan asli artikel yang sudah tayang di website, Anda bisa kembali ke halaman daftar <strong>Posts</strong>, lalu klik tulisan <strong>Lihat</strong> pada baris artikel tersebut.
                </div>
            </div>
        </x-filament::section>

        <!-- Profil Toko -->
        <x-filament::section icon="heroicon-o-user-group">
            <x-slot name="heading">
                3. Mengelola Tim & Kotak Masuk Pesan
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 space-y-4">
                
                <h4>A. Menambah Anggota Tim (Team Members)</h4>
                <p>Digunakan untuk menampilkan foto pengrajin atau tim inti Anda di halaman "Tentang Kami".</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Klik menu <strong>Team Members</strong> di grup Profil Toko.</li>
                    <li>Klik <strong>New Team Member</strong>.</li>
                    <li>Isi <strong>Name</strong> dan <strong>Role</strong> (Jabatan, misal: "Pengrajin Utama" atau "CEO").</li>
                    <li>Unggah foto di kolom Photo.</li>
                    <li>(Opsional) Isi tautan / link profil media sosial (Instagram, Facebook) jika ada.</li>
                    <li>Klik <strong>Create</strong>.</li>
                </ol>

                <h4>B. Membaca Pesan Pengunjung (Messages)</h4>
                <p>Setiap pesan yang dikirim oleh pengunjung melalui formulir "Hubungi Kami" di website, akan terkumpul di menu <strong>Messages</strong>.</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Buka menu tersebut untuk melihat daftar pesan masuk.</li>
                    <li>Klik ikon mata (View) pada baris pesan untuk membaca detail dan informasi kontak pengirim, lalu Anda bisa menghubunginya secara mandiri via Email / WhatsApp.</li>
                </ul>
            </div>
        </x-filament::section>

        <!-- Pengaturan Web -->
        <x-filament::section icon="heroicon-o-cog-6-tooth">
            <x-slot name="heading">
                4. Pengaturan Sistem & Informasi Website
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 space-y-4">
                <p>Bagian ini mengatur semua teks dasar, link sosial media, kontak, hingga akses admin.</p>

                <h4>A. Mengubah Info Website (Settings)</h4>
                <p>Buka menu <strong>Settings</strong> di grup Pengaturan. Di sini Anda akan melihat barisan data seperti <code>whatsapp</code>, <code>instagram</code>, <code>address</code>, dll. Untuk mengubahnya:</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Klik tombol <strong>Edit</strong> di sebelah kanan pada baris yang ingin diubah (contoh: <code>whatsapp</code>).</li>
                    <li>Ubah isi teks pada kolom <strong>Value</strong>.</li>
                    <li>Klik <strong>Save Changes</strong>.</li>
                </ol>
                <p class="text-xs text-gray-500">* Catatan format nomor WA: Gunakan format internasional tanpa tanda tambah (+). Contoh: <code>6281234567890</code>.</p>

                <h4>B. Menambah Admin Baru (Users)</h4>
                <p>Anda dapat memberikan akses kepada rekan kerja dengan menambahkannya di menu <strong>Users</strong>. Klik <strong>New User</strong> -> Isi Nama, Email, dan Password -> Klik <strong>Create</strong>.</p>

                <h4>C. Mengaktifkan Mode Perbaikan (Maintenance Mode)</h4>
                <p>Jika Anda sedang merombak konten dan tidak ingin toko dilihat secara umum sementara waktu:</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Buka halaman awal <strong>Dashboard</strong>.</li>
                    <li>Cari kotak panel <strong>Maintenance Mode</strong>.</li>
                    <li>Klik tombol untuk menyalakannya.</li>
                    <li>Saat aktif, Anda (Admin) tetap bisa mengakses dan melihat website seperti biasa, namun pengunjung umum akan mendapati halaman beranda menampilkan status "Situs Sedang Diperbaiki".</li>
                </ol>

                <h4>D. Pemantauan Aktivitas Keamanan</h4>
                <p>Website Anda telah dilengkapi perlindungan sistem dari upaya pembobolan <em>(Brute Force & Honeypot)</em>. Anda dapat memantau riwayat siapa saja yang mencoba <em>login</em> ke panel admin (baik yang sukses maupun gagal) secara langsung melalui widget <strong>Login Attempts</strong> yang ada di halaman paling depan Dashboard.</p>
            </div>
        </x-filament::section>

        <!-- Galeri Pelanggan -->
        <x-filament::section icon="heroicon-o-camera">
            <x-slot name="heading">
                5. Mengelola Galeri Pelanggan (Instagram)
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 space-y-4">
                <p>Bagian ini mengatur foto-foto pelanggan yang muncul di halaman utama website pada bagian <strong>#KisahDMoroy</strong>.</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Buka menu <strong>Galeri Pelanggan</strong> di grup Tampilan Depan.</li>
                    <li>Klik <strong>New Galeri Pelanggan</strong>.</li>
                    <li>Pilih foto dari <em>Media Manager</em>.</li>
                    <li>(Opsional) Masukkan <strong>Link Instagram</strong> pelanggan jika Anda ingin pengunjung diarahkan ke profil tersebut saat foto diklik.</li>
                    <li>Atur <strong>Urutan</strong> (semakin kecil angka, semakin awal muncul) dan pastikan tombol <strong>Aktif</strong> menyala.</li>
                    <li>Klik <strong>Create</strong>.</li>
                </ol>
            </div>
        </x-filament::section>

        <!-- Media Manager -->
        <x-filament::section icon="heroicon-o-photo">
            <x-slot name="heading">
                6. Panduan Penggunaan Media (Gambar)
            </x-slot>
            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300 space-y-4">
                <p>Panel Admin ini dilengkapi dengan <strong>Media Manager (Curator)</strong>. Fitur ini layaknya "Galeri HP", di mana semua foto yang pernah Anda unggah (upload) akan tersimpan dan dapat digunakan kembali berulang kali tanpa harus mengunggah ulang.</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Saat Anda diminta memasukkan foto produk atau artikel, klik pada kotak kosong yang tersedia.</li>
                    <li>Jendela <em>popup</em> Galeri akan muncul.</li>
                    <li><strong>Untuk Gambar Baru:</strong> Tarik & lepas (<em>drag & drop</em>) file dari komputer Anda ke dalam jendela tersebut, atau klik area unggah di dalam popup.</li>
                    <li><strong>Untuk Gambar Lama:</strong> Cukup cari dan klik foto yang pernah diunggah sebelumnya di galeri tersebut, lalu klik tombol <strong>Insert</strong> di pojok.</li>
                </ul>
            </div>
        </x-filament::section>
        
    </div>
</x-filament-panels::page>
