@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_name', "D'Moroy") . ' - Artisan Handmade')
@section('meta_description', \App\Models\Setting::get('tagline', 'Menganyam Alam, Melestarikan Budaya Jambi.'))

@section('content')
<!-- Hero Section (Editorial Artisan Full-Bleed Split) -->
<section aria-labelledby="hero-heading" class="relative w-full h-[85vh] lg:h-screen bg-brand-ivory flex flex-col lg:flex-row border-b border-brand-brown/10 overflow-hidden">
    <!-- Left: Content -->
    <div class="w-full lg:w-1/2 flex px-6 md:px-16 lg:px-24 py-12 lg:py-0 z-10">
        <div class="m-auto w-full max-w-xl flex flex-col justify-center">
            <div class="mb-8 flex items-center gap-4 animate-fade-in-up" aria-hidden="true">
                <span class="w-12 h-px bg-brand-gold"></span>
                <span class="text-brand-gold font-bold tracking-[0.25em] uppercase text-[10px]">@lang('home.premium_collection')</span>
            </div>
            <h1 id="hero-heading" class="text-5xl lg:text-7xl xl:text-[5rem] text-brand-brown font-serif mb-8 leading-[1.05] tracking-tight animate-fade-in-up delay-100">
                @if(app()->getLocale() == 'en')
                    Premium Woven Bag Collection
                @else
                    {!! \App\Models\Setting::get('hero_title', 'Menganyam Alam,<br><span class="italic text-brand-gold font-light">Melestarikan Budaya</span> Jambi.') !!}
                @endif
            </h1>
            <p class="text-brand-brown/70 text-lg lg:text-xl mb-12 max-w-lg leading-relaxed animate-fade-in-up delay-200 font-serif">
                @if(app()->getLocale() == 'en')
                    A classy ethnic touch made from natural pandan fibers and selected leather.
                @else
                    {{ \App\Models\Setting::get('hero_subtitle', "D'Moroy menghadirkan kerajinan anyaman serat alam premium. Mengangkat warisan budaya lokal dengan desain proporsional dan ramah lingkungan.") }}
                @endif
            </p>
            <div class="flex flex-col sm:flex-row gap-5 animate-fade-in-up delay-300">
                <a href="{{ \App\Models\Setting::get('hero_cta_link', '/products') }}" class="inline-flex justify-center items-center px-10 py-4 bg-brand-brown text-brand-ivory font-bold uppercase tracking-widest text-xs hover:bg-brand-gold transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold focus-visible:ring-offset-2 shadow-xl shadow-brand-brown/10">
                    @lang('home.explore_collection')
                </a>
                <a href="/about" class="inline-flex justify-center items-center px-10 py-4 border border-brand-brown/20 text-brand-brown font-bold uppercase tracking-widest text-xs hover:border-brand-brown hover:bg-brand-brown/5 transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold focus-visible:ring-offset-2">
                    @lang('home.our_story')
                </a>
            </div>
        </div>
    </div>
    
    <!-- Right: Image (menempel ke kanan, crop dari bawah) -->
    <div class="w-full lg:w-1/2 relative animate-fade-in-up delay-400">
        <img src="{{ asset('images/dmoroy/home_hero.jpg') }}" alt="Produk anyaman eksklusif D'Moroy dengan serat alami" class="absolute inset-0 w-full h-full object-cover object-top">
        
        <!-- Elegant Minimalist Badge -->
        <div class="absolute bottom-0 left-0 bg-brand-ivory p-6 md:p-8 flex items-center gap-6 z-20 border-r border-t border-brand-brown/10" aria-hidden="true">
            <div class="w-14 h-14 rounded-full border border-brand-brown/20 flex items-center justify-center text-brand-brown">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div>
                <p class="text-brand-brown font-serif italic text-xl leading-none mb-1">100%</p>
                <p class="text-[10px] font-bold text-brand-brown/50 uppercase tracking-[0.2em]">@lang('home.natural_fiber')</p>
            </div>
        </div>
    </div>
</section>

