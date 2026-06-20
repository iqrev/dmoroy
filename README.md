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
# dmoroy
