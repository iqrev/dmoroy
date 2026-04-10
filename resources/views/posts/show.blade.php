@extends('layouts.app')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah Group'))
@section('meta_description', Str::limit(strip_tags($post->content), 160))

@section('content')
<article class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex text-sm text-gray-400 mb-10" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="/" class="hover:text-brand-red transition-colors">Beranda</a></li>
                <li><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></li>
                <li><a href="/posts" class="hover:text-brand-red transition-colors">Edukasi</a></li>
                <li><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></li>
                <li class="text-gray-900 font-medium truncate max-w-xs">{{ $post->title }}</li>
            </ol>
        </nav>

        {{-- Header --}}
        <header class="mb-10">
            <p class="text-brand-red font-bold text-sm uppercase tracking-widest mb-4">
                {{ $post->created_at->translatedFormat('d F Y') }}
            </p>
            <h1 class="text-4xl md:text-5xl font-serif leading-tight mb-6">{{ $post->title }}</h1>
        </header>

        {{-- Cover Image --}}
        @if($post->image)
        <div class="aspect-video rounded-3xl overflow-hidden mb-12 shadow-md">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        {{-- Content --}}
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed
                    prose-headings:font-serif prose-headings:text-gray-900
                    prose-a:text-brand-red prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-2xl prose-img:shadow-md
                    prose-strong:text-gray-900">
            {!! $post->content !!}
        </div>

        {{-- Divider --}}
        <hr class="my-16 border-gray-100">

        {{-- Share & Navigate --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Bagikan Artikel</p>
                <div class="flex gap-3">
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank"
                       class="w-10 h-10 rounded-full bg-[#25D366] flex items-center justify-center hover:scale-110 transition-transform shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                       class="w-10 h-10 rounded-full bg-[#1877F2] flex items-center justify-center hover:scale-110 transition-transform shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <a href="/posts" class="inline-flex items-center gap-2 text-brand-red font-medium hover:gap-3 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Kembali ke Edukasi
            </a>
        </div>
    </div>
</article>

{{-- Related Posts --}}
@if($relatedPosts->count() > 0)
<section class="py-16 px-4 bg-batik-subtle">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-serif mb-8">Artikel Terkait</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($relatedPosts as $related)
            <a href="{{ route('posts.show', $related->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/600x400/FDFCFB/C02424?text=' . urlencode($related->title) }}"
                         alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-2 line-clamp-2 group-hover:text-brand-red transition-colors">{{ $related->title }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2">{{ strip_tags($related->content) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