<!-- Keunggulan Produk (Why Choose Us) -->
<section aria-labelledby="features-heading" class="py-24 px-6 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block" aria-hidden="true">@lang('home.our_values')</span>
            <h2 id="features-heading" class="text-4xl md:text-5xl font-serif text-brand-brown">@lang('home.masterpiece_heading')</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
            <!-- Feature 1 -->
            <article class="group p-8 rounded-3xl bg-brand-ivory/50 hover:bg-brand-ivory transition-colors border border-brand-brown/5">
                <div class="w-14 h-14 rounded-full bg-brand-brown/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-brand-brown"><path d="M12 2L2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/></svg>
                </div>
                <h3 class="text-2xl font-serif text-brand-brown mb-4">@lang('home.feature1_title')</h3>
                <p class="text-brand-brown/70 leading-relaxed">@lang('home.feature1_desc')</p>
            </article>

            <!-- Feature 2 -->
            <article class="group p-8 rounded-3xl bg-brand-ivory/50 hover:bg-brand-ivory transition-colors border border-brand-brown/5">
                <div class="w-14 h-14 rounded-full bg-brand-brown/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-brand-brown"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <h3 class="text-2xl font-serif text-brand-brown mb-4">@lang('home.feature2_title')</h3>
                <p class="text-brand-brown/70 leading-relaxed">@lang('home.feature2_desc')</p>
            </article>

            <!-- Feature 3 -->
            <article class="group p-8 rounded-3xl bg-brand-ivory/50 hover:bg-brand-ivory transition-colors border border-brand-brown/5">
                <div class="w-14 h-14 rounded-full bg-brand-brown/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform" aria-hidden="true">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-brand-brown"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"/></svg>
                </div>
                <h3 class="text-2xl font-serif text-brand-brown mb-4">@lang('home.feature3_title')</h3>
                <p class="text-brand-brown/70 leading-relaxed">@lang('home.feature3_desc')</p>
            </article>
        </div>
    </div>
</section>

<!-- Produk & Layanan (Our Products) - Masonry Editorial -->
<section aria-labelledby="products-heading" class="py-24 px-4 bg-brand-ivory">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="max-w-2xl">
                <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block" aria-hidden="true">@lang('home.our_collection')</span>
                <h2 id="products-heading" class="text-4xl md:text-5xl font-serif text-brand-brown mb-4">@lang('home.collection_heading')</h2>
                <p class="text-brand-brown/70 text-lg">@lang('home.collection_desc')</p>
            </div>
            <a href="/products" class="shrink-0 text-brand-brown font-bold border-b-2 border-brand-gold hover:text-brand-gold transition-colors pb-1 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded">@lang('home.view_all')</a>
        </div>

        <!-- Clean 4-Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" role="list">
            @php 
                $demoProducts = ['Tas Anyaman Elegan', 'Clutch Etnik Modern', 'Tote Bag Serat Alam', 'Dompet Serat Pandan'];
            @endphp
            @forelse($featuredProducts->take(4) as $product)
                @php 
                    // Map product name to specific image for dummy data
                    $fallbackImg = asset('images/dmoroy/fiber_texture.png');
                    $nameLower = strtolower($product->name);
                    if (str_contains($nameLower, 'biaso bae')) {
                        $fallbackImg = asset('images/dmoroy/bag_biaso_bae.png');
                    } elseif (str_contains($nameLower, 'sangkek')) {
                        $fallbackImg = asset('images/dmoroy/bag_sangkek.png');
                    } elseif (str_contains($nameLower, 'canteek')) {
                        $fallbackImg = asset('images/dmoroy/bag_canteek.png');
                    }
                    
                    $img = !empty($product->media_urls) ? $product->media_urls[0] : $fallbackImg;
                @endphp
                
                <article role="listitem">
                    <a href="/products/{{ $product->slug }}" class="group block focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded-2xl h-full flex flex-col">
                        <div class="relative overflow-hidden rounded-2xl mb-5 aspect-[4/5] bg-brand-ivory/50 shadow-sm border border-brand-brown/5">
                            <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-brand-brown/0 group-hover:bg-brand-brown/10 transition-colors duration-500" aria-hidden="true"></div>
                            @if($product->is_featured)
                                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-brand-brown text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-sm">@lang('home.featured')</span>
                            @endif
                        </div>
                        <div class="px-2 flex-grow flex flex-col">
                            <h3 class="font-serif text-2xl mb-2 group-hover:text-brand-gold transition-colors text-brand-brown leading-tight">{{ $product->name }}</h3>
                            @if($product->price > 0)
                                <p class="text-brand-brown font-medium opacity-80 mt-auto">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            @else
                                <p class="text-brand-brown font-medium opacity-80 mt-auto text-sm italic">Hubungi Admin untuk tanya harga</p>
                            @endif
                        </div>
                    </a>
                </article>
            @empty
                <!-- Demo Grid -->
                @foreach(range(1, 4) as $i)
                    <article class="group block opacity-70" role="listitem">
                        <div class="relative overflow-hidden rounded-2xl mb-5 aspect-[4/5] bg-brand-brown/5 flex items-center justify-center border border-brand-brown/10" aria-hidden="true">
                            <span class="font-serif italic text-brand-brown/20 text-4xl">{{ $i }}</span>
                        </div>
                        <div class="px-2">
                            <h3 class="font-serif text-2xl mb-2 text-brand-brown">{{ $demoProducts[$i-1] }}</h3>
                        </div>
                    </article>
                @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- Pemberdayaan Sosial (Full-width Parallax) -->
