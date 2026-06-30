<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', \App\Models\Setting::get('site_name', "D'Moroy"))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('tagline', 'Koleksi anyaman handmade premium dengan sentuhan hangat, autentik, dan elegan.'))">
    
    <!-- SEO & Social Media Meta Tags -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ \App\Models\Setting::get('site_name', "D'Moroy") }}">
    <meta property="og:title" content="@yield('og_title', view()->yieldContent('title', \App\Models\Setting::get('site_name', "D'Moroy")))">
    <meta property="og:description" content="@yield('og_description', view()->yieldContent('meta_description', \App\Models\Setting::get('tagline', 'Koleksi anyaman handmade premium dengan sentuhan hangat, autentik, dan elegan.')))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:image" content="@yield('og_image', asset('images/favicon.jpg'))">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', view()->yieldContent('title', \App\Models\Setting::get('site_name', "D'Moroy")))">
    <meta name="twitter:description" content="@yield('og_description', view()->yieldContent('meta_description', \App\Models\Setting::get('tagline', 'Koleksi anyaman handmade premium dengan sentuhan hangat, autentik, dan elegan.')))">
    <meta name="twitter:image" content="@yield('og_image', asset('images/favicon.jpg'))">

    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased pb-20 md:pb-0 text-brand-brown" x-data="{ cartOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 300)">
    <!-- Skip to Main Content Link (WCAG) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-[100] bg-brand-brown text-white px-6 py-4 font-bold focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold">
        Skip to main content
    </a>

    <!-- Top Header -->
    <div class="bg-brand-brown text-white py-2 px-4 hidden md:block" aria-hidden="true">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-[13px] font-medium">
            <div class="flex items-center gap-5">
                <a href="#" tabindex="-1" class="hover:text-brand-gold transition-colors"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.551-.14-2.661-.14C12.51 2 10.5 3.4 10.5 5.85v3.65h-3v4h3v9h3.5v-9z"/></svg></a>
                <a href="#" tabindex="-1" class="hover:text-brand-gold transition-colors"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.39 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.48.75 2.78 1.89 3.55-.7 0-1.36-.21-1.94-.53v.05c0 2.07 1.47 3.8 3.43 4.2-.36.1-.73.15-1.12.15-.27 0-.54-.03-.8-.08.54 1.69 2.11 2.93 3.97 2.96-1.46 1.14-3.3 1.82-5.3 1.82-.35 0-.69-.02-1.02-.06C3.18 20.29 5.41 21 7.8 21 14.59 21 18.3 15.37 18.3 10.5c0-.16 0-.32-.01-.48.72-.52 1.35-1.17 1.85-1.91l.32.89z"/></svg></a>
            </div>
            <div>Artisan Handmade Knitwear</div>
        </div>
    </div>

    <!-- Header/Navigation -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <nav aria-label="Main Navigation" class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" aria-label="D'Moroy Homepage" class="flex items-center gap-3 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded">
                <img src="{{ asset('images/logo.png') }}" alt="{{ \App\Models\Setting::get('site_name', "D'Moroy") }} Logo" class="h-10 md:h-12 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="/" {{ Request::is('/') ? 'aria-current=page' : '' }} class="hover:text-brand-brown transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded px-2 py-1">@lang('nav.home')</a>
                
                <a href="/about" {{ Request::is('about') ? 'aria-current=page' : '' }} class="hover:text-brand-brown transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded px-2 py-1">@lang('nav.about')</a>

                <a href="/products" {{ Request::is('products*') ? 'aria-current=page' : '' }} class="hover:text-brand-brown transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded px-2 py-1">@lang('nav.catalog')</a>

                <a href="/posts" {{ Request::is('posts*') ? 'aria-current=page' : '' }} class="hover:text-brand-brown transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded px-2 py-1">@lang('nav.articles')</a>

                <a href="{{ route('cart.index') }}" @click.prevent="cartOpen = true" aria-label="Keranjang Belanja" class="relative group p-2 text-gray-600 hover:text-brand-brown transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute -top-1 -right-1 bg-brand-brown text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full group-hover:scale-110 transition-transform">
                            {{ count(session('cart', [])) }}
                        </span>
                    @endif
                </a>
                
                <div class="flex items-center border border-brand-brown/20 rounded-full overflow-hidden text-xs font-bold">
                    <a href="{{ route('lang.switch', 'id') }}" class="px-2 py-1 {{ App::getLocale() == 'id' ? 'bg-brand-brown text-white' : 'text-brand-brown hover:bg-gray-100' }} transition-colors">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 {{ App::getLocale() == 'en' ? 'bg-brand-brown text-white' : 'text-brand-brown hover:bg-gray-100' }} transition-colors">EN</a>
                </div>

                <a href="/contact" class="px-6 py-2 bg-brand-brown text-white font-bold rounded hover:bg-brand-gold transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold focus-visible:ring-offset-2">@lang('nav.contact')</a>
            </div>

            <!-- Mobile Search/Cart Placeholder -->
            <div class="flex items-center gap-2 md:hidden">
                <div class="flex items-center border border-brand-brown/20 rounded-full overflow-hidden text-[10px] font-bold mr-2">
                    <a href="{{ route('lang.switch', 'id') }}" class="px-2 py-1 {{ App::getLocale() == 'id' ? 'bg-brand-brown text-white' : 'text-brand-brown hover:bg-gray-100' }}">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 {{ App::getLocale() == 'en' ? 'bg-brand-brown text-white' : 'text-brand-brown hover:bg-gray-100' }}">EN</a>
                </div>

                <a href="{{ route('cart.index') }}" @click.prevent="cartOpen = true" aria-label="Keranjang Belanja" class="relative p-2 text-gray-600 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute top-0 right-0 bg-brand-brown text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">
                            {{ count(session('cart', [])) }}
                        </span>
                    @endif
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main id="main-content" tabindex="-1" class="focus:outline-none">
        @include('components.toast')
        @yield('content')
    </main>

    <!-- Mobile Navigation (Bottom Bar) -->
    <nav aria-label="Mobile Navigation" class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-100 md:hidden flex justify-around items-center h-16 px-4">
        <a href="/" {{ Request::is('/') ? 'aria-current=page' : '' }} class="flex flex-col items-center gap-1 text-xs focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded p-1 {{ Request::is('/') ? 'text-brand-brown font-bold' : 'text-gray-400' }}">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span>@lang('nav.home')</span>
        </a>
        <a href="/products" {{ Request::is('products*') ? 'aria-current=page' : '' }} class="flex flex-col items-center gap-1 text-xs focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded p-1 {{ Request::is('products*') ? 'text-brand-brown font-bold' : 'text-gray-400' }}">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <span>@lang('nav.catalog')</span>
        </a>
        <a href="/posts" {{ Request::is('posts*') ? 'aria-current=page' : '' }} class="flex flex-col items-center gap-1 text-xs focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded p-1 {{ Request::is('posts*') ? 'text-brand-brown font-bold' : 'text-gray-400' }}">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
            <span>@lang('nav.articles')</span>
        </a>
        <a href="/contact" {{ Request::is('contact*') ? 'aria-current=page' : '' }} class="flex flex-col items-center gap-1 text-xs focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded p-1 {{ Request::is('contact*') ? 'text-brand-brown font-bold' : 'text-gray-400' }}">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span>@lang('nav.contact')</span>
        </a>
    </nav>

    <!-- Footer (Desktop) -->
    <footer aria-labelledby="footer-heading" class="bg-white border-t border-gray-100 hidden md:block py-12 mt-20">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <a href="/" aria-label="D'Moroy Homepage" class="flex items-center gap-3 mb-4 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ \App\Models\Setting::get('site_name', "D'Moroy") }} Logo" class="h-12 md:h-16 w-auto">
                </a>
                <p class="text-gray-500 max-w-sm">{{ \App\Models\Setting::get('tagline', 'Koleksi anyaman handmade premium dengan sentuhan hangat, autentik, dan elegan.') }}</p>
            </div>
            <div>
                <h3 class="font-bold mb-4 text-brand-brown">Navigasi</h3>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li><a href="/" class="hover:text-brand-brown focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded px-1">@lang('nav.home')</a></li>
                    <li><a href="/products" class="hover:text-brand-brown focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded px-1">@lang('nav.catalog')</a></li>
                    <li><a href="/posts" class="hover:text-brand-brown focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded px-1">@lang('nav.articles')</a></li>
                    <li><a href="/about" class="hover:text-brand-brown focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded px-1">@lang('nav.about')</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4 text-brand-brown">Kontak</h3>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li>WhatsApp: 0821-8705-1969</li>
                    <li>Email: dmoroykreasialamnusantara@gmail.com</li>
                    <li>Lorong beringin IV no 38 rt 14 kelurahan, The Hok, Kec. Jambi Sel., Kota Jambi, Jambi 36138</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-gray-50 text-center text-gray-400 text-xs">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', "D'Moroy") }}. All rights reserved.
        </div>
    </footer>

    @include('components.mini-cart')

    <!-- Back to Top Button -->
    <button 
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-show="scrolled" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-8"
        class="fixed bottom-24 md:bottom-8 right-6 z-40 bg-brand-brown text-white p-3 rounded-full shadow-lg hover:bg-brand-gold hover:text-brand-brown transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold"
        aria-label="Back to top"
        x-cloak>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
    </button>

    @stack('scripts')
</body>
</html>
