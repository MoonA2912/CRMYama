<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mt-1">
            Detail Custom Fitting
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Informasi lengkap booking dan riwayat custom fitting pelanggan.
        </p>
    </div>
</x-slot>


<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Success Message --}}
        @if (session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100">

                        <svg
                            class="w-5 h-5 text-green-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Main Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">


            {{-- Customer Header --}}
            <div class="px-6 sm:px-8 py-7 border-b border-gray-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-full bg-[#06330A]/10
                                    flex items-center justify-center
                                    text-lg font-bold text-[#06330A]">

                            {{ strtoupper(substr($customFitting->customer->name ?? '-', 0, 1)) }}

                        </div>


                        <div>

                            <p class="text-xs font-semibold uppercase tracking-[0.15em] text-gray-400">
                                Pelanggan
                            </p>

                            <h3 class="text-xl font-bold text-gray-900 mt-1">
                                {{ $customFitting->customer->name ?? '-' }}
                            </h3>

                            @if($customFitting->customer && $customFitting->customer->phone)

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $customFitting->customer->phone }}
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- Status --}}
                    @php

                        $statusClasses = match($customFitting->status) {

                            'pending' =>
                                'bg-amber-50 text-amber-700 border-amber-200',

                            'confirmed' =>
                                'bg-blue-50 text-blue-700 border-blue-200',

                            'completed' =>
                                'bg-green-50 text-green-700 border-green-200',

                            'cancelled',
                            'rejected' =>
                                'bg-red-50 text-red-700 border-red-200',

                            default =>
                                'bg-gray-100 text-gray-700 border-gray-200',

                        };


                        $statusLabel = match($customFitting->status) {

                            'pending' =>
                                'Menunggu Konfirmasi',

                            'confirmed' =>
                                'Dikonfirmasi',

                            'completed' =>
                                'Selesai',

                            'cancelled' =>
                                'Dibatalkan',

                            'rejected' =>
                                'Ditolak',

                            default =>
                                ucfirst($customFitting->status),

                        };

                    @endphp


                    <span
                        class="inline-flex w-fit items-center
                               px-3.5 py-1.5
                               rounded-full
                               border
                               text-xs font-semibold
                               {{ $statusClasses }}"
                    >
                        {{ $statusLabel }}
                    </span>

                </div>

            </div>


            {{-- Booking Information --}}
            <div class="px-6 sm:px-8 py-7 border-b border-gray-100">

                <div class="flex items-center gap-3 mb-5">

                    <div class="w-9 h-9 rounded-lg bg-[#06330A]/10
                                flex items-center justify-center">

                        <svg
                            class="w-5 h-5 text-[#06330A]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-base font-semibold text-gray-900">
                            Data Booking
                        </h3>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi jadwal dan jenis custom fitting.
                        </p>

                    </div>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                    {{-- Date --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs text-gray-400">
                            Tanggal Custom Fitting
                        </p>

                        <p class="text-sm font-semibold text-gray-900 mt-1">
                            {{ $customFitting->fitting_date
                                ? $customFitting->fitting_date->format('d M Y')
                                : '-' }}
                        </p>

                    </div>


                    {{-- Time --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs text-gray-400">
                            Jam Booking
                        </p>

                        <p class="text-sm font-semibold text-gray-900 mt-1">
                            {{ $customFitting->booking_time
                                ? \Carbon\Carbon::parse($customFitting->booking_time)->format('H:i') . ' WIB'
                                : '-' }}
                        </p>

                    </div>


                    {{-- Fitting Type --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs text-gray-400">
                            Jenis Custom Fitting
                        </p>

                        @if($customFitting->fitting_type)

                            <span class="inline-flex mt-1 px-3 py-1 rounded-lg
                                         bg-[#06330A]/5
                                         text-[#06330A]
                                         text-xs font-semibold">
                                {{ $customFitting->fitting_type }}
                            </span>

                        @else

                            <p class="text-sm font-semibold text-gray-900 mt-1">
                                -
                            </p>

                        @endif

                    </div>


                    {{-- Status --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs text-gray-400">
                            Status Booking
                        </p>

                        <p class="text-sm font-semibold text-gray-900 mt-1">
                            {{ $statusLabel }}
                        </p>

                    </div>

                </div>


                {{-- Notes --}}
                <div class="mt-4 rounded-xl bg-gray-50 p-4">

                    <p class="text-xs text-gray-400">
                        Catatan Booking
                    </p>

                    <p class="text-sm text-gray-700 leading-6 mt-1">
                        {{ $customFitting->notes ?: '-' }}
                    </p>

                </div>

            </div>


            {{-- Fitting Result --}}
            <div class="px-6 sm:px-8 py-7">

                <div class="flex items-center gap-3 mb-5">

                    <div class="w-9 h-9 rounded-lg bg-[#06330A]/10
                                flex items-center justify-center">

                        <svg
                            class="w-5 h-5 text-[#06330A]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-base font-semibold text-gray-900">
                            Hasil Custom Fitting
                        </h3>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Data yang dicatat setelah proses fitting dilakukan.
                        </p>

                    </div>

                </div>


                {{-- Physical Data --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs text-gray-400">
                            Tinggi Badan
                        </p>

                        <p class="text-sm font-semibold text-gray-900 mt-1">
                            {{ $customFitting->height ?: '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs text-gray-400">
                            Berat Badan
                        </p>

                        <p class="text-sm font-semibold text-gray-900 mt-1">
                            {{ $customFitting->weight ?: '-' }}
                        </p>

                    </div>

                </div>


                {{-- Customer Needs --}}
                <div class="rounded-xl bg-gray-50 p-4 mb-4">

                    <p class="text-xs text-gray-400">
                        Kebutuhan / Keluhan Pelanggan
                    </p>

                    <p class="text-sm text-gray-700 leading-6 mt-1">
                        {{ $customFitting->customer_needs ?: '-' }}
                    </p>

                </div>


                {{-- Fitting Result --}}
                <div class="rounded-xl bg-gray-50 p-4 mb-4">

                    <p class="text-xs text-gray-400">
                        Hasil Custom Fitting
                    </p>

                    <p class="text-sm text-gray-700 leading-6 mt-1">
                        {{ $customFitting->fitting_result ?: '-' }}
                    </p>

                </div>


                {{-- Recommendation --}}
                <div class="rounded-xl bg-gray-50 p-4">

                    <p class="text-xs text-gray-400">
                        Rekomendasi
                    </p>

                    <p class="text-sm text-gray-700 leading-6 mt-1">
                        {{ $customFitting->recommendation ?: '-' }}
                    </p>

                </div>

            </div>


            {{-- Footer Actions --}}
            <div class="px-6 sm:px-8 py-5 bg-gray-50 border-t border-gray-100">

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                    <a
                        href="{{ route('custom-fittings.index') }}"
                        class="inline-flex items-center justify-center
                               px-5 py-2.5
                               rounded-xl
                               bg-white
                               border border-gray-200
                               text-gray-700
                               text-sm font-semibold
                               hover:bg-gray-100
                               transition"
                    >
                        Kembali
                    </a>


                    <a
                        href="{{ route('custom-fittings.edit', $customFitting) }}"
                        class="inline-flex items-center justify-center gap-2
                               px-5 py-2.5
                               rounded-xl
                               bg-[#06330A]
                               hover:bg-[#052807]
                               text-white
                               text-sm font-semibold
                               transition
                               shadow-sm"
                    >

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                   M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                            />
                        </svg>

                        Edit Custom Fitting

                    </a>

                </div>

            </div>


        </div>

    </div>

</div>


</x-app-layout>
