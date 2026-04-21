@extends('layouts.admin')
@section('page-title', 'Edit Produk')
@section('page-subtitle', $product->name)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('name') border-red-300 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
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
                        $specKeys = [];
                        $specValues = [];
                        
                        // Parse from old input (validation fail) or existing product data
                        if(old('spec_keys')) {
                            $specKeys = old('spec_keys');
                            $specValues = old('spec_values', []);
                        } else {
                            $keteranganStr = $product->keterangan ?? '';
                            if ($keteranganStr) {
                                foreach(explode('|', str_replace(["\r\n", "\n"], "|", $keteranganStr)) as $spec) {
                                    $parts = explode(':', $spec, 2);
                                    if(count($parts) === 2 && trim($parts[0]) !== '') {
                                        $specKeys[] = trim($parts[0]);
                                        $specValues[] = trim($parts[1]);
                                    } elseif (trim($spec) !== '') {
                                        $specKeys[] = 'Lainnya';
                                        $specValues[] = trim($spec);
                                    }
                                }
                            }
                        }
                        
                        // Default to empty array if still empty
                        if(empty($specKeys)) {
                            $specKeys = [''];
                            $specValues = [''];
                        }
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
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="100"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga Diskon</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" min="0" step="100"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Berat (gram)</label>
                    <input type="number" name="weight" value="{{ old('weight', $product->weight) }}" min="0" step="0.01"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 text-sm">
                </div>
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 rounded text-primary-500 focus:ring-primary-400">
                    <span class="text-sm text-gray-700">Produk Unggulan</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-primary-500 focus:ring-primary-400">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            {{-- Existing Images --}}
            @if($product->images->count() > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                <div class="flex gap-3 flex-wrap">
                    @foreach($product->images as $image)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-24 h-24 object-cover rounded-xl border-2 {{ $image->is_primary ? 'border-primary-400' : 'border-gray-200' }}">
                        @if($image->is_primary)
                            <span class="absolute top-1 left-1 bg-primary-500 text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold">Utama</span>
                        @endif
                        <div class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-1">
                            @if(!$image->is_primary)
                                <button type="submit" form="form-primary-{{ $image->id }}" class="p-1.5 bg-white rounded-lg text-blue-600 hover:bg-blue-50" title="Set Utama">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </button>
                            @endif
                                <button type="submit" form="form-delete-{{ $image->id }}" onclick="return confirm('Hapus gambar?')" class="p-1.5 bg-white rounded-lg text-red-600 hover:bg-red-50" title="Hapus">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tambah Gambar Baru</label>
                <input type="file" name="images[]" multiple accept="image/*" data-preview="image-preview"
                    class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-primary-50 file:text-primary-600 file:font-medium file:cursor-pointer hover:file:bg-primary-100">
                <div id="image-preview" class="flex gap-2 mt-3 flex-wrap"></div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary text-white font-semibold py-2.5 px-8 rounded-xl text-sm">Update Produk</button>
                <a href="{{ route('admin.products.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-medium text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- Helper forms for Image Actions (outside main form to prevent nesting) --}}
@if($product->images->count() > 0)
    @foreach($product->images as $image)
        @if(!$image->is_primary)
            <form id="form-primary-{{ $image->id }}" action="{{ route('admin.products.image.primary', $image) }}" method="POST" class="hidden">
                @csrf @method('PUT')
            </form>
        @endif
        <form id="form-delete-{{ $image->id }}" action="{{ route('admin.products.image.delete', $image) }}" method="POST" class="hidden">
            @csrf @method('DELETE')
        </form>
    @endforeach
@endif
@endsection
