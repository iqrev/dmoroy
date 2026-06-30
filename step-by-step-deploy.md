# Panduan Deploy Laravel ke Hostinger (Shared Hosting)

Karena Hostinger (terutama paket Shared Hosting) memiliki aturan yang ketat untuk keamanan, proses deploy aplikasi Laravel 11/13 memerlukan langkah-langkah khusus. Harap ikuti panduan ini langkah demi langkah agar website D'Moroy dapat berjalan dengan sempurna tanpa *Error 500*.

---

## 1. Persiapan File (Local ke Server)
Sebelum memindahkan file, pastikan Anda mem-*build* aset dari komputer lokal.
1. Jalankan perintah ini di komputer Anda:
   ```bash
   npm run build
   ```
2. Compress (ZIP) seluruh folder proyek Anda, lalu *upload* dan ekstrak ke folder instalasi di Hostinger (biasanya di dalam `/domains/dmoroy.com/public_html` atau sesuai pengaturan *Document Root* Anda). 
3. Edit file `.env` di server, sesuaikan kredensial Database, dan ubah pengaturan ini:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://dmoroy.com
   ```

---

## 2. Gunakan PHP 8.4 di Terminal SSH
Secara *default*, jika Anda mengetik `php` di terminal SSH Hostinger, sistem akan menggunakan PHP 8.2. Versi ini **tidak kompatibel** dengan sistem Laravel kita saat ini. 

Setiap kali Anda ingin menjalankan perintah Artisan atau Composer, Anda **wajib** menggunakan *alias* versi PHP yang benar.

❌ **Contoh yang SALAH**:
```bash
php artisan optimize:clear
```

✅ **Contoh yang BENAR**:
```bash
php8.4 artisan optimize:clear
```

**⚠️ PENTING: Jika muncul pesan `-bash: php8.4: command not found`**
Itu berarti alias `php8.4` tidak dikonfigurasi di server Anda. Gunakan salah satu dari *path absolut* berikut yang tersedia di Hostinger:
```bash
/opt/alt/php84/usr/bin/php artisan migrate --force
```
Atau:
```bash
/usr/bin/php84 artisan migrate --force
```

*(Tips: Agar Anda tidak capek mengetik path yang panjang, jalankan perintah ini di awal sesi SSH Anda untuk membuat alias sementara: `alias php='/opt/alt/php84/usr/bin/php'`. Setelah itu, Anda bisa mengetik `php artisan migrate` dengan aman).*

---

## 3. Eksekusi Database Migration
Karena database di production biasanya sudah berisi data asli (katalog produk, riwayat transaksi, pengaturan, dll), **JANGAN PERNAH** menggunakan `migrate:fresh`. Perintah tersebut akan menghapus seluruh isi database!

Jalankan perintah ini untuk melakukan update struktur tabel dengan aman:
```bash
php8.4 artisan migrate --force
```

---

## 4. Perbaikan Storage Link (Symlink) - ⚠️ SANGAT PENTING
Aplikasi ini memerlukan akses ke folder `storage/app/public` untuk menampilkan gambar (produk, artikel, dll). 
Di Laravel biasa, kita menggunakan `php artisan storage:link`. Namun, fungsi PHP `symlink()` **telah di-disable** oleh Hostinger demi alasan keamanan. Jika Anda memaksa menjalankan perintah itu, Anda akan mendapat pesan *Error 500* atau *function disabled*.

**Solusinya:** Gunakan perintah *symlink native* milik OS Linux lewat terminal SSH.
Pastikan posisi direktori Anda berada di *root* aplikasi Laravel (contoh: di dalam `public_html`), lalu jalankan baris ini:
```bash
ln -s "$PWD/storage/app/public" "$PWD/public/storage"
```

---

## 5. Konfigurasi Domain (Document Root)
Pada panel hosting (hPanel) Hostinger, pastikan pengaturan domain Anda mengarah (Document Root) langsung ke dalam folder `public/` milik Laravel.
- **Benar:** `/domains/dmoroy.com/public_html/public`
- **Salah:** `/domains/dmoroy.com/public_html`

---

## 6. Info Tambahan: Keamanan & Maintenance Mode
- **Proteksi Login:** Halaman login admin `/admin` telah diproteksi dengan *Rate Limiting* (maksimal 5x gagal per menit) dan *Honeypot* untuk mencegah serangan *bot/brute force*.
- **Bypass Maintenance Mode:** Apabila Anda menyalakan *Maintenance Mode* dari Dashboard Admin, situs utama akan down dan menampilkan *Error 503*. Jangan panik, Anda (sebagai Admin) tetap bisa mengakses halaman `/admin` kapanpun secara normal untuk mematikan kembali fitur tersebut.
