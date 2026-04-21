@extends('layouts.app')
@section('title', 'Profil Saya - GlowUp Beauty')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">👤 Profil Saya</h1>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Avatar --}}
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-gradient-to-br from-primary-400 to-accent-400 flex items-center justify-center text-white text-2xl font-bold flex-shrink-0">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <input type="file" name="avatar" accept="image/*" data-preview="avatar-preview"
                        class="text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-primary-50 file:text-primary-600 file:font-medium file:cursor-pointer hover:file:bg-primary-100">
                    <p class="text-xs text-gray-400 mt-1">Maks. 2MB (JPG, PNG, WEBP)</p>
                    <div id="avatar-preview" class="flex gap-2 mt-2"></div>
                </div>
            </div>

            @error('avatar') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('name') border-red-300 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('email') border-red-300 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm"
                    placeholder="08xx-xxxx-xxxx">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                <textarea name="address" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm resize-none"
                    placeholder="Alamat lengkap">{{ old('address', $user->address) }}</textarea>
            </div>

            <hr class="border-gray-100">
            <p class="text-sm font-medium text-gray-700">Ganti Password <span class="text-gray-400">(kosongkan jika tidak ingin mengubah)</span></p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm @error('password') border-red-300 @enderror"
                        placeholder="Minimal 8 karakter">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm"
                        placeholder="Ulangi password">
                </div>
            </div>

            <button type="submit" class="btn-primary text-white font-semibold py-3 px-8 rounded-xl text-sm">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
