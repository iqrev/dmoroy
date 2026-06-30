@extends('layouts.app')

@section('title', 'Hubungi Kami - d\'moroy')
@section('meta_description', 'Kunjungi bengkel kerja d\'moroy atau hubungi kami untuk menjalin kerja sama dan pemesanan anyaman serat alam.')

@section('content')
<!-- Hero Contact (Editorial) -->
<section aria-labelledby="contact-heading" class="relative pt-32 pb-24 px-6 bg-brand-brown overflow-hidden">
    <div class="absolute inset-0 bg-brand-ivory/5 mix-blend-overlay" style="background-image: url('{{ asset('images/dmoroy/texture.png') }}'); background-size: cover; opacity: 0.1;" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto text-center relative z-10">
        <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-6 block" aria-hidden="true">@lang('pages.contact_info')</span>
        <h1 id="contact-heading" class="text-5xl md:text-7xl font-serif text-brand-ivory mb-6 leading-tight">@lang('pages.contact_us')</h1>
        <p class="text-brand-ivory/70 text-lg max-w-2xl mx-auto font-serif">
            @lang('pages.contact_desc')
        </p>
    </div>
</section>

<!-- Contact Info & Form (Asymmetrical Layout) -->
<section aria-label="Informasi Kontak dan Formulir" class="py-24 px-6 bg-brand-ivory relative">
    <!-- Floating background accent -->
    <div class="absolute top-0 right-0 w-1/3 h-full bg-white hidden lg:block" aria-hidden="true"></div>
    
    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-16 relative z-10">
        
        <!-- Left: Contact Details -->
        <div class="lg:col-span-5 flex flex-col justify-center">
            <h2 class="text-4xl font-serif text-brand-brown mb-12">Saluran Resmi <br><span class="italic font-light">D'Moroy</span></h2>
            
            <address class="space-y-10 not-italic">
                <!-- Alamat -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 rounded-full bg-brand-brown/5 flex items-center justify-center shrink-0 border border-brand-brown/10 group-hover:bg-brand-gold group-hover:text-white transition-colors" aria-hidden="true">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-brand-brown mb-1">@lang('pages.visit_studio')</h3>
                        <p class="text-brand-brown/70 leading-relaxed font-serif">
                            @lang('pages.address')
                        </p>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 rounded-full bg-brand-brown/5 flex items-center justify-center shrink-0 border border-brand-brown/10 group-hover:bg-[#25D366] group-hover:text-white transition-colors" aria-hidden="true">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-brand-brown mb-1">WhatsApp / Telepon</h3>
                        <p class="text-brand-brown/70 leading-relaxed font-serif">
                            <a href="https://wa.me/6282187051969" target="_blank" class="hover:text-brand-gold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded">
                                0821-8705-1969
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 rounded-full bg-brand-brown/5 flex items-center justify-center shrink-0 border border-brand-brown/10 group-hover:bg-brand-brown group-hover:text-white transition-colors" aria-hidden="true">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-brand-brown mb-1">Email Resmi</h3>
                        <p class="text-brand-brown/70 leading-relaxed font-serif">
                            <a href="mailto:dmoroykreasialamnusantara@gmail.com" class="hover:text-brand-gold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded">
                                dmoroykreasialamnusantara@gmail.com
                            </a>
                        </p>
                    </div>
                </div>
            </address>
            
            <hr class="my-10 border-brand-brown/10">
            
            <div>
                <p class="font-bold text-brand-brown mb-4">Peta Lokasi Kami:</p>
                <div class="rounded-2xl overflow-hidden shadow-sm border border-brand-brown/10 w-full h-64 md:h-80">
                    <iframe 
                        src="https://www.google.com/maps?q=-1.6255872,103.6270735&z=17&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <hr class="my-10 border-brand-brown/10">
            
            <div>
                <p class="font-bold text-brand-brown mb-4">Ikuti Katalog Digital Kami:</p>
                <div class="flex gap-4">
                    <a href="{{ \App\Models\Setting::get('instagram', 'https://instagram.com/dmoroy') }}" target="_blank" aria-label="Kunjungi Instagram D'Moroy" class="w-12 h-12 rounded-full border border-brand-brown/20 flex items-center justify-center text-brand-brown hover:bg-brand-brown hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Glassmorphism Form -->
        <div class="lg:col-span-7">
            <div class="bg-white/80 backdrop-blur-xl p-10 md:p-14 rounded-[40px] shadow-2xl border border-white">
                <h3 class="text-3xl font-serif text-brand-brown mb-8">@lang('pages.send_message')</h3>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3" role="status" aria-live="polite">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <p>@lang('pages.success_msg')</p>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="text-xs font-bold text-brand-brown/70 uppercase tracking-widest mb-2 block">@lang('pages.name') <span class="text-red-500" aria-hidden="true">*</span></label>
                            <input type="text" name="name" id="name" required
                                   aria-required="true"
                                   @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                                   class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-brand-brown/20 focus:border-brand-gold focus:ring-0 transition-colors outline-none font-serif text-brand-brown placeholder-brand-brown/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded" placeholder="Tulis nama Anda" value="{{ old('name') }}">
                            @error('name')
                                <p id="name-error" class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="text-xs font-bold text-brand-brown/70 uppercase tracking-widest mb-2 block">@lang('pages.email') <span class="text-red-500" aria-hidden="true">*</span></label>
                            <input type="email" name="email" id="email" required
                                   aria-required="true"
                                   @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                                   class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-brand-brown/20 focus:border-brand-gold focus:ring-0 transition-colors outline-none font-serif text-brand-brown placeholder-brand-brown/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded" placeholder="nama@email.com" value="{{ old('email') }}">
                            @error('email')
                                <p id="email-error" class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="text-xs font-bold text-brand-brown/70 uppercase tracking-widest mb-2 block">@lang('pages.subject') <span class="text-red-500" aria-hidden="true">*</span></label>
                        <input type="text" name="subject" id="subject" required
                               aria-required="true"
                               @error('subject') aria-invalid="true" aria-describedby="subject-error" @enderror
                               class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-brand-brown/20 focus:border-brand-gold focus:ring-0 transition-colors outline-none font-serif text-brand-brown placeholder-brand-brown/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded" placeholder="Tentang apa pesan ini?" value="{{ old('subject') }}">
                        @error('subject')
                            <p id="subject-error" class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="message" class="text-xs font-bold text-brand-brown/70 uppercase tracking-widest mb-2 block">@lang('pages.message') <span class="text-red-500" aria-hidden="true">*</span></label>
                        <textarea name="message" id="message" rows="4" required
                                  aria-required="true"
                                  @error('message') aria-invalid="true" aria-describedby="message-error" @enderror
                                  class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-brand-brown/20 focus:border-brand-gold focus:ring-0 transition-colors outline-none font-serif text-brand-brown placeholder-brand-brown/30 resize-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold rounded" placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                        @error('message')
                            <p id="message-error" class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full py-5 bg-brand-brown text-brand-ivory font-bold uppercase tracking-widest text-sm rounded-2xl hover:bg-brand-gold hover:text-white transition-all shadow-xl shadow-brand-brown/20 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-gold focus-visible:ring-offset-2">
                            @lang('pages.send_btn')
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>

<!-- FAQ Section -->
<section aria-labelledby="faq-heading" class="py-24 px-6 bg-white border-t border-brand-brown/10">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16 fade-up" x-intersect="$el.classList.add('in-view')">
            <span class="text-brand-gold font-bold tracking-[0.2em] uppercase text-xs mb-3 block">Bantuan</span>
            <h2 id="faq-heading" class="text-4xl font-serif text-brand-brown">Pertanyaan Umum</h2>
        </div>

        <div class="space-y-4" x-data="{ activeAccordion: null }">
            @php
                $faqs = [
                    ['q' => 'Bagaimana cara memesan produk custom?', 'a' => 'Untuk pesanan custom (desain, ukuran, atau warna khusus), Anda bisa langsung menghubungi kami via WhatsApp. Tim pengrajin kami akan membantu mewujudkan keinginan Anda.'],
                    ['q' => 'Apakah melayani pengiriman ke luar negeri?', 'a' => 'Ya, kami melayani pengiriman internasional ke beberapa negara. Biaya kirim akan disesuaikan dengan negara tujuan dan berat dimensi paket.'],
                    ['q' => 'Berapa lama proses pembuatan produk pre-order?', 'a' => 'Waktu pengerjaan bervariasi tergantung kerumitan desain, biasanya memakan waktu antara 7 hingga 14 hari kerja.'],
                    ['q' => 'Bagaimana cara merawat tas anyaman agar awet?', 'a' => 'Simpan di tempat kering dan tidak lembab. Bersihkan dengan sikat halus atau lap kering jika terkena debu. Hindari paparan sinar matahari langsung terlalu lama untuk menjaga warna serat.'],
                ];
            @endphp
            @foreach($faqs as $index => $faq)
            <div class="border border-brand-brown/10 rounded-2xl overflow-hidden bg-brand-ivory/30 fade-up" x-intersect="$el.classList.add('in-view')" style="transition-delay: {{ $index * 100 }}ms">
                <button type="button" class="w-full px-6 py-5 flex items-center justify-between text-left focus-visible:outline-none focus-visible:bg-brand-ivory transition-colors" @click="activeAccordion === {{ $index }} ? activeAccordion = null : activeAccordion = {{ $index }}">
                    <span class="font-bold text-brand-brown text-lg pr-4">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-brand-brown transform transition-transform duration-300" :class="{ 'rotate-180': activeAccordion === {{ $index }} }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div class="px-6 overflow-hidden transition-all duration-300 max-h-0" :style="activeAccordion === {{ $index }} ? 'max-height: 500px;' : ''">
                    <p class="pb-6 text-brand-brown/70 leading-relaxed font-serif">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
