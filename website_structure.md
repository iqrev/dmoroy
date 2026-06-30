# Detail Struktur dan UI/UX Halaman Website Dmoroy

Dokumen ini berisi penjabaran detail struktur antarmuka (UI/UX), komponen, dan tata letak (*layout*) dari setiap halaman pada website ini. Struktur ini menggunakan pendekatan desain **Hybrid Web-App** dengan gaya *Editorial/Etnik Modern*.

---

## 1. Global Layout (Muncul di semua halaman)
Komponen ini diatur melalui file master layout (`layouts/app.blade.php`).
*   **Top Header**: Bar kecil di paling atas (khusus Desktop) berisi teks promosi dan ikon sosial media ringan.
*   **Main Navigation (Header)**: 
    *   *Desktop*: Sticky Navbar efek *glassmorphism* (blur), Logo di kiri, Menu Navigasi di tengah (Home, About, Catalog, Articles, Contact), ikon Keranjang (dengan *badge* notifikasi jumlah barang), dan tombol Language Switcher (ID/EN).
    *   *Mobile*: Hanya logo, bahasa, dan ikon keranjang. Menu utama dipindah ke bagian bawah layar.
*   **Mobile Bottom Navigation**: Menu bar statis di bagian bawah layar (mirip tampilan aplikasi *mobile/App-like*) dengan ikon untuk Beranda, Katalog, Artikel, dan Kontak.
*   **Footer**: Dibagi menjadi 4 kolom (Desktop) yang memuat Logo & Slogan, Tautan Navigasi Cepat, Detail Kontak lengkap, dan hak cipta.
*   **Floating "Back to Top"**: Tombol melayang di pojok kanan bawah yang muncul setelah halaman di-scroll ke bawah.

---

## 2. Beranda (Home)
Menggunakan pola *landing page* yang *scrollable* dengan pembagian *section* yang kontras.
*   **Hero Section**: Tata letak *split full-bleed*. Kiri berisi teks (Judul besar yang *aesthetic*, Subjudul, dan 2 tombol *Call-to-Action*). Kanan berisi gambar layar penuh dengan *badge* melayang bertuliskan "100% Natural Fiber".
*   **Keunggulan (Why Choose Us)**: Grid 3 kolom berlatar putih. Setiap kolom memuat *card* yang berisi *icon* bulat, judul keunggulan, dan teks deskripsi singkat.
*   **Our Collection (Katalog Singkat)**: Grid 3 kolom bergaya editorial (*Masonry-like*). Kartu produk menampilkan rasio foto 3:4. Saat kursor diarahkan (hover), foto perlahan berubah menjadi transparan/gelap. Terdapat *badge* "Top/Featured".
*   **Pemberdayaan Sosial (Parallax)**: *Section* lebar penuh (full-width) dengan latar belakang gambar *parallax* bertema gelap. Memiliki elemen dekoratif berupa grafik SVG yang berputar pelan (*spin animation*).
*   **Testimonial**: Grid 3 kolom bergaya *glassmorphism* (latar agak transparan/blur) di atas latar belakang cokelat tua tekstur serat.
*   **Instagram Gallery**: Wadah gambar persegi (rasio 1:1) yang bisa digeser secara horizontal (horizontal scroll / *snap-mandatory*) mirip tampilan *feed* Instagram.
*   **Blog/Journal Singkat**: Grid 3 kolom yang menampilkan artikel terbaru (Gambar, Tanggal, Judul, dan cuplikan teks).

---

## 3. Tentang Kami (About)
Fokus pada narasi cerita (*storytelling*) dan *branding*.
*   **Hero Section**: Tata letak terbelah; kiri memuat judul besar, kanan memuat foto dengan sudut lengkung di atas (*rounded-t-full*) dan kotak kutipan (quote) yang melayang tumpang tindih.
*   **Full Story**: Kolom tunggal di tengah dengan *typography* lebar dan elemen *blockquote* (kutipan) bergaris emas.
*   **Visi & Misi**: Tata letak 2 kolom bergaya asimetris. Visi menggunakan latar terang polos, Misi menggunakan latar gelap bertekstur.
*   **Prinsip Kami (Values Grid)**: Grid 3 kolom berisi kartu putih dengan angka besar transparan di latar belakang (01, 02, 03) untuk mempertegas urutan nilai perusahaan.
*   **CTA (Call to Action)**: Spanduk gelap di bagian bawah untuk mengajak pengunjung mengklik tombol "Hubungi Kami".

