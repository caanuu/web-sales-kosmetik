@extends('layouts.admin')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Buat produk baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Nama & Kategori --}}
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

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm resize-none">{{ old('description') }}</textarea>
            </div>

            {{-- Spesifikasi --}}
            <div class="pt-5 border-t border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-semibold text-gray-800">Spesifikasi Tambahan</label>
                    <button type="button" id="add-spec-btn"
                        class="text-xs text-primary-600 bg-primary-50 px-3 py-1.5 rounded-lg font-medium hover:bg-primary-100 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Spesifikasi
                    </button>
                </div>
                <div class="space-y-3" id="specs-container">
                    @php
                        $specKeys   = old('spec_keys', ['']);
                        $specValues = old('spec_values', ['']);
                    @endphp
                    @foreach($specKeys as $index => $keyVal)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start spec-row bg-gray-50 p-4 rounded-xl relative border border-gray-100">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Spesifikasi</label>
                                <input type="text" name="spec_keys[]" value="{{ $keyVal }}" placeholder="Contoh: Ukuran, Warna, Material"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 text-sm">
                            </div>
                            <div class="pr-8">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nilai</label>
                                <input type="text" name="spec_values[]" value="{{ $specValues[$index] ?? '' }}" placeholder="Contoh: 50ml, Merah, Canvas"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 text-sm">
                            </div>
                            <button type="button" class="remove-spec-btn absolute top-4 right-4 p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Harga, Diskon, Stok --}}
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

            {{-- Brand & Berat --}}
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

            {{-- Checkbox --}}
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

            {{-- Upload Gambar --}}
            <div class="pt-4 border-t border-gray-100">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Gambar Produk <span class="text-red-500">*</span></label>
                <p class="text-xs text-gray-400 mb-3">Gambar pertama yang dipilih otomatis jadi gambar utama. Maks 2MB per gambar.</p>

                {{-- Drop Zone --}}
                <label id="drop-zone"
                    class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-primary-300 rounded-xl cursor-pointer bg-primary-50 hover:bg-primary-100 transition-colors group">
                    <svg class="w-10 h-10 text-primary-400 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-medium text-primary-600">Klik atau drag gambar ke sini</span>
                    <span class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — maks 2MB per file</span>
                    <input id="image-input" type="file" name="images[]" multiple accept="image/*" class="hidden" required>
                </label>

                @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                {{-- Preview Grid --}}
                <div id="image-preview" class="flex gap-3 mt-4 flex-wrap"></div>
                <p id="preview-hint" class="hidden text-xs text-gray-400 mt-2">💡 Gambar pertama (border biru) adalah gambar utama. Klik gambar lain untuk menjadikannya utama.</p>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary text-white font-semibold py-2.5 px-8 rounded-xl text-sm">Simpan Produk</button>
                <a href="{{ route('admin.products.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-medium text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Spesifikasi ────────────────────────────────────────────
    const specsContainer = document.getElementById('specs-container');
    document.getElementById('add-spec-btn').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 items-start spec-row bg-gray-50 p-4 rounded-xl relative border border-gray-100';
        row.innerHTML = `
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Spesifikasi</label>
                <input type="text" name="spec_keys[]" placeholder="Contoh: Ukuran, Warna, Material"
                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 text-sm">
            </div>
            <div class="pr-8">
                <label class="block text-xs font-medium text-gray-500 mb-1">Nilai</label>
                <input type="text" name="spec_values[]" placeholder="Contoh: 50ml, Merah, Canvas"
                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary-400 text-sm">
            </div>
            <button type="button" class="remove-spec-btn absolute top-4 right-4 p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>`;
        specsContainer.appendChild(row);
    });
    specsContainer.addEventListener('click', function (e) {
        if (e.target.closest('.remove-spec-btn')) {
            e.target.closest('.spec-row').remove();
        }
    });

    // ── Image Upload & Preview ─────────────────────────────────
    const input     = document.getElementById('image-input');
    const dropZone  = document.getElementById('drop-zone');
    const preview   = document.getElementById('image-preview');
    const hint      = document.getElementById('preview-hint');
    let   fileList  = [];       // our managed list
    let   primaryIdx = 0;       // index of primary image

    function buildDataTransfer() {
        const dt = new DataTransfer();
        fileList.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }

    function renderPreviews() {
        preview.innerHTML = '';
        if (fileList.length === 0) { hint.classList.add('hidden'); return; }
        hint.classList.remove('hidden');

        fileList.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrap = document.createElement('div');
                wrap.className = 'relative cursor-pointer group';
                wrap.innerHTML = `
                    <img src="${e.target.result}"
                        class="w-24 h-24 object-cover rounded-xl border-4 transition-all ${idx === primaryIdx ? 'border-primary-400 shadow-md' : 'border-gray-200 opacity-80 hover:opacity-100'}">
                    ${idx === primaryIdx
                        ? '<span class="absolute top-1 left-1 bg-primary-500 text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold">Utama</span>'
                        : '<span class="absolute inset-0 flex items-center justify-center bg-black/30 rounded-xl opacity-0 group-hover:opacity-100 text-white text-xs font-semibold transition-opacity">Set Utama</span>'
                    }
                    <button type="button" data-remove="${idx}" class="remove-img-btn absolute -top-1.5 -right-1.5 w-5 h-5 bg-red-500 text-white rounded-full text-xs flex items-center justify-center hover:bg-red-600 shadow">✕</button>`;

                wrap.addEventListener('click', function (ev) {
                    if (ev.target.closest('.remove-img-btn')) return;
                    primaryIdx = idx;
                    // Reorder so primary is first
                    const reordered = [...fileList];
                    const [primary] = reordered.splice(idx, 1);
                    reordered.unshift(primary);
                    fileList = reordered;
                    primaryIdx = 0;
                    buildDataTransfer();
                    renderPreviews();
                });

                wrap.querySelector('.remove-img-btn').addEventListener('click', function (ev) {
                    ev.stopPropagation();
                    const removeIdx = parseInt(this.dataset.remove);
                    fileList.splice(removeIdx, 1);
                    if (primaryIdx >= fileList.length) primaryIdx = 0;
                    buildDataTransfer();
                    renderPreviews();
                });

                preview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
    }

    input.addEventListener('change', function () {
        Array.from(this.files).forEach(f => fileList.push(f));
        primaryIdx = 0;
        buildDataTransfer();
        renderPreviews();
    });

    // Drag & drop
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('bg-primary-100'); });
    dropZone.addEventListener('dragleave', ()  => dropZone.classList.remove('bg-primary-100'));
    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('bg-primary-100');
        Array.from(e.dataTransfer.files).forEach(f => { if(f.type.startsWith('image/')) fileList.push(f); });
        primaryIdx = 0;
        buildDataTransfer();
        renderPreviews();
    });
});
</script>
@endsection
