# Changelog - Batik Jambi Berkah

Semua perubahan penting pada proyek ini akan didokumentasikan di sini.

## [1.3.0] - 2026-05-19
### Added
- **Sistem Role Management**: Menambahkan tingkat keamanan baru (`super_admin` dan `admin`) pada tabel pengguna.
- **Menu Karyawan / Admin**: Hanya *Super Admin* yang dapat melihat menu ini untuk mengelola akun staf lain (*User Policy*).
- **Widget Produk Terbaru**: Menambahkan tabel ringkasan 5 produk terakhir yang ditambahkan langsung ke layar utama dasbor admin.
- **Kompresi & Editor Gambar**: Menambahkan fitur *Image Editor* dan kompresi rasio maksimal (1280px) untuk unggahan gambar artikel (*PostResource*).

### Changed
- **Pembaruan Desain UI/UX Admin**: Warna dasar Panel Admin (Filament) diubah menjadi *Crimson Red* (#8b0000) dengan tipografi *Plus Jakarta Sans*.
- **Penyederhanaan Ruang Kerja**: *Sidebar* admin kini dapat dilipat (*collapsible*), dan widget sapaan (*Welcome Account Widget*) dihilangkan untuk area yang lebih lega.
- **Redesain Kotak Maintenance**: Memperbarui *interface* widget pemeliharaan agar sejajar (inline) dengan batasan warna penanda (*border*) yang lebih rapi.

### Fixed
- Memperbaiki kotak isian Editor Teks (Tiptap / ProseMirror) pada Artikel yang sebelumnya menyisakan area tidak bisa diklik di bagian bawah kotak.
- Memperbaiki kegagalan (*bug*) render tombol *upload* gambar utama (*CuratorPicker*) pada halaman Artikel, dan menggantinya dengan fitur FileUpload bawaan Filament.

## [1.2.2] - 2026-05-18
### Added
- Widget *Maintenance Mode* di halaman Dashboard Admin (mematikan/menyalakan website dengan satu klik).
- Pengecualian akses halaman Admin saat website dalam mode *maintenance*.

### Changed
- Mengubah tampilan form pembuatan Artikel menjadi *full-width* vertikal agar ruang ketik maksimal.
- Editor teks "Isi Artikel" secara default dibuat lebih tinggi/luas (`min-height: 30rem`).

### Fixed
- Error *Undefined array key `size_for_humans`* pada Curator Picker yang menyebabkan halaman Edit Produk *crash*.
- Kolom *slug* artikel diubah dari *disabled* menjadi *readOnly* agar dapat terisi otomatis saat judul diketik.

## [1.2.1] - 2026-05-13
### Fixed
- Memperbaiki *Internal Server Error* (syntax error) pada halaman detail produk di production yang disebabkan oleh Blade mem-parsing key `"@context"` pada JSON-LD Schema.


## [1.2.0] - 2026-04-10
### Added
- Sistem Keranjang Belanja (Shopping Cart) berbasis session.
- Fitur Checkout via WhatsApp dengan pesan otomatis yang terformat.
- Badge jumlah item di keranjang pada navbar (Desktop & Mobile).
- Halaman Detail Produk menyertakan pilihan "Tambah ke Keranjang" dan "Beli Langsung".
- Section "Produk Lainnya" pada halaman detail produk.

### Fixed
- Error `foreach()` pada detail produk jika gambar bernilai null.
- Typo pada heading "Produk Serupa".

## [1.1.0] - 2026-04-10
### Added
- Relasi Many-to-Many untuk Kategori Artikel.
- Halaman Frontend sekarang menampilkan banyak kategori untuk setiap artikel.
- Optimasi SEO dengan JSON-LD Schema (Product & BlogPosting).
- Integrasi Video Hero YouTube yang dinamis di Beranda.

### Changed
- CMS: Pengelompokan menu navigasi admin (Katalog, Berita & Edukasi, Profil Toko, Pengaturan).
- CMS: Input slug otomatis di-disable dan bersifat read-only.

## [1.0.0] - 2026-04-09
### Added
- Inisialisasi proyek Laravel 11 dengan Filament PHP.
- Desain dasar frontend dengan Tailwind CSS v4.
- Management Produk, Kategori, Artikel, dan Slider.
- Halaman Profil (About Us) dan Kontak.
