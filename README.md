# Batik Jambi Berkah Group - Official Website

Website platform modern untuk melestarikan warisan budaya Batik Jambi. Dibangun dengan fokus pada estetika premium, performa tinggi, dan pengalaman pengguna yang intuitif.

![Batik Jambi Hero](public/images/logo.png)

## 🚀 Fitur Utama

- **Katalog Produk Dinamis**: Penjelajahan koleksi batik dengan fitur filter kategori.
- **Sistem Keranjang Belanja**: Pengalaman belanja seamless berbasis session.
- **Checkout WhatsApp Otomatis**: Integrasi langsung ke WhatsApp untuk pemesanan yang cepat dan personal.
- **Edukasi & Wawasan**: Blog/Artikel untuk berbagi filosofi dan sejarah motif batik Jambi.
- **CMS Terintegrasi**: Panel kontrol admin yang mudah digunakan untuk mengelola konten, produk, dan pengaturan toko.
- **Optimasi SEO**: Penggunaan JSON-LD Schema (Product & BlogPosting) dan sitemap dinamis.
- **Desain Premium**: Menggunakan Tailwind CSS v4 dengan elemen visual yang artisanal.

## 🛠️ Stack Teknologi

- **Backend**: Laravel 11
- **Admin Panel**: Filament PHP (TALL Stack)
- **Frontend**: Blade & Tailwind CSS v4
- **Database**: SQLite / MySQL
- **Tooling**: Vite for asset bundling

## 📦 Instalasi

1. **Clone repositori**:
   ```bash
   git clone [URL-REPOSIROTIR]
   cd batikJambiBerkah
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

5. **Migrasi Database**:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server**:
   ```bash
   php artisan serve
   ```

## 📝 Dokumentasi Admin

Admin panel dapat diakses melalui `/admin` dengan kredensial yang dikonfigurasi saat instalasi. Seluruh log perubahan fitur dapat dilihat langsung di menu **Changelog** pada panel pengaturan admin.

## 📄 Lisensi

Proyek ini dikembangkan oleh SwarnaTech untuk Batik Jambi Berkah Group. Seluruh hak cipta desain dan aset dilindungi.
