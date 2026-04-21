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
            <div class="pt-6 mt-4 border-t border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <label class="block text-sm font-semibold text-gray-800">Spesifikasi Tambahan</label>
                    <button type="button" id="add-spec-btn" class="text-xs text-primary-600 bg-primary-50 px-3 py-1.5 rounded-lg font-medium hover:bg-primary-100 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Spesifikasi
                    </button>
                </div>
                
                <div class="space-y-3" id="specs-container">
                    @php
                        $specKeys = old('spec_keys', ['']);
                        $specValues = old('spec_values', ['']);
                    @endphp
                    @foreach($specKeys as $index => $keyVal)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start spec-row bg-gray-50 p-4 rounded-xl relative border border-gray-100">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Spesifikasi (Kolom)</label>
                                <input type="text" name="spec_keys[]" value="{{ $keyVal }}" placeholder="Contoh: Ukuran, Warna, Material"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm">
                            </div>
                            <div class="pr-8">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nilai / Isi Spesifikasi</label>
                                <input type="text" name="spec_values[]" value="{{ $specValues[$index] ?? '' }}" placeholder="Contoh: 50ml, Merah, Canvas"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm">
                            </div>
                            <button type="button" class="remove-spec-btn absolute top-4 right-4 p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors" title="Hapus spesifikasi ini">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                @error('keterangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const container = document.getElementById('specs-container');
                        const addBtn = document.getElementById('add-spec-btn');

                        addBtn.addEventListener('click', function() {
                            const newRow = document.createElement('div');
                            newRow.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 items-start spec-row bg-gray-50 p-4 rounded-xl relative border border-gray-100';
                            newRow.innerHTML = `
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Spesifikasi (Kolom)</label>
                                    <input type="text" name="spec_keys[]" placeholder="Contoh: Ukuran, Warna, Material" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm">
                                </div>
                                <div class="pr-8">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Nilai / Isi Spesifikasi</label>
                                    <input type="text" name="spec_values[]" placeholder="Contoh: 50ml, Merah, Canvas" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm">
                                </div>
                                <button type="button" class="remove-spec-btn absolute top-4 right-4 p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors" title="Hapus spesifikasi ini"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            `;
                            container.appendChild(newRow);
                        });

                        container.addEventListener('click', function(e) {
                            if(e.target.closest('.remove-spec-btn')) {
                                const rows = container.querySelectorAll('.spec-row');
                                if(rows.length > 0) {
                                    e.target.closest('.spec-row').remove();
                                }
                            }
                        });
                    });
                </script>
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
