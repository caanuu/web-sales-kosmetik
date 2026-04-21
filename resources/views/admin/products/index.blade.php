@extends('layouts.admin')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola semua produk toko')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: <strong>{{ $products->total() }}</strong> produk</p>
    <a href="{{ route('admin.products.create') }}" class="btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded-xl flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Produk
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Produk</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Kategori</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Harga</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Stok</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="text-right py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                @if($product->primaryImage)
                                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 line-clamp-1">{{ $product->name }}</p>
                                @if($product->brand) <p class="text-xs text-gray-400">{{ $product->brand }}</p> @endif
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600">{{ $product->category?->name }}</td>
                    <td class="py-3 px-4">
                        @if($product->discount_price)
                            <span class="text-xs text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span><br>
                            <span class="font-medium text-primary-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                        @else
                            <span class="font-medium text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <span class="font-medium {{ $product->stock < 5 ? 'text-red-600' : 'text-gray-800' }}">{{ $product->stock }}</span>
                    </td>
                    <td class="py-3 px-4">
                        @if($product->is_active)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Aktif</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500">Nonaktif</span>
                        @endif
                        @if($product->is_featured)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 ml-1">Featured</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="p-2 rounded-lg hover:bg-blue-50 text-blue-600" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-red-600" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $products->links() }}</div>
@endsection
