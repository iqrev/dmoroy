# Batik Jambi Berkah - Design System

File ini mendokumentasikan pedoman antarmuka pengguna (UI/UX) dan desain visual yang digunakan dalam proyek ini.

## Typography (Tipografi)
- **Primary Font (Admin & Body)**: `Plus Jakarta Sans`. Digunakan untuk teks utama, antarmuka Admin (Filament), dan paragraf agar terlihat bersih, modern, dan mudah dibaca (legible).
- **Display Font (Heading)**: `Playfair Display`. Digunakan untuk judul halaman, tajuk (heading), dan elemen berukuran besar untuk memberikan sentuhan klasik, premium, dan elegan khas Batik.

## Color Palette (Palet Warna)
Identitas visual sangat krusial. Sistem menggunakan variabel warna Tailwind yang telah disesuaikan:
- **Brand Primary (Batik Crimson)**: `#8b0000`. Warna utama yang merepresentasikan keanggunan. Digunakan untuk tombol utama, sorotan (highlight), dan identitas brand di Dashboard.
- **Success (Online/Stok Aman)**: `success-500` / `#10b981`.
- **Warning (Draft/Stok Menipis)**: `warning-500` / `#f59e0b`.
- **Danger (Offline/Stok Habis)**: `danger-600` / `#e11d48`.
- **Backgrounds**: 
  - Frontend: `#faf9f6` (Off-white/Cream halus yang merepresentasikan warna dasar kain).
  - Admin: Menggunakan palet standar Filament V3 dengan dukungan penuh *Dark Mode*.

## UI/UX Guidelines
1. **Admin Dashboard (Filament v3)**:
   - **Tampilan Bersih**: Menghilangkan widget sapaan bawaan untuk fokus pada data.
   - **Hirarki Visual**: Urutan widget dikunci secara sistematis -> `MaintenanceWidget` (Prioritas Utama, status server), `StatsOverview` (Ringkasan Data), lalu `LatestProductsWidget` (Aktivitas Tabel).
   - **Ruang Kerja (Workspace)**: *Sidebar* dibuat agar dapat dilipat (*collapsible*) untuk memaksimalkan ruang kerja pada tampilan tabel.
2. **Frontend (Halaman Publik)**:
   - Berbasis *Tailwind CSS v4*.
   - Mengadopsi pendekatan *Mobile-First* untuk responsivitas maksimal.
   - Tombol dan kartu (cards) memiliki interaksi hover (animasi) yang halus.
