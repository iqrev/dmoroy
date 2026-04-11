@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_name', 'Batik Jambi Berkah') . ' - Pusat Batik Jambi Autentik')
@section('meta_description', \App\Models\Setting::get('tagline', 'Melestarikan warisan budaya melalui karya seni batik Jambi yang berkualitas dan bermakna.'))

@section('content')
@php
    $heroVideoValue = \App\Models\Setting::get('hero_video_id', '6yK_qYnpxXk');
    
    // Extract YouTube ID if a full URL is provided
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $heroVideoValue, $match)) {
        $heroVideoId = $match[1];
    } else {
        $heroVideoId = $heroVideoValue;
    }

    $heroTitle = \App\Models\Setting::get('hero_title', 'Warisan Luhur Batik Jambi');
    $heroSubtitle = \App\Models\Setting::get('hero_subtitle', 'Melestarikan keindahan motif tradisional Jambi yang sarat akan makna dan sejarah.');
    $heroCtaText = \App\Models\Setting::get('hero_cta_text', 'Lihat Katalog');
    $heroCtaLink = \App\Models\Setting::get('hero_cta_link', '/products');
@endphp

<!-- Hero Section -->
<section class="relative w-full py-40 overflow-hidden bg-black flex items-center justify-center text-center px-4">
    <!-- YouTube Background -->
    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden">
        <iframe 
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"
            style="width: 177.77vh; min-width: 100%; height: 56.25vw; min-height: 100%;"
            src="https://www.youtube.com/embed/{{ $heroVideoId }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $heroVideoId }}&rel=0&showinfo=0&iv_load_policy=3&modestbranding=1&enablejsapi=1" 
            frameborder="0" 
            allow="autoplay; encrypted-media" 
            allowfullscreen>
        </iframe>
    </div>
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/80"></div>

    <!-- Centered Content -->
    <div class="relative z-10 max-w-5xl mx-auto">
        <h1 class="text-4xl md:text-7xl text-white font-serif mb-8 leading-tight animate-fade-in-up">
            {!! $heroTitle !!}
        </h1>
        <p class="text-white/80 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed animate-fade-in-up delay-100">
            {{ $heroSubtitle }}
        </p>
        <div class="flex flex-wrap justify-center gap-4 animate-fade-in-up delay-200">
            <a href="{{ $heroCtaLink }}" class="btn-primary px-10 py-4 text-lg shadow-xl shadow-brand-red/20 transform hover:-translate-y-1 transition-all">
                {{ $heroCtaText }}
            </a>
            <a href="/about" class="px-10 py-4 rounded-full font-medium text-white border border-white/30 backdrop-blur-md hover:bg-white/10 transition-all transform hover:-translate-y-1">
                Tentang Kami
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 px-4 bg-batik-subtle">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl mb-2 font-serif">Kategori Produk</h2>
                <div class="w-16 h-1 bg-brand-red rounded-full"></div>
            </div>
            <a href="/products" class="text-brand-red font-medium text-sm flex items-center gap-1">Lihat Semua <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @forelse($categories as $category)
                <a href="/products?category={{ $category->slug }}" class="card-batik relative group aspect-square">
                    <img src="{{ $category->image_url ?: 'https://placehold.co/400x400/FDFCFB/C02424?text=' . $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold">{{ $category->name }}</h3>
                        <p class="text-white/70 text-xs">{{ $category->products_count }} Produk</p>
                    </div>
                </a>
            @empty
                <!-- Demo Categories if empty -->
                @foreach(['Kain Batik', 'Busana', 'Aksesoris', 'Cinderamata'] as $demoCat)
                <div class="card-batik relative group aspect-square">
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 font-serif italic text-2xl">{{ substr($demoCat, 0, 1) }}</div>
                    <div class="absolute inset-0 bg-black/20 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold">{{ $demoCat }}</h3>
                    </div>
                </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products (Mobile-First Simple Grid) -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl mb-2 font-serif italic">Koleksi Terlaris</h2>
            <p class="text-gray-500 max-w-md mx-auto">Pilih dari koleksi motif paling populer yang menjadi favorit para kolektor.</p>
        </div>

        <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
                <div class="group">
                    <a href="/products/{{ $product->slug }}" class="block card-batik aspect-[3/4] mb-4 relative">
                        @php $img = !empty($product->media_urls) ? $product->media_urls[0] : null; @endphp
                        <img src="{{ $img ?: 'https://placehold.co/400x600/FDFCFB/C02424?text=' . $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($product->is_featured)
                            <span class="absolute top-4 right-4 bg-brand-gold text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest">Unggulan</span>
                        @endif
                    </a>
                    <a href="/products/{{ $product->slug }}" class="block">
                        <h3 class="font-bold text-lg mb-1 group-hover:text-brand-red transition-colors">{{ $product->name }}</h3>
                        <p class="text-brand-red font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                </div>
            @empty
                <!-- Demo Products -->
                @foreach(range(1, 4) as $i)
                <div class="opacity-50">
                    <div class="card-batik aspect-[3/4] mb-4 bg-gray-50 flex items-center justify-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    </div>
                    <div class="h-4 w-3/4 bg-gray-100 rounded mb-2"></div>
                    <div class="h-4 w-1/2 bg-gray-50 rounded"></div>
                </div>
                @endforeach
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="/products" class="inline-flex items-center gap-2 font-bold px-8 py-4 border-2 border-brand-red text-brand-red rounded-full hover:bg-brand-red hover:text-white transition-all">
                Jelajahi Semua Produk
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- History Snippet -->
<section class="py-20 bg-brand-red text-white overflow-hidden relative">
    <!-- Decorative Batik Motif in Background -->
    <div class="absolute top-0 right-0 w-64 h-64 text-white/5 -rotate-12 translate-x-32 -translate-y-32">
        <svg viewBox="0 0 100 100" class="w-full h-full fill-current">
            <path d="M50 0 L100 50 L50 100 L0 50 Z" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-4xl font-serif mb-6 leading-tight">Warisan Budaya <br>Dibalik Sehelai Kain</h2>
            <p class="text-white/80 text-lg mb-8">Batik Jambi bukan sekadar kain, ia adalah rekaman sejarah dan kearifan lokal yang telah diwariskan turun-temurun. Setiap tarikan canting dan tetesan malam menceritakan filosofi hidup masyarakat Jambi.</p>
            <a href="/about" class="inline-block px-8 py-4 bg-white text-brand-red rounded-full font-bold hover:bg-opacity-90 transition-all">Pelajari Sejarah Kami</a>
        </div>
        <div class="relative">
            <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl skew-y-3">
                <img src="{{ asset('images/hero.png') }}" class="w-full h-full object-cover">
            </div>
            <div class="absolute -bottom-6 -left-6 bg-brand-gold p-6 rounded-2xl shadow-xl -rotate-3 text-white">
                <p class="text-3xl font-serif">25+</p>
                <p class="text-sm font-medium uppercase tracking-wider">Tahun Berkarya</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <h2 class="text-3xl font-serif">Edukasi & Wawasan Batik</h2>
        <div class="w-16 h-1 bg-brand-gold mx-auto mt-4 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8 text-left">
        @forelse($latestPosts as $post)
            <a href="/posts/{{ $post->slug }}" class="group">
                <div class="aspect-video rounded-xl overflow-hidden mb-4">
                    <img src="{{ $post->image_url ?: 'https://placehold.co/600x400' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <h3 class="font-bold text-xl mb-2">{{ $post->title }}</h3>
                <p class="text-gray-500 text-sm line-clamp-2">{{ strip_tags($post->content) }}</p>
            </a>
        @empty
            @foreach(['Filosofi Motif Biji Timun', 'Cara Merawat Batik Tulis', 'Sejarah Batik Jambi'] as $demoPost)
            <div class="group opacity-70">
                <div class="aspect-video rounded-xl bg-gray-100 mb-4"></div>
                <h3 class="font-bold text-xl mb-2">{{ $demoPost }}</h3>
                <p class="text-gray-400 text-sm">Pelajari lebih dalam tentang warisan budaya...</p>
            </div>
            @endforeach
        @endforelse
    </div>
</section>
@endsection
