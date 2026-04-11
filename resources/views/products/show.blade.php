@extends('layouts.app')

@section('title', $product->name . ' - ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah'))
@section('meta_description', strip_tags(Str::limit($product->description, 160)))

@section('og_title', $product->name)
@section('og_description', strip_tags(Str::limit($product->description, 160)))
@section('og_image', !empty($product->media_urls) ? $product->media_urls[0] : asset('images/logo.png'))
@section('og_type', 'product')

@push('scripts')
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
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
  "@context": "https://schema.org",
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
<section class="py-12 px-4 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto">
        {{-- Breadcrumbs --}}
        <x-breadcrumbs :items="[
            ['label' => 'Katalog', 'url' => route('products.index')],
            ['label' => $product->name, 'url' => '#'],
        ]" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image Gallery -->
            <div class="space-y-4">
                <div class="card-batik aspect-square">
                    @php $mainImg = !empty($product->media_urls) ? $product->media_urls[0] : null; @endphp
                    <img src="{{ $mainImg ?: 'https://placehold.co/800x800/FDFCFB/C02424?text=' . $product->name }}" 
                         class="w-full h-full object-cover" 
                         id="mainImage" 
                         alt="{{ $product->name }}">
                </div>
                @if(!empty($product->media_urls) && count($product->media_urls) > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->media_urls as $url)
                    <button class="card-batik aspect-square opacity-60 hover:opacity-100 transition-opacity" 
                            onclick="document.getElementById('mainImage').src='{{ $url }}'">
                        <img src="{{ $url }}" class="w-full h-full object-cover" alt="{{ $product->name }} - Gambar {{ $loop->iteration }}">
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
                            <p class="text-sm font-bold">{{ $product->workshop_location ?: 'Jambi, Indonesia' }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            
                            <div class="flex items-center gap-4">
                                <label for="quantity" class="text-sm font-bold text-gray-500 uppercase tracking-widest">Jumlah</label>
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden w-fit bg-white">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()" class="px-4 py-2 hover:bg-gray-50 transition-colors">-</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-12 text-center border-none focus:ring-0 font-bold" readonly>
                                    <button type="button" onclick="this.previousElementSibling.stepUp()" class="px-4 py-2 hover:bg-gray-50 transition-colors">+</button>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-brand-red text-white py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                Tambah ke Keranjang
                            </button>
                        </form>

                        @php
                            $waMessage = rawurlencode("Halo Batik Jambi Berkah, saya tertarik dengan produk " . $product->name . " yang saya lihat di website. Apakah produk ini tersedia?");
                            $waLink = "https://wa.me/" . str_replace(['-', ' ', '+'], '', \App\Models\Setting::get('whatsapp', '6281234567890')) . "?text=" . $waMessage;
                        @endphp
                        <a href="{{ $waLink }}" target="_blank" class="w-full text-center border-2 border-brand-red text-brand-red py-3.5 rounded-full font-bold hover:bg-brand-red/5 transition-all">
                            Beli Langsung (WhatsApp)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-20">
            <h2 class="text-2xl font-serif mb-8 italic text-gray-800">Produk Serupa</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <div class="group">
                    <a href="/products/{{ $related->slug }}" class="block card-batik aspect-[3/4] mb-4 overflow-hidden">
                        @php $rImg = !empty($related->media_urls) ? $related->media_urls[0] : null; @endphp
                        <img src="{{ $rImg ?: 'https://placehold.co/400x600/FDFCFB/C02424?text=' . $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <a href="/products/{{ $related->slug }}">
                        <h3 class="font-bold text-sm mb-1 line-clamp-1 group-hover:text-brand-red transition-colors">{{ $related->name }}</h3>
                        <p class="text-brand-red font-bold text-sm">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Other Products -->
        @if($otherProducts->count() > 0)
        <div class="mt-20 pt-12 border-t border-gray-100">
            <h2 class="text-2xl font-serif mb-8 italic text-gray-800">Produk Lainnya</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($otherProducts as $other)
                <div class="group">
                    <a href="/products/{{ $other->slug }}" class="block card-batik aspect-[3/4] mb-4 overflow-hidden">
                        @php $oImg = !empty($other->media_urls) ? $other->media_urls[0] : null; @endphp
                        <img src="{{ $oImg ?: 'https://placehold.co/400x600/FDFCFB/C02424?text=' . $other->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <a href="/products/{{ $other->slug }}">
                        <h3 class="font-bold text-sm mb-1 line-clamp-1 group-hover:text-brand-red transition-colors">{{ $other->name }}</h3>
                        <p class="text-brand-red font-bold text-sm">Rp {{ number_format($other->price, 0, ',', '.') }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
