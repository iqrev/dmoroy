@extends('layouts.app')

@section('title', 'Edukasi Batik - ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group'))
@section('meta_description', 'Pelajari filosofi, motif, dan sejarah Batik Jambi. Konten edukatif dari para ahli dan pengrajin ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group') . '.')

@section('content')
{{-- Hero --}}
<section class="relative py-24 px-4 bg-batik-subtle overflow-hidden">
    <div class="max-w-4xl mx-auto text-center">
        <p class="text-brand-red font-medium uppercase tracking-widest text-sm mb-4">Wawasan & Edukasi</p>
        <h1 class="text-5xl md:text-6xl font-serif mb-6 leading-tight">Belajar tentang <span class="text-brand-red italic">Batik Jambi</span></h1>
        <p class="text-gray-500 text-xl max-w-xl mx-auto leading-relaxed">
            Temukan kisah di balik setiap motif, filosofi mendalam, dan cara merawat batik Anda agar tetap indah.
        </p>
    </div>
</section>

{{-- Posts Grid --}}
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        @if($posts->count() > 0)
            {{-- Featured Post --}}
            @php $featured = $posts->first(); @endphp
            <a href="{{ route('posts.show', $featured->slug) }}" class="group block mb-16">
                <div class="grid md:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-shadow border border-gray-100">
                    <div class="aspect-video md:aspect-auto min-h-64 overflow-hidden">
                        <img src="{{ $featured->image ? asset('storage/' . $featured->image) : 'https://placehold.co/800x500/FDFCFB/C02424?text=Batik+Jambi' }}"
                             alt="{{ $featured->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-10 bg-white flex flex-col justify-center">
                        <span class="inline-block bg-brand-red/10 text-brand-red text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full w-fit mb-6">Artikel Pilihan</span>
                        <h2 class="text-3xl font-serif mb-4 leading-tight group-hover:text-brand-red transition-colors">{{ $featured->title }}</h2>
                        <p class="text-gray-500 leading-relaxed mb-6 line-clamp-3">{{ strip_tags($featured->content) }}</p>
                        <div class="flex items-center gap-2 text-brand-red font-medium text-sm">
                            <span>Baca Selengkapnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Other Posts --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts->skip(1) as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/600x400/FDFCFB/C02424?text=' . urlencode($post->title) }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="p-6">
                            <p class="text-brand-red text-xs font-bold uppercase tracking-widest mb-3">
                                {{ $post->created_at->format('d M Y') }}
                            </p>
                            <h3 class="font-bold text-xl mb-3 leading-tight group-hover:text-brand-red transition-colors line-clamp-2">{{ $post->title }}</h3>
                            <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">{{ strip_tags($post->content) }}</p>
                            <div class="mt-4 flex items-center gap-1 text-brand-red text-sm font-medium">
                                <span>Baca</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <div class="py-32 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
                </div>
                <h3 class="text-2xl font-serif mb-3 text-gray-600">Belum Ada Artikel</h3>
                <p class="text-gray-400">Artikel edukasi akan segera hadir. Nantikan konten menarik dari kami.</p>
            </div>
        @endif
    </div>
</section>
@endsection
