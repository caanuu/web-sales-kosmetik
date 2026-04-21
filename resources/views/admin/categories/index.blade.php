@extends('layouts.admin')
@section('page-title', 'Manajemen Kategori')
@section('page-subtitle', 'Kelola kategori produk')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: <strong>{{ $categories->total() }}</strong> kategori</p>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded-xl flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Kategori</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Jumlah Produk</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="text-right py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-primary-100 flex-shrink-0 flex items-center justify-center">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $category->name }}</p>
                                <p class="text-xs text-gray-400">{{ $category->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600">{{ $category->products_count }} produk</td>
                    <td class="py-3 px-4">
                        @if($category->is_active)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Aktif</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500">Nonaktif</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 rounded-lg hover:bg-blue-50 text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-10 text-gray-400">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $categories->links() }}</div>
@endsection
