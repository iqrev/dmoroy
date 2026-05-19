# Project Context for Gemini

Dokumen ini berfungsi sebagai panduan konteks (*system prompt*) untuk AI (khususnya Gemini) saat menangani proyek ini di sesi mendatang.

## 1. Tech Stack Overview
- **Framework**: Laravel (v13.4.0)
- **PHP Version**: >= 8.3 (Server Produksi menggunakan 8.4.19)
- **Admin Panel**: Filament PHP v3
- **Styling**: Tailwind CSS v4, Blade Components
- **Media Manager**: Awcodes/Curator (Filament Plugin)

## 2. Server & Deployment (Hostinger)
Proyek ini di-*hosting* pada layanan *Shared Hosting* Hostinger (hPanel). Ada aturan ketat yang wajib diperhatikan AI:
- **PHP CLI Tersembunyi**: Perintah `php` atau `composer` di terminal SSH secara bawaan mengarah ke PHP 8.2 (yang tidak kompatibel dengan Laravel 13). Selalu instruksikan user untuk menggunakan alias `php8.4` atau *path* absolut `/usr/bin/php8.4` (Contoh: `php8.4 artisan migrate`).
- **Symlink Dilarang oleh Server**: Fungsi PHP `symlink()` di-disable oleh Hostinger demi keamanan. Jika menjalankan `php artisan storage:link`, akan muncul *Error 500* atau *exec() failed*.
  - **Solusi Tepat**: Gunakan *command* Linux native lewat SSH: `ln -s "$PWD/storage/app/public" "$PWD/public/storage"`.

## 3. Fitur Kunci
- **Manajemen Konten (CMS)**: Post/Artikel menggunakan Filament RichEditor tinggi dinamis (`min-height: 30rem`). Input `slug` bersifat `readOnly()` (otomatis terisi berdasarkan nama).
- **Maintenance Pintar**: Fitur *Maintenance Mode* dikontrol dari Widget Dashboard. Telah ditambahkan pengecualian (*bypass*) di `bootstrap/app.php` untuk rute `/admin*` dan `/livewire*` agar Admin tidak terkunci saat situs sedang *down*. Terdapat juga custom halaman *error 503* di `resources/views/errors/503.blade.php`.
- **E-Commerce Minimalis**: Terdapat struktur produk, relasi tag/kategori, dan alur checkout via WhatsApp.

## 4. Instruksi Perbaikan Kode
- Jika terjadi error `Undefined array key "size_for_humans"` pada Curator Picker, itu karena gambar lama tidak memiliki meta data. Gunakan *Null Coalescing* (`?? ''`) di *blade template* nya.
- Gunakan struktur komponen Filament v3 (misal: gunakan `x-filament::section` bukan `x-filament::card`).
- **DILARANG KERAS** menyarankan perintah `php artisan migrate:fresh` di *production* karena database sudah memiliki data (katalog & artikel) yang aktif. Selalu gunakan `php artisan migrate --force`.
