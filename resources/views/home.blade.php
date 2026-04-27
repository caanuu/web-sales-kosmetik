@extends('layouts.app')
@section('title', 'Sahata Cosmetic')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-pink-100 via-primary-50 to-fuchsia-50 overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <div
                class="absolute top-10 left-10 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse">
            </div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"
                style="animation-delay: 2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative">
            <div class="max-w-2xl">
                <span
                    class="inline-block px-4 py-1.5 bg-white/70 backdrop-blur rounded-full text-xs font-semibold text-pink-600 mb-6 border border-pink-200">
                    ✨ Koleksi Terbaru 2025
                </span>
                <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                    Temukan
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600">Kecantikan</span>
                    Terbaik Untukmu
                </h1>
                <p class="mt-5 text-lg text-gray-600 leading-relaxed max-w-lg">
                    Koleksi lengkap skincare, makeup, dan parfum dari brand ternama dengan harga terbaik. Glow up mulai dari
                    sini!
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}"
                        class="btn-primary px-8 py-3.5 text-white font-semibold rounded-full text-sm inline-flex items-center gap-2 shadow-lg shadow-pink-500/30">
                        Belanja Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#categories"
                        class="px-8 py-3.5 border-2 border-pink-300 text-pink-600 font-semibold rounded-full text-sm hover:bg-pink-50 transition-colors bg-white/50 backdrop-blur">
                        Lihat Kategori
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="mt-10 flex flex-wrap items-center gap-6 text-sm text-gray-600 dark:text-gray-200 font-medium">
                    <div
                        class="flex items-center gap-2 bg-white/80 dark:bg-white/10 px-3 py-1.5 rounded-lg border border-pink-100 dark:border-white/10 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        100% Original
                    </div>
                    <div
                        class="flex items-center gap-2 bg-white/80 dark:bg-white/10 px-3 py-1.5 rounded-lg border border-pink-100 dark:border-white/10 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            <path
                                d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H14a1 1 0 001-1v-2l-2-5H4V4H3z" />
                        </svg>
                        Gratis Ongkir Min. Rp 50.000
                    </div>
                    <div
                        class="flex items-center gap-2 bg-white/80 dark:bg-white/10 px-3 py-1.5 rounded-lg border border-pink-100 dark:border-white/10 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Bisa COD (Bayar di Tempat)
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
                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-primary-100 to-accent-100 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-10 h-10 object-cover rounded-xl">
                            @else
                                <svg class="w-7 h-7 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-sm font-semibold text-gray-700 group-hover:text-primary-600 transition-colors">
                            {{ $category->name }}
                        </h3>
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
                    <a href="{{ route('products.index') }}"
                        class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
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
            <a href="{{ route('products.index', ['sort' => 'latest']) }}"
                class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
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
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-lg font-medium">Belum ada produk tersedia</p>
                <p class="text-sm mt-1">Nantikan koleksi terbaru kami segera!</p>
            </div>
        @endif
    </section>

    {{-- Dynamic Banners / CTA --}}
    @if(isset($banners) && $banners->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="space-y-8">
                @foreach($banners as $banner)
                    <div
                        class="bg-gradient-to-r from-primary-600 via-primary-500 to-accent-500 rounded-3xl overflow-hidden shadow-lg relative flex flex-col md:flex-row min-h-[300px]">
                        <div class="p-10 md:p-12 text-left text-white relative z-10 flex-1 flex flex-col justify-center">
                            @if($banner->subtitle)
                                <span
                                    class="inline-block mb-3 text-pink-200 font-bold uppercase tracking-wider text-sm">{{ $banner->subtitle }}</span>
                            @endif
                            <h2 class="text-3xl lg:text-4xl font-extrabold">{{ $banner->title }}</h2>
                            @if($banner->description)
                                <p class="mt-4 text-pink-50 max-w-lg leading-relaxed">{{ $banner->description }}</p>
                            @endif
                            @if($banner->button_text && $banner->button_link)
                                <div class="mt-8">
                                    <a href="{{ url($banner->button_link) }}"
                                        class="inline-block bg-white text-primary-600 font-bold px-8 py-3.5 rounded-full text-sm hover:bg-pink-50 transition-colors shadow-md hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                                        {{ $banner->button_text }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        @if($banner->image)
                            <div class="md:w-5/12 h-64 md:h-auto relative overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-l from-transparent via-accent-500/20 to-accent-500 z-10">
                                </div>
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover object-center absolute inset-0">
                            </div>
                        @else
                            <div class="absolute inset-0 opacity-10 pointer-events-none">
                                <div class="absolute -top-20 -left-20 w-60 h-60 bg-white rounded-full"></div>
                                <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white rounded-full"></div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @else
        {{-- Fallback Static CTA --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div
                class="bg-gradient-to-r from-primary-600 via-primary-500 to-accent-500 rounded-3xl p-10 lg:p-14 text-center text-white relative overflow-hidden shadow-lg">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute -top-20 -left-20 w-60 h-60 bg-white rounded-full"></div>
                    <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white rounded-full"></div>
                </div>
                <div class="relative z-10">
                    <h2 class="text-2xl lg:text-4xl font-bold">Siap untuk Glow Up?</h2>
                    <p class="mt-3 text-pink-100 max-w-lg mx-auto">Daftar sekarang dan dapatkan penawaran eksklusif untuk member
                        baru!</p>
                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-block mt-6 bg-white text-primary-600 font-bold px-8 py-3.5 rounded-full text-sm hover:bg-pink-50 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                            Gabung Sekarang — Gratis!
                        </a>
                    @endguest
                </div>
            </div>
        </section>
    @endif
@endsection