<section aria-labelledby="social-heading" class="relative py-32 bg-brand-brown text-brand-ivory overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20 bg-cover bg-center bg-fixed mix-blend-overlay" style="background-image: url('{{ asset('images/dmoroy/studio.png') }}');" aria-hidden="true"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-brand-brown via-brand-brown/95 to-brand-brown/60 z-10" aria-hidden="true"></div>
    
    <div class="relative z-20 max-w-7xl mx-auto px-6 grid md:grid-cols-2 items-center gap-16">
        <div>
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-4 block" aria-hidden="true">@lang('home.social_empowerment')</span>
            <h2 id="social-heading" class="text-4xl md:text-6xl font-serif mb-8 leading-tight">@lang('home.grow_together')</h2>
            <div class="w-20 h-1 bg-brand-gold mb-8" aria-hidden="true"></div>
            <p class="text-brand-ivory/80 text-lg leading-relaxed mb-6">
                @lang('home.social_desc1')
            </p>
            <p class="text-brand-ivory/80 text-lg leading-relaxed">
                @lang('home.social_desc2')
            </p>
        </div>
        <div class="hidden md:block" aria-hidden="true">
            <!-- Dekoratif -->
            <div class="relative w-full aspect-square border border-brand-gold/30 rounded-full flex items-center justify-center p-8">
                <div class="w-full h-full border border-brand-ivory/20 rounded-full flex items-center justify-center animate-[spin_60s_linear_infinite]">
                    <svg viewBox="0 0 100 100" class="w-3/4 h-3/4 text-brand-ivory/10"><path fill="currentColor" d="M50 0 C77.6 0 100 22.4 100 50 C100 77.6 77.6 100 50 100 C22.4 100 0 77.6 0 50 C0 22.4 22.4 0 50 0 Z M50 10 C27.9 10 10 27.9 10 50 C10 72.1 27.9 90 50 90 C72.1 90 90 72.1 90 50 C90 27.9 72.1 10 50 10 Z"/></svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section aria-labelledby="testimonial-heading" class="py-24 px-6 bg-brand-brown text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-cover bg-center mix-blend-overlay" style="background-image: url('{{ asset('images/dmoroy/fiber_texture.png') }}');"></div>
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-16 fade-up" x-intersect="$el.classList.add('in-view')">
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block">@lang('home.testimonials')</span>
            <h2 id="testimonial-heading" class="text-4xl md:text-5xl font-serif text-brand-ivory">@lang('home.what_they_say')</h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8" role="list">
            @php
                $testimonials = [
                    ['name' => 'Siti Aminah', 'role' => 'Kolektor Tas Etnik', 'text' => 'Anyaman D\'Moroy sangat halus dan rapi. Desainnya modern namun tetap mempertahankan nilai tradisional Jambi. Sangat direkomendasikan!'],
                    ['name' => 'Budi Santoso', 'role' => 'Pengusaha', 'text' => 'Saya membeli tas anyaman untuk hadiah istri, dia sangat menyukainya. Kualitas material alamnya terasa mewah dan awet digunakan sehari-hari.'],
                    ['name' => 'Rina Wijaya', 'role' => 'Pecinta Fashion', 'text' => 'Bangga bisa memakai produk lokal dengan kualitas ekspor. Setiap detail anyamannya menceritakan kisah pengrajin yang luar biasa.'],
                ];
            @endphp
            @foreach($testimonials as $testi)
            <div class="bg-white/10 backdrop-blur-sm p-8 rounded-3xl border border-white/10 fade-up" x-intersect="$el.classList.add('in-view')" style="transition-delay: {{ $loop->index * 150 }}ms">
                <div class="text-brand-gold mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                </div>
                <p class="text-white/90 leading-relaxed mb-6 font-serif italic text-lg">"{{ $testi['text'] }}"</p>
                <div>
                    <h4 class="font-bold text-brand-ivory">{{ $testi['name'] }}</h4>
                    <p class="text-sm text-brand-gold">{{ $testi['role'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Instagram Gallery -->
<section aria-labelledby="gallery-heading" class="py-24 bg-brand-ivory overflow-hidden border-b border-brand-brown/10">
    <div class="max-w-7xl mx-auto px-6 text-center mb-16 fade-up" x-intersect="$el.classList.add('in-view')">
        <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block">@lang('home.customer_gallery')</span>
        <h2 id="gallery-heading" class="text-4xl md:text-5xl font-serif text-brand-brown mb-4">@lang('home.gallery_heading')</h2>
        <p class="text-brand-brown/60">@lang('home.gallery_desc') <a href="#" class="text-brand-gold hover:underline">@dmoroy.id</a></p>
    </div>
    
    <div class="flex overflow-x-auto pb-8 snap-x snap-mandatory gap-4 px-6 md:px-12 lg:justify-center" style="scrollbar-width: none;">
        @php
            $latestProducts = \App\Models\Product::with('mediaImages')->latest()->get();
            $igImages = [];
            foreach($latestProducts as $prod) {
                if (!empty($prod->media_urls)) {
                    foreach($prod->media_urls as $url) {
                        if (!in_array($url, $igImages)) {
                            $igImages[] = $url;
                        }
                        if(count($igImages) >= 8) break;
                    }
                }
                if(count($igImages) >= 8) break;
            }
            
            if (empty($igImages)) {
                $igImages = [
                    asset('images/dmoroy/bag_biaso_bae.png'),
                    asset('images/dmoroy/hero_knit.png'),
                    asset('images/dmoroy/bag_sangkek.png'),
                    asset('images/dmoroy/bag_canteek.png'),
                    asset('images/dmoroy/hero_woven.png'),
                ];
            }
        @endphp
        @foreach($igImages as $img)
        <div class="flex-none w-64 h-64 md:w-72 md:h-72 rounded-2xl overflow-hidden relative group snap-center fade-up" x-intersect="$el.classList.add('in-view')" style="transition-delay: {{ $loop->index * 100 }}ms">
            <img src="{{ $img }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Instagram Post {{ $loop->iteration }}">
            <div class="absolute inset-0 bg-brand-brown/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Blog Section -->
<section aria-labelledby="blog-heading" class="py-24 px-6 bg-white">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
        <div>
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block" aria-hidden="true">@lang('home.journal_insights')</span>
            <h2 id="blog-heading" class="text-4xl font-serif text-brand-brown">@lang('home.culture_inspiration')</h2>
        </div>
        <a href="/posts" class="text-brand-brown font-bold border-b-2 border-brand-gold hover:text-brand-gold transition-colors pb-1 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded">@lang('home.read_more')</a>
    </div>

    <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8" role="list">
        @forelse($latestPosts as $post)
            <article role="listitem" class="border-t border-brand-brown/10 pt-6">
                <a href="/posts/{{ $post->slug }}" class="group block focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded p-2 -m-2">
                    <span class="text-brand-gold font-bold text-[10px] tracking-widest uppercase mb-3 block" aria-hidden="true">{{ $post->created_at->format('M d, Y') }}</span>
                    <h3 class="font-serif text-2xl mb-4 text-brand-brown group-hover:text-brand-gold transition-colors leading-snug line-clamp-2">{{ $post->title }}</h3>
                    <div class="aspect-video rounded-xl overflow-hidden mb-5">
                        <img src="{{ $post->image_url ?: asset('images/dmoroy/yarn.png') }}" alt="" role="presentation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <p class="text-brand-brown/70 text-sm line-clamp-3 leading-relaxed">{{ strip_tags($post->content) }}</p>
                </a>
            </article>
        @empty
            @foreach(['Melestarikan Budaya Lokal Melalui Karya', 'Proses Dibalik Pembuatan Kerajinan', 'Tips Merawat Anyaman Serat Alam'] as $demoPost)
            <article role="listitem" class="group border-t border-brand-brown/10 pt-6 opacity-70">
                <span class="text-brand-gold font-bold text-[10px] tracking-widest uppercase mb-3 block" aria-hidden="true">@lang('home.today')</span>
                <h3 class="font-serif text-2xl mb-4 text-brand-brown">{{ $demoPost }}</h3>
                <div class="aspect-video rounded-xl bg-brand-ivory mb-5" aria-hidden="true"></div>
            </article>
            @endforeach
        @endforelse
    </div>
</section>
@endsection
