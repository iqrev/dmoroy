# Panduan Deploy Laravel ke Hostinger (Shared Hosting)

Karena Hostinger (terutama paket Shared Hosting) memiliki aturan yang ketat untuk keamanan, proses deploy aplikasi Laravel 11/13 memerlukan langkah-langkah khusus.

**⚠️ PENTING SEBELUM MULAI (TENTANG PHP 8.4)**
Di Hostinger hPanel, jika Anda sekadar mengetik `php` atau `composer`, sistem akan menggunakan PHP 8.2 bawaan (yang akan membuat aplikasi ini error karena butuh PHP 8.4). 
Untuk itu, Anda **wajib** menggunakan *executable* PHP 8.4 secara langsung, yaitu: `/opt/alt/php84/usr/bin/php`.

Berikut adalah urutan *deploy* langkah-demi-langkah yang benar melalui terminal SSH:

---

## 1. Install Dependensi (Jika folder `vendor` belum ada)
Karena Composer bawaan Hostinger menggunakan PHP 8.2, kita harus memanggil Composer dengan PHP 8.4 secara eksplisit:
```bash
/opt/alt/php84/usr/bin/php $(which composer) install --optimize-autoloader --no-dev
```
*(Catatan: Anda juga bisa men-zip folder `vendor` dari komputer lokal dan langsung mengunggahnya agar lebih praktis).*

## 2. Jalankan Migrasi Database
**JANGAN PERNAH** gunakan `migrate:fresh` di *production* karena akan menghapus seluruh data katalog!
```bash
/opt/alt/php84/usr/bin/php artisan migrate --force
```

## 3. Generate Link Storage (PENGECUALIAN HOSTINGER)
**JANGAN gunakan `php artisan storage:link`!**
Fungsi PHP `symlink()` telah **di-disable** oleh Hostinger demi alasan keamanan. Jika dijalankan, perintah tersebut akan gagal. Sebagai gantinya, gunakan instruksi *native* Linux:

```bash
# Hapus folder storage lama di public (jika sudah ada)
rm -rf public/storage

# Buat symlink baru menggunakan command Linux
ln -s "$PWD/storage/app/public" "$PWD/public/storage"
```

## 4. Optimasi Laravel (Caching)
Langkah terakhir, pastikan konfigurasi dan rute website di-*cache* agar *loading* website menjadi sangat cepat:
```bash
/opt/alt/php84/usr/bin/php artisan optimize
/opt/alt/php84/usr/bin/php artisan view:cache
```

---
*Selesai! Website D'Moroy Anda kini siap diakses secara online tanpa error.*
