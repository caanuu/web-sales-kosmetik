@extends('layouts.admin')
@section('page-title', 'Manajemen Pesanan')
@section('page-subtitle', 'Kelola semua pesanan')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="flex items-center gap-2">
        <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-gray-200 text-sm bg-white">
            <option value="">Semua Status</option>
            @foreach(['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..." class="pl-9 pr-4 py-2 rounded-lg border border-gray-200 text-sm w-56">
            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">No. Pesanan</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Customer</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Total</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Pembayaran</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                    <th class="text-right py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 font-medium text-gray-800">{{ $order->order_number }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $order->user->name }}</td>
                    <td class="py-3 px-4 font-medium text-gray-800">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $order->payment_method_label }}</td>
                    <td class="py-3 px-4">
                        @php $c = ['pending'=>'yellow','processing'=>'blue','shipped'=>'purple','completed'=>'green','cancelled'=>'red'][$order->status] ?? 'gray'; @endphp
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-{{ $c }}-100 text-{{ $c }}-700">{{ $order->status_label }}</span>
                    </td>
                    <td class="py-3 px-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="py-3 px-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-primary-600 hover:text-primary-700 font-medium text-xs">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-10 text-gray-400">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $orders->links() }}</div>
@endsection
