<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group'))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('tagline', 'Melestarikan Warisan Budaya Melalui Karya Batik'))">
    
    <!-- SEO & Social Media Meta Tags -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group') }}">
    <meta property="og:title" content="@yield('og_title', view()->yieldContent('title', \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group')))">
    <meta property="og:description" content="@yield('og_description', view()->yieldContent('meta_description', \App\Models\Setting::get('tagline', 'Melestarikan Warisan Budaya Melalui Karya Batik')))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', view()->yieldContent('title', \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group')))">
    <meta name="twitter:description" content="@yield('og_description', view()->yieldContent('meta_description', \App\Models\Setting::get('tagline', 'Melestarikan Warisan Budaya Melalui Karya Batik')))">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

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

                <!-- Artikel Dropdown (Mega Menu) -->
                <div class="dropdown group/mega">
                    <a href="/posts" class="hover:text-brand-red transition-colors flex items-center gap-1">
                        Artikel
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </a>
                    <div class="dropdown-content min-w-[500px] py-2 !-translate-x-1/3 mt-2 overflow-hidden shadow-2xl">
                        <div class="flex">x
                            {{-- Edukasi Column --}}
                            @if($navGroups['edukasi'])
                            <div class="bg-gray-50/50 p-5 border-r border-gray-100 flex-1">
                                <h4 class="text-center text-[10px] font-bold uppercase tracking-[0.2em] text-brand-red/60 mb-4 pb-2 border-b border-brand-red/10">Edukasi & Wawasan</h4>
                                <div class="space-y-1">
                                    @foreach($navGroups['edukasi']->children as $cat)
                                        <a href="/posts?category={{ $cat->slug }}" class="dropdown-item !px-3 !py-1.5 rounded-lg hover:bg-white hover:shadow-sm">
                                            {{ $cat->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            {{-- Galeri Column --}}
                            @if($navGroups['galeri'])
                            <div class="bg-white p-5 flex-1">
                                <h4 class="text-center text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-4 pb-2 border-b border-gray-100">Galeri & Dokumentasi</h4>
                                <div class="space-y-1">
                                    @foreach($navGroups['galeri']->children as $cat)
                                        @if($cat->children->count() > 0)
                                            <div class="dropdown-submenu">
                                                <div class="dropdown-item flex items-center justify-between !px-3 !py-1.5 rounded-lg hover:bg-gray-50">
                                                    {{ $cat->name }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-40"><path d="m9 18 6-6-6-6"/></svg>
                                                </div>
                                                <div class="dropdown-submenu-content !left-[100%] !-mt-2">
                                                    <a href="/posts?category={{ $cat->slug }}" class="dropdown-item font-semibold text-brand-red text-xs border-b border-gray-50 mb-1">Semua {{ $cat->name }}</a>
                                                    @foreach($cat->children as $child)
                                                        <a href="/posts?category={{ $child->slug }}" class="dropdown-item">{{ $child->name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <a href="/posts?category={{ $cat->slug }}" class="dropdown-item !px-3 !py-1.5 rounded-lg hover:bg-gray-50">
                                                {{ $cat->name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="bg-brand-red/[0.02] p-4 border-t border-gray-100">
                            <a href="/posts" class="text-xs text-brand-red font-bold hover:gap-2 transition-all flex items-center justify-center gap-1 group/btn">
                                <span>Lihat Semua Artikel & Wawasan</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover/btn:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="relative group p-2 text-gray-600 hover:text-brand-red transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute -top-1 -right-1 bg-brand-red text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full group-hover:scale-110 transition-transform">
                            {{ count(session('cart', [])) }}
                        </span>
                    @endif
                </a>
                <a href="/contact" class="btn-primary py-2 text-sm">Hubungi Kami</a>
            </div>

            <!-- Mobile Search/Cart Placeholder -->
            <div class="flex items-center gap-2 md:hidden">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute top-0 right-0 bg-brand-red text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">
                            {{ count(session('cart', [])) }}
                        </span>
                    @endif
                </a>
                <button class="p-2 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @include('components.toast')
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
            <span>Artikel</span>
        </a>
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center gap-1 text-xs {{ Request::is('cart*') ? 'text-brand-red' : 'text-gray-400' }}">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                @if(count(session('cart', [])) > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-brand-red text-white text-[8px] font-bold w-3.5 h-3.5 flex items-center justify-center rounded-full">
                        {{ count(session('cart', [])) }}
                    </span>
                @endif
            </div>
            <span>Keranjang</span>
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
                    <li><a href="/posts" class="hover:text-brand-red">Artikel & Edukasi</a></li>
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

    @stack('scripts')
</body>
</html>
