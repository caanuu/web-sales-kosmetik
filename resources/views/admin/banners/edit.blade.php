@extends('layouts.admin')
@section('page-title', 'Edit Banner')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Banner <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm resize-none">{{ old('description', $banner->description) }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Teks Tombol <span class="text-red-500">*</span></label>
                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Tombol <span class="text-red-500">*</span></label>
                    <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
            </div>
            @if($banner->image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $banner->image) }}" class="w-full max-w-md h-32 object-cover rounded-xl border">
            </div>
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $banner->image ? 'Ganti Gambar' : 'Gambar Banner' }}</label>
                <input type="file" name="image" accept="image/*" data-preview="banner-preview"
                    class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-primary-50 file:text-primary-600 file:font-medium file:cursor-pointer">
                <div id="banner-preview" class="flex gap-2 mt-2"></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', $banner->order) }}" min="0"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-primary-500">
                        <span class="text-sm text-gray-700">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary text-white font-semibold py-2.5 px-8 rounded-xl text-sm">Update Banner</button>
                <a href="{{ route('admin.banners.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-medium text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
