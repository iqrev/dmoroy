# Changelog - Batik Jambi Berkah

Semua perubahan penting pada proyek ini akan didokumentasikan di sini.

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
