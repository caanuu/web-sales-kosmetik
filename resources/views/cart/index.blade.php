@extends('layouts.app')
@section('title', 'Keranjang Belanja - Sahata Cosmetic')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center gap-4 mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-primary-600 transition-colors bg-white px-4 py-2 rounded-full border border-gray-100 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">🛒 Keranjang Belanja</h1>
    </div>

    @if($carts->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($carts as $cart)
            <div class="bg-white rounded-2xl border border-gray-100 p-4 flex gap-4 shadow-sm">
                <a href="{{ route('products.show', $cart->product->slug) }}" class="w-24 h-24 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                    @if($cart->product->primaryImage)
                        <img src="{{ asset('storage/' . $cart->product->primaryImage->image_path) }}" alt="{{ $cart->product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </a>

                <div class="flex-1 min-w-0">
                    <a href="{{ route('products.show', $cart->product->slug) }}" class="text-sm font-semibold text-gray-800 hover:text-primary-600 line-clamp-1">{{ $cart->product->name }}</a>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $cart->product->brand }}</p>
                    <p class="text-sm font-bold text-primary-600 mt-1">Rp {{ number_format($cart->product->effective_price, 0, ',', '.') }}</p>

                    <div class="flex items-center justify-between mt-3">
                        <form action="{{ route('cart.update', $cart) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <button type="button" data-qty-minus class="px-2.5 py-1.5 hover:bg-gray-100 text-gray-500 text-xs">−</button>
                                <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->stock }}"
                                       class="w-10 text-center border-0 text-xs font-semibold focus:ring-0 py-1.5"
                                       onchange="this.form.submit()">
                                <button type="button" data-qty-plus class="px-2.5 py-1.5 hover:bg-gray-100 text-gray-500 text-xs">+</button>
                            </div>
                        </form>

                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-gray-800">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</span>
                            <form action="{{ route('cart.remove', $cart) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm sticky top-24">
                <h3 class="font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal ({{ $carts->count() }} item)</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkos Kirim</span>
                        <span class="text-gray-400 text-xs mt-0.5">Dihitung saat Checkout</span>
                    </div>
                    <hr class="border-gray-100">
                    <div class="flex justify-between font-bold text-gray-800 text-base">
                        <span>Total Sementara</span>
                        <span class="text-primary-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" class="block w-full btn-primary text-white font-semibold py-3 rounded-xl text-sm text-center mt-6">
                    Checkout Sekarang
                </a>

                <a href="{{ route('products.index') }}" class="block text-center text-sm text-gray-500 hover:text-primary-500 mt-3">
                    Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        <h3 class="text-lg font-semibold text-gray-600">Keranjang kosong</h3>
        <p class="text-gray-400 mt-1">Yuk mulai belanja produk favoritmu!</p>
        <a href="{{ route('products.index') }}" class="inline-block mt-4 btn-primary text-white font-semibold py-2.5 px-6 rounded-full text-sm">Belanja Sekarang</a>
    </div>
    @endif
</div>
@endsection
