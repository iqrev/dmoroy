@extends('layouts.app')

@section('title', 'Tentang Kami - Batik Jambi Berkah Group')
@section('meta_description', 'Mengenal lebih dekat Batik Jambi Berkah Group, pengrajin batik Jambi autentik dengan pengalaman lebih dari 25 tahun melestarikan warisan budaya.')

@section('content')
{{-- Hero About --}}
<section class="relative py-24 px-4 bg-brand-red overflow-hidden">
    {{-- Decorative batik motif --}}
    <div class="absolute inset-0 opacity-5">
        <svg viewBox="0 0 200 200" class="w-full h-full" preserveAspectRatio="xMidYMid slice">
            <pattern id="batik-about" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M20 0 L40 20 L20 40 L0 20 Z" fill="none" stroke="white" stroke-width="1"/>
                <circle cx="20" cy="20" r="5" fill="white"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#batik-about)"/>
        </svg>
    </div>
    <div class="max-w-4xl mx-auto text-center relative z-10">
        <p class="text-brand-gold font-medium uppercase tracking-widest text-sm mb-4">Sejak 1998</p>
        <h1 class="text-5xl md:text-6xl font-serif text-white mb-6 leading-tight">Tentang Kami</h1>
        <p class="text-white/80 text-xl max-w-2xl mx-auto leading-relaxed">
            Kami adalah pelestari batik Jambi yang berkomitmen menghadirkan karya seni terbaik dari tangan para pengrajin lokal berbakat.
        </p>
    </div>
</section>

{{-- Our Story --}}
<section class="py-20 px-4">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        <div>
            <p class="text-brand-red font-medium uppercase tracking-widest text-sm mb-4">Kisah Kami</p>
            <h2 class="text-4xl font-serif mb-6 leading-tight">Warisan Budaya Dibalik Sehelai Kain</h2>
            <div class="space-y-4 text-gray-600 leading-relaxed">
                <p>Batik Jambi Berkah Group lahir dari kecintaan mendalam terhadap warisan budaya leluhur. Berdiri sejak 1998, kami memulai perjalanan dari sebuah ruang kecil di Jambi dengan hanya tiga pengrajin yang berdedikasi.</p>
                <p>Kini, lebih dari dua dekade berkarya, kami telah berkembang menjadi salah satu produsen batik Jambi terkemuka yang mempekerjakan puluhan pengrajin lokal. Setiap lembar kain yang kami hadirkan adalah bukti nyata warisan budaya yang terus hidup.</p>
                <p>Motif-motif seperti <em>Biji Timun</em>, <em>Durian Pecah</em>, <em>Angsa Berdiri</em>, dan <em>Kalung Berhias</em> menjadi identitas kuat Batik Jambi yang kami jaga keasliannya dengan sepenuh hati.</p>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl">
                <img src="{{ asset('images/hero.png') }}" alt="Proses pembuatan batik Jambi" class="w-full h-full object-cover">
            </div>
            <div class="absolute -bottom-8 -left-8 bg-brand-gold p-8 rounded-3xl text-white shadow-xl -rotate-3">
                <p class="text-4xl font-serif font-bold">25+</p>
                <p class="text-sm font-medium uppercase tracking-wider mt-1">Tahun Berkarya</p>
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="py-16 px-4 bg-batik-subtle">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
        @foreach([
            ['50+', 'Pengrajin Lokal', 'Tenaga kerja terampil yang kami berdayakan'],
            ['500+', 'Motif Koleksi', 'Ragam motif autentik khas Jambi'],
            ['10K+', 'Pelanggan Puas', 'Di seluruh Indonesia dan mancanegara'],
            ['1998', 'Tahun Berdiri', 'Dua dekade lebih melestarikan budaya'],
        ] as $stat)
        <div class="text-center">
            <p class="text-4xl font-serif text-brand-red font-bold mb-2">{{ $stat[0] }}</p>
            <p class="font-bold text-sm">{{ $stat[1] }}</p>
            <p class="text-gray-500 text-xs mt-1">{{ $stat[2] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Our Values --}}
<section class="py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif mb-4">Nilai-Nilai Kami</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Prinsip yang selalu kami pegang dalam setiap karya yang kami hadirkan.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['🎨', 'Autentisitas', 'Setiap motif kami bersumber dari khazanah budaya asli Jambi, dijaga kemurniannya dari generasi ke generasi.'],
                ['✋', 'Kualitas Handmade', 'Proses batik tulis kami dikerjakan secara manual oleh tangan-tangan terampil pengrajin berpengalaman.'],
                ['🌿', 'Keberlanjutan', 'Kami menggunakan pewarna alami dan bahan ramah lingkungan untuk menjaga ekosistem alam Jambi.'],
            ] as $value)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="text-5xl mb-6">{{ $value[0] }}</div>
                <h3 class="text-xl font-bold mb-4">{{ $value[1] }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ $value[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team Members --}}
@if($teamMembers->count() > 0)
<section class="py-20 px-4 bg-batik-subtle">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif mb-4">Tim Kami</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Orang-orang berdedikasi di balik setiap karya Batik Jambi Berkah.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($teamMembers as $member)
            <div class="text-center group">
                <div class="w-32 h-32 rounded-full mx-auto mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-brand-gold transition-colors">
                    <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=C02424&color=fff&size=200' }}" 
                         alt="{{ $member->name }}" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-lg">{{ $member->name }}</h3>
                <p class="text-brand-red text-sm font-medium">{{ $member->position }}</p>
                @if($member->bio)
                <p class="text-gray-500 text-xs mt-2 leading-relaxed">{{ $member->bio }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-20 px-4 bg-brand-red text-white text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-4xl font-serif mb-6">Ingin Bekerja Sama?</h2>
        <p class="text-white/80 text-lg mb-8">Kami terbuka untuk kolaborasi, pesanan custom, dan kemitraan distribusi. Hubungi kami sekarang.</p>
        <a href="/contact" class="inline-block bg-white text-brand-red px-10 py-4 rounded-full font-bold hover:bg-brand-cream transition-colors shadow-lg">
            Hubungi Kami
        </a>
    </div>
</section>
@endsection
