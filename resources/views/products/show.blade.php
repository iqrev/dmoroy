@extends('layouts.app')

@section('title', $product->name . ' - ' . \App\Models\Setting::get('site_name', "D'Moroy"))
@section('meta_description', strip_tags(Str::limit($product->description, 160)))

@section('og_title', $product->name)
@section('og_description', strip_tags(Str::limit($product->description, 160)))
@section('og_image', !empty($product->media_urls) ? $product->media_urls[0] : asset('images/logo.png'))
@section('og_type', 'product')

@push('scripts')
<script type="application/ld+json">
{
  "@@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": [
    @foreach($product->media_urls as $url)
      "{{ url($url) }}"{{ !$loop->last ? ',' : '' }}
    @endforeach
  ],
  "description": "{{ strip_tags(Str::limit($product->description, 200)) }}",
  "sku": "BJB-{{ $product->id }}",
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $product->price }}",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</script>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Beranda",
    "item": "{{ url('/') }}"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Katalog",
    "item": "{{ url('/products') }}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{ $product->name }}",
    "item": "{{ url()->current() }}"
  }]
}
</script>
@endpush

@section('content')
<article class="py-12 px-4 bg-white min-h-screen" x-data="{ stickyVisible: false, qty: 1 }">
    <div class="max-w-7xl mx-auto">
        {{-- Breadcrumbs --}}
        <x-breadcrumbs :items="[
            ['label' => __('pages.our_catalog'), 'url' => route('products.index')],
            ['label' => $product->name, 'url' => '#'],
        ]" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image Gallery -->
            <div class="space-y-4">
                @php $mainImg = !empty($product->media_urls) ? $product->media_urls[0] : null; @endphp
                <div class="card-Dmoroy aspect-square relative overflow-hidden cursor-crosshair rounded-2xl" aria-hidden="true"
                     x-data="{ zoomX: 0, zoomY: 0, isHovering: false, mainImg: '{{ $mainImg ?: asset('images/dmoroy/hero_woven.png') }}' }"
                     @mousemove="
                        const rect = $el.getBoundingClientRect();
                        zoomX = (($event.clientX - rect.left) / rect.width) * 100;
                        zoomY = (($event.clientY - rect.top) / rect.height) * 100;
                     "
                     @mouseenter="isHovering = true"
                     @mouseleave="isHovering = false"
                     @update-main-image.window="mainImg = $event.detail">
                     
                    <!-- Gambar Normal -->
                    <img :src="mainImg" 
                         class="w-full h-full object-cover transition-opacity duration-300" 
                         :class="{ 'opacity-0': isHovering }"
                         alt="Gambar Utama {{ $product->name }}">

                    <!-- Gambar Zoom -->
                    <div class="absolute inset-0 pointer-events-none opacity-0 transition-opacity duration-200 bg-white"
                         :class="{ 'opacity-100': isHovering }">
                        <img :src="mainImg"
                             class="w-full h-full object-cover"
                             :style="`transform-origin: ${zoomX}% ${zoomY}%; transform: scale(2.5);`"
                             alt="Zoom Gambar Utama">
                    </div>
                </div>
                @if(!empty($product->media_urls) && count($product->media_urls) > 1)
                <div class="grid grid-cols-4 gap-4" role="group" aria-label="Galeri Gambar Produk">
                    @foreach($product->media_urls as $url)
                    <button type="button" aria-label="Lihat Gambar {{ $loop->iteration }}" class="card-Dmoroy aspect-square opacity-60 hover:opacity-100 transition-opacity focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded overflow-hidden" 
                            @click="$dispatch('update-main-image', '{{ $url }}')">
                        <img src="{{ $url }}" class="w-full h-full object-cover" alt="Thumbnail {{ $loop->iteration }}">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <span class="text-brand-brown font-bold text-sm uppercase tracking-widest">{{ $product->category->name }}</span>
                    <h1 class="text-4xl font-serif mt-2">{{ $product->name }}</h1>
                </div>

                @if($product->price > 0)
                    <div class="text-3xl font-bold text-brand-brown mb-8" aria-label="Harga: Rp {{ number_format($product->price, 0, ',', '.') }}">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                @else
                    <div class="text-2xl font-bold text-brand-brown mb-8 italic" aria-label="Harga: Hubungi Admin untuk tanya harga">
                        Hubungi Admin untuk tanya harga
                    </div>
                @endif

                <div class="prose prose-sm max-w-none text-gray-600 mb-12">
                    {!! $product->description !!}
                </div>

                <div class="mt-auto space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-brand-ivory rounded-2xl border border-brand-gold/20">
                        <div class="w-12 h-12 bg-white rounded flex items-center justify-center text-brand-gold" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Lokasi Workshop</p>
                            <p class="text-sm font-bold">{{ $product->workshop_location ?: 'Jambi, Indonesia' }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4" x-intersect:leave="stickyVisible = true" x-intersect:enter="stickyVisible = false">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            
                            <div class="flex items-center gap-4">
                                <label for="quantity" class="text-sm font-bold text-gray-500 uppercase tracking-widest">@lang('pages.quantity')</label>
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden w-fit bg-white focus-within:ring-2 focus-within:ring-brand-gold">
                                    <button type="button" aria-label="Kurangi jumlah" @click="if(qty > 1) qty--" class="px-4 py-2 hover:bg-gray-50 transition-colors focus-visible:outline-none focus-visible:bg-gray-100">-</button>
                                    <input type="number" name="quantity" id="quantity" x-model="qty" min="1" aria-label="Jumlah item" class="w-12 text-center border-none focus:ring-0 outline-none focus:outline-none appearance-none font-bold p-0 m-0">
                                    <button type="button" aria-label="Tambah jumlah" @click="qty++" class="px-4 py-2 hover:bg-gray-50 transition-colors focus-visible:outline-none focus-visible:bg-gray-100">+</button>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-brand-brown text-white py-4 rounded font-bold text-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 group focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold focus-visible:ring-offset-2">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                @lang('pages.add_to_cart')
                            </button>
                        </form>

                        @php
                            $waMessage = rawurlencode("Halo D'Moroy, saya tertarik dengan produk " . $product->name . " yang saya lihat di website. Apakah produk ini tersedia?");
                            $waLink = "https://wa.me/" . str_replace(['-', ' ', '+'], '', \App\Models\Setting::get('whatsapp', '6281234567890')) . "?text=" . $waMessage;
                        @endphp
                        <a href="{{ $waLink }}" target="_blank" class="w-full text-center border-2 border-brand-brown text-brand-brown py-3.5 rounded font-bold hover:bg-brand-brown/5 transition-all focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold">
                            @lang('pages.buy_now_wa')
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <section aria-labelledby="related-heading" class="mt-20">
            <h2 id="related-heading" class="text-2xl font-serif mb-8 italic text-gray-800">Produk Serupa</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8" role="list">
                @foreach($relatedProducts as $related)
                <article role="listitem" class="group">
                    <a href="/products/{{ $related->slug }}" tabindex="-1" class="block card-Dmoroy aspect-[3/4] mb-4 overflow-hidden focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded-2xl">
                        @php $rImg = !empty($related->media_urls) ? $related->media_urls[0] : null; @endphp
                        <img src="{{ $rImg ?: asset('images/dmoroy/fiber_texture.png') }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <a href="/products/{{ $related->slug }}" class="block focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded">
                        <h3 class="font-bold text-sm mb-1 line-clamp-1 group-hover:text-brand-brown transition-colors">{{ $related->name }}</h3>
                        @if($related->price > 0)
                            <p class="text-brand-brown font-bold text-sm">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                        @else
                            <p class="text-brand-brown font-bold text-sm italic">Hubungi Admin untuk tanya harga</p>
                        @endif
                    </a>
                </article>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Other Products -->
        @if($otherProducts->count() > 0)
        <section aria-labelledby="other-heading" class="mt-20 pt-12 border-t border-gray-100">
            <h2 id="other-heading" class="text-2xl font-serif mb-8 italic text-gray-800">Produk Lainnya</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8" role="list">
                @foreach($otherProducts as $other)
                <article role="listitem" class="group">
                    <a href="/products/{{ $other->slug }}" tabindex="-1" class="block card-Dmoroy aspect-[3/4] mb-4 overflow-hidden focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold rounded-2xl">
                        @php $oImg = !empty($other->media_urls) ? $other->media_urls[0] : null; @endphp
                        <img src="{{ $oImg ?: asset('images/dmoroy/fiber_texture.png') }}" alt="{{ $other->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <a href="/products/{{ $other->slug }}" class="block focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded">
                        <h3 class="font-bold text-sm mb-1 line-clamp-1 group-hover:text-brand-brown transition-colors">{{ $other->name }}</h3>
                        @if($other->price > 0)
                            <p class="text-brand-brown font-bold text-sm">Rp {{ number_format($other->price, 0, ',', '.') }}</p>
                        @else
                            <p class="text-brand-brown font-bold text-sm italic">Hubungi Admin untuk tanya harga</p>
                        @endif
                    </a>
                </article>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <!-- Sticky Add to Cart -->
    <div x-show="stickyVisible" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-2xl z-50 p-4 md:py-4 md:px-8" x-cloak>
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="hidden md:flex items-center gap-4">
                <img src="{{ $mainImg ?: asset('images/dmoroy/hero_woven.png') }}" class="w-12 h-12 object-cover rounded" alt="Thumbnail">
                <div>
                    <h3 class="font-bold text-sm text-brand-brown">{{ $product->name }}</h3>
                    @if($product->price > 0)
                        <p class="text-brand-gold font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @else
                        <p class="text-brand-gold font-bold text-sm italic">Hubungi Admin untuk tanya harga</p>
                    @endif
                </div>
            </div>
            
            <form action="{{ route('cart.add') }}" method="POST" class="flex items-center gap-4 w-full md:w-auto ml-auto">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" :value="qty">
                @if($product->price > 0)
                    <div class="font-bold text-brand-brown whitespace-nowrap block md:hidden text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                @else
                    <div class="font-bold text-brand-brown whitespace-nowrap block md:hidden text-lg italic">Hubungi Admin untuk tanya harga</div>
                @endif
                <button type="submit" class="btn-primary w-full md:w-auto py-3 px-8 text-sm md:text-base whitespace-nowrap">@lang('pages.add_to_cart')</button>
            </form>
        </div>
    </div>
</article>
@endsection
