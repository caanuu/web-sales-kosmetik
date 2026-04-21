<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GlowUp Beauty - Toko kosmetik online terlengkap dengan produk skincare, makeup, dan parfum berkualitas.">
    <title>@yield('title', 'GlowUp Beauty - Toko Kosmetik Online')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Flash Messages --}}
    @if(session('success'))
    <div data-auto-dismiss="4000" class="fixed top-4 right-4 z-[100] animate-slide-down">
        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div data-auto-dismiss="5000" class="fixed top-4 right-4 z-[100] animate-slide-down">
        <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- Navbar --}}
    <nav class="glass sticky top-0 z-50 border-b border-pink-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <span class="text-xl font-bold gradient-text hidden sm:block">GlowUp Beauty</span>
                </a>

                {{-- Search Bar --}}
                <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 max-w-md mx-8">
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk, brand, kategori..."
                               class="w-full pl-10 pr-4 py-2.5 rounded-full border border-pink-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-sm bg-white/80 transition-all">
                        <svg class="absolute left-3.5 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </form>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Beranda</a>
                    <a href="{{ route('products.index') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Produk</a>

                    {{-- Theme Toggle --}}
                    <button onclick="toggleTheme()" class="theme-toggle mx-2" title="Ganti Tema" aria-label="Toggle dark mode">
                        <span class="theme-toggle-knob">
                            <svg class="theme-toggle-icon sun-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/></svg>
                            <svg class="theme-toggle-icon moon-icon" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                        </span>
                    </button>

                    @auth
                        <a href="{{ route('cart.index') }}" class="relative px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>Keranjang</span>
                            @php $cartCount = auth()->user()->carts()->count(); @endphp
                            @if($cartCount > 0)
                                <span id="cart-badge" class="absolute -top-1 -right-1 w-5 h-5 bg-primary-500 text-white text-xs rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('orders.index') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Pesanan</a>

                        <div class="relative ml-2" x-data="{ open: false }">
                            <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-primary-50 transition-all">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-accent-400 flex items-center justify-center text-white text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 animate-slide-down">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Profil Saya</a>
                                <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Wishlist Favorite</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Riwayat Pesanan</a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Admin Panel</a>
                                @endif
                                <hr class="my-1 border-gray-100">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-700 rounded-lg hover:bg-primary-50 transition-all">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary px-4 py-2 text-sm font-semibold text-white rounded-full">Daftar</a>
                    @endauth
                </div>

                {{-- Mobile menu button --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-primary-50">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-pink-100 bg-white px-4 pb-4">
            <form action="{{ route('products.index') }}" method="GET" class="mt-3 mb-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                       class="w-full pl-4 pr-4 py-2.5 rounded-full border border-pink-200 focus:border-primary-400 text-sm">
            </form>
            <a href="{{ route('home') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">Beranda</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">Produk</a>
            <button onclick="toggleTheme()" class="flex items-center gap-3 w-full px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">
                <svg class="w-4 h-4 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                <svg class="w-4 h-4 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/></svg>
                <span class="dark:hidden">Mode Gelap</span>
                <span class="hidden dark:inline">Mode Terang</span>
            </button>
            @auth
                <a href="{{ route('wishlist.index') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">Wishlist</a>
                <a href="{{ route('cart.index') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">Keranjang</a>
                <a href="{{ route('orders.index') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">Pesanan</a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700 hover:text-primary-600 rounded-lg">Profil</a>
                <form action="{{ route('logout') }}" method="POST" class="mt-1">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2.5 text-sm font-medium text-red-600 rounded-lg">Logout</button>
                </form>
            @else
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2.5 text-sm font-medium text-primary-600 border border-primary-200 rounded-full">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center btn-primary px-4 py-2.5 text-sm font-semibold text-white rounded-full">Daftar</a>
                </div>
            @endauth
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <span class="text-xl font-bold text-white">GlowUp Beauty</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">Toko kosmetik online terlengkap dengan produk skincare, makeup, dan parfum berkualitas dari brand ternama.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Kategori</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.index', ['category' => 'skincare']) }}" class="hover:text-primary-400 transition-colors">Skincare</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'makeup']) }}" class="hover:text-primary-400 transition-colors">Makeup</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'parfum']) }}" class="hover:text-primary-400 transition-colors">Parfum</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'bodycare']) }}" class="hover:text-primary-400 transition-colors">Bodycare</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            info@glowupbeauty.com
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            +62 812-3456-7890
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} GlowUp Beauty. All rights reserved.
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
