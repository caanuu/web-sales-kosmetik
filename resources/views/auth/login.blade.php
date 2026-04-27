@extends('layouts.app')
@section('title', 'Masuk - Sahata Cosmetic')

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
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h1>
                <p class="text-gray-500 text-sm mt-1">Masuk ke akun Sahata Cosmetic kamu</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-pink-100 p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all @error('email') border-red-300 @enderror"
                            placeholder="contoh@email.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm transition-all @error('password') border-red-300 @enderror"
                            placeholder="Masukkan password">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-primary-500 focus:ring-primary-400">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full btn-primary text-white font-semibold py-3 px-4 rounded-xl text-sm">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary-600 font-semibold hover:text-primary-700">Daftar
                        Sekarang</a>
                </p>
            </div>
        </div>
    </div>
@endsection