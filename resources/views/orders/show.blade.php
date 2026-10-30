<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Detail Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap transaksi dan produk dalam pesanan.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div
                    class="mb-6 rounded-xl
                           border border-green-200
                           bg-green-50
                           px-5 py-4
                           text-sm text-green-700"
                >
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERROR MESSAGE --}}
            @if (session('error'))

                <div
                    class="mb-6 rounded-xl
                           border border-red-200
                           bg-red-50
                           px-5 py-4
                           text-sm text-red-700"
                >
                    {{ session('error') }}
                </div>

            @endif


            {{-- ORDER SUMMARY --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden mb-6"
            >

                <div class="p-6 sm:p-8">

                    <div
                        class="flex flex-col lg:flex-row
                               lg:items-start lg:justify-between
                               gap-6 mb-8"
                    >

                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-[0.18em] text-gray-400">
                                Order
                            </p>

                            <h3
                                class="text-2xl font-bold
                                       text-[#06330A] mt-2"
                            >
                                {{ $order->order_number }}
                            </h3>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            @if($order->status === 'completed')

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2 rounded-full
                                           bg-green-50 text-green-700
                                           text-xs font-semibold"
                                >
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Selesai
                                </span>

                            @elseif($order->status === 'cancelled')

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2 rounded-full
                                           bg-red-50 text-red-600
                                           text-xs font-semibold"
                                >
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Dibatalkan
                                </span>

                            @elseif($order->status === 'paid')

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2 rounded-full
                                           bg-blue-50 text-blue-700
                                           text-xs font-semibold"
                                >
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    Dibayar
                                </span>

                            @elseif($order->status === 'processing')

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2 rounded-full
                                           bg-orange-50 text-orange-700
                                           text-xs font-semibold"
                                >
                                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                    Diproses
                                </span>

                            @elseif($order->status === 'shipped')

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2 rounded-full
                                           bg-purple-50 text-purple-700
                                           text-xs font-semibold"
                                >
                                    <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                    Dikirim
                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2 rounded-full
                                           bg-yellow-50 text-yellow-700
                                           text-xs font-semibold"
                                >
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    {{ ucfirst($order->status) }}
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ORDER INFORMATION --}}
                    <div
                        class="grid grid-cols-1 sm:grid-cols-3
                               gap-4"
                    >

                        <div
                            class="rounded-xl bg-[#F7F7F5]
                                   border border-gray-100 p-5"
                        >

                            <p class="text-xs text-gray-400">
                                Pelanggan
                            </p>

                            <p class="text-sm font-semibold
                                      text-gray-900 mt-2">
                                {{ $order->customer->name ?? '-' }}
                            </p>

                        </div>


                        <div
                            class="rounded-xl bg-[#F7F7F5]
                                   border border-gray-100 p-5"
                        >

                            <p class="text-xs text-gray-400">
                                Tanggal Pesanan
                            </p>

                            <p class="text-sm font-semibold
                                      text-gray-900 mt-2">
                                {{ $order->order_date->format('d/m/Y') }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $order->order_date->format('H:i') }}
                            </p>

                        </div>


                        <div
                            class="rounded-xl bg-[#F7F7F5]
                                   border border-gray-100 p-5"
                        >

                            <p class="text-xs text-gray-400">
                                Total Pesanan
                            </p>

                            <p class="text-lg font-bold
                                      text-[#06330A] mt-2">
                                Rp {{ number_format(
                                    $order->total_amount,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </p>

                        </div>

                    </div>


                    {{-- PAYMENT PROOF --}}
                    <div class="border-t border-gray-100 mt-8 pt-7">

                        <div class="flex items-center gap-3 mb-4">

                            <div
                                class="w-9 h-9 rounded-xl
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
                                        d="M12 6v12m-3-3h6m5-12H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="text-base font-bold text-gray-900">
                                    Bukti Pembayaran
                                </h3>

                                <p class="text-xs text-gray-400 mt-0.5">
                                    Bukti pembayaran yang diunggah pelanggan.
                                </p>

                            </div>

                        </div>


                        @if ($order->payment_proof)

                            @php
                                $extension = strtolower(
                                    pathinfo(
                                        $order->payment_proof,
                                        PATHINFO_EXTENSION
                                    )
                                );
                            @endphp


                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))

                                <a
                                    href="{{ \App\Support\StoredMediaUrl::resolve($order->payment_proof) }}"
                                    target="_blank"
                                    class="inline-block"
                                >

                                    <img
                                        src="{{ \App\Support\StoredMediaUrl::resolve($order->payment_proof) }}"
                                        alt="Bukti Pembayaran"
                                        class="w-52 h-52 object-contain
                                               rounded-xl
                                               border border-gray-200
                                               bg-gray-50
                                               hover:opacity-80
                                               transition"
                                    >

                                </a>

                                <p class="text-xs text-gray-400 mt-2">
                                    Klik gambar untuk melihat ukuran penuh.
                                </p>


                            @elseif ($extension === 'pdf')

                                <a
                                    href="{{ \App\Support\StoredMediaUrl::resolve($order->payment_proof) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2
                                           px-4 py-2.5 rounded-xl
                                           bg-red-50
                                           text-red-600
                                           text-sm font-semibold
                                           hover:bg-red-100
                                           transition"
                                >
                                    📄 Lihat Bukti Pembayaran (PDF)
                                </a>

                            @endif

                        @else

                            <div
                                class="rounded-xl
                                       bg-gray-50
                                       border border-dashed border-gray-200
                                       px-5 py-4"
                            >

                                <p class="text-sm text-gray-400">
                                    Belum ada bukti pembayaran.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- PRODUCTS --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden mb-6"
            >

                <div class="p-6 sm:p-8">

                    <div class="flex items-center gap-3 mb-6">

                        <div
                            class="w-9 h-9 rounded-xl
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
                                    d="M3 7h18M5 7l1 13h12l1-13M9 7V5a3 3 0 0 1 6 0v2"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-base font-bold text-gray-900">
                                Produk dalam Pesanan
                            </h3>

                            <p class="text-xs text-gray-400 mt-0.5">
                                Daftar produk yang dibeli pelanggan.
                            </p>

                        </div>

                    </div>


                    @if ($order->items->count() > 0)

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead>

                                    <tr
                                        class="border-b border-gray-100"
                                    >

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-500 uppercase
                                                   tracking-wider"
                                        >
                                            Produk
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-500 uppercase
                                                   tracking-wider"
                                        >
                                            Harga
                                        </th>

                                        <th
                                            class="px-4 py-4 text-center
                                                   text-xs font-semibold
                                                   text-gray-500 uppercase
                                                   tracking-wider"
                                        >
                                            Jumlah
                                        </th>

                                        <th
                                            class="px-4 py-4 text-right
                                                   text-xs font-semibold
                                                   text-gray-500 uppercase
                                                   tracking-wider"
                                        >
                                            Subtotal
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($order->items as $item)

                                        @php
                                            $productSubtotal =
                                                $item->price * $item->quantity;

                                            $printSubtotal =
                                                ($item->print_price ?? 0) *
                                                $item->quantity;
                                        @endphp


                                        <tr class="hover:bg-[#FAFAF8] transition">

                                            {{-- PRODUCT --}}
                                            <td class="px-4 py-5">

                                                <div class="flex items-start gap-4">

                                                    @if ($item->product && $item->product->image)

                                                        <img
                                                            src="{{ \App\Support\StoredMediaUrl::resolve($item->product->image) }}"
                                                            alt="{{ $item->product->name }}"
                                                            class="w-16 h-16 rounded-xl
                                                                   object-cover
                                                                   border border-gray-100"
                                                        >

                                                    @else

                                                        <div
                                                            class="w-16 h-16 rounded-xl
                                                                   bg-gray-50
                                                                   flex items-center
                                                                   justify-center"
                                                        >

                                                            <svg
                                                                class="w-7 h-7 text-gray-300"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M3 7h18M5 7l1 13h12l1-13M9 7V5a3 3 0 0 1 6 0v2"
                                                                />
                                                            </svg>

                                                        </div>

                                                    @endif


                                                    <div>

                                                        <p
                                                            class="text-sm font-semibold
                                                                   text-gray-900"
                                                        >
                                                            {{ $item->product->name ?? '-' }}
                                                        </p>


                                                        {{-- PRINTED GOLF BALLS --}}
                                                        @if ($item->print_custom)

                                                            <div class="mt-3">

                                                                <span
                                                                    class="inline-flex items-center
                                                                           gap-1.5
                                                                           px-3 py-1 rounded-full
                                                                           bg-green-50
                                                                           text-[#06330A]
                                                                           text-xs font-semibold"
                                                                >
                                                                    🎨 Printed Golf Balls
                                                                </span>


                                                                <div
                                                                    class="mt-3 space-y-1.5"
                                                                >

                                                                    <p class="text-xs text-gray-500">
                                                                        Biaya print:
                                                                        <span class="font-semibold text-gray-700">
                                                                            Rp {{ number_format(
                                                                                $item->print_price,
                                                                                0,
                                                                                ',',
                                                                                '.'
                                                                            ) }}
                                                                        </span>
                                                                        × {{ $item->quantity }}
                                                                    </p>


                                                                    <p class="text-xs text-gray-500">
                                                                        Subtotal print:
                                                                        <span class="font-semibold text-gray-700">
                                                                            Rp {{ number_format(
                                                                                $printSubtotal,
                                                                                0,
                                                                                ',',
                                                                                '.'
                                                                            ) }}
                                                                        </span>
                                                                    </p>

                                                                </div>


                                                                {{-- DESIGN --}}
                                                                @if ($item->design_image)

                                                                    <div class="mt-4">

                                                                        <p
                                                                            class="text-xs font-medium
                                                                                   text-gray-500 mb-2"
                                                                        >
                                                                            Desain yang diupload
                                                                        </p>


                                                                        <a
                                                                            href="{{ \App\Support\StoredMediaUrl::resolve($item->design_image) }}"
                                                                            target="_blank"
                                                                            class="inline-block"
                                                                        >

                                                                            <img
                                                                                src="{{ \App\Support\StoredMediaUrl::resolve($item->design_image) }}"
                                                                                alt="Desain Printed Golf Balls"
                                                                                class="w-24 h-24
                                                                                       object-cover
                                                                                       rounded-xl
                                                                                       border border-gray-200
                                                                                       hover:opacity-80
                                                                                       transition"
                                                                            >

                                                                        </a>


                                                                        <p
                                                                            class="text-xs text-gray-400
                                                                                   mt-1"
                                                                        >
                                                                            Klik gambar untuk melihat ukuran penuh.
                                                                        </p>

                                                                    </div>

                                                                @endif

                                                            </div>

                                                        @endif

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- PRICE --}}
                                            <td
                                                class="px-4 py-5
                                                       text-sm text-gray-700
                                                       align-top"
                                            >
                                                Rp {{ number_format(
                                                    $item->price,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </td>


                                            {{-- QUANTITY --}}
                                            <td
                                                class="px-4 py-5
                                                       text-sm text-gray-700
                                                       text-center align-top"
                                            >
                                                {{ $item->quantity }}
                                            </td>


                                            {{-- SUBTOTAL --}}
                                            <td
                                                class="px-4 py-5
                                                       text-sm font-semibold
                                                       text-gray-900
                                                       text-right align-top"
                                            >
                                                Rp {{ number_format(
                                                    $item->subtotal,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                    @else

                        <div
                            class="rounded-xl
                                   bg-gray-50
                                   border border-dashed border-gray-200
                                   p-8 text-center"
                        >

                            <p class="text-sm text-gray-400">
                                Belum ada produk dalam pesanan ini.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ADD PRODUCT --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden mb-6"
            >

                <div class="p-6 sm:p-8">

                    <div class="flex items-center gap-3 mb-6">

                        <div
                            class="w-9 h-9 rounded-xl
                                   bg-green-50
                                   flex items-center justify-center"
                        >

                            <span class="text-lg text-[#06330A]">
                                +
                            </span>

                        </div>

                        <div>

                            <h3 class="text-base font-bold text-gray-900">
                                Tambahkan Produk
                            </h3>

                            <p class="text-xs text-gray-400 mt-0.5">
                                Tambahkan produk ke dalam pesanan ini.
                            </p>

                        </div>

                    </div>


                    <form
                        action="{{ route('orders.items.store', $order) }}"
                        method="POST"
                    >

                        @csrf


                        <div
                            class="grid grid-cols-1
                                   md:grid-cols-3 gap-5"
                        >

                            {{-- PRODUCT --}}
                            <div class="md:col-span-2">

                                <label
                                    for="product_id"
                                    class="block text-sm font-semibold
                                           text-gray-800 mb-2"
                                >
                                    Produk
                                </label>


                                <select
                                    name="product_id"
                                    id="product_id"
                                    required
                                    class="w-full rounded-xl
                                           border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]
                                           text-sm"
                                >

                                    <option value="">
                                        -- Pilih Produk --
                                    </option>


                                    @foreach (\App\Models\Product::where('is_active', true)->orderBy('name')->get() as $product)

                                        <option value="{{ $product->id }}">

                                            {{ $product->name }}
                                            - Rp {{ number_format(
                                                $product->price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                            (Stok: {{ $product->stock }})

                                        </option>

                                    @endforeach

                                </select>


                                @error('product_id')

                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- QUANTITY --}}
                            <div>

                                <label
                                    for="quantity"
                                    class="block text-sm font-semibold
                                           text-gray-800 mb-2"
                                >
                                    Jumlah
                                </label>


                                <input
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    min="1"
                                    value="{{ old('quantity', 1) }}"
                                    required
                                    class="w-full rounded-xl
                                           border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]
                                           text-sm"
                                >


                                @error('quantity')

                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        <div class="mt-5">

                            <button
                                type="submit"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-[#06330A]
                                       text-white
                                       text-sm font-semibold
                                       hover:bg-[#052808]
                                       transition shadow-sm"
                            >
                                + Tambahkan Produk
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ORDER TOTAL --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div class="p-6 sm:p-8">

                    <div
                        class="flex flex-col lg:flex-row
                               lg:items-end lg:justify-between
                               gap-8"
                    >

                        {{-- SUMMARY --}}
                        <div class="w-full lg:max-w-md">

                            <h3
                                class="text-base font-bold
                                       text-gray-900 mb-5"
                            >
                                Ringkasan Pesanan
                            </h3>


                            {{-- SUBTOTAL --}}
                            <div
                                class="flex justify-between
                                       text-sm text-gray-500 mb-3"
                            >

                                <span>
                                    Subtotal
                                </span>

                                <span class="font-medium text-gray-700">
                                    Rp {{ number_format(
                                        $order->items->sum('subtotal'),
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>


                            {{-- DISCOUNT --}}
                            <div
                                class="flex justify-between
                                       text-sm text-gray-500 mb-4"
                            >

                                <span>
                                    Diskon ({{ number_format(
                                        $order->discount_percentage,
                                        0
                                    ) }}%)
                                </span>

                                <span class="font-medium text-green-600">
                                    - Rp {{ number_format(
                                        $order->discount_amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>


                            {{-- TOTAL --}}
                            <div
                                class="border-t border-gray-100
                                       pt-4 flex items-center
                                       justify-between"
                            >

                                <span
                                    class="text-base font-bold
                                           text-gray-900"
                                >
                                    Total Pesanan
                                </span>

                                <span
                                    class="text-2xl font-bold
                                           text-[#06330A]"
                                >
                                    Rp {{ number_format(
                                        $order->total_amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div
                            class="flex flex-col sm:flex-row
                                   gap-3"
                        >

                            <a
                                href="{{ route('orders.index') }}"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-gray-100
                                       text-gray-700
                                       text-sm font-semibold
                                       hover:bg-gray-200
                                       transition"
                            >
                                Kembali
                            </a>


                            <a
                                href="{{ route('orders.edit', $order) }}"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-[#06330A]
                                       text-white
                                       text-sm font-semibold
                                       hover:bg-[#052808]
                                       transition shadow-sm"
                            >
                                Edit Pesanan
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
