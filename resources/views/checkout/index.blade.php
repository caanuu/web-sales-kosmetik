@extends('layouts.app')
@section('title', 'Checkout - GlowUp Beauty')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center gap-4 mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-primary-600 transition-colors bg-white px-4 py-2 rounded-full border border-gray-100 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">📦 Checkout</h1>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Shipping Details --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Alamat Pengiriman
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Penerima</label>
                            <input type="text" name="recipient_name" value="{{ old('recipient_name', $user->name) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('recipient_name') border-red-300 @enderror">
                            @error('recipient_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon</label>
                            <input type="text" name="recipient_phone" value="{{ old('recipient_phone', $user->phone) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('recipient_phone') border-red-300 @enderror">
                            @error('recipient_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Wilayah Pengiriman (Sumatera Utara)</label>
                            <select name="shipping_area_id" id="shipping_area" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('shipping_area_id') border-red-300 @enderror">
                                <option value="" data-cost="0">Pilih Kota / Kabupaten Tujuan</option>
                                @foreach($shippingAreas as $area)
                                    <option value="{{ $area->id }}" data-cost="{{ $area->cost }}" {{ old('shipping_area_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shipping_area_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Lengkap Lengkap (Jalan, RT/RW, Kecamatan)</label>
                        <textarea name="shipping_address" rows="3" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm resize-none @error('shipping_address') border-red-300 @enderror">{{ old('shipping_address', $user->address) }}</textarea>
                        @error('shipping_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan <span class="text-gray-400">(opsional)</span></label>
                        <textarea name="notes" rows="2" placeholder="Catatan untuk kurir atau penjual..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm resize-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Metode Pembayaran
                    </h3>
                    @error('payment_method') <p class="text-red-500 text-xs mb-2">{{ $message }}</p> @enderror

                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-colors has-[:checked]:border-primary-400 has-[:checked]:bg-primary-50 dark:has-[:checked]:bg-primary-900/30 border-gray-200 hover:border-gray-300">
                            <input type="radio" name="payment_method" value="cod" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }} class="text-primary-500 focus:ring-primary-400">
                            <div>
                                <span class="text-sm font-semibold text-gray-800">COD (Bayar di Tempat)</span>
                                <p class="text-xs text-gray-500">Bayar saat barang sampai</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-colors has-[:checked]:border-primary-400 has-[:checked]:bg-primary-50 dark:has-[:checked]:bg-primary-900/30 border-gray-200 hover:border-gray-300">
                            <input type="radio" name="payment_method" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }} class="text-primary-500 focus:ring-primary-400">
                            <div>
                                <span class="text-sm font-semibold text-gray-800">Transfer Bank</span>
                                <p class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-colors has-[:checked]:border-primary-400 has-[:checked]:bg-primary-50 dark:has-[:checked]:bg-primary-900/30 border-gray-200 hover:border-gray-300">
                            <input type="radio" name="payment_method" value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'checked' : '' }} class="text-primary-500 focus:ring-primary-400">
                            <div>
                                <span class="text-sm font-semibold text-gray-800">E-Wallet</span>
                                <p class="text-xs text-gray-500">GoPay, OVO, Dana, ShopeePay</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm sticky top-24">
                    <h3 class="font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>

                    <div class="space-y-3 mb-4">
                        @foreach($carts as $cart)
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                @if($cart->product->primaryImage)
                                    <img src="{{ asset('storage/' . $cart->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-800 line-clamp-1">{{ $cart->product->name }}</p>
                                <p class="text-xs text-gray-400">{{ $cart->quantity }}x Rp {{ number_format($cart->product->effective_price, 0, ',', '.') }}</p>
                            </div>
                            <span class="text-xs font-semibold text-gray-700">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <hr class="border-gray-100 my-4">

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span id="shipping_cost_display">Rp 0</span>
                        </div>
                        <hr class="border-gray-100">
                        <div class="flex justify-between font-bold text-gray-800 text-base">
                            <span>Total</span>
                            <span class="text-primary-600" id="total_display" data-subtotal="{{ $subtotal }}">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-primary text-white font-semibold py-3 rounded-xl text-sm mt-6 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const shippingSelect = document.getElementById('shipping_area');
        const costDisplay = document.getElementById('shipping_cost_display');
        const totalDisplay = document.getElementById('total_display');
        const subtotal = parseInt(totalDisplay.dataset.subtotal) || 0;

        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount).replace('Rp', 'Rp ');
        }

        function calculateShipping() {
            const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
            const cost = parseInt(selectedOption.getAttribute('data-cost')) || 0;
            
            costDisplay.textContent = cost > 0 ? formatRupiah(cost) : 'Rp 0';
            totalDisplay.textContent = formatRupiah(subtotal + cost);
        }

        shippingSelect.addEventListener('change', calculateShipping);
        
        // Calculate on load in case of old inputs
        if (shippingSelect.value) {
            calculateShipping();
        }
    });
</script>
@endsection
