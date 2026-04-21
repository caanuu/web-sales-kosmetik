@extends('layouts.admin')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Buat produk baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('name') border-red-300 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm @error('category_id') border-red-300 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm resize-none">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0" step="100"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm @error('price') border-red-300 @enderror">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga Diskon (Rp)</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price') }}" min="0" step="100"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm @error('stock') border-red-300 @enderror">
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Berat (gram)</label>
                    <input type="number" name="weight" value="{{ old('weight') }}" min="0" step="0.01"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 rounded text-primary-500 focus:ring-primary-400">
                    <span class="text-sm text-gray-700">Produk Unggulan</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded text-primary-500 focus:ring-primary-400">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Produk <span class="text-red-500">*</span></label>
                <input type="file" name="images[]" multiple accept="image/*" data-preview="image-preview" required
                    class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-primary-50 file:text-primary-600 file:font-medium file:cursor-pointer hover:file:bg-primary-100 @error('images') border-red-300 @enderror @error('images.*') border-red-300 @enderror">
                <p class="text-xs text-gray-400 mt-1">Gambar pertama akan menjadi gambar utama. Maks 2MB per gambar.</p>
                @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <div id="image-preview" class="flex gap-2 mt-3 flex-wrap"></div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary text-white font-semibold py-2.5 px-8 rounded-xl text-sm">Simpan Produk</button>
                <a href="{{ route('admin.products.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-medium text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
