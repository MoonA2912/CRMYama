@php
    $cartLayout = auth()->user()->role === 'admin'
        ? 'app-layout'
        : 'customer-layout';
@endphp

<x-dynamic-component :component="$cartLayout">

    @if($cartLayout === 'app-layout')

        <x-slot name="header">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Keranjang
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Periksa produk yang ingin Anda beli.
                </p>
            </div>

        </x-slot>

    @endif


    <div class="min-h-screen bg-[#F7F7F5] py-10">

        <div class="max-w-6xl mx-auto px-6 lg:px-8">


            {{-- FLASH MESSAGE --}}
            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>

            @endif


            @if(empty($cart))

                {{-- CART KOSONG --}}
                <div class="bg-white rounded-2xl border border-gray-200
                            shadow-sm p-12 text-center">

                    <div class="text-4xl mb-4">
                        🛒
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900">
                        Keranjang masih kosong
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Silakan pilih produk terlebih dahulu.
                    </p>

                    <a
                        href="{{ route('catalog') }}"
                        class="inline-block mt-6 px-5 py-3
                               bg-[#06330A] text-white
                               rounded-xl text-sm font-medium
                               hover:bg-[#06330A]/90 transition"
                    >
                        Lihat Katalog
                    </a>

                </div>


            @else

                {{-- ========================================== --}}
                {{-- FORM CHECKOUT TERPISAH                     --}}
                {{-- ========================================== --}}

                <form
                    id="selected-checkout-form"
                    action="{{ route('checkout.prepare') }}"
                    method="POST"
                >
                    @csrf
                </form>


                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                    {{-- ========================================== --}}
                    {{-- KIRI : DAFTAR PRODUK                      --}}
                    {{-- ========================================== --}}

                    <div class="lg:col-span-2">

                        <div class="bg-white rounded-2xl border border-gray-200
                                    shadow-sm overflow-hidden">


                            {{-- HEADER --}}
                            <div class="px-6 py-5 border-b border-gray-100">

                                <div class="flex items-center justify-between">

                                    {{-- PILIH SEMUA --}}
                                    <label
                                        class="flex items-center gap-3 cursor-pointer"
                                    >

                                        <input
                                            type="checkbox"
                                            id="select-all"
                                            class="w-4 h-4 rounded
                                                   border-gray-300
                                                   text-[#06330A]
                                                   focus:ring-[#06330A]"
                                        >

                                        <span
                                            class="text-sm font-semibold
                                                   text-gray-900"
                                        >
                                            Pilih Semua
                                        </span>

                                    </label>


                                    {{-- JUMLAH TERPILIH --}}
                                    <span
                                        id="selected-count"
                                        class="text-xs text-gray-400"
                                    >
                                        0 produk dipilih
                                    </span>

                                </div>

                            </div>


                            {{-- ================================= --}}
                            {{-- DAFTAR ITEM                       --}}
                            {{-- ================================= --}}

                            <div class="divide-y divide-gray-100">

                                @foreach($cart as $cartKey => $item)

                                    @php

                                        $productSubtotal =
                                            $item['price'] * $item['quantity'];

                                        $printSubtotal =
                                            ($item['print_price'] ?? 0)
                                            * $item['quantity'];

                                        $itemTotal =
                                            $productSubtotal
                                            + $printSubtotal;

                                    @endphp


                                    {{-- ITEM CART --}}
                                    <div
                                        class="p-6"
                                        data-cart-item
                                        data-total="{{ $itemTotal }}"
                                    >

                                        <div class="flex items-start gap-4">


                                            {{-- CHECKBOX --}}
                                            <div class="pt-2 flex-shrink-0">

                                                <input
                                                    type="checkbox"
                                                    name="selected_items[]"
                                                    value="{{ $cartKey }}"
                                                    form="selected-checkout-form"
                                                    class="cart-checkbox w-4 h-4
                                                           rounded
                                                           border-gray-300
                                                           text-[#06330A]
                                                           focus:ring-[#06330A]"
                                                >

                                            </div>


                                            {{-- FOTO PRODUK --}}
                                            <div
                                                class="w-20 h-20
                                                       bg-gray-50
                                                       rounded-lg
                                                       flex items-center
                                                       justify-center
                                                       overflow-hidden
                                                       flex-shrink-0"
                                            >

                                                @if($item['image'])

                                                    <img
                                                        src="{{ asset('storage/' . $item['image']) }}"
                                                        alt="{{ $item['name'] }}"
                                                        class="w-full h-full
                                                               object-contain
                                                               block"
                                                        style="max-width:100%;
                                                               max-height:100%;"
                                                    >

                                                @else

                                                    <span class="text-xs text-gray-400">
                                                        No Image
                                                    </span>

                                                @endif

                                            </div>


                                            {{-- INFORMASI PRODUK --}}
                                            <div class="flex-1 min-w-0">


                                                {{-- NAMA --}}
                                                <h3
                                                    class="text-sm
                                                           font-semibold
                                                           text-gray-900"
                                                >
                                                    {{ $item['name'] }}
                                                </h3>


                                                {{-- HARGA --}}
                                                <p
                                                    class="text-xs
                                                           text-gray-400
                                                           mt-1"
                                                >
                                                    Rp
                                                    {{ number_format($item['price'], 0, ',', '.') }}

                                                    ×

                                                    {{ $item['quantity'] }}
                                                </p>


                                                {{-- CUSTOM PRINT --}}
                                                @if($item['print_custom'] ?? false)

                                                    <div class="mt-3">

                                                        <span
                                                            class="inline-flex
                                                                   items-center
                                                                   px-3 py-1
                                                                   rounded-full
                                                                   bg-green-50
                                                                   text-[#06330A]
                                                                   text-xs
                                                                   font-medium"
                                                        >
                                                            🎨 Custom Print
                                                        </span>


                                                        <p
                                                            class="text-xs
                                                                   text-gray-500
                                                                   mt-2"
                                                        >
                                                            Biaya print:

                                                            Rp
                                                            {{ number_format($item['print_price'], 0, ',', '.') }}

                                                            ×

                                                            {{ $item['quantity'] }}
                                                        </p>


                                                        {{-- DESAIN --}}
                                                        @if(!empty($item['design_image']))

                                                            <div class="mt-2">

                                                                <p
                                                                    class="text-xs
                                                                           text-gray-400
                                                                           mb-2"
                                                                >
                                                                    Desain:
                                                                </p>


                                                                <img
                                                                    src="{{ asset('storage/' . $item['design_image']) }}"
                                                                    alt="Desain custom print"
                                                                    class="w-16 h-16
                                                                           object-cover
                                                                           rounded-lg
                                                                           border
                                                                           border-gray-200"
                                                                >

                                                            </div>

                                                        @endif

                                                    </div>

                                                @endif


                                                {{-- QUANTITY + HAPUS --}}
                                                <div
                                                    class="flex
                                                           items-center
                                                           gap-3
                                                           mt-4"
                                                >

                                                    {{-- QUANTITY --}}
                                                    <div class="flex items-center">

                                                        <button
                                                            type="submit"
                                                            form="update-{{ $cartKey }}"
                                                            name="quantity"
                                                            value="{{ max(1, $item['quantity'] - 1) }}"
                                                            class="w-8 h-8
                                                                   border
                                                                   border-gray-300
                                                                   rounded-l-lg
                                                                   text-gray-600
                                                                   hover:bg-gray-50"
                                                        >
                                                            −
                                                        </button>


                                                        <span
                                                            class="w-10 h-8
                                                                   border-t
                                                                   border-b
                                                                   border-gray-300
                                                                   flex
                                                                   items-center
                                                                   justify-center
                                                                   text-sm"
                                                        >
                                                            {{ $item['quantity'] }}
                                                        </span>


                                                        <button
                                                            type="submit"
                                                            form="update-{{ $cartKey }}"
                                                            name="quantity"
                                                            value="{{ $item['quantity'] + 1 }}"
                                                            class="w-8 h-8
                                                                   border
                                                                   border-gray-300
                                                                   rounded-r-lg
                                                                   text-gray-600
                                                                   hover:bg-gray-50"
                                                        >
                                                            +
                                                        </button>

                                                    </div>


                                                    {{-- HAPUS --}}
                                                    <button
                                                        type="submit"
                                                        form="remove-{{ $cartKey }}"
                                                        class="text-xs
                                                               text-red-500
                                                               hover:text-red-700"
                                                    >
                                                        Hapus
                                                    </button>

                                                </div>

                                            </div>


                                            {{-- SUBTOTAL --}}
                                            <div
                                                class="text-right
                                                       flex-shrink-0"
                                            >

                                                <p
                                                    class="text-xs
                                                           text-gray-400"
                                                >
                                                    Subtotal
                                                </p>


                                                <p
                                                    class="text-sm
                                                           font-bold
                                                           text-gray-900
                                                           mt-1"
                                                >
                                                    Rp
                                                    {{ number_format($itemTotal, 0, ',', '.') }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- FORM UPDATE QUANTITY --}}
                                    <form
                                        id="update-{{ $cartKey }}"
                                        action="{{ route('cart.update', $cartKey) }}"
                                        method="POST"
                                        class="hidden"
                                    >

                                        @csrf

                                        @method('PATCH')

                                    </form>


                                    {{-- FORM HAPUS --}}
                                    <form
                                        id="remove-{{ $cartKey }}"
                                        action="{{ route('cart.remove', $cartKey) }}"
                                        method="POST"
                                        class="hidden"
                                    >

                                        @csrf

                                        @method('DELETE')

                                    </form>

                                @endforeach

                            </div>

                        </div>

                    </div>


                    {{-- ========================================== --}}
                    {{-- KANAN : RINGKASAN                         --}}
                    {{-- ========================================== --}}

                    <div>

                        <div
                            class="bg-white
                                   rounded-2xl
                                   border border-gray-200
                                   shadow-sm
                                   p-6
                                   sticky
                                   top-6"
                        >

                            <h3
                                class="text-base
                                       font-semibold
                                       text-gray-900"
                            >
                                Ringkasan Belanja
                            </h3>


                            <div class="mt-5 space-y-3">


                                {{-- JUMLAH PRODUK --}}
                                <div
                                    class="flex
                                           justify-between
                                           text-sm"
                                >

                                    <span class="text-gray-500">
                                        Produk dipilih
                                    </span>


                                    <span
                                        id="summary-count"
                                        class="font-medium
                                               text-gray-900"
                                    >
                                        0
                                    </span>

                                </div>


                                {{-- TOTAL --}}
                                <div
                                    class="border-t
                                           border-gray-100
                                           pt-4
                                           mt-4"
                                >

                                    <div
                                        class="flex
                                               justify-between"
                                    >

                                        <span class="text-sm text-gray-500">
                                            Total
                                        </span>


                                        <span
                                            id="selected-total"
                                            class="text-lg
                                                   font-bold
                                                   text-[#06330A]"
                                        >
                                            Rp 0
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- CHECKOUT --}}
                            <button
                                id="checkout-button"
                                type="submit"
                                form="selected-checkout-form"
                                disabled
                                class="w-full
                                       mt-6
                                       px-5
                                       py-3
                                       rounded-xl
                                       bg-[#06330A]
                                       hover:bg-[#06330A]/90
                                       text-white
                                       text-sm
                                       font-medium
                                       transition
                                       disabled:opacity-40
                                       disabled:cursor-not-allowed"
                            >
                                Checkout Produk Dipilih
                            </button>


                            {{-- LANJUT BELANJA --}}
                            <a
                                href="{{ route('catalog') }}"
                                class="block
                                       w-full
                                       mt-3
                                       px-5
                                       py-3
                                       rounded-xl
                                       border
                                       border-gray-300
                                       text-gray-700
                                       text-sm
                                       font-medium
                                       text-center
                                       hover:bg-gray-50
                                       transition"
                            >
                                Lanjut Belanja
                            </a>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================== --}}
    {{-- JAVASCRIPT                                --}}
    {{-- ========================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const selectAll =
                document.getElementById('select-all');

            const checkboxes =
                document.querySelectorAll('.cart-checkbox');

            const checkoutButton =
                document.getElementById('checkout-button');

            const selectedCount =
                document.getElementById('selected-count');

            const summaryCount =
                document.getElementById('summary-count');

            const selectedTotal =
                document.getElementById('selected-total');


            function updateSummary() {

                let count = 0;

                let total = 0;


                checkboxes.forEach(function (checkbox) {

                    if (checkbox.checked) {

                        count++;


                        const item =
                            checkbox.closest('[data-cart-item]');


                        if (item) {

                            total +=
                                Number(item.dataset.total);

                        }

                    }

                });


                selectedCount.textContent =
                    count + ' produk dipilih';


                summaryCount.textContent =
                    count;


                selectedTotal.textContent =
                    'Rp ' +
                    total.toLocaleString('id-ID');


                checkoutButton.disabled =
                    count === 0;


                if (selectAll) {

                    selectAll.checked =
                        checkboxes.length > 0 &&
                        count === checkboxes.length;

                }

            }


            if (selectAll) {

                selectAll.addEventListener(
                    'change',
                    function () {

                        checkboxes.forEach(
                            function (checkbox) {

                                checkbox.checked =
                                    selectAll.checked;

                            }
                        );


                        updateSummary();

                    }
                );

            }


            checkboxes.forEach(
                function (checkbox) {

                    checkbox.addEventListener(
                        'change',
                        updateSummary
                    );

                }
            );


            updateSummary();

        });

    </script>

</x-dynamic-component>