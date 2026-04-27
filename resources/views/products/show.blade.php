@extends('layouts.app')
@section('title', $product->name . ' - Sahata Cosmetic')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header Action & Breadcrumb --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary-600 transition-colors bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm hover:shadow-md w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>

            <nav class="flex items-center gap-2 text-sm text-gray-500 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-primary-500">Home</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('products.index') }}" class="hover:text-primary-500">Produk</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-800 font-medium truncate max-w-[150px] md:max-w-[200px]">{{ $product->name }}</span>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            {{-- Image Gallery --}}
            <div>
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
                    @if($product->images->count() > 0)
                        <div id="main-image-container" class="aspect-square">
                            <img id="main-image" src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="aspect-square bg-gradient-to-br from-primary-100 to-accent-100 flex items-center justify-center">
                            <svg class="w-20 h-20 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if($product->images->count() > 1)
                    <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                        @foreach($product->images as $image)
                            <button type="button" data-image-url="{{ asset('storage/' . $image->image_path) }}"
                                onclick="document.getElementById('main-image').src = this.dataset.imageUrl"
                                class="w-20 h-20 flex-shrink-0 rounded-xl border-2 border-gray-200 hover:border-primary-400 overflow-hidden transition-colors focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div>
                <div class="mb-2">
                    <a href="{{ route('products.index', ['category' => $product->category?->slug]) }}"
                        class="text-xs font-semibold text-primary-500 uppercase tracking-wider hover:text-primary-600">
                        {{ $product->category?->name }}
                    </a>
                </div>

                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                @if($product->brand)
                    <p class="text-gray-500 mt-1">Brand: <span class="font-medium text-gray-700">{{ $product->brand }}</span>
                    </p>
                @endif

                {{-- Rating --}}
                <div class="flex items-center gap-3 mt-3">
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= round($product->average_rating) ? 'text-amber-400' : 'text-gray-200' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500">{{ $product->average_rating }}
                        ({{ $product->approvedReviews->count() }} review)</span>
                </div>

                {{-- Price --}}
                <div class="mt-5 p-4 bg-primary-50/60 rounded-xl">
                    @if($product->discount_price)
                        <div class="flex items-center gap-3">
                            <span class="text-3xl font-extrabold text-primary-600">Rp
                                {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                            <span class="text-lg text-gray-400 line-through">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span
                                class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">-{{ $product->discount_percent }}%</span>
                        </div>
                    @else
                        <span class="text-3xl font-extrabold text-gray-800">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                {{-- Stock --}}
                <div class="mt-4 flex items-center gap-2">
                    @if($product->stock > 0)
                        <span class="w-2.5 h-2.5 bg-green-400 rounded-full"></span>
                        <span class="text-sm text-green-600 font-medium">Stok tersedia ({{ $product->stock }})</span>
                    @else
                        <span class="w-2.5 h-2.5 bg-red-400 rounded-full"></span>
                        <span class="text-sm text-red-600 font-medium">Stok habis</span>
                    @endif
                </div>

                {{-- Add to Cart --}}
                @auth
                    <div class="mt-6 space-y-3">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                                <button type="button" data-qty-minus
                                    class="px-3 py-3 hover:bg-gray-100 text-gray-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="w-14 text-center border-0 text-sm font-semibold focus:ring-0">
                                <button type="button" data-qty-plus
                                    class="px-3 py-3 hover:bg-gray-100 text-gray-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v12m6-6H6" />
                                    </svg>
                                </button>
                            </div>
                            <button type="submit"
                                class="flex-1 btn-primary text-white font-semibold py-3 px-6 rounded-xl text-sm flex items-center justify-center gap-2"
                                {{ $product->stock < 1 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>

                        <form action="{{ route('wishlist.toggle') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="w-full py-3 px-6 rounded-xl text-sm font-semibold border-2 border-primary-200 text-primary-600 hover:bg-primary-50 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                {{ $inWishlist ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-6">
                        <a href="{{ route('login') }}"
                            class="block w-full btn-primary text-white font-semibold py-3 px-6 rounded-xl text-sm text-center">
                            Login untuk Membeli
                        </a>
                    </div>
                @endauth

                {{-- Description --}}
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="font-semibold text-gray-800 mb-3">Deskripsi Produk</h3>
                    <div class="text-sm text-gray-600 leading-relaxed prose prose-sm max-w-none">
                        {!! nl2br(e($product->description ?? 'Tidak ada deskripsi.')) !!}
                    </div>
                </div>

                @if($product->keterangan)
                    <div class="mt-4 p-4 bg-primary-50 rounded-xl border border-primary-100">
                        <h3 class="font-semibold text-primary-700 mb-3 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Spesifikasi Produk
                        </h3>
                        <div class="flex flex-col gap-2.5 text-sm text-primary-800">
                            @foreach(explode('|', $product->keterangan) as $spec)
                                @php $parts = explode(':', $spec, 2); @endphp
                                @if(count($parts) === 2 && trim($parts[0]) !== '')
                                    <div class="flex items-start gap-4">
                                        <span class="font-medium text-primary-600 w-1/3 shrink-0">{{ trim($parts[0]) }}</span>
                                        <span class="flex-1 leading-relaxed">{{ trim($parts[1]) }}</span>
                                    </div>
                                @elseif(trim($spec) !== '')
                                    <div class="flex items-start gap-2">
                                        <span class="text-primary-400 mt-0.5">•</span>
                                        <span class="flex-1 leading-relaxed">{{ trim($spec) }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($product->weight)
                    <div class="mt-4 text-sm text-gray-500">
                        Berat: {{ $product->weight }} gram
                    </div>
                @endif
            </div>
        </div>

        {{-- Reviews Section --}}
        <section class="mt-16">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Review & Rating</h2>

            {{-- Review Form --}}
            @auth
                @if(!$userReview)
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-8 shadow-sm">
                        <h3 class="font-semibold text-gray-800 mb-4">Tulis Review</h3>
                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <div class="star-rating flex items-center gap-1">
                                    <input type="hidden" name="rating" value="5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg data-value="{{ $i }}"
                                            class="star w-8 h-8 cursor-pointer {{ $i <= 5 ? 'active text-amber-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1.5">Komentar</label>
                                <textarea id="comment" name="comment" rows="3"
                                    placeholder="Bagikan pengalaman kamu dengan produk ini..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm resize-none"></textarea>
                            </div>

                            <button type="submit" class="btn-primary text-white font-semibold py-2.5 px-6 rounded-xl text-sm">
                                Kirim Review
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-8 text-sm text-green-700">
                        Kamu sudah memberikan review untuk produk ini.
                    </div>
                @endif
            @endauth

            {{-- Review List --}}
            @if($product->approvedReviews->count() > 0)
                <div class="space-y-4">
                    @foreach($product->approvedReviews as $review)
                        <div class="bg-white rounded-xl border border-gray-100 p-5">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-400 to-accent-400 flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $review->user->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            @if($review->comment)
                                <p class="text-sm text-gray-600 leading-relaxed mt-2">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 text-gray-400">
                    <p>Belum ada review untuk produk ini.</p>
                </div>
            @endif
        </section>

        {{-- Related Products --}}
        @if($relatedProducts->count() > 0)
            <section class="mt-16">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Produk Serupa</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    @foreach($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection