# Panduan Deployment - Batik Jambi Berkah '87

Dokumentasi ini menjelaskan langkah-langkah untuk melakukan deployment aplikasi Batik Jambi Berkah ke server produksi (VPS / Shared Hosting).

## 1. Persyaratan Sistem
Pastikan server Anda memenuhi kriteria berikut:
- **PHP 8.2+** (Direkomendasikan 8.3 atau 8.4)
- **Composer**
- **Node.js & NPM**
- **MySQL** (atau MariaDB)
- Ekstensi PHP yang diperlukan: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `gd`, `intl`, `json`, `mbstring`, `openssl`, `pcre`, `pdo`, `tokenizer`, `xml`.

---

## 2. Langkah-langkah Instalasi

### A. Clone Repository
```bash
git clone https://github.com/iqrev/batikJambiBerkah.git
cd batikJambiBerkah
```

### B. Install Dependensi
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node.js dependencies
npm install
```

### C. Konfigurasi Environment
Salin file `.env.example` ke `.env` dan sesuaikan nilainya:
```bash
cp .env.example .env
php artisan key:generate --show
```
**Penting:** Ubah variabel berikut di `.env`:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://domainanda.com`
- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_DATABASE=nama_database_anda`
- `DB_USERNAME=username_mysql`
- `DB_PASSWORD=password_mysql`

### D. Persiapan Database
```bash
# Pastikan database sudah dibuat di MySQL
php artisan migrate --force
```

### E. Compile Assets & Optimization
```bash
# Build frontend assets (Vite)
npm run build

# Optimize Laravel
php artisan optimize
php artisan view:cache
php artisan config:cache
php artisan route:cache
```

### F. File Storage & Permissions
```bash
# Buat symbolic link untuk media
php artisan storage:link

# Atur izin folder (Linux server)
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data .
```

---

## 3. Konfigurasi Lanjutan

### A. Penjadwalan Tugas (Cron Job)
Tambahkan entri berikut ke crontab server Anda agar fitur Laravel Scheduler berjalan:
```bash
* * * * * cd /path/ke/aplikasi && php artisan schedule:run >> /dev/null 2>&1
```

### B. Queue Worker (Penting untuk Performa)
Gunakan Supervisor untuk menjalankan queue worker agar proses latar belakang tetap berjalan:
```bash
php artisan queue:work --stop-when-empty
```

### C. SSL / HTTPS
Pastikan SSL (Let's Encrypt atau Cloudflare) aktif untuk keamanan transaksi dan form kontak.

---

## 4. Tips Tambahan
- **Filament User**: Pastikan Anda sudah membuat user admin pertama kali dengan perintah `php artisan make:filament-user`.
- **Media Optimization**: Gunakan alat server side untuk optimasi gambar jika diperlukan, meskipun aplikasi sudah menggunakan format WebP.

---
*Dibuat oleh AI Assistant - Batik Jambi Berkah '87 Project Documentation*
