@props(['product'])

@php
    $image = $product->primaryImage?->image_path
        ? asset('storage/' . $product->primaryImage->image_path)
        : 'https://ui-avatars.com/api/?name=' . urlencode($product->name) . '&size=300&background=fce7f3&color=ec4899';
    $avgRating = $product->average_rating;
    $reviewCount = $product->approvedReviews->count();
@endphp

<div class="product-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 group">
    {{-- Image --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block relative overflow-hidden aspect-square">
        <img src="{{ $image }}" alt="{{ $product->name }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

        @if($product->discount_percent > 0)
            <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                -{{ $product->discount_percent }}%
            </span>
        @endif

        @if($product->is_featured)
            <span class="absolute top-3 right-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                ★ Featured
            </span>
        @endif

        {{-- Wishlist button overlay --}}
        @auth
        <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="w-9 h-9 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-md transition-all hover:scale-110">
                <svg class="w-4 h-4 text-primary-500" fill="{{ auth()->user()->wishlists->contains('product_id', $product->id) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
        </form>
        @endauth
    </a>

    {{-- Info --}}
    <div class="p-4">
        <a href="{{ route('products.index', ['category' => $product->category?->slug]) }}" class="text-xs font-medium text-primary-500 hover:text-primary-600 uppercase tracking-wide">
            {{ $product->category?->name ?? 'Uncategorized' }}
        </a>

        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="mt-1 text-sm font-semibold text-gray-800 line-clamp-2 hover:text-primary-600 transition-colors leading-snug">
                {{ $product->name }}
            </h3>
        </a>

        @if($product->brand)
            <p class="text-xs text-gray-400 mt-0.5">{{ $product->brand }}</p>
        @endif

        {{-- Rating --}}
        <div class="flex items-center gap-1 mt-2">
            @for($i = 1; $i <= 5; $i++)
                <svg class="w-3.5 h-3.5 {{ $i <= round($avgRating) ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
            <span class="text-xs text-gray-400 ml-1">({{ $reviewCount }})</span>
        </div>

        {{-- Price --}}
        <div class="mt-3 flex items-center justify-between">
            <div>
                @if($product->discount_price)
                    <span class="text-xs text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="block text-base font-bold text-primary-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                @else
                    <span class="text-base font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                @endif
            </div>

            @auth
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="w-9 h-9 btn-primary rounded-full flex items-center justify-center text-white" title="Tambah ke Keranjang"
                    {{ $product->stock < 1 ? 'disabled' : '' }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </button>
            </form>
            @endauth
        </div>

        @if($product->stock < 1)
            <p class="text-xs text-red-500 font-medium mt-1">Stok Habis</p>
        @elseif($product->stock <= 5)
            <p class="text-xs text-amber-500 font-medium mt-1">Sisa {{ $product->stock }} item</p>
        @endif
    </div>
</div>
