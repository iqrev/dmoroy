# Panduan Deploy dari Awal (Hostinger Shared Hosting)

Panduan ini dibuat khusus untuk struktur **Document Root = Project Root** di mana semua file diletakkan langsung di dalam folder `public_html`.

---

## 1. Persiapan Sebelum Hapus & Deploy
Pastikan semua kode di komputer lokal Anda, termasuk gambar-gambar (`storage/app/public/products` dan `storage/app/public/media`), sudah ter-commit dan di-push ke GitHub.

*(Opsional)* Anda bisa meng-copy file `.env` di Hostinger terlebih dahulu ke tempat aman jika Anda tidak mau repot mengetik ulang kredensial database.

---

## 2. Hapus Website Lama
Di terminal SSH Hostinger, jalankan perintah ini (hati-hati, ini akan menghapus semua file):
```bash
cd /home/u823179607/domains/batikjambiberkahgroup.com
rm -rf public_html
```

---

## 3. Clone Repository Baru
Clone ulang repositori dari GitHub, langsung menggunakan nama folder `public_html`:
```bash
git clone https://github.com/iqrev/batikJambiBerkah.git public_html
cd public_html
```

---

## 4. Setup File `.env`
Buat file `.env` baru:
```bash
cp .env.example .env
```
Edit file `.env` (bisa menggunakan `nano .env` di SSH, atau lewat File Manager hPanel). 
Pastikan:
- `APP_ENV=production`
- `APP_DEBUG=false`
- Kredensial Database MySQL (Host, DB Name, User, Password) sudah benar sesuai di Hostinger.

---

## 5. Install Composer & Key Generate
**PENTING:** Karena Hostinger secara *default* menggunakan PHP versi lama, Anda **HARUS** menggunakan path absolut PHP versi terbaru (8.3 atau 8.4) untuk menjalankan artisan dan composer.

Jalankan perintah-perintah ini secara berurutan:
```bash
# 1. Install Composer dependencies menggunakan PHP 8.3/8.4 (sesuaikan path)
/opt/alt/php83/usr/bin/php /usr/bin/composer install --optimize-autoloader --no-dev

# 2. Generate Application Key
/opt/alt/php83/usr/bin/php artisan key:generate

# 3. Jalankan Migrasi Database
/opt/alt/php83/usr/bin/php artisan migrate --force
```
*(Catatan: Jika `/opt/alt/php83/...` tidak ditemukan, coba `/opt/alt/php84/usr/bin/php`)*

---

## 6. Persiapan Folder Storage & Gambar
1. Upload folder `storage/app/public` dari komputer lokal Anda ke Hostinger (bisa di-zip dulu, upload lewat hPanel, lalu ekstrak ke `public_html/storage/app/public`).
2. Berikan izin tulis untuk folder storage dan cache:
```bash
chmod -R 775 storage bootstrap/cache
```
3. Hapus symlink lama (jika terbawa dari git) karena kita menggunakan Route Fallback:
```bash
rm -f public/storage
```

---

## 7. Setup .htaccess (Routing)
File `.htaccess` utama di `public_html` sangat penting untuk mengarahkan traffic ke folder `public/`.
Edit atau buat file `public_html/.htaccess`, lalu isikan kode ini (Gunakan File Manager Hostinger):

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```
*(Artinya: semua request diarahkan ke `public/` di mana index.php Laravel berada)*

---

## 8. Optimasi Akhir
```bash
/opt/alt/php83/usr/bin/php artisan config:cache
/opt/alt/php83/usr/bin/php artisan route:cache
/opt/alt/php83/usr/bin/php artisan view:cache
```

Selesai! Website seharusnya sudah menyala kembali dengan sempurna, dan gambar akan otomatis dirender lewat Route Fallback Laravel.
