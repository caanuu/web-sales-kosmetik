@extends('layouts.app')
@section('title', 'Riwayat Pesanan - GlowUp Beauty')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📋 Riwayat Pesanan</h1>

    @if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
        <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <span class="text-sm font-bold text-gray-800">{{ $order->order_number }}</span>
                    <span class="text-xs text-gray-400 ml-2">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                @php
                    $colors = ['pending' => 'yellow', 'processing' => 'blue', 'shipped' => 'purple', 'completed' => 'green', 'cancelled' => 'red'];
                    $c = $colors[$order->status] ?? 'gray';
                @endphp
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-{{ $c }}-100 text-{{ $c }}-700">{{ $order->status_label }}</span>
            </div>

            <div class="flex items-center gap-3">
                @foreach($order->items->take(3) as $item)
                <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                    @if($item->product?->primaryImage)
                        <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                    @endif
                </div>
                @endforeach
                @if($order->items->count() > 3)
                <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center text-xs text-gray-500 font-medium flex-shrink-0">
                    +{{ $order->items->count() - 3 }}
                </div>
                @endif
                <div class="flex-1 text-right">
                    <p class="text-xs text-gray-500">Total</p>
                    <p class="text-sm font-bold text-primary-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
    @else
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        <h3 class="text-lg font-semibold text-gray-600">Belum ada pesanan</h3>
        <p class="text-gray-400 mt-1">Mulai belanja sekarang!</p>
        <a href="{{ route('products.index') }}" class="inline-block mt-4 btn-primary text-white font-semibold py-2.5 px-6 rounded-full text-sm">Belanja Sekarang</a>
    </div>
    @endif
</div>
@endsection
