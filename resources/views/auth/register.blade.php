@extends('layouts.app')
@section('title', 'Daftar - Sahata Cosmetic')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Bergabung dengan Sahata Cosmetic</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-pink-100 p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all @error('name') border-red-300 @enderror"
                            placeholder="Nama lengkap kamu">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all @error('email') border-red-300 @enderror"
                            placeholder="contoh@email.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon <span
                                class="text-gray-400">(opsional)</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all"
                            placeholder="08xx-xxxx-xxxx">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all @error('password') border-red-300 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all"
                            placeholder="Ulangi password">
                    </div>

                    <button type="submit" class="w-full btn-primary text-white font-semibold py-3 px-4 rounded-xl text-sm">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:text-primary-700">Masuk</a>
                </p>
            </div>
        </div>
    </div>
@endsection