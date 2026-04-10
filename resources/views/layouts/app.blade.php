<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group'))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('tagline', 'Melestarikan Warisan Budaya Melalui Karya Batik'))">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased pb-20 md:pb-0">
    <!-- Top Header -->
    <div class="bg-brand-red text-white py-2 px-4 hidden md:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-[13px] font-medium">
            <div class="flex items-center gap-5">
                <a href="#" class="hover:text-brand-gold transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.551-.14-2.661-.14C12.51 2 10.5 3.4 10.5 5.85v3.65h-3v4h3v9h3.5v-9z"/></svg></a>
                <a href="#" class="hover:text-brand-gold transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.39 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.48.75 2.78 1.89 3.55-.7 0-1.36-.21-1.94-.53v.05c0 2.07 1.47 3.8 3.43 4.2-.36.1-.73.15-1.12.15-.27 0-.54-.03-.8-.08.54 1.69 2.11 2.93 3.97 2.96-1.46 1.14-3.3 1.82-5.3 1.82-.35 0-.69-.02-1.02-.06C3.18 20.29 5.41 21 7.8 21 14.59 21 18.3 15.37 18.3 10.5c0-.16 0-.32-.01-.48.72-.52 1.35-1.17 1.85-1.91l.32.89z"/></svg></a>
                <a href="#" class="hover:text-brand-gold transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                <a href="#" class="hover:text-brand-gold transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
            </div>
            <div>The Art of Batik Jambi</div>
        </div>
    </div>
    <!-- Header/Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="{{ \App\Models\Setting::get('site_name') }}" class="w-12 h-12 object-contain">
                <span class="font-serif text-lg font-bold leading-tight hidden sm:block">
                    @php $nameParts = explode(' ', \App\Models\Setting::get('site_name', 'Batik Jambi Berkah'), 3); @endphp
                    {{ $nameParts[0] ?? '' }} {{ $nameParts[1] ?? '' }}<br>
                    <span class="text-brand-red">{{ $nameParts[2] ?? '' }}</span>
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="/" class="hover:text-brand-red transition-colors">Beranda</a>
                
                <!-- Profil Dropdown -->
                <div class="dropdown">
                    <a href="/about" class="hover:text-brand-red transition-colors flex items-center gap-1">
                        Profil
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </a>
                    <div class="dropdown-content">
                        <a href="/about" class="dropdown-item">Tentang Kami</a>
                        <a href="/about#team" class="dropdown-item">Tim Kami</a>
                        <a href="/about#history" class="dropdown-item">Sejarah</a>
                    </div>
                </div>

                <a href="/products" class="hover:text-brand-red transition-colors">Katalog</a>

                <!-- Galeri & Edukasi Dropdown -->
                <div class="dropdown">
                    <a href="#" class="hover:text-brand-red transition-colors flex items-center gap-1">
                        Galeri & Edukasi
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </a>
                    <div class="dropdown-content">
                        <a href="/posts" class="dropdown-item font-bold border-b border-gray-50 pb-2 mb-1">Knowledge / Blog</a>
                        
                        <div class="dropdown-submenu">
                            <div class="dropdown-item flex items-center justify-between">
                                Stand/Pameran
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </div>
                            <div class="dropdown-submenu-content">
                                <a href="/posts?category=pameran-luar-negeri" class="dropdown-item">Luar Negeri</a>
                                <a href="/posts?category=pameran-dalam-negeri" class="dropdown-item">Dalam Negeri</a>
                            </div>
                        </div>

                        <div class="dropdown-submenu">
                            <div class="dropdown-item flex items-center justify-between">
                                Fashion Show
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </div>
                            <div class="dropdown-submenu-content">
                                <a href="/posts?category=fashion-show-luar-negeri" class="dropdown-item">Luar Negeri</a>
                                <a href="/posts?category=fashion-show-dalam-negeri" class="dropdown-item">Dalam Negeri</a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="/contact" class="btn-primary py-2 text-sm">Hubungi Kami</a>
            </div>

            <!-- Mobile Search/Cart Placeholder -->
            <div class="flex items-center gap-4 md:hidden">
                <button class="p-2 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Mobile Navigation (Bottom Bar) -->
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-100 md:hidden flex justify-around items-center h-16 px-4">
        <a href="/" class="flex flex-col items-center gap-1 text-xs {{ Request::is('/') ? 'text-brand-red' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span>Beranda</span>
        </a>
        <a href="/products" class="flex flex-col items-center gap-1 text-xs {{ Request::is('products*') ? 'text-brand-red' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <span>Belanja</span>
        </a>
        <a href="/posts" class="flex flex-col items-center gap-1 text-xs {{ Request::is('posts*') ? 'text-brand-red' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
            <span>Edukasi</span>
        </a>
        <a href="/contact" class="flex flex-col items-center gap-1 text-xs {{ Request::is('contact*') ? 'text-brand-red' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span>Kontak</span>
        </a>
    </div>

    <!-- Footer (Desktop) -->
    <footer class="bg-white border-t border-gray-100 hidden md:block py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <a href="/" class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ \App\Models\Setting::get('site_name') }}" class="w-12 h-12 object-contain">
                    <span class="font-serif text-lg font-bold leading-tight">
                        {{ \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group') }}
                    </span>
                </a>
                <p class="text-gray-500 max-w-sm">{{ \App\Models\Setting::get('tagline', 'Melestarikan warisan budaya melalui karya seni batik Jambi yang berkualitas dan bermakna.') }}</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Navigasi</h4>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li><a href="/" class="hover:text-brand-red">Beranda</a></li>
                    <li><a href="/products" class="hover:text-brand-red">Katalog Produk</a></li>
                    <li><a href="/posts" class="hover:text-brand-red">Edukasi Batik</a></li>
                    <li><a href="/about" class="hover:text-brand-red">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Kontak</h4>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li>WhatsApp: +{{ \App\Models\Setting::get('whatsapp', '62812-3456-7890') }}</li>
                    <li>Email: {{ \App\Models\Setting::get('email', 'info@batikjambiberkah.com') }}</li>
                    <li>{{ \App\Models\Setting::get('address', 'Jambi, Indonesia') }}</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-gray-50 text-center text-gray-400 text-xs">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group') }}. All rights reserved.
        </div>
    </footer>
</body>
</html>
