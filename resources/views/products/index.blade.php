@extends('layouts.app')

@section('title', 'Katalog Produk - ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah'))
@section('meta_description', 'Jelajahi koleksi batik Jambi autentik kami. Tersedia berbagai motif tradisional seperti Biji Timun, Durian Pecah, dan Angso Duo.')

@section('content')
<section class="py-12 px-4 bg-batik-subtle min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <h1 class="text-4xl font-serif mb-4">Katalog <span class="text-brand-red">Produk</span></h1>
            <p class="text-gray-500 text-sm">Jelajahi keindahan motif asli Jambi dalam berbagai bentuk karya seni.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <div>
                        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">Pencarian</h3>
                        <form action="{{ route('products.index') }}" method="GET" class="relative group max-w-sm">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-gray-400 group-focus-within:text-brand-red transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                </span>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari motif batik..." 
                                       class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm outline-none focus:border-brand-red focus:ring-4 focus:ring-brand-red/5 transition-all placeholder:text-gray-400">
                            </div>
                        </form>
                    </div>

                    <div>
                        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">Kategori</h3>
                        <div class="space-y-2 flex flex-wrap lg:flex-col gap-2 lg:gap-0">
                            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-full lg:rounded-none lg:px-0 lg:py-1 text-sm {{ !request('category') ? 'text-brand-red font-bold' : 'text-gray-500 hover:text-brand-red' }}">Semua</a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full lg:rounded-none lg:px-0 lg:py-1 text-sm {{ request('category') == $category->slug ? 'text-brand-red font-bold' : 'text-gray-500 hover:text-brand-red' }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm text-gray-500 italic">
                        Menampilkan {{ $products->total() }} produk
                        @if(request('q')) untuk "{{ request('q') }}" @endif
                    </p>
                </div>
                <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="group">
                            <a href="{{ route('products.show', $product->slug) }}" class="block card-batik aspect-[3/4] mb-4 relative overflow-hidden">
                                @php $img = !empty($product->media_urls) ? $product->media_urls[0] : null; @endphp
                                <img src="{{ $img ?: 'https://placehold.co/400x600/FDFCFB/C02424?text=' . $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                     alt="{{ $product->name }}">
                                @if($product->is_featured)
                                    <span class="absolute top-3 right-3 bg-brand-gold text-white text-[10px] px-2 py-1 rounded-full font-bold uppercase tracking-wider">Top</span>
                                @endif
                            </a>
                            <a href="{{ route('products.show', $product->slug) }}">
                                <h3 class="font-bold text-base mb-1 group-hover:text-brand-red transition-colors">{{ $product->name }}</h3>
                                <p class="text-brand-red font-semibold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Produk Tidak Ditemukan</h3>
                            <p class="text-gray-400 italic">Maaf, kami tidak menemukan produk dengan kata kunci "{{ request('q') }}".</p>
                            <a href="{{ route('products.index') }}" class="inline-block mt-6 text-brand-red font-medium underline">Hapus Pencarian</a>
                        </div>
                    @endforelse
                </div>
                <div class="mt-12">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection
