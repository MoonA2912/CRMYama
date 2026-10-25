<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Dashboard
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola aktivitas CRM Yama Golf Store Palembang.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div
                class="relative overflow-hidden rounded-3xl
                       bg-[#06330A] shadow-sm mb-8"
            >

                <div class="absolute -right-16 -top-16
                            w-52 h-52 rounded-full
                            bg-white/5">
                </div>

                <div class="absolute right-20 -bottom-20
                            w-44 h-44 rounded-full
                            bg-white/5">
                </div>

                <div class="relative p-7 sm:p-9">

                    <p class="text-xs font-semibold uppercase
                              tracking-[0.2em] text-white/60">
                        Yama Golf Store Palembang
                    </p>

                    <h1 class="text-2xl sm:text-3xl font-bold
                               text-white mt-2">
                        Selamat datang, {{ Auth::user()->name }}! 👋
                    </h1>

                    <p class="text-sm text-white/70 mt-2 max-w-xl">
                        Pantau aktivitas pelanggan, pesanan, produk,
                        dan interaksi CRM Yama Golf Store melalui dashboard.
                    </p>

                </div>

            </div>


            {{-- Statistics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2
                        lg:grid-cols-5 gap-5 mb-8">


                {{-- Total Customers --}}
                <div
                    class="bg-white rounded-2xl border border-gray-100
                           shadow-sm p-6"
                >

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Pelanggan
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-3">
                                {{ $totalCustomers }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Data pelanggan
                            </p>
                        </div>

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-green-50
                                   flex items-center justify-center"
                        >
                            <svg
                                class="w-5 h-5 text-[#06330A]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 10-6 0"
                                />
                            </svg>
                        </div>

                    </div>

                </div>


                {{-- Total Products --}}
                <div
                    class="bg-white rounded-2xl border border-gray-100
                           shadow-sm p-6"
                >

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Produk
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-3">
                                {{ $totalProducts }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Produk tersedia
                            </p>
                        </div>

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-green-50
                                   flex items-center justify-center"
                        >
                            <svg
                                class="w-5 h-5 text-[#06330A]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                />
                            </svg>
                        </div>

                    </div>

                </div>


                {{-- Total Orders --}}
                <div
                    class="bg-white rounded-2xl border border-gray-100
                           shadow-sm p-6"
                >

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Pesanan
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-3">
                                {{ $totalOrders }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Pesanan pelanggan
                            </p>
                        </div>

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-green-50
                                   flex items-center justify-center"
                        >
                            <svg
                                class="w-5 h-5 text-[#06330A]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h13M10 21a1 1 0 11-2 0 1 1 0 012 0zm9 0a1 1 0 11-2 0 1 1 0 012 0z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>


                {{-- Feedback --}}
                <div
                    class="bg-white rounded-2xl border border-gray-100
                           shadow-sm p-6"
                >

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Feedback
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-3">
                                {{ $totalFeedback }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Feedback pelanggan
                            </p>
                        </div>

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-green-50
                                   flex items-center justify-center"
                        >
                            <svg
                                class="w-5 h-5 text-[#06330A]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 10h8M8 14h5m7-2a8 8 0 11-16 0c0 1.7.5 3.3 1.5 4.7L4 20l3.3-1.5A8 8 0 0020 12z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>
                {{-- Total Sales --}}
<div
    class="bg-white rounded-2xl border border-gray-100
           shadow-sm p-6"
>
    <div class="flex items-start justify-between">

        <div>
            <p class="text-sm font-medium text-gray-500">
                Total Penjualan
            </p>

            <p class="text-2xl font-bold text-gray-900 mt-3">
                Rp {{ number_format($totalSales, 0, ',', '.') }}
            </p>

            <p class="text-xs text-gray-400 mt-1">
                Pesanan selesai
            </p>
        </div>

        <div
            class="w-11 h-11 rounded-xl
                   bg-green-50
                   flex items-center justify-center"
        >
            <svg
                class="w-5 h-5 text-[#06330A]"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M12 8c-2.21 0-4 .9-4 2s1.79 2 4 2 4 .9 4 2-1.79 2-4 2m0-10V4m0 16v-2m8-6a8 8 0 11-16 0 8 8 0 0116 0z"
                />
            </svg>
        </div>

    </div>
</div>

            </div>


            {{-- Analytical CRM --}}
            <div
                class="bg-white rounded-2xl border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div
                    class="px-6 py-6 sm:px-8
                           border-b border-gray-100"
                >

                    <div class="flex flex-col sm:flex-row
                                sm:items-center sm:justify-between
                                gap-3">

                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-[0.18em] text-[#06330A]">
                                Analytical CRM
                            </p>

                            <h3 class="text-xl font-bold text-gray-900 mt-1">
                                Produk Terlaris
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Analisis produk berdasarkan jumlah penjualan.
                            </p>

                        </div>

                        <a
                            href="{{ route('reports.index') }}"
                            class="inline-flex items-center justify-center
                                   px-4 py-2 rounded-xl
                                   text-sm font-semibold
                                   text-[#06330A]
                                   bg-green-50
                                   hover:bg-green-100
                                   transition"
                        >
                            Lihat Laporan
                        </a>

                    </div>

                </div>


                <div class="p-6 sm:p-8">

                    @if($bestSellingProducts->count() > 0)

                        <div class="space-y-3">

                            @foreach($bestSellingProducts as $index => $item)

                                <div
                                    class="flex items-center justify-between
                                           gap-4 p-4 rounded-2xl
                                           bg-[#F7F7F5]
                                           border border-transparent
                                           hover:border-green-100
                                           transition"
                                >

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-10 h-10 rounded-xl
                                                   bg-[#06330A]
                                                   text-white
                                                   flex items-center
                                                   justify-center
                                                   text-sm font-bold
                                                   flex-shrink-0"
                                        >
                                            {{ $index + 1 }}
                                        </div>

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $item->product->name }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $item->product->category }}
                                            </p>

                                        </div>

                                    </div>


                                    <div class="text-right flex-shrink-0">

                                        <p class="text-lg font-bold text-[#06330A]">
                                            {{ $item->total_quantity }}
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            terjual
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="py-10 text-center">

                            <p class="text-sm text-gray-500">
                                Belum tersedia data penjualan produk.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>