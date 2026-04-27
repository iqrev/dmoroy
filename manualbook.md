# Manual Book - Batik Jambi Berkah '87

Dokumentasi ini berisi panduan penggunaan fitur-fitur yang tersedia di website Batik Jambi Berkah, baik dari sisi Administrator (Admin Panel) maupun sisi Pengunjung (Frontend).

## Daftar Isi
1. [Fitur Admin Panel](#fitur-admin-panel)
2. [Manajemen Media (Curator)](#manajemen-media-curator)
3. [Fitur Frontend (Website Utama)](#fitur-frontend-website-utama)
4. [Pengaturan SEO & Meta](#pengaturan-seo--meta)
5. [Panduan Operasional Umum](#panduan-operasional-umum)

---

## Fitur Admin Panel
Panel Admin dikelola menggunakan **Filament PHP v3**. Anda dapat mengaksesnya melalui `/admin`.

### 1. Manajemen Produk (`Katalog`)
- **Produk**: Mengelola katalog batik (Nama, Harga, Stok, Deskripsi).
    - **Status Publikasi**: Gunakan status `Draft` jika produk belum siap ditampilkan, atau `Tayang` untuk mempublikasikannya.
    - **Views Count**: Anda dapat memantau seberapa banyak produk telah dilihat oleh pengunjung langsung dari tabel produk.
- **Kategori Produk**: Mengelompokkan produk berdasarkan jenis batik (Contoh: Pewarna Alam, Batik Tulis).
- **Tag Produk**: Gunakan tag untuk mempermudah pencarian produk berdasarkan kata kunci spesifik (Contoh: #tulis, #pewarnaalam).
- **Produk Unggulan**: Menampilkan produk pilihan di halaman depan dengan mengaktifkan toggle "Unggulan".

### 2. Manajemen Artikel (`Blog`)
- **Artikel**: Mengelola konten berita, edukasi, atau dokumentasi event.
- **Kategori Artikel**: Pengelompokan artikel (Contoh: Edukasi, Dokumentasi).
- **Rich Editor**: Penulisan konten menggunakan teks bergaya (Heading, Bold, List, Image).

### 3. Manajemen Konten Statis
- **Slider**: Mengelola gambar carousel/slide yang muncul di bagian paling atas halaman Beranda.
- **Team**: Mengelola profil tim/staf yang muncul di halaman "Tentang Kami".
- **Settings**: Pengaturan global website (Nama Toko, Logo, Footer, Link Social Media, & Nomor WhatsApp).

### 4. Manajemen Komunikasi
- **Pesan**: Melihat data pesan yang masuk melalui formulir kontak di halaman Frontend.

---

## Manajemen Media (Curator)
Website ini menggunakan sistem manajemen media ala WordPress.

### Keunggulan:
- **Reuse Media**: Gambar yang sudah diunggah sekali dapat digunakan berkali-kali di Produk atau Artikel tanpa perlu unggah ulang.
- **Infinite Scroll**: Galeri media akan otomatis memuat gambar lama saat Anda men-scroll ke bawah di jendela picker.
- **Square Preview**: Tampilan pratinjau media di Admin seragam (Rasio 1:1) agar terlihat rapi dan tidak memakan ruang.
- **Optimasi WebP**: Sistem otomatis mengarahkan penggunaan format WebP untuk performa website yang lebih cepat.

---

## Fitur Frontend (Website Utama)
Halaman yang dapat diakses oleh publik:

1. **Beranda (Home)**:
    - Slide utama (Hero Slider).
    - Menampilkan Produk Unggulan.
    - Menampilkan Artikel terbaru.
2. **Katalog Produk**:
    - Melihat daftar semua produk.
    - Filter berdasarkan kategori.
    - Detail produk dengan galeri foto.
    - **Order via WhatsApp**: Tombol otomatis yang mengarahkan pelanggan ke WhatsApp Admin dengan format pesan khusus.
3. **Blog / Artikel**:
    - Halaman berita dan edukasi seputar Batik Jambi.
    - Breadcrumbs untuk kemudahan navigasi.
4. **Keranjang Belanja (Cart)**:
    - Fitur sederhana untuk mengumpulkan produk sebelum melakukan checkout via WhatsApp.
5. **Tentang Kami (About)**:
    - Sejarah singkat dan Visi Misi.
    - Menampilkan profil tim pengelola.
6. **Hubungi Kami (Contact)**:
    - Lokasi bisnis (Map).
    - Formulir pengiriman pesan.

---

## Pengaturan SEO & Meta
Website ini sudah dilengkapi dengan fitur optimasi mesin pencari secara otomatis:
- **Meta Tags**: Judul dan deskripsi halaman diatur secara dinamis untuk memudahkan Google dan Search Engine lainnya mengindeks website.
* **JSON-LD Structure**: Data terstruktur otomatis disisipkan di setiap produk dan artikel untuk memunculkan rich snippet di hasil pencarian.
* **Open Graph**: Saat link website dibagikan ke media sosial (WhatsApp, Facebook, Twitter), pratinjau gambar dan deskripsi akan muncul secara profesional.

---

## Panduan Operasional Umum

### Cara Menambah Produk Baru:
1. Masuk ke **Admin Panel** > **Produk**.
2. Klik tombol **New Product**.
3. Isi Nama, Harga, dan Stok.
4. Pilih gambar dari **Media Library** (atau unggah baru).
5. Klik **Save**.

### Cara Mengganti Nomor WhatsApp (Checkout):
1. Masuk ke **Admin Panel** > **Settings**.
2. Cari kolom input nomor WhatsApp (Pastikan diawali dengan kode negara, contoh: `62812...`).
3. Klik **Save Changes**.

### Cara Mengoptimalkan Gambar:
- Disarankan menggunakan gambar dengan rasio 1:1 (Square) untuk produk agar tampilan di website terlihat konsisten dan rapi.
- Ukuran file maksimal tiap gambar yang disarankan adalah di bawah 1MB untuk menjamin kecepatan akses pengguna.

---
*Manual book ini dibuat untuk membantu operasional tim Batik Jambi Berkah '87.*
