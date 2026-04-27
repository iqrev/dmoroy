@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan | ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah'))

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 bg-gray-50/30">
    <div class="max-w-xl w-full text-center space-y-10 py-20">
        <!-- Decoration -->
        <div class="relative inline-block">
            <div class="absolute -inset-4 bg-brand-gold/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="relative flex items-center justify-center">
                <span class="text-[150px] md:text-[200px] font-serif font-black text-brand-red opacity-10">404</span>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="absolute w-24 h-24 md:w-32 md:h-32 object-contain opacity-20 grayscale">
            </div>
        </div>
        
        <div class="space-y-4">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-800">Ups! Motif Tidak Ditemukan</h2>
            <div class="w-20 h-1 bg-brand-gold mx-auto rounded-full"></div>
            <p class="text-gray-500 text-lg max-w-md mx-auto leading-relaxed">
                Maaf, halaman yang Anda cari tidak tersedia dalam koleksi kami atau mungkin telah dipindahkan.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-8 py-3.5 bg-brand-red text-white text-sm font-bold rounded-xl hover:bg-red-700 transition-all duration-300 shadow-xl shadow-brand-red/20 group">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-8 py-3.5 bg-white border-2 border-gray-100 text-gray-700 text-sm font-bold rounded-xl hover:border-brand-gold hover:text-brand-gold transition-all duration-300">
                Lihat Katalog Batik
            </a>
        </div>

        <!-- Artistic Footer decoration -->
        <div class="flex justify-center gap-2 opacity-20">
            <div class="w-2 h-2 rounded-full bg-brand-gold"></div>
            <div class="w-2 h-2 rounded-full bg-brand-red"></div>
            <div class="w-2 h-2 rounded-full bg-brand-gold"></div>
        </div>
    </div>
</div>
@endsection
