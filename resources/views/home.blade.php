@extends('layouts.app')
@section('title', 'GlowUp Beauty - Toko Kosmetik Online Terlengkap')

@section('content')
{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-primary-50 via-accent-50 to-pink-50 overflow-hidden">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-10 left-10 w-72 h-72 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative">
        <div class="max-w-2xl">
            <span class="inline-block px-4 py-1.5 bg-white/70 backdrop-blur rounded-full text-xs font-semibold text-primary-600 mb-6 border border-primary-100">
                ✨ Koleksi Terbaru 2025
            </span>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                Temukan
                <span class="gradient-text">Kecantikan</span>
                Terbaik Untukmu
            </h1>
            <p class="mt-5 text-lg text-gray-600 leading-relaxed max-w-lg">
                Koleksi lengkap skincare, makeup, dan parfum dari brand ternama dengan harga terbaik. Glow up mulai dari sini!
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}" class="btn-primary px-8 py-3.5 text-white font-semibold rounded-full text-sm inline-flex items-center gap-2">
                    Belanja Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#categories" class="px-8 py-3.5 border-2 border-primary-200 text-primary-600 font-semibold rounded-full text-sm hover:bg-primary-50 transition-colors">
                    Lihat Kategori
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="mt-10 flex flex-wrap items-center gap-6 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    100% Original
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Gratis Ongkir
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    COD Tersedia
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Categories Section --}}
<section id="categories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-10">
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Belanja per Kategori</h2>
        <p class="text-gray-500 mt-2">Temukan produk sesuai kebutuhanmu</p>
    </div>

    @if($categories->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
           class="group bg-white rounded-2xl p-5 text-center border border-gray-100 hover:border-primary-200 hover:shadow-lg transition-all duration-300">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-primary-100 to-accent-100 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-10 h-10 object-cover rounded-xl">
                @else
                    <svg class="w-7 h-7 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                @endif
            </div>
            <h3 class="text-sm font-semibold text-gray-700 group-hover:text-primary-600 transition-colors">{{ $category->name }}</h3>
            <p class="text-xs text-gray-400 mt-0.5">{{ $category->products_count }} produk</p>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-10 text-gray-400">
        <p>Belum ada kategori tersedia.</p>
    </div>
    @endif
</section>

{{-- Featured Products --}}
@if($featuredProducts->count() > 0)
<section class="bg-gradient-to-b from-white to-primary-50/30 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">⭐ Produk Unggulan</h2>
                <p class="text-gray-500 mt-1">Pilihan terbaik untuk kamu</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest Products --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">🆕 Produk Terbaru</h2>
            <p class="text-gray-500 mt-1">Yang baru datang di toko kami</p>
        </div>
        <a href="{{ route('products.index', ['sort' => 'latest']) }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    @if($latestProducts->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
        @foreach($latestProducts as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
    @else
    <div class="text-center py-16 text-gray-400">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <p class="text-lg font-medium">Belum ada produk tersedia</p>
        <p class="text-sm mt-1">Nantikan koleksi terbaru kami segera!</p>
    </div>
    @endif
</section>

{{-- CTA Banner --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="bg-gradient-to-r from-primary-600 via-primary-500 to-accent-500 rounded-3xl p-10 lg:p-14 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-20 -left-20 w-60 h-60 bg-white rounded-full"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white rounded-full"></div>
        </div>
        <div class="relative">
            <h2 class="text-2xl lg:text-4xl font-bold">Siap untuk Glow Up?</h2>
            <p class="mt-3 text-pink-100 max-w-lg mx-auto">Daftar sekarang dan dapatkan penawaran eksklusif untuk member baru!</p>
            @guest
            <a href="{{ route('register') }}" class="inline-block mt-6 bg-white text-primary-600 font-bold px-8 py-3.5 rounded-full text-sm hover:bg-pink-50 transition-colors shadow-lg">
                Gabung Sekarang — Gratis!
            </a>
            @endguest
        </div>
    </div>
</section>
@endsection
