# Panduan Deployment - Hostinger Shared Hosting (MySQL)

Dokumentasi ini menjelaskan langkah-langkah untuk melakukan deployment aplikasi **Batik Jambi Berkah '87** ke Shared Hosting Hostinger menggunakan database MySQL.

## 1. Persyaratan Sistem di Hostinger
Pastikan konfigurasi PHP di hPanel setidaknya memenuhi:
- **PHP Version**: 8.2 atau 8.3 (Dapat diatur di Menu *Advanced -> PHP Configuration*).
- **PHP Extensions**: Aktifkan `intl`, `bcmath`, `gd`, `imagick`, `opcache`, `zip`.
- **Database**: 1 Database MySQL kosong.

---

## 2. Langkah-Langkah Deployment

### A. Persiapan Folder (public_html)
Aplikasi Laravel memiliki folder `public` sebagai entry point. Di Hostinger, Anda perlu menyesuaikan ini:
1. Upload semua file project ke root directory (satu level di atas `public_html`).
2. ATAU upload isi folder `public` aplikasi ke dalam folder `public_html` Hostinger.
3. ATAU jika menggunakan SSH, arahkan domain ke folder `public` project.

### B. Konfigurasi Environment (.env)
Edit file `.env` di File Manager Hostinger dan sesuaikan bagian database:
```env
APP_NAME="Batik Jambi Berkah"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nama-domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u123456789_nama_db
DB_USERNAME=u123456789_user_db
DB_PASSWORD=password_database_anda
```

### C. Instalasi melalui SSH (Direkomendasikan)
Gunakan Terminal SSH Hostinger untuk menjalankan perintah berikut:
```bash
# 1. Install Dependensi (jika belum ada folder vendor)
composer install --optimize-autoloader --no-dev

# 2. Jalankan Migrasi Database
php artisan migrate --force

# 3. Generate Link Storage
# Jika folder public_html/storage sudah ada, hapus dulu
php artisan storage:link

# 4. Optimasi Laravel
php artisan optimize
php artisan view:cache
```

### D. Compile Assets (Local)
Karena Hostinger Shared Hosting biasanya tidak mendukung `npm run build` secara maksimal:
1. Jalankan `npm run build` di komputer lokal Anda.
2. Pastikan file di `public/build/` ikut terupload ke folder public_html server.

---

## 3. Masalah Umum & Solusi

### 1. Error 404 pada Gambar
Jika gambar tidak tampil, pastikan symbolic link storage benar:
```bash
# Hapus symlink lama
rm public/storage
# Buat ulang dengan path absolut (sesuaikan dengan path Hostinger Anda)
ln -s /home/u123456789/domains/domainanda.com/storage/app/public /home/u123456789/domains/domainanda.com/public_html/storage
```

### 2. File .env tidak terbaca
Pastikan file `.env` ada di root folder aplikasi, bukan di dalam `public_html`.

### 3. Error Permission
Pastikan folder `storage` dan `bootstrap/cache` memiliki izin tulis (biasanya 755 atau 775).

---

## 4. Maintenance & Pembaruan
Setiap ada perubahan kode (git pull), jalankan perintah optimasi:
```bash
git pull origin main
php artisan migrate --force
php artisan optimize
```

---
*Dibuat untuk Project Batik Jambi Berkah '87 - Hostinger Deployment Guide*
