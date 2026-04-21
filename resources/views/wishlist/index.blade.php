@extends('layouts.app')
@section('title', 'Wishlist - GlowUp Beauty')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center gap-4 mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-primary-600 transition-colors bg-white px-4 py-2 rounded-full border border-gray-100 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">❤️ Wishlist Saya</h1>
    </div>

    @if($wishlists->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
        @foreach($wishlists as $wishlist)
            <x-product-card :product="$wishlist->product" />
        @endforeach
    </div>

    <div class="mt-8">{{ $wishlists->links() }}</div>
    @else
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        <h3 class="text-lg font-semibold text-gray-600">Wishlist kosong</h3>
        <p class="text-gray-400 mt-1">Simpan produk favoritmu di sini!</p>
        <a href="{{ route('products.index') }}" class="inline-block mt-4 btn-primary text-white font-semibold py-2.5 px-6 rounded-full text-sm">Jelajahi Produk</a>
    </div>
    @endif
</div>
@endsection
