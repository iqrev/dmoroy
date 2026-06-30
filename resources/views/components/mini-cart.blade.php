<!-- resources/views/components/mini-cart.blade.php -->
<div x-show="cartOpen" class="fixed inset-0 z-[100] overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" x-cloak>
    <div class="absolute inset-0 overflow-hidden">
        <!-- Background overlay -->
        <div x-show="cartOpen" 
             x-transition:enter="ease-in-out duration-500" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in-out duration-500" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
             @click="cartOpen = false" aria-hidden="true"></div>

        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <!-- Slide-over panel -->
            <div x-show="cartOpen" 
                 x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                 x-transition:enter-start="translate-x-full" 
                 x-transition:enter-end="translate-x-0" 
                 x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                 x-transition:leave-start="translate-x-0" 
                 x-transition:leave-end="translate-x-full" 
                 class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                    <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-xl font-serif text-gray-900" id="slide-over-title">Keranjang Belanja</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button" @click="cartOpen = false" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-gold">
                                    <span class="absolute -inset-0.5"></span>
                                    <span class="sr-only">Tutup panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="flow-root">
                                @php
                                    $cart = session('cart', []);
                                    $total = 0;
                                    foreach($cart as $item) {
                                        $total += $item['price'] * $item['quantity'];
                                    }
                                @endphp
                                @if(count($cart) > 0)
                                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                                        @foreach($cart as $id => $item)
                                            <li class="flex py-6">
                                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                    @php $productModel = \App\Models\Product::find($item['id']); $liveImg = !empty($productModel?->media_urls) ? $productModel->media_urls[0] : null; @endphp
                                                    <img src="{{ $liveImg ?: (!empty($item['image']) ? $item['image'] : asset('images/dmoroy/hero_woven.png')) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover object-center">
                                                </div>
                                                <div class="ml-4 flex flex-1 flex-col">
                                                    <div>
                                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                                            <h3><a href="/products/{{ $item['slug'] }}">{{ $item['name'] }}</a></h3>
                                                            <p class="ml-4">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-1 items-end justify-between text-sm">
                                                        <p class="text-gray-500">Qty {{ $item['quantity'] }}</p>
                                                        <div class="flex">
                                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="font-medium text-brand-brown hover:text-brand-brown-hover">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center py-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <p class="text-gray-500">Keranjang Anda kosong</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(count($cart) > 0)
                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900 mb-4">
                                <p>Subtotal</p>
                                <p>Rp {{ number_format($total, 0, ',', '.') }}</p>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('cart.index') }}" class="flex items-center justify-center rounded-md border border-transparent bg-brand-brown px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-brand-brown-hover">Lihat Keranjang & Checkout</a>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>
                                    atau
                                    <button type="button" class="font-medium text-brand-brown hover:text-brand-brown-hover" @click="cartOpen = false">
                                        Lanjut Belanja
                                        <span aria-hidden="true"> &rarr;</span>
                                    </button>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
