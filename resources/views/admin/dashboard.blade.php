@extends('layouts.admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan statistik toko')

@section('content')
{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ number_format($stats['total_products']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pengguna</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ number_format($stats['total_users']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ number_format($stats['total_orders']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Revenue (Selesai)</p>
                <p class="text-2xl font-extrabold text-gray-800 mt-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Pesanan Pending</p>
                <p class="text-3xl font-extrabold text-amber-600 mt-1">{{ number_format($stats['pending_orders']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Review Pending</p>
                <p class="text-3xl font-extrabold text-purple-600 mt-1">{{ number_format($stats['pending_reviews']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
        </div>
    </div>
</div>

{{-- Recent Orders --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-bold text-gray-800">Pesanan Terbaru</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua →</a>
    </div>

    @if($recentOrders->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left py-3 px-2 font-semibold text-gray-600">No. Pesanan</th>
                    <th class="text-left py-3 px-2 font-semibold text-gray-600">Customer</th>
                    <th class="text-left py-3 px-2 font-semibold text-gray-600">Total</th>
                    <th class="text-left py-3 px-2 font-semibold text-gray-600">Status</th>
                    <th class="text-left py-3 px-2 font-semibold text-gray-600">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b border-gray-50 hover:bg-gray-50">
                    <td class="py-3 px-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-primary-600 font-medium hover:underline">{{ $order->order_number }}</a>
                    </td>
                    <td class="py-3 px-2 text-gray-700">{{ $order->user->name }}</td>
                    <td class="py-3 px-2 font-medium text-gray-800">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="py-3 px-2">
                        @php $c = ['pending'=>'yellow','processing'=>'blue','shipped'=>'purple','completed'=>'green','cancelled'=>'red'][$order->status] ?? 'gray'; @endphp
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-{{ $c }}-100 text-{{ $c }}-700">{{ $order->status_label }}</span>
                    </td>
                    <td class="py-3 px-2 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-center text-gray-400 py-8">Belum ada pesanan.</p>
    @endif
</div>
@endsection
