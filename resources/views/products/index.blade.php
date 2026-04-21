@extends('layouts.app')
@section('title', 'Produk - GlowUp Beauty')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-primary-600 transition-colors bg-white px-4 py-2 rounded-full border border-gray-100 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary-500">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium">Produk</span>
        </nav>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar Filters --}}
        <aside class="w-full lg:w-64 flex-shrink-0">
            <form action="{{ route('products.index') }}" method="GET" id="filter-form">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            Kategori
                        </h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="text-primary-500 focus:ring-primary-400" onchange="this.form.submit()">
                                <span class="text-sm text-gray-600">Semua Kategori</span>
                            </label>
                            @foreach($categories as $cat)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'checked' : '' }} class="text-primary-500 focus:ring-primary-400" onchange="this.form.submit()">
                                <span class="text-sm text-gray-600">{{ $cat->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">Rentang Harga</h3>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-primary-400 focus:ring-1 focus:ring-primary-200">
                            <span class="text-gray-400 self-center">-</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-primary-400 focus:ring-1 focus:ring-primary-200">
                        </div>
                    </div>

                    @if($brands->count() > 0)
                    <hr class="border-gray-100">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">Brand</h3>
                        <select name="brand" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-primary-400" onchange="this.form.submit()">
                            <option value="">Semua Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <button type="submit" class="w-full btn-primary text-white text-sm font-semibold py-2.5 rounded-xl">
                        Terapkan Filter
                    </button>

                    @if(request()->hasAny(['category', 'min_price', 'max_price', 'brand', 'search']))
                        <a href="{{ route('products.index') }}" class="block text-center text-sm text-gray-500 hover:text-primary-500">Reset Filter</a>
                    @endif
                </div>
            </form>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            {{-- Sort & Result Count --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-3">
                <p class="text-sm text-gray-500">
                    Menampilkan <strong class="text-gray-800">{{ $products->total() }}</strong> produk
                    @if(request('search'))
                        untuk "<span class="text-primary-600">{{ request('search') }}</span>"
                    @endif
                </p>
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2">
                    @foreach(request()->except('sort', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <label class="text-sm text-gray-500">Urutkan:</label>
                    <select name="sort" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-primary-400 bg-white">
                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select>
                </form>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h3 class="text-lg font-semibold text-gray-600">Produk tidak ditemukan</h3>
                    <p class="text-gray-400 mt-1">Coba ubah kata kunci atau filter pencarian</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 text-sm text-primary-600 font-semibold hover:text-primary-700">Reset Pencarian</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
