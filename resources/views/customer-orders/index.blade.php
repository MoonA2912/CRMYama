@php
    $orderLayout = auth()->user()->role === 'admin'
        ? 'app-layout'
        : 'customer-layout';
@endphp

<x-dynamic-component :component="$orderLayout">

    @if($orderLayout === 'app-layout')
        <x-slot name="header">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Pesanan Saya
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Lihat riwayat dan status pesanan Anda.
                </p>
            </div>
        </x-slot>
    @endif


    <div class="min-h-screen bg-[#F7F7F5] py-10">

        <div class="max-w-6xl mx-auto px-6 lg:px-8">


            {{-- HEADER --}}

            <div class="mb-8">

                <p class="text-xs font-semibold uppercase
                          tracking-[0.2em] text-[#06330A]">
                    Yama Golf Store
                </p>

                <h1 class="text-3xl font-bold text-gray-900 mt-2">
                    Pesanan Saya
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Lihat riwayat dan status pesanan Anda.
                </p>

            </div>


            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERROR MESSAGE --}}

            @if(session('error'))

                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl">
                    {{ session('error') }}
                </div>

            @endif


            {{-- ORDER LIST --}}

            @if($orders->count() > 0)

                <div class="space-y-5">

                    @foreach($orders as $order)

                        @php
                            $statusLabels = [
                                'pending' => 'Menunggu Pembayaran',
                                'paid' => 'Sudah Dibayar',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];

                            $statusClasses = [
                                'pending' => 'bg-yellow-50 text-yellow-700',
                                'paid' => 'bg-blue-50 text-blue-700',
                                'processing' => 'bg-indigo-50 text-indigo-700',
                                'shipped' => 'bg-purple-50 text-purple-700',
                                'completed' => 'bg-green-50 text-green-700',
                                'cancelled' => 'bg-red-50 text-red-700',
                            ];

                            $visibleItems = $order->items->take(3);
                            $remainingItems = max($order->items->count() - 3, 0);
                        @endphp


                        <a
                            href="{{ route('customer.orders.show', $order) }}"
                            class="block bg-white rounded-2xl
                                   border border-gray-200
                                   shadow-sm
                                   hover:shadow-md
                                   hover:-translate-y-0.5
                                   transition-all duration-200"
                        >

                            <div class="p-5 sm:p-6">


                                {{-- TOP --}}

                                <div class="flex flex-col sm:flex-row
                                            sm:items-center
                                            sm:justify-between
                                            gap-3">

                                    <div>

                                        <p class="text-xs text-gray-400">
                                            Nomor Pesanan
                                        </p>

                                        <h3 class="text-base font-semibold
                                                   text-gray-900 mt-1">
                                            {{ $order->order_number }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $order->order_date->format('d M Y, H:i') }}
                                        </p>

                                    </div>


                                    <span
                                        class="self-start sm:self-auto
                                               inline-flex
                                               px-3 py-1.5
                                               rounded-full
                                               text-xs font-medium
                                               {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-700' }}"
                                    >
                                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                    </span>

                                </div>


                                {{-- PRODUCTS PREVIEW --}}

                                <div class="border-t border-gray-100
                                            mt-5 pt-5">

                                    <div class="flex items-center
                                                justify-between mb-3">

                                        <p class="text-xs font-medium
                                                  text-gray-500">
                                            Produk
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            {{ $order->items->sum('quantity') }}
                                            produk
                                        </p>

                                    </div>


                                    <div class="flex items-center
                                                justify-between gap-4">


                                        {{-- PRODUCT IMAGES --}}

                                        <div class="flex items-center">

                                            @foreach($visibleItems as $index => $item)

                                                @if($item->product)

                                                    <div
                                                        class="w-16 h-16 sm:w-20 sm:h-20
                                                               rounded-xl
                                                               bg-[#F7F7F5]
                                                               border border-gray-200
                                                               overflow-hidden
                                                               {{ $index > 0 ? '-ml-3' : '' }}
                                                               relative"
                                                    >

                                                        @if($item->product->image)

                                                            <img
                                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                                alt="{{ $item->product->name }}"
                                                                class="w-full h-full
                                                                       object-cover"
                                                            >

                                                        @else

                                                            <div
                                                                class="w-full h-full
                                                                       flex items-center
                                                                       justify-center
                                                                       text-gray-300"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-7 h-7"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="currentColor"
                                                                    stroke-width="1.5"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M4 16l4.586-4.586a2 2 0 016.828 0L20 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L12 16m-8 4h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                    />
                                                                </svg>
                                                            </div>

                                                        @endif

                                                    </div>

                                                @endif

                                            @endforeach


                                            {{-- REMAINING PRODUCT COUNT --}}

                                            @if($remainingItems > 0)

                                                <div
                                                    class="w-16 h-16 sm:w-20 sm:h-20
                                                           rounded-xl
                                                           bg-gray-100
                                                           border border-gray-200
                                                           -ml-3
                                                           flex items-center
                                                           justify-center
                                                           relative
                                                           text-xs
                                                           font-semibold
                                                           text-gray-500"
                                                >
                                                    +{{ $remainingItems }}
                                                </div>

                                            @endif

                                        </div>


                                        {{-- TOTAL --}}

                                        <div class="text-right shrink-0">

                                            <p class="text-xs text-gray-400">
                                                Total
                                            </p>

                                            <p class="text-lg sm:text-xl
                                                      font-bold
                                                      text-[#06330A]
                                                      mt-1">
                                                Rp {{ number_format(
                                                    $order->total_amount,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- BOTTOM --}}

                                <div class="border-t border-gray-100
                                            mt-5 pt-4
                                            flex items-center
                                            justify-between">

                                    <p class="text-xs text-gray-400">
                                        Lihat detail pesanan
                                    </p>

                                    <span
                                        class="text-sm font-medium
                                               text-[#06330A]"
                                    >
                                        Detail
                                        <span class="ml-1">
                                            →
                                        </span>
                                    </span>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>


            @else

                {{-- EMPTY STATE --}}

                <div
                    class="bg-white rounded-2xl
                           border border-gray-200
                           shadow-sm
                           p-10 sm:p-14
                           text-center"
                >

                    <div
                        class="w-20 h-20 mx-auto
                               rounded-full
                               bg-[#F7F7F5]
                               flex items-center
                               justify-center
                               text-4xl"
                    >
                        📦
                    </div>


                    <h3 class="text-lg font-semibold
                               text-gray-900 mt-5">
                        Belum ada pesanan
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 max-w-sm mx-auto">
                        Pesanan yang Anda buat akan muncul di sini.
                    </p>


                    <a
                        href="{{ route('catalog') }}"
                        class="inline-flex items-center
                               mt-6 px-5 py-3
                               rounded-xl
                               bg-[#06330A]
                               hover:bg-[#052807]
                               text-white
                               text-sm font-medium
                               transition"
                    >
                        Mulai Belanja
                    </a>

                </div>

            @endif

        </div>

    </div>

</x-dynamic-component>