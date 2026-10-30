<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Pelanggan
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen">

        {{-- =========================
            HERO
        ========================== --}}
        <div class="bg-white border-b border-gray-100">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-14">

                <div class="max-w-3xl">

                    <p class="text-sm font-semibold tracking-widest text-gray-500 uppercase">
                        Yama Golf Store
                    </p>

                    <h1 class="text-4xl md:text-5xl font-semibold text-gray-900 mt-3 leading-tight">
                        Lengkapi permainan golf kamu.
                    </h1>

                    <p class="text-gray-500 text-base md:text-lg mt-4 max-w-2xl">
                        Temukan berbagai perlengkapan golf dan layanan
                        yang sesuai dengan kebutuhanmu.
                    </p>

                    <div class="flex flex-wrap gap-3 mt-7">

                        <a href="{{ route('catalog') }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-md text-sm font-medium hover:bg-gray-700 transition">
                            Belanja Sekarang
                        </a>

                        <a href="{{ route('cart.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-100 transition">
                            Lihat Keranjang
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            QUICK MENU
        ========================== --}}
        <div class="bg-white border-b border-gray-200">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="flex flex-wrap items-center gap-x-8 gap-y-3 py-4">

                    <a href="{{ route('catalog') }}"
                       class="text-sm font-medium text-gray-900 hover:text-blue-600 transition">
                        Katalog
                    </a>

                    <a href="{{ route('customer.orders') }}"
                       class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Pesanan Saya
                    </a>

                    <a href="{{ route('customer.custom-fittings') }}"
                       class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Custom Fitting
                    </a>

                    <a href="{{ route('customer.feedback') }}"
                       class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Feedback
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Profil
                    </a>

                </div>

            </div>

        </div>


        {{-- =========================
            PRODUK PILIHAN
        ========================== --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">

            <div class="flex items-end justify-between mb-6">

                <div>

                    <h2 class="text-2xl font-semibold text-gray-900">
                        Produk Pilihan
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Jelajahi beberapa produk yang tersedia di Yama Golf Store.
                    </p>

                </div>

                <a href="{{ route('catalog') }}"
                   class="hidden sm:inline text-sm font-medium text-gray-700 hover:text-blue-600">
                    Lihat Semua →
                </a>

            </div>


            @if ($products->count())

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach ($products as $product)

                        <a href="{{ route('catalog.show', $product) }}"
                           class="group">

                            {{-- Product Image --}}
                            <div class="aspect-square bg-white rounded-xl overflow-hidden border border-gray-100">

                                @if ($product->image)

                                    <img src="{{ \App\Support\StoredMediaUrl::resolve($product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                                @else

                                    <div class="w-full h-full flex items-center justify-center text-gray-400">

                                        <div class="text-center">

                                            <div class="text-4xl mb-2">
                                                🏌🏻
                                            </div>

                                            <p class="text-xs">
                                                Tidak ada gambar
                                            </p>

                                        </div>

                                    </div>

                                @endif

                            </div>


                            {{-- Product Information --}}
                            <div class="mt-4">

                                <p class="text-xs text-gray-500 uppercase tracking-wide">
                                    {{ $product->category }}
                                </p>

                                <h3 class="font-medium text-gray-900 mt-1 group-hover:text-blue-600 transition">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-base font-semibold text-gray-900 mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                <div class="bg-white rounded-xl border border-gray-100 p-10 text-center">

                    <p class="text-gray-500">
                        Belum ada produk yang tersedia.
                    </p>

                    <a href="{{ route('catalog') }}"
                       class="inline-block mt-4 text-sm font-medium text-gray-800 hover:text-blue-600">
                        Lihat Katalog
                    </a>

                </div>

            @endif


            {{-- Mobile link --}}
            <div class="mt-6 sm:hidden">

                <a href="{{ route('catalog') }}"
                   class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Lihat Semua Produk →
                </a>

            </div>

        </div>


        {{-- =========================
            CUSTOM FITTING CTA
        ========================== --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-12">

            <div class="bg-gray-900 rounded-2xl overflow-hidden">

                <div class="px-8 py-10 md:px-12 md:py-12">

                    <p class="text-sm font-medium text-gray-400 uppercase tracking-widest">
                        Layanan Yama Golf Store
                    </p>

                    <h2 class="text-2xl md:text-3xl font-semibold text-white mt-2">
                        Butuh custom fitting?
                    </h2>

                    <p class="text-gray-300 mt-3 max-w-2xl">
                        Lihat riwayat custom fitting kamu dan dapatkan
                        layanan yang sesuai dengan kebutuhan permainan golf.
                    </p>

                    <a href="{{ route('customer.custom-fittings') }}"
                       class="inline-flex mt-6 px-5 py-2.5 bg-white text-gray-900 rounded-md text-sm font-medium hover:bg-gray-100 transition">
                        Lihat Custom Fitting
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>