---

## 4. Katalog Produk (Products Index)
*   **Header**: Judul sederhana di pojok kiri atas.
*   **Layout Grid 2-Kolom (Sidebar + Konten)**:
    *   **Sidebar Kiri (Sticky)**: Mengambang saat di-scroll. Berisi form kotak *Search* dan daftar teks kategori vertikal (Semua, Tas, dll).
    *   **Grid Produk Kanan**: Menampilkan kartu produk (rasio 3:4). Jika produk di-hover, muncul tombol **"Lihat Cepat" (Quick View)** dari bawah. Menampilkan efek pergantian gambar produk (*image swap*).
*   **Quick View Modal**: *Pop-up* layar yang membelah tampilan menjadi dua; gambar produk di kiri, dan informasi singkat beserta *form* tambah ke keranjang (Add to Cart) di kanan.

---

## 5. Detail Produk (Product Show)
*   **Breadcrumbs**: Jejak navigasi di atas (Beranda > Katalog > Nama Produk).
*   **Detail Utama (Split 2 Kolom)**:
    *   **Kolom Kiri (Galeri)**: Gambar utama produk (bentuk persegi). Dilengkapi fitur *Zoom-on-Hover* (gambar membesar mengikuti kursor). Di bawahnya terdapat grid 4 kolom untuk tombol *thumbnail* (mengubah gambar utama saat diklik).
    *   **Kolom Kanan (Info & Form)**: Kategori, Judul Produk, Harga, Deskripsi Panjang. Terdapat *box* Info Lokasi Workshop, input Jumlah (Quantity) dengan tombol + dan -, tombol besar "Tambah ke Keranjang", dan tombol sekunder "Beli via WhatsApp".
*   **Sticky Add-to-Cart**: Sebuah bar melayang di bagian bawah layar yang akan *otomatis muncul* ketika form Add-to-Cart utama terlewat saat user men-scroll layar ke bawah.
*   **Produk Serupa & Lainnya**: Dua *section* grid 4 kolom di bagian bawah yang menampilkan rekomendasi produk lain.

---

## 6. Keranjang Belanja (Cart)
*   **Daftar Item (List Layout)**: Menampilkan produk secara vertikal berbentuk baris mendatar. Tiap baris berisi Gambar, Nama Produk, Harga Satuan, tombol pengatur kuantitas (-/+) yang akan *me-refresh total secara otomatis (AJAX)*, Subtotal, dan tombol "Hapus".
*   **Summary Box**: Kotak ringkasan pesanan di bawah form list. Menampilkan Total Harga.
*   **Checkout via WhatsApp**: Tombol CTA hijau besar yang, apabila diklik, akan me-redirect pengguna ke aplikasi WhatsApp admin dengan teks pesan yang sudah terisi data pesanan keranjang (Nama barang, jumlah, dan total).
*   **Empty State**: Tampilan visual di tengah layar berisi ikon keranjang kosong dan tombol "Lanjut Belanja" jika tidak ada produk di keranjang.

---

## 7. Artikel & Kontak
*   **Kontak (Asymmetrical Layout)**: Kiri memuat informasi teks, detail alamat, dan *embed* Google Maps persegi panjang. Kanan memuat form input pesan melayang (Glassmorphism card). Di bagian bawah dilampirkan *Accordion FAQ* (Tanya Jawab).
*   **Artikel (Grid Layout)**: Grid rapi 3 kolom menampilkan gambar rasio 16:9, label kategori interaktif, tanggal format kapital, judul panjang yang terpotong rapi (*line-clamp*), dan tautan "Baca".

---
*Struktur UI/UX di atas dapat Anda serahkan kepada Desainer atau Developer Anda untuk mulai menyusun framework antarmuka yang setara.*
