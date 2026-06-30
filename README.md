# UMKM Website Blueprint

Blueprint atau template website untuk UMKM (Usaha Mikro, Kecil, dan Menengah). Dibangun dengan fokus pada kemudahan pengelolaan, performa, dan desain modern.

## 🚀 Fitur Utama

- **Katalog Produk Dinamis**: Penjelajahan koleksi produk dengan fitur filter kategori.
- **Sistem Keranjang Belanja**: Pengalaman belanja seamless berbasis session.
- **Checkout WhatsApp Otomatis**: Integrasi langsung ke WhatsApp untuk pemesanan yang cepat dan personal.
- **Blog & Informasi**: Artikel untuk berbagi informasi produk atau update terbaru.
- **CMS Terintegrasi**: Panel kontrol admin yang mudah digunakan untuk mengelola konten, produk, dan pengaturan toko.
- **Optimasi SEO**: Penggunaan JSON-LD Schema (Product & BlogPosting) dan sitemap dinamis.
- **Desain Responsif**: Menggunakan Tailwind CSS v4 untuk tampilan yang rapih di berbagai perangkat.

## 🛠️ Stack Teknologi

- **Backend**: Laravel 11/13
- **Admin Panel**: Filament PHP (TALL Stack)
- **Frontend**: Blade & Tailwind CSS v4
- **Database**: MySQL / SQLite
- **Tooling**: Vite for asset bundling

## 📦 Instalasi

1. **Clone repositori**:
   ```bash
   git clone [URL-REPOSITORI]
   cd umkm-blueprint
   ```

2. **Instal dependensi PHP**:
   ```bash
   composer install
   ```

3. **Instal dependensi JS**:
   ```bash
   npm install
   npm run build
   ```

4. **Konfigurasi Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Migrasi Database & Seeding**:
   ```bash
   php artisan migrate --seed
   ```

6. **Link Storage**:
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Server**:
   ```bash
   php artisan serve
   ```

## 📝 Dokumentasi Admin

Admin panel dapat diakses melalui `/admin` dengan kredensial default dari seeder (lihat `DatabaseSeeder.php`).

## 📄 Lisensi

Proyek Blueprint. Bebas disesuaikan untuk kebutuhan klien UMKM.

## ☁️ Panduan Deploy ke Hostinger (Shared Hosting)

Karena Hostinger (terutama paket Shared Hosting) memiliki aturan yang ketat, harap ikuti panduan berikut langkah demi langkah agar website D'Moroy dapat berjalan dengan sempurna.

### 1. Persiapan File
1. Jalankan `npm run build` di komputer lokal Anda untuk mem-*build* aset frontend.
2. Upload seluruh file proyek ke folder instalasi di Hostinger (biasanya di dalam `/domains/domainanda.com/public_html` atau *subfolder*). 
3. Konfigurasikan file `.env`, sesuaikan kredensial Database dan pastikan `APP_ENV=production` serta `APP_DEBUG=false`.

### 2. Gunakan PHP 8.4 di Terminal SSH
Secara *default*, terminal SSH Hostinger menggunakan PHP 8.2 yang **tidak kompatibel** dengan framework terbaru yang digunakan. 
Setiap kali Anda ingin menjalankan perintah Artisan atau Composer, Anda **wajib** memanggil versi PHP yang benar.

Contoh yang **BENAR**:
```bash
php8.4 artisan optimize:clear
```
*(Atau gunakan path absolut `/usr/bin/php8.4` jika alias tidak berfungsi).*

### 3. Eksekusi Database Migration
Karena database di production biasanya sudah berisi data (katalog produk, artikel, dll), **JANGAN PERNAH** menggunakan `migrate:fresh` karena akan menghapus semua data!

Jalankan:
```bash
php8.4 artisan migrate --force
```

### 4. Perbaikan Storage Link (Symlink)
Fungsi PHP `symlink()` **di-disable** oleh Hostinger demi alasan keamanan. Akibatnya, perintah `php8.4 artisan storage:link` akan **gagal / Error 500**.

**Solusinya:** Gunakan *command* symlink native milik Linux. Buka terminal SSH, pastikan Anda berada di direktori aplikasi Laravel Anda, lalu jalankan:
```bash
ln -s "$PWD/storage/app/public" "$PWD/public/storage"
```

### 5. Konfigurasi Domain (Document Root)
Pastikan konfigurasi domain Anda di hPanel mengarah langsung ke folder `public/` (bukan folder *root* proyek).

### 6. Keamanan & Maintenance Mode
- **Keamanan:** Login admin dilengkapi dengan proteksi *Rate Limiting* (maksimal 5 kali percobaan gagal per menit) dan *Honeypot*.
- **Maintenance:** Jika *Maintenance Mode* diaktifkan lewat Widget Dashboard Admin, situs web publik akan menampilkan halaman *Error 503* kustom. Namun, Admin tetap dapat mengakses halaman `/admin` tanpa terkunci untuk mematikan kembali mode *maintenance*.
