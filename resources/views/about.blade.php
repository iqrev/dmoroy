@extends('layouts.app')

@section('title', 'Cerita Kami - D\'Moroy')
@section('meta_description', 'Berdiri dari sebuah kecintaan mendalam terhadap barang-barang etnik dan unik, D\'Moroy lahir untuk mengangkat potensi besar alam Jambi.')

@section('content')
<!-- Hero About (Editorial) -->
<section aria-labelledby="about-heading" class="relative pt-32 pb-24 px-6 bg-brand-ivory overflow-hidden border-b border-brand-brown/10">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        <div class="relative z-10">
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-6 block" aria-hidden="true">@lang('home.our_story')</span>
            <h1 id="about-heading" class="text-5xl md:text-7xl font-serif text-brand-brown mb-8 leading-[1.1]">@lang('pages.about_title')</h1>
            <div class="w-20 h-1 bg-brand-gold mb-8" aria-hidden="true"></div>
            <p class="text-brand-brown/80 text-xl max-w-lg leading-relaxed font-serif italic">
                @lang('pages.about_desc1')
            </p>
        </div>
        <div class="relative z-10 hidden md:block" aria-hidden="true">
            <div class="aspect-[4/5] w-3/4 ml-auto rounded-t-full overflow-hidden shadow-2xl relative">
                @php $aboutHeroImg = \App\Models\Setting::getMediaUrl('about_hero_image', asset('images/anyaman.webp')); @endphp
                <img src="{{ $aboutHeroImg }}" alt="Proses D'Moroy" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-brand-brown/10 mix-blend-overlay"></div>
            </div>
            
            <!-- Floating Text Overlay -->
            <div class="absolute top-1/3 -left-12 bg-white p-6 rounded-2xl shadow-xl max-w-xs border border-brand-brown/5">
                <p class="text-brand-brown font-serif italic text-lg leading-snug">"Mengubah potensi lokal menjadi nilai yang memberdayakan."</p>
            </div>
        </div>
    </div>
</section>

<!-- Full Story Content -->
<section aria-label="Narasi Sejarah" class="py-24 px-6 bg-white relative">
    <div class="max-w-4xl mx-auto">
        <div class="prose prose-lg prose-brown mx-auto font-serif">
            <p class="text-2xl text-brand-brown leading-relaxed mb-8 font-medium">
                @lang('pages.story_p1')
            </p>
            <p class="text-brand-brown/80 leading-relaxed mb-6">
                @lang('pages.story_p2')
            </p>
            <p class="text-brand-brown/80 leading-relaxed mb-6">
                @lang('pages.story_p3')
            </p>
            
            <div class="my-16 pl-8 border-l-4 border-brand-gold py-2">
                <p class="text-2xl text-brand-brown italic leading-relaxed m-0">
                    @lang('pages.story_quote')
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section aria-label="Vision and Mission" class="py-12 px-6 bg-white relative">
    <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Vision -->
            <div class="bg-brand-ivory p-10 md:p-14 rounded-3xl border border-brand-brown/5 flex flex-col justify-center">
                <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-4 block" aria-hidden="true">@lang('pages.vision')</span>
                <h2 class="text-4xl font-serif text-brand-brown mb-6">@lang('pages.vision')</h2>
                <p class="text-brand-brown/80 leading-relaxed text-xl font-serif">
                    @lang('pages.vision_desc')
                </p>
            </div>
            
            <!-- Mission -->
            <div class="bg-brand-brown text-white p-10 md:p-14 rounded-3xl shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-5 bg-cover bg-center mix-blend-overlay" style="background-image: url('{{ asset('images/dmoroy/fiber_texture.png') }}');" aria-hidden="true"></div>
                <div class="relative z-10">
                    <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-4 block" aria-hidden="true">@lang('pages.mission')</span>
                    <h2 class="text-4xl font-serif text-brand-ivory mb-8">@lang('pages.mission')</h2>
                    <ul class="space-y-5 text-white/90">
                        <li class="flex items-start gap-4">
                            <span class="text-brand-gold mt-1.5 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </span>
                            <span class="leading-relaxed">@lang('pages.mission1')</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="text-brand-gold mt-1.5 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </span>
                            <span class="leading-relaxed">@lang('pages.mission2')</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="text-brand-gold mt-1.5 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </span>
                            <span class="leading-relaxed">@lang('pages.mission3')</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Editorial Grid -->
<section aria-labelledby="principles-heading" class="py-24 px-6 bg-brand-ivory border-y border-brand-brown/10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block" aria-hidden="true">@lang('pages.our_principles')</span>
            <h2 id="principles-heading" class="text-4xl font-serif mb-4 text-brand-brown">@lang('pages.principles_heading')</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-12" role="list">
            @foreach([
                [__('pages.principle1_title'), __('pages.principle1_desc')],
                [__('pages.principle2_title'), __('pages.principle2_desc')],
                [__('pages.principle3_title'), __('pages.principle3_desc')],
            ] as $i => $value)
            <article role="listitem" class="relative bg-white p-10 shadow-sm border border-brand-brown/5 rounded-3xl hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                <span class="absolute top-6 right-8 text-6xl font-serif font-bold text-brand-ivory/80 opacity-50" aria-hidden="true">{{ '0' . ($i + 1) }}</span>
                <div class="w-12 h-1 bg-brand-gold mb-8 mt-4 rounded-full" aria-hidden="true"></div>
                <h3 class="text-2xl font-serif font-bold mb-4 text-brand-brown">{{ $value[0] }}</h3>
                <p class="text-brand-brown/70 leading-relaxed">{{ $value[1] }}</p>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section aria-labelledby="cta-heading" class="py-24 px-6 bg-brand-brown text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-cover bg-center mix-blend-overlay" style="background-image: url('{{ asset('images/dmoroy/fiber_texture.png') }}');" aria-hidden="true"></div>
    <div class="max-w-2xl mx-auto relative z-10">
        <h2 id="cta-heading" class="text-4xl md:text-5xl font-serif mb-6 leading-tight text-brand-ivory">@lang('pages.cta_heading')</h2>
        <p class="text-white/80 text-lg mb-10 font-light">@lang('pages.cta_desc')</p>
        <a href="/contact" class="inline-block bg-brand-gold text-brand-brown px-10 py-4 rounded font-bold hover:bg-white hover:shadow-xl transition-all shadow-lg uppercase tracking-wider text-sm focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-white focus-visible:ring-offset-2">
            @lang('pages.contact_us')
        </a>
    </div>
</section>
@endsection
