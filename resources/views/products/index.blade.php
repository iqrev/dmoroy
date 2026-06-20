@extends('layouts.app')

@section('title', 'Katalog Produk - ' . \App\Models\Setting::get('site_name', "D'Moroy"))
@section('meta_description', 'Jelajahi koleksi tas anyaman premium D\'Moroy. Tersedia berbagai desain etnik yang elegan dan fungsional dari bahan serat alam berkualitas tinggi.')

@section('content')
<section class="py-12 px-4 bg-brand-ivory min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <h1 class="text-4xl font-serif mb-4 text-brand-brown">Katalog <span class="text-brand-gold italic font-light">Produk</span></h1>
            <p class="text-brand-brown/70 text-sm font-serif">Jelajahi keindahan anyaman Jambi dalam berbagai bentuk karya rajut premium.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <div>
                        <h3 class="font-bold text-lg mb-4 flex items-center gap-2 text-brand-brown">Pencarian</h3>
                        <form action="{{ route('products.index') }}" method="GET" class="relative group max-w-sm">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-brand-brown/40 group-focus-within:text-brand-gold transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                </span>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari tas anyaman..." 
                                       class="w-full pl-12 pr-4 py-3 bg-white border border-brand-brown/10 rounded-2xl text-sm outline-none focus:border-brand-gold focus:ring-4 focus:ring-brand-gold/10 transition-all placeholder:text-brand-brown/40 font-serif text-brand-brown">
                            </div>
                        </form>
                    </div>

                    <div>
                        <h3 class="font-bold text-lg mb-4 flex items-center gap-2 text-brand-brown">Kategori</h3>
                        <div class="space-y-2 flex flex-wrap lg:flex-col gap-2 lg:gap-0">
                            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-full lg:rounded-none lg:px-0 lg:py-1 text-sm {{ !request('category') ? 'text-brand-gold font-bold' : 'text-brand-brown/60 hover:text-brand-gold' }}">Semua</a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full lg:rounded-none lg:px-0 lg:py-1 text-sm {{ request('category') == $category->slug ? 'text-brand-gold font-bold' : 'text-brand-brown/60 hover:text-brand-gold' }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

            <section class="lg:col-span-3" aria-label="Daftar Produk" x-data="{ quickViewOpen: false, activeProduct: null, qty: 1 }">
                <div class="flex items-center justify-between mb-6" aria-live="polite">
                    <p class="text-sm text-brand-brown/60 italic font-serif">
                        Menampilkan {{ $products->total() }} produk
                        @if(request('q')) untuk "{{ request('q') }}" @endif
                    </p>
                </div>
                <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 gap-6" role="list">
                    @forelse($products as $product)
                        <article class="group" role="listitem">
                            <a href="{{ route('products.show', $product->slug) }}" tabindex="-1" class="block card-Dmoroy aspect-[3/4] mb-4 relative overflow-hidden rounded-2xl focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold group">
                                @php 
                                    $img1 = !empty($product->media_urls) ? $product->media_urls[0] : asset('images/dmoroy/hero_woven.png'); 
                                    $img2 = (!empty($product->media_urls) && count($product->media_urls) > 1) ? $product->media_urls[1] : $img1;
                                    $productJson = json_encode([
                                        'id' => $product->id,
                                        'name' => $product->name,
                                        'price' => number_format($product->price, 0, ',', '.'),
                                        'image' => $img1,
                                        'slug' => $product->slug,
                                        'desc' => \Illuminate\Support\Str::limit(strip_tags($product->description), 120)
                                    ]);
                                @endphp
                                <div class="w-full h-full relative bg-brand-ivory/50">
                                    @if(!empty($product->media_urls) && count($product->media_urls) > 1)
                                        <img src="{{ $img1 }}" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 group-hover:opacity-0" alt="Foto {{ $product->name }}">
                                        <img src="{{ $img2 }}" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0 group-hover:opacity-100" alt="Detail {{ $product->name }}">
                                    @else
                                        <img src="{{ $img1 }}" class="absolute inset-0 w-full h-full object-cover" alt="Foto {{ $product->name }}">
                                    @endif
                                </div>
                                <button type="button" @click.prevent='activeProduct = {{ $productJson }}; qty = 1; quickViewOpen = true;' class="absolute inset-x-4 bottom-4 bg-brand-brown text-white font-bold py-2.5 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 transform-gpu text-sm z-10 hover:bg-brand-gold">
                                    Lihat Cepat
                                </button>
                                @if($product->is_featured)
                                    <span class="absolute top-3 right-3 bg-brand-gold text-white text-[10px] px-2 py-1 rounded-full font-bold uppercase tracking-wider z-10" aria-hidden="true">Top</span>
                                    <span class="sr-only">Produk unggulan</span>
                                @endif
                            </a>
                            <a href="{{ route('products.show', $product->slug) }}" class="block focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded">
                                <h3 class="font-bold text-base mb-1 group-hover:text-brand-gold transition-colors text-brand-brown font-serif">{{ $product->name }}</h3>
                                <p class="text-brand-brown font-semibold text-sm opacity-80 font-serif">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </a>
                        </article>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-brand-brown/5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-brown/20"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <h3 class="text-lg font-bold mb-2 text-brand-brown font-serif">Produk Tidak Ditemukan</h3>
                            <p class="text-brand-brown/60 italic font-serif">Maaf, kami tidak menemukan produk dengan kata kunci "{{ request('q') }}".</p>
                            <a href="{{ route('products.index') }}" class="inline-block mt-6 text-brand-gold font-medium hover:underline">Hapus Pencarian</a>
                        </div>
                    @endforelse
                </div>
                <div class="mt-12">{{ $products->links() }}</div>
                
                <!-- Quick View Modal -->
                <div x-show="quickViewOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                        <div x-show="quickViewOpen" @click="quickViewOpen = false" x-transition.opacity class="fixed inset-0 bg-brand-brown/80 transition-opacity" aria-hidden="true"></div>
                        
                        <div x-show="quickViewOpen" x-transition.scale class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-2xl border border-gray-100">
                            <button @click="quickViewOpen = false" type="button" class="absolute top-4 right-4 w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-800 transition-colors z-10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold">
                                <span class="sr-only">Tutup</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </button>
                            <div class="flex flex-col md:flex-row max-h-[85vh] overflow-y-auto">
                                <div class="w-full md:w-1/2 bg-gray-50/50 flex items-center justify-center p-6 md:p-8">
                                    <img :src="activeProduct?.image" :alt="activeProduct?.name" class="w-full max-h-[250px] md:max-h-[320px] object-contain rounded-xl mix-blend-multiply">
                                </div>
                                <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-start">
                                    <div class="mb-6">
                                        <h3 class="text-2xl font-serif text-brand-brown mb-1.5 leading-tight" id="modal-title" x-text="activeProduct?.name"></h3>
                                        <p class="text-xl text-brand-gold font-bold mb-4 font-serif">Rp <span x-text="activeProduct?.price"></span></p>
                                        <p class="text-gray-500 leading-relaxed font-serif text-sm line-clamp-3" x-text="activeProduct?.desc"></p>
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                                        @csrf
                                        <input type="hidden" name="id" :value="activeProduct?.id">
                                        <div class="flex gap-3 h-11">
                                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden h-full bg-white w-28 shrink-0 focus-within:border-brand-gold focus-within:ring-1 focus-within:ring-brand-gold transition-all">
                                                <button type="button" class="px-3 h-full bg-gray-50 hover:bg-gray-100 text-brand-brown transition-colors" @click="if(qty > 1) qty--">-</button>
                                                <input type="number" name="quantity" x-model="qty" min="1" class="w-full h-full text-center border-none p-0 focus:ring-0 text-brand-brown font-bold bg-transparent text-sm">
                                                <button type="button" class="px-3 h-full bg-gray-50 hover:bg-gray-100 text-brand-brown transition-colors" @click="qty++">+</button>
                                            </div>
                                            <button type="submit" class="flex-1 bg-brand-brown hover:bg-brand-gold text-white font-bold uppercase tracking-wider text-[11px] h-full rounded-lg shadow-sm transition-all focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold">Tambah</button>
                                        </div>
                                    </form>
                                    <div class="mt-auto pt-4 border-t border-gray-100">
                                        <a :href="'/products/' + activeProduct?.slug" class="text-xs font-bold tracking-widest uppercase text-brand-brown hover:text-brand-gold transition-colors inline-flex items-center gap-1.5 group/link focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded py-1">
                                            <span>Detail Lengkap</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform group-hover/link:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
