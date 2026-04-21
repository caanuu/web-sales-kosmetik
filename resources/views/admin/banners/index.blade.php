@extends('layouts.admin')
@section('page-title', 'Manajemen Banner')
@section('page-subtitle', 'Kelola banner homepage')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: <strong>{{ $banners->total() }}</strong> banner</p>
    <a href="{{ route('admin.banners.create') }}" class="btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded-xl flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Banner
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Urutan</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Banner</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Button</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="text-right py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-600 font-medium">{{ $banner->order }}</td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-24 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                @if($banner->image)
                                    <img src="{{ asset('storage/' . $banner->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-200 to-accent-200 flex items-center justify-center text-primary-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $banner->title }}</p>
                                @if($banner->subtitle) <p class="text-xs text-gray-400">{{ $banner->subtitle }}</p> @endif
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600 text-xs">
                        <span class="bg-primary-50 text-primary-600 px-2 py-1 rounded-lg font-medium">{{ $banner->button_text }}</span>
                        <span class="block mt-1 text-gray-400">→ {{ $banner->button_link }}</span>
                    </td>
                    <td class="py-3 px-4">
                        @if($banner->is_active)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Aktif</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500">Nonaktif</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="p-2 rounded-lg hover:bg-blue-50 text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-10 text-gray-400">Belum ada banner.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $banners->links() }}</div>
@endsection
