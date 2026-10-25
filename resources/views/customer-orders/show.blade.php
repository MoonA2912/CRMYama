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
                    Detail Pesanan
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap pesanan Anda.
                </p>
            </div>

        </x-slot>
    @endif


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-6xl mx-auto px-6">


            {{-- FLASH MESSAGE --}}
            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl">
                    {{ session('error') }}
                </div>

            @endif


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                {{-- DETAIL PESANAN --}}
                <div class="lg:col-span-2 space-y-6">


                    {{-- HEADER ORDER --}}
                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6">

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center sm:justify-between gap-4">

                            <div>

                                <p class="text-xs text-gray-400">
                                    Nomor Pesanan
                                </p>

                                <h3 class="text-lg font-bold text-gray-900 mt-1">
                                    {{ $order->order_number }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $order->order_date->format('d M Y, H:i') }}
                                </p>

                            </div>


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

                            @endphp


                            <span
                                class="inline-flex px-3 py-1.5 rounded-full
                                       text-xs font-medium
                                       {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-700' }}"
                            >
                                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                            </span>

                        </div>

                    </div>


                    {{-- STATUS PESANAN --}}
                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Status Pesanan
                        </h3>


                        @if($order->status === 'cancelled')

                            <div class="mt-5 p-4 bg-red-50 border border-red-100 rounded-xl">

                                <p class="text-sm font-medium text-red-700">
                                    Pesanan Dibatalkan
                                </p>

                                <p class="text-xs text-red-500 mt-1">
                                    Pesanan ini telah dibatalkan dan tidak dapat diproses lebih lanjut.
                                </p>

                            </div>

                        @else

                            @php

                                $steps = [
                                    'pending' => [
                                        'title' => 'Menunggu Pembayaran',
                                        'description' => 'Bukti pembayaran telah dikirim dan sedang menunggu konfirmasi dari toko.'
                                    ],

                                    'paid' => [
                                        'title' => 'Pembayaran Dikonfirmasi',
                                        'description' => 'Pembayaran telah dikonfirmasi oleh toko.'
                                    ],

                                    'processing' => [
                                        'title' => 'Sedang Diproses',
                                        'description' => 'Pesanan sedang dipersiapkan oleh toko.'
                                    ],

                                    'shipped' => [
                                        'title' => 'Sedang Dikirim',
                                        'description' => 'Pesanan telah dikirim kepada Anda.'
                                    ],

                                    'completed' => [
                                        'title' => 'Selesai',
                                        'description' => 'Pesanan telah selesai.'
                                    ],
                                ];

                                $statusOrder = [
                                    'pending',
                                    'paid',
                                    'processing',
                                    'shipped',
                                    'completed'
                                ];

                                $currentIndex = array_search(
                                    $order->status,
                                    $statusOrder
                                );

                            @endphp


                            <div class="mt-6">

                                @foreach($statusOrder as $index => $status)

                                    @php
                                        $isCompleted = $index < $currentIndex;
                                        $isCurrent = $index === $currentIndex;
                                    @endphp


                                    <div class="flex gap-4">

                                        {{-- INDICATOR --}}
                                        <div class="flex flex-col items-center">

                                            @if($isCompleted)

                                                <div class="w-8 h-8 rounded-full
                                                            bg-green-100 text-green-600
                                                            flex items-center justify-center
                                                            text-sm font-bold">
                                                    ✓
                                                </div>

                                            @elseif($isCurrent)

                                                <div class="w-8 h-8 rounded-full
                                                            bg-gray-900 text-white
                                                            flex items-center justify-center
                                                            text-xs font-bold">
                                                    {{ $index + 1 }}
                                                </div>

                                            @else

                                                <div class="w-8 h-8 rounded-full
                                                            bg-gray-100 text-gray-400
                                                            flex items-center justify-center
                                                            text-xs">
                                                    {{ $index + 1 }}
                                                </div>

                                            @endif


                                            @if(!$loop->last)

                                                <div class="w-px h-10 bg-gray-200"></div>

                                            @endif

                                        </div>


                                        {{-- CONTENT --}}
                                        <div class="pb-6">

                                            <p class="text-sm font-semibold
                                                      {{ ($isCurrent || $isCompleted)
                                                          ? 'text-gray-900'
                                                          : 'text-gray-400' }}">

                                                {{ $steps[$status]['title'] }}

                                            </p>


                                            @if($isCurrent)

                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $steps[$status]['description'] }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>


                    {{-- PRODUK --}}
                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Produk Pesanan
                        </h3>


                        <div class="mt-5 space-y-4">

                            @foreach($order->items as $item)

                                <div class="pb-5 border-b border-gray-100 last:border-0 last:pb-0">

                                    <div class="flex items-center gap-4">

                                        {{-- FOTO PRODUK --}}
                                        <div class="w-20 h-20 bg-gray-50 rounded-xl
                                                    flex items-center justify-center
                                                    flex-shrink-0">

                                            @if($item->product && $item->product->image)

                                                <img
                                                    src="{{ asset('storage/' . $item->product->image) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-14 h-14 object-contain"
                                                >

                                            @else

                                                <span class="text-xs text-gray-400">
                                                    No image
                                                </span>

                                            @endif

                                        </div>


                                        {{-- INFO --}}
                                        <div class="flex-1">

                                            <h4 class="text-sm font-semibold text-gray-900">
                                                {{ $item->product->name ?? 'Produk' }}
                                            </h4>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                                × {{ $item->quantity }}
                                            </p>

                                            {{-- CUSTOM PRINT --}}
                                            @if($item->print_custom)

                                                <div class="mt-2 inline-flex items-center gap-2
                                                            px-2.5 py-1 rounded-lg
                                                            bg-green-50 text-green-700
                                                            text-xs font-medium">

                                                    <span>✓</span>
                                                    <span>Custom Print</span>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- SUBTOTAL --}}
                                        <div class="text-right">

                                            <p class="text-sm font-semibold text-gray-900">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- DESAIN CUSTOM PRINT --}}
                                    @if($item->print_custom && $item->design_image)

                                        <div class="mt-4 ml-0 sm:ml-24 p-4
                                                    bg-gray-50 border border-gray-200
                                                    rounded-xl">

                                            <div class="flex flex-col sm:flex-row
                                                        sm:items-center gap-4">

                                                <div>
                                                    <p class="text-xs font-semibold text-gray-700">
                                                        Desain Custom Print
                                                    </p>

                                                    <p class="text-xs text-gray-400 mt-1">
                                                        Desain yang diupload untuk produk ini.
                                                    </p>
                                                </div>

                                                <a
                                                    href="{{ asset('storage/' . $item->design_image) }}"
                                                    target="_blank"
                                                    class="sm:ml-auto"
                                                >
                                                    <img
                                                        src="{{ asset('storage/' . $item->design_image) }}"
                                                        alt="Desain Custom Print"
                                                        class="w-24 h-24 object-cover rounded-xl
                                                               border border-gray-200
                                                               bg-white hover:opacity-90 transition"
                                                    >
                                                </a>

                                            </div>

                                        </div>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- RINGKASAN --}}
                <div>

                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6 sticky top-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Ringkasan Pembayaran
                        </h3>


                        <div class="mt-5 space-y-3">


                            {{-- SUBTOTAL --}}
                            <div class="flex justify-between text-sm text-gray-600">

                                <span>
                                    Subtotal
                                </span>

                                <span>
                                    Rp {{ number_format(
                                        $order->total_amount + $order->discount_amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>


                            {{-- DISKON --}}
                            <div class="flex justify-between text-sm text-gray-600">

                                <span>
                                    Diskon Membership
                                </span>

                                <span class="text-green-600">
                                    - Rp {{ number_format(
                                        $order->discount_amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>


                            @if($order->discount_percentage > 0)

                                <p class="text-xs text-green-600">
                                    Diskon membership
                                    {{ number_format($order->discount_percentage, 0) }}%
                                </p>

                            @endif


                            {{-- TOTAL --}}
                            <div class="border-t border-gray-200 pt-4 mt-4">

                                <div class="flex justify-between items-center">

                                    <span class="text-base font-semibold text-gray-900">
                                        Total
                                    </span>

                                    <span class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format(
                                            $order->total_amount,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </div>

                            </div>


                            {{-- BUKTI PEMBAYARAN --}}
                            <div class="border-t border-gray-200 pt-4 mt-4">

                                <p class="text-sm font-semibold text-gray-900">
                                    Bukti Pembayaran
                                </p>


                                @if($order->payment_proof)

                                    <a
                                        href="{{ asset('storage/' . $order->payment_proof) }}"
                                        target="_blank"
                                        class="block mt-3 px-4 py-2.5
                                               text-center text-sm font-medium
                                               border border-gray-300
                                               rounded-xl text-gray-700
                                               hover:bg-gray-50 transition"
                                    >
                                        Lihat Bukti Pembayaran
                                    </a>

                                    <p class="text-xs text-gray-400 mt-2 text-center">
                                        Bukti pembayaran telah diupload.
                                    </p>

                                @else

                                    <p class="text-xs text-gray-400 mt-2">
                                        Belum ada bukti pembayaran.
                                    </p>

                                @endif

                            </div>


                            {{-- BATALKAN PESANAN --}}
                            @if($order->status === 'pending')

                                <div class="border-t border-gray-200 pt-4 mt-4">

                                    <form
                                        action="{{ route('customer.orders.cancel', $order) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full px-4 py-2.5
                                                   text-center text-sm font-medium
                                                   text-red-600
                                                   border border-red-200
                                                   rounded-xl
                                                   hover:bg-red-50
                                                   transition"
                                        >
                                            ✕ Batalkan Pesanan
                                        </button>

                                    </form>

                                    <p class="text-xs text-gray-400 mt-2 text-center">
                                        Pesanan hanya dapat dibatalkan sebelum pembayaran dikonfirmasi.
                                    </p>

                                </div>

                            @endif


                            {{-- FEEDBACK --}}
                            @if($order->status === 'completed' && $order->feedbacks->isEmpty())

                                <a
                                    href="{{ route('customer.feedback.create', ['order_id' => $order->id]) }}"
                                    class="block mt-3 px-4 py-2.5
                                           text-center text-sm font-medium
                                           bg-gray-900 text-white
                                           rounded-xl
                                           hover:bg-gray-800 transition"
                                >
                                    💬 Beri Feedback
                                </a>

                            @endif


                            {{-- KEMBALI --}}
                            <a
                                href="{{ route('customer.orders') }}"
                                class="flex w-full items-center justify-center
                                       px-4 py-3
                                       mt-3
                                       border border-gray-300
                                       text-gray-700
                                       text-sm font-medium
                                       rounded-xl
                                       hover:bg-gray-50
                                       transition"
                            >
                                ← Kembali ke Pesanan Saya
                            </a>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-dynamic-component>