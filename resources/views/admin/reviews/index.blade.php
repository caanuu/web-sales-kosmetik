@extends('layouts.admin')
@section('page-title', 'Moderasi Review')
@section('page-subtitle', 'Approve atau hapus review')

@section('content')
<form action="{{ route('admin.reviews.index') }}" method="GET" class="mb-6">
    <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-gray-200 text-sm bg-white">
        <option value="">Semua Review</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
    </select>
</form>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">User</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Produk</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Rating</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Komentar</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="text-right py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-700">{{ $review->user->name }}</td>
                    <td class="py-3 px-4 text-gray-700 max-w-[150px] truncate">{{ $review->product->name }}</td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600 max-w-[200px]">
                        <p class="truncate">{{ $review->comment ?? '-' }}</p>
                    </td>
                    <td class="py-3 px-4">
                        @if($review->is_approved)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Approved</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-700">Pending</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            @if(!$review->is_approved)
                            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                @csrf @method('PUT')
                                <button type="submit" class="p-2 rounded-lg hover:bg-green-50 text-green-600" title="Approve">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.reviews.reject', $review) }}" method="POST">
                                @csrf @method('PUT')
                                <button type="submit" class="p-2 rounded-lg hover:bg-amber-50 text-amber-600" title="Reject">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-red-600" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada review.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $reviews->links() }}</div>
@endsection
