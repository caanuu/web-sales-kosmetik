@extends('layouts.admin')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm @error('name') border-red-300 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm resize-none">{{ old('description', $category->description) }}</textarea>
            </div>
            @if($category->image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $category->image) }}" class="w-20 h-20 object-cover rounded-xl border">
            </div>
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $category->image ? 'Ganti Gambar' : 'Gambar' }}</label>
                <input type="file" name="image" accept="image/*" data-preview="img-preview"
                    class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-primary-50 file:text-primary-600 file:font-medium file:cursor-pointer">
                <div id="img-preview" class="flex gap-2 mt-2"></div>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-primary-500">
                <span class="text-sm text-gray-700">Aktif</span>
            </label>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary text-white font-semibold py-2.5 px-8 rounded-xl text-sm">Update</button>
                <a href="{{ route('admin.categories.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-medium text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
