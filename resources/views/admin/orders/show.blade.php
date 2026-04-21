@extends('layouts.admin')
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', $order->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        {{-- Status Update --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-4">Update Status</h3>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex items-center gap-3">
                @csrf @method('PUT')
                <select name="status" class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-sm">
                    @foreach(['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                        <option value="{{ $val }}" {{ $order->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary text-white text-sm font-semibold px-6 py-2.5 rounded-xl">Update</button>
            </form>
        </div>

        {{-- Items --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-4">Produk Dipesan</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        @if($item->product?->primaryImage)
                            <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ $item->product?->name ?? 'Produk dihapus' }}</p>
                        <p class="text-xs text-gray-500">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="text-sm font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-3">Info Customer</h3>
            <div class="text-sm space-y-2 text-gray-600">
                <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-3">Pengiriman</h3>
            <div class="text-sm space-y-2 text-gray-600">
                <p><strong>Penerima:</strong> {{ $order->recipient_name }}</p>
                <p><strong>Telepon:</strong> {{ $order->recipient_phone }}</p>
                <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
                @if($order->notes) <p><strong>Catatan:</strong> {{ $order->notes }}</p> @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-3">Pembayaran</h3>
            <div class="text-sm space-y-2">
                <div class="flex justify-between text-gray-600">
                    <span>Metode</span>
                    <span class="font-medium">{{ $order->payment_method_label }}</span>
                </div>
                <div class="flex justify-between text-gray-600"><span>Subtotal</span><span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
                <div class="flex justify-between text-gray-600"><span>Ongkir</span><span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span></div>
                <hr class="border-gray-100">
                <div class="flex justify-between font-bold text-gray-800"><span>Total</span><span class="text-primary-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
