@extends('layouts.app')
@section('title', 'Detail Pesanan ' . $order->order_number . ' - GlowUp Beauty')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('orders.index') }}" class="hover:text-primary-500">Pesanan</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-800 font-medium">{{ $order->order_number }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Order Status --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-gray-800">Status Pesanan</h2>
                    @php
                        $colors = ['pending' => 'yellow', 'processing' => 'blue', 'shipped' => 'purple', 'completed' => 'green', 'cancelled' => 'red'];
                        $c = $colors[$order->status] ?? 'gray';
                    @endphp
                    <span class="text-sm font-semibold px-4 py-1.5 rounded-full bg-{{ $c }}-100 text-{{ $c }}-700">{{ $order->status_label }}</span>
                </div>

                {{-- Progress bar --}}
                @if($order->status !== 'cancelled')
                @php
                    $steps = ['pending', 'processing', 'shipped', 'completed'];
                    $currentStep = array_search($order->status, $steps);
                @endphp
                <div class="flex items-center gap-2 mt-4">
                    @foreach($steps as $index => $step)
                        <div class="flex-1">
                            <div class="h-2 rounded-full {{ $index <= $currentStep ? 'bg-primary-500' : 'bg-gray-200' }}"></div>
                            <p class="text-xs mt-1 {{ $index <= $currentStep ? 'text-primary-600 font-medium' : 'text-gray-400' }}">
                                {{ match($step) { 'pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai' } }}
                            </p>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-4">Produk Dipesan</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex gap-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($item->product?->primaryImage)
                                <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">{{ $item->product?->name ?? 'Produk dihapus' }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-sm font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-3">Info Pengiriman</h3>
                <div class="text-sm space-y-2 text-gray-600">
                    <p><strong>Penerima:</strong> {{ $order->recipient_name }}</p>
                    <p><strong>Telepon:</strong> {{ $order->recipient_phone }}</p>
                    <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
                    @if($order->notes)
                        <p><strong>Catatan:</strong> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-3">Pembayaran</h3>
                <div class="text-sm space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Metode</span>
                        <span class="font-medium">{{ $order->payment_method_label }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <hr class="border-gray-100">
                    <div class="flex justify-between font-bold text-gray-800">
                        <span>Total</span>
                        <span class="text-primary-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
