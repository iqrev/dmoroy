@extends('layouts.app')

@section('title', 'Hubungi Kami - Batik Jambi Berkah Group')
@section('meta_description', 'Pesan batik Jambi autentik atau ajukan pertanyaan via WhatsApp, email, atau kunjungi langsung workshop kami di Jambi, Indonesia.')

@section('content')
{{-- Hero Contact --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 bg-batik-subtle opacity-50"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10">
        <p class="text-brand-red font-medium uppercase tracking-widest text-sm mb-4">Kami Siap Membantu</p>
        <h1 class="text-5xl md:text-6xl font-serif mb-6 leading-tight">Hubungi <span class="text-brand-red italic">Kami</span></h1>
        <p class="text-gray-500 text-xl max-w-2xl mx-auto leading-relaxed">
            Ada pertanyaan tentang produk, ingin memesan dalam jumlah besar, atau sekadar ingin tahu lebih banyak? Tim kami siap membantu Anda.
        </p>
    </div>
</section>

{{-- Contact Methods --}}
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-3 gap-8 mb-20">
            {{-- WhatsApp --}}
            <a href="https://wa.me/6281234567890" target="_blank" 
               class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:border-[#25D366]/30 hover:shadow-lg transition-all text-center">
                <div class="w-20 h-20 rounded-full bg-[#25D366]/10 flex items-center justify-center mx-auto mb-6 group-hover:bg-[#25D366]/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="#25D366">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-2">WhatsApp</h3>
                <p class="text-gray-500 text-sm mb-4">Respons cepat, langsung ke tim kami</p>
                <p class="text-[#25D366] font-bold">+{{ \App\Models\Setting::get('whatsapp', '62 812-3456-7890') }}</p>
                <span class="inline-block mt-4 text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">{{ \App\Models\Setting::get('office_hours', 'Senin - Sabtu, 08:00 - 17:00') }}</span>
            </a>

            {{-- Email --}}
            <a href="mailto:info@batikjambiberkah.com" 
               class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:border-brand-red/30 hover:shadow-lg transition-all text-center">
                <div class="w-20 h-20 rounded-full bg-brand-red/10 flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-red/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#C02424" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-2">Email</h3>
                <p class="text-gray-500 text-sm mb-4">Untuk pertanyaan detail dan penawaran</p>
                <p class="text-brand-red font-bold text-sm">{{ \App\Models\Setting::get('email', 'info@batikjambiberkah.com') }}</p>
                <span class="inline-block mt-4 text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">Dibalas dalam 1x24 jam</span>
            </a>

            {{-- Location --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 text-center">
                <div class="w-20 h-20 rounded-full bg-brand-gold/10 flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#DAA520" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-2">Workshop Kami</h3>
                <p class="text-gray-500 text-sm mb-4">Kunjungi langsung dan lihat prosesnya</p>
                <p class="text-gray-700 font-medium text-sm">{!! nl2br(e(\App\Models\Setting::get('address', 'Jl. Batik Lama No. 88\nJambi, Indonesia 36122'))) !!}</p>
                <span class="inline-block mt-4 text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">Buka Senin - Sabtu</span>
            </div>
        </div>

        {{-- WhatsApp CTA Big --}}
        <div class="bg-brand-red rounded-3xl p-12 text-center text-white overflow-hidden relative">
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-x-12 -translate-y-12"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-x-12 translate-y-12"></div>
            <div class="relative z-10">
                <p class="text-brand-gold font-medium uppercase tracking-widest text-sm mb-4">Cara Tercepat</p>
                <h2 class="text-3xl md:text-4xl font-serif mb-6">Pesan Langsung via WhatsApp</h2>
                <p class="text-white/80 max-w-xl mx-auto mb-8 text-lg">
                    Ceritakan kebutuhan Anda — batik tulis, batik cap, atau custom motif. Tim kami siap memberikan penawaran terbaik.
                </p>
                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp', '6281234567890') }}?text={{ urlencode('Halo ' . \App\Models\Setting::get('site_name', 'Batik Jambi Berkah') . '! Saya ingin tahu lebih lanjut tentang produk batik Anda.') }}" 
                   target="_blank"
                   class="inline-flex items-center gap-3 bg-[#25D366] text-white px-10 py-5 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Chat WhatsApp Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Social Media --}}
<section class="py-16 px-4 bg-batik-subtle">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-serif mb-4">Ikuti Kami</h2>
        <p class="text-gray-500 mb-10">Dapatkan inspirasi batik terbaru dan update koleksi kami di media sosial.</p>
        <div class="flex justify-center gap-6">
            @foreach([
                ['Instagram', \App\Models\Setting::get('instagram', 'https://instagram.com/batikjambiberkah'), '#E1306C', 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'],
                ['Facebook', \App\Models\Setting::get('facebook', 'https://facebook.com/batikjambiberkah'), '#1877F2', 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'],
                ['TikTok', \App\Models\Setting::get('tiktok', 'https://tiktok.com/@batikjambiberkah'), '#000000', 'M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z'],
            ] as $social)
            <a href="{{ $social[1] }}" target="_blank"
               class="w-14 h-14 rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-md"
               style="background-color: {{ $social[2] }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="{{ $social[3] }}"/>
                </svg>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
