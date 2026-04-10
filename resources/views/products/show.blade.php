@extends('layouts.app')

@section('title', $product->name . ' - ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah'))
@section('meta_description', strip_tags(Str::limit($product->description, 160)))

@section('content')
<section class="py-12 px-4 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="/" class="hover:text-brand-red">Beranda</a></li>
                <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></li>
                <li><a href="/products" class="hover:text-brand-red">Katalog</a></li>
                <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></li>
                <li class="text-gray-900 font-medium truncate">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image Gallery -->
            <div class="space-y-4">
                <div class="card-batik aspect-square">
                    @php $mainImg = $product->images[0] ?? null; @endphp
                    <img src="{{ $mainImg ? asset('storage/' . $mainImg) : 'https://placehold.co/800x800/FDFCFB/C02424?text=' . $product->name }}" class="w-full h-full object-cover" id="mainImage">
                </div>
                @if($product->images && count($product->images) > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $image)
                    <button class="card-batik aspect-square opacity-60 hover:opacity-100 transition-opacity" onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $image) }}'">
                        <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <span class="text-brand-red font-bold text-sm uppercase tracking-widest">{{ $product->category->name }}</span>
                    <h1 class="text-4xl font-serif mt-2">{{ $product->name }}</h1>
                </div>

                <div class="text-3xl font-bold text-brand-red mb-8">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <div class="prose prose-sm max-w-none text-gray-600 mb-12">
                    {!! $product->description !!}
                </div>

                <div class="mt-auto space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-brand-cream rounded-2xl border border-brand-gold/20">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-brand-gold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Lokasi Workshop</p>
                            <p class="text-sm font-bold">Jambi, Indonesia</p>
                        </div>
                    </div>

                    @php
                        $waMessage = rawurlencode("Halo Batik Jambi Berkah, saya tertarik dengan produk " . $product->name . " yang saya lihat di website. Apakah produk ini tersedia?");
                        $waLink = "https://wa.me/6281234567890?text=" . $waMessage;
                    @endphp
                    <a href="{{ $waLink }}" target="_blank" class="block w-full text-center bg-[#25D366] text-white py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-20">
            <h2 class="text-2xl font-serif mb-8 italic">Produk Seupa</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <div class="group">
                    <a href="/products/{{ $related->slug }}" class="block card-batik aspect-[3/4] mb-4 overflow-hidden">
                        @php $rImg = $related->images[0] ?? null; @endphp
                        <img src="{{ $rImg ? asset('storage/' . $rImg) : 'https://placehold.co/400x600/FDFCFB/C02424?text=' . $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <a href="/products/{{ $related->slug }}">
                        <h3 class="font-bold text-sm mb-1 line-clamp-1">{{ $related->name }}</h3>
                        <p class="text-brand-red font-medium text-sm">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
