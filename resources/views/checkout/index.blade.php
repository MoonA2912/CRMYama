@php
    $checkoutLayout = auth()->user()->role === 'admin'
        ? 'app-layout'
        : 'customer-layout';
@endphp

<x-dynamic-component :component="$checkoutLayout">

    @if($checkoutLayout === 'app-layout')

        <x-slot name="header">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Checkout
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Periksa pesanan Anda sebelum melakukan pembayaran.
                </p>
            </div>

        </x-slot>

    @endif


    <div class="min-h-screen bg-[#F7F7F5] py-10">

        <div class="max-w-6xl mx-auto px-6 lg:px-8">


            {{-- PAGE INTRO --}}
            <div class="mb-8">

                <p class="text-[11px]
                          tracking-[0.28em]
                          uppercase
                          text-[#06330A]/50
                          font-medium">
                    Yama Golf Store
                </p>

                <h1 class="mt-2 text-3xl font-semibold
                           tracking-tight text-[#06330A]">
                    Checkout
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Periksa pesanan Anda sebelum melakukan pembayaran.
                </p>

            </div>


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


            {{-- VALIDATION ERROR --}}
            @if($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl">

                    <ul class="list-disc list-inside text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                {{-- ========================================== --}}
                {{-- KIRI                                      --}}
                {{-- ========================================== --}}

                <div class="lg:col-span-2 space-y-6">


                    {{-- DATA PELANGGAN --}}
                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6">

                        <h3 class="text-base font-semibold text-gray-900">
                            Data Pelanggan
                        </h3>

                        <p class="text-xs text-gray-400 mt-1 mb-5">
                            Informasi penerima pesanan.
                        </p>


                        <div class="space-y-4">


                            <div>

                                <p class="text-xs text-gray-400">
                                    Nama
                                </p>

                                <p class="text-sm font-medium text-gray-900 mt-1">
                                    {{ $customer->name }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs text-gray-400">
                                    No. Telepon
                                </p>

                                <p class="text-sm font-medium text-gray-900 mt-1">
                                    {{ $customer->phone }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs text-gray-400">
                                    Alamat
                                </p>

                                <p class="text-sm font-medium text-gray-900 mt-1">
                                    {{ $customer->address ?? '-' }}
                                </p>

                            </div>


                        </div>

                    </div>


                    {{-- PESANAN --}}
                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6">

                        <h3 class="text-base font-semibold text-gray-900">
                            Pesanan Dipilih
                        </h3>

                        <p class="text-xs text-gray-400 mt-1 mb-6">
                            Produk yang akan diproses dalam pesanan ini.
                        </p>


                        <div class="space-y-5">


                            @foreach($checkoutCart as $item)

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


                                <div
                                    class="pb-5
                                           border-b
                                           border-gray-100
                                           last:border-0
                                           last:pb-0"
                                >

                                    <div class="flex items-start gap-4">


                                        {{-- FOTO --}}
                                        <div
                                            class="w-16 h-16
                                                   bg-gray-50
                                                   rounded-xl
                                                   flex items-center
                                                   justify-center
                                                   overflow-hidden
                                                   flex-shrink-0"
                                        >

                                            @if($item['image'])

                                                <img
                                                    src="{{ \App\Support\StoredMediaUrl::resolve($item['image']) }}"
                                                    alt="{{ $item['name'] }}"
                                                    class="w-full h-full
                                                           object-contain"
                                                >

                                            @else

                                                <span class="text-xs text-gray-400">
                                                    No Image
                                                </span>

                                            @endif

                                        </div>


                                        {{-- INFO --}}
                                        <div class="flex-1 min-w-0">

                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $item['name'] }}
                                            </p>


                                            <p class="text-xs text-gray-400 mt-1">
                                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                × {{ $item['quantity'] }}
                                            </p>


                                            {{-- CUSTOM PRINT --}}
                                            @if($item['print_custom'] ?? false)

                                                <div class="mt-3">

                                                    <span
                                                        class="inline-flex items-center
                                                               px-3 py-1
                                                               rounded-full
                                                               bg-green-50
                                                               text-[#06330A]
                                                               text-xs
                                                               font-medium"
                                                    >
                                                        🎨 Custom Print
                                                    </span>


                                                    <p class="text-xs text-gray-500 mt-2">
                                                        Biaya print:
                                                        Rp {{ number_format($item['print_price'] ?? 5000, 0, ',', '.') }}
                                                        × {{ $item['quantity'] }}
                                                    </p>


                                                    <p class="text-xs font-medium text-gray-700 mt-1">
                                                        Subtotal print:
                                                        Rp {{ number_format($printSubtotal, 0, ',', '.') }}
                                                    </p>


                                                    {{-- DESAIN --}}
                                                    @if(!empty($item['design_image']))

                                                        <div class="mt-3">

                                                            <p class="text-xs text-gray-500 mb-2">
                                                                Desain yang diupload:
                                                            </p>

                                                            <img
                                                                src="{{ \App\Support\StoredMediaUrl::resolve($item['design_image']) }}"
                                                                alt="Desain custom print"
                                                                class="w-20 h-20
                                                                       object-cover
                                                                       rounded-lg
                                                                       border border-gray-200"
                                                            >

                                                        </div>

                                                    @endif

                                                </div>

                                            @endif

                                        </div>


                                        {{-- TOTAL ITEM --}}
                                        <div class="text-right flex-shrink-0">

                                            <p class="text-xs text-gray-400">
                                                Subtotal
                                            </p>

                                            <p class="text-sm font-bold text-gray-900 mt-1">
                                                Rp {{ number_format($itemTotal, 0, ',', '.') }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endforeach


                        </div>

                    </div>


                    {{-- BUKTI PEMBAYARAN --}}
                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm p-6">

                        <h3 class="text-base font-semibold text-gray-900">
                            Bukti Pembayaran
                        </h3>

                        <p class="text-sm text-gray-500 mt-1 mb-5">
                            Upload bukti transfer pembayaran untuk
                            menyelesaikan pesanan.
                        </p>


                        <label
                            for="payment_proof"
                            class="block text-sm font-medium
                                   text-gray-700 mb-2"
                        >
                            Upload Bukti Transfer
                        </label>


                        <input
                            type="file"
                            id="payment_proof"
                            name="payment_proof"
                            form="checkout-form"
                            accept=".jpg,.jpeg,.png,.webp,.pdf"
                            required
                            class="block w-full text-sm text-gray-600
                                   border border-gray-300 rounded-xl
                                   px-4 py-3
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-lg file:border-0
                                   file:text-sm file:font-medium
                                   file:bg-gray-100 file:text-gray-700
                                   hover:file:bg-gray-200"
                        >


                        <p class="text-xs text-gray-400 mt-2">
                            Format: JPG, JPEG, PNG, WEBP, atau PDF.
                            Maksimal 2 MB.
                        </p>

                    </div>


                </div>

                                    {{-- BIRTHDAY VOUCHER --}}
                    @if($birthdayVoucher)

                        <div class="bg-white rounded-2xl border border-green-200
                                    shadow-sm p-6">

                            <div class="flex items-start gap-4">

                                <div
                                    class="w-11 h-11
                                           rounded-xl
                                           bg-green-50
                                           flex items-center
                                           justify-center
                                           text-xl
                                           flex-shrink-0"
                                >
                                    🎂
                                </div>

                                <div class="flex-1">

                                    <p class="text-xs font-semibold uppercase
                                              tracking-[0.18em] text-[#06330A]">
                                        Birthday Reward
                                    </p>

                                    <h3 class="text-base font-semibold text-gray-900 mt-1">
                                        Birthday Voucher
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Dapatkan diskon
{{ rtrim(rtrim(number_format(
    $birthdayVoucher->discount_percent,
    2,
    ',',
    '.'
), '0'), ',') }}%
hingga maksimal Rp
{{ number_format(
    $birthdayVoucher->maximum_discount,
    0,
    ',',
    '.'
) }}
untuk transaksi ini.
                                    </p>

                                    <div class="mt-4
                                                flex flex-col sm:flex-row
                                                sm:items-center
                                                sm:justify-between
                                                gap-3">

                                        <div>

                                            <p class="text-xs text-gray-400">
                                                Kode voucher
                                            </p>

                                            <p class="text-sm font-bold
                                                      tracking-wider
                                                      text-gray-900 mt-1">
                                                {{ $birthdayVoucher->code }}
                                            </p>

                                        </div>

                                        <label
                                            class="inline-flex items-center
                                                   gap-2
                                                   cursor-pointer"
                                        >

                                            <input
                                                type="checkbox"
                                                name="use_birthday_voucher"
                                                value="1"
                                                form="checkout-form"
                                                class="rounded
                                                       border-gray-300
                                                       text-[#06330A]
                                                       focus:ring-[#06330A]"
                                            >

                                            <span class="text-sm font-medium
                                                         text-[#06330A]">
                                                Gunakan voucher
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

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

                        <h3 class="text-base font-semibold text-gray-900">
                            Ringkasan Pembayaran
                        </h3>


                        <div class="mt-5 space-y-4">


                            {{-- SUBTOTAL --}}
                            <div class="flex justify-between text-sm">

                                <span class="text-gray-500">
                                    Subtotal
                                </span>

                                <span class="font-medium text-gray-900">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>

                            </div>


                            {{-- DISKON --}}
                            <div class="flex justify-between text-sm">

                                <span class="text-gray-500">
                                    Diskon Membership
                                </span>

                                <span class="font-medium text-green-600">
                                    {{ $discountPercentage }}%
                                </span>

                            </div>


                            @if($discountAmount > 0)

                                <div class="flex justify-between text-sm">

                                    <span class="text-gray-500">
                                        Potongan
                                    </span>

                                    <span class="font-medium text-green-600">
                                        - Rp {{ number_format($discountAmount, 0, ',', '.') }}
                                    </span>

                                </div>

                            @endif

                            @if($birthdayVoucher)

    <div
        id="birthday-voucher-summary"
        class="flex justify-between text-sm hidden"
    >

        <span class="text-gray-500">
            Birthday Voucher
        </span>

        <span class="font-medium text-green-600">
            - Rp
            <span id="birthday-voucher-amount">
                0
            </span>
        </span>

    </div>

@endif


                            {{-- TOTAL --}}
                            <div
                                class="border-t
                                       border-gray-100
                                       pt-5
                                       mt-5"
                            >

                                <div class="flex justify-between items-end">

                                    <span class="font-semibold text-gray-900">
                                        Total
                                    </span>

                                    <span class="text-xl font-bold text-[#06330A]">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- FORM CHECKOUT --}}
                        <form
                            id="checkout-form"
                            action="{{ route('checkout.process') }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf


                            <button
                                type="submit"
                                class="w-full
                                       mt-6
                                       px-5
                                       py-3.5
                                       rounded-xl
                                       bg-[#06330A]
                                       hover:bg-[#06330A]/90
                                       text-white
                                       text-sm
                                       font-medium
                                       transition"
                            >
                                Buat Pesanan
                            </button>

                        </form>


                        {{-- KEMBALI --}}
                        <a
                            href="{{ route('cart.index') }}"
                            class="block
                                   w-full
                                   mt-3
                                   px-5
                                   py-3.5
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
                            Kembali ke Keranjang
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const voucherCheckbox =
            document.querySelector('input[name="use_birthday_voucher"]');

        const voucherSummary =
            document.getElementById('birthday-voucher-summary');

        const voucherAmount =
            document.getElementById('birthday-voucher-amount');

        const totalElement =
            document.querySelector('.text-xl.font-bold.text-\\[\\#06330A\\]');

        if (!voucherCheckbox || !voucherSummary || !voucherAmount || !totalElement) {
            return;
        }

        const subtotal =
            {{ $subtotal }};

        const membershipDiscountAmount =
            {{ $discountAmount }};

        const voucherPercentage =
            {{ $birthdayVoucher?->discount_percent ?? 0 }};

        const voucherMaximumDiscount =
            {{ $birthdayVoucher?->maximum_discount ?? 0 }};

        const totalBeforeVoucher =
            subtotal -
            membershipDiscountAmount;

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(
                Math.round(number)
            );
        }

        function updateVoucher() {

            if (voucherCheckbox.checked) {

                const calculatedVoucherDiscount =
    totalBeforeVoucher *
    (voucherPercentage / 100);

const voucherDiscount =
    Math.min(
        calculatedVoucherDiscount,
        voucherMaximumDiscount
    );

                const finalTotal =
                    totalBeforeVoucher -
                    voucherDiscount;

                voucherSummary.classList.remove('hidden');

                voucherAmount.textContent =
                    formatRupiah(voucherDiscount);

                totalElement.textContent =
                    'Rp ' + formatRupiah(finalTotal);

            } else {

                voucherSummary.classList.add('hidden');

                voucherAmount.textContent =
                    '0';

                totalElement.textContent =
                    'Rp ' + formatRupiah(totalBeforeVoucher);
            }
        }

        voucherCheckbox.addEventListener(
            'change',
            updateVoucher
        );

        updateVoucher();

    });
</script>

</x-dynamic-component>