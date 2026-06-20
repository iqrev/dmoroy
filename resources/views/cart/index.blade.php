@extends('layouts.app')

@section('title', 'Keranjang Belanja - ' . \App\Models\Setting::get('site_name', "D'Moroy"))

@section('content')
<section class="py-12 px-4 bg-brand-ivory min-h-screen">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-serif mb-8 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            @lang('pages.shopping_cart')
        </h1>

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 gap-6">
                @foreach($cart as $id => $item)
                    <div class="bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100 flex items-start md:items-center gap-4 md:gap-6 group">
                        <!-- Image -->
                        <div class="w-24 h-24 md:w-32 md:h-32 rounded-xl overflow-hidden flex-shrink-0 bg-gray-50 border border-gray-100">
                            <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('images/dmoroy/hero_knit.png') }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Content wrapper -->
                        <div class="flex-grow flex flex-col md:flex-row justify-between w-full">
                            
                            <!-- Info & Quantity -->
                            <div class="flex flex-col gap-2 md:gap-4 text-left flex-grow">
                                <div>
                                    <h3 class="font-bold text-base md:text-lg leading-tight md:mb-1 group-hover:text-brand-brown transition-colors">
                                        <a href="/products/{{ $item['slug'] }}">{{ $item['name'] }}</a>
                                    </h3>
                                    <p class="text-brand-brown font-bold text-sm md:text-base">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>

                                <!-- Quantity -->
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50 w-fit">
                                    <button type="button" onclick="updateQty({{ $id }}, 'down')" class="px-3 py-1 hover:bg-gray-200 transition-colors">-</button>
                                    <input type="number" value="{{ $item['quantity'] }}" min="1" class="w-10 text-center border-none bg-transparent focus:ring-0 outline-none focus:outline-none appearance-none font-bold pointer-events-none p-0 m-0" id="qty-{{ $id }}">
                                    <button type="button" onclick="updateQty({{ $id }}, 'up')" class="px-3 py-1 hover:bg-gray-200 transition-colors">+</button>
                                </div>
                            </div>

                            <!-- Subtotal & Remove -->
                            <div class="text-left md:text-right flex flex-row md:flex-col justify-between items-center md:items-end gap-2 mt-4 md:mt-0 w-full md:w-auto">
                                <p class="font-bold text-gray-900 text-sm md:text-base">Total: Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs uppercase tracking-widest font-bold transition-colors">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="mt-8 bg-white rounded-3xl p-8 shadow-md border border-brand-gold/10">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500 font-medium tracking-wide uppercase text-sm">@lang('pages.subtotal')</span>
                    <span class="text-3xl font-serif font-bold text-brand-brown">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                @php
                    $waMsg = __("pages.checkout_confirm") . "\n\n";
                    foreach($cart as $item) {
                        $waMsg .= "• " . $item['name'] . " (x" . $item['quantity'] . ") - Rp " . number_format($item['price'] * $item['quantity'], 0, ',', '.') . "\n";
                    }
                    $waMsg .= "\n*Total: Rp " . number_format($total, 0, ',', '.') . "*\n\nApakah stok tersedia?";
                    $waLink = "https://wa.me/" . str_replace(['-', ' ', '+'], '', \App\Models\Setting::get('whatsapp', '6281234567890')) . "?text=" . rawurlencode($waMsg);
                @endphp

                <a href="{{ $waLink }}" target="_blank" class="w-full bg-[#25D366] text-white py-5 rounded-full font-bold text-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-3 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    @lang('pages.checkout_wa')
                </a>
                <p class="text-center text-gray-400 text-xs mt-4">Pesanan Anda akan dikirimkan langsung ke admin kami melalui WhatsApp.</p>
            </div>
        @else
            <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <h2 class="text-2xl font-serif mb-2 text-brand-brown">@lang('pages.cart_empty')</h2>
                <p class="text-brand-brown/60 mb-8">@lang('pages.cart_desc')</p>
                <a href="/products" class="btn-primary inline-flex">@lang('pages.continue_shopping')</a>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    function updateQty(id, direction) {
        const input = document.getElementById('qty-' + id);
        let val = parseInt(input.value);
        
        if (direction === 'up') val++;
        if (direction === 'down' && val > 1) val--;
        
        input.value = val;

        // AJAX update to session
        fetch(`/cart/update/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: val })
        }).then(() => {
            window.location.reload();
        });
    }
</script>
@endpush
@endsection
