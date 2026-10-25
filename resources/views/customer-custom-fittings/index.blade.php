<x-dynamic-component :component="'customer-layout'">

    <div class="min-h-screen bg-[#F7F7F5] py-10">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">

                <div>
                    <h1 class="text-3xl font-semibold text-gray-900">
                        Custom Fitting
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Lihat booking, riwayat fitting, dan rekomendasi Anda.
                    </p>
                </div>

                <a href="{{ route('customer.custom-fittings.create') }}"
                   class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#164A22] hover:bg-[#103719] text-white text-sm font-semibold transition">
                    + Booking Custom Fitting
                </a>

            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Validation Error --}}
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">
                    <ul class="text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($customFittings->count() > 0)

                <div class="space-y-5">

                    @foreach($customFittings as $fitting)

                        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

                            {{-- Top --}}
                            <div class="p-6 sm:p-7">

                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wide">
                                            Jadwal Custom Fitting
                                        </p>

                                        <div class="flex flex-wrap items-center gap-3 mt-2">

                                            <h2 class="text-lg font-semibold text-gray-900">
                                                {{ $fitting->fitting_date->format('d M Y') }}
                                            </h2>

                                            @if($fitting->booking_time)
                                                <span class="text-sm text-gray-500">
                                                    • {{ \Carbon\Carbon::parse($fitting->booking_time)->format('H:i') }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    @php
                                        $statusClasses = match($fitting->status) {
                                            'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                            'confirmed' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'completed' => 'bg-green-50 text-green-700 border-green-200',
                                            'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                            'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                            default => 'bg-gray-50 text-gray-600 border-gray-200',
                                        };

                                        $statusLabel = match($fitting->status) {
                                            'pending' => 'Menunggu Konfirmasi',
                                            'confirmed' => 'Dikonfirmasi',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                            'rejected' => 'Ditolak',
                                            default => ucfirst($fitting->status),
                                        };
                                    @endphp

                                    <span class="inline-flex w-fit items-center px-3 py-1.5 rounded-full border text-xs font-semibold {{ $statusClasses }}">
                                        {{ $statusLabel }}
                                    </span>

                                </div>

                                {{-- Booking Information --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-6 pt-6 border-t border-gray-100">

                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Jenis Custom Fitting
                                        </p>

                                        <p class="text-sm font-medium text-gray-800 mt-1">
                                            {{ $fitting->fitting_type ?: '-' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Waktu Booking
                                        </p>

                                        <p class="text-sm font-medium text-gray-800 mt-1">
                                            {{ $fitting->booking_time
                                                ? \Carbon\Carbon::parse($fitting->booking_time)->format('H:i') . ' WIB'
                                                : '-' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-400">
                                            Catatan
                                        </p>

                                        <p class="text-sm text-gray-700 mt-1">
                                            {{ $fitting->notes ?: '-' }}
                                        </p>
                                    </div>

                                </div>

                                {{-- Result --}}
                                @if($fitting->fitting_result || $fitting->recommendation || $fitting->height || $fitting->weight || $fitting->customer_needs)

                                    <div class="mt-6 pt-6 border-t border-gray-100">

                                        <h3 class="text-sm font-semibold text-gray-900 mb-4">
                                            Hasil Custom Fitting
                                        </h3>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                                            <div>
                                                <p class="text-xs text-gray-400">
                                                    Tinggi Badan
                                                </p>

                                                <p class="text-sm font-medium text-gray-800 mt-1">
                                                    {{ $fitting->height ?: '-' }}
                                                </p>
                                            </div>

                                            <div>
                                                <p class="text-xs text-gray-400">
                                                    Berat Badan
                                                </p>

                                                <p class="text-sm font-medium text-gray-800 mt-1">
                                                    {{ $fitting->weight ?: '-' }}
                                                </p>
                                            </div>

                                            <div>
                                                <p class="text-xs text-gray-400">
                                                    Kebutuhan / Keluhan
                                                </p>

                                                <p class="text-sm text-gray-700 mt-1">
                                                    {{ $fitting->customer_needs ?: '-' }}
                                                </p>
                                            </div>

                                            <div class="sm:col-span-2 lg:col-span-3">
                                                <p class="text-xs text-gray-400">
                                                    Hasil Fitting
                                                </p>

                                                <p class="text-sm text-gray-700 mt-1">
                                                    {{ $fitting->fitting_result ?: '-' }}
                                                </p>
                                            </div>

                                            <div class="sm:col-span-2 lg:col-span-3">
                                                <p class="text-xs text-gray-400">
                                                    Rekomendasi
                                                </p>

                                                <p class="text-sm text-gray-700 mt-1">
                                                    {{ $fitting->recommendation ?: '-' }}
                                                </p>
                                            </div>

                                        </div>

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- Empty State --}}
                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-12 text-center">

                    <div class="text-5xl mb-5">
                        🏌🏻‍♀️
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900">
                        Belum ada custom fitting
                    </h2>

                    <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
                        Anda belum memiliki booking atau riwayat custom fitting.
                        Silakan buat booking untuk mendapatkan layanan custom fitting.
                    </p>

                    <a href="{{ route('customer.custom-fittings.create') }}"
                       class="inline-flex items-center justify-center mt-6 px-5 py-3 rounded-xl bg-[#164A22] hover:bg-[#103719] text-white text-sm font-semibold transition">
                        Booking Custom Fitting
                    </a>

                </div>

            @endif

        </div>
    </div>

</x-dynamic-component>