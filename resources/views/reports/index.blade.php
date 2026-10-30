<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#06330A]/60">
                    Yama Golf Store
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#06330A]">
                    Laporan & Analisis Bisnis
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Ringkasan data pelanggan, transaksi, produk, feedback, dan layanan.
                </p>
            </div>

            <form
                method="GET"
                action="{{ route('reports.index') }}"
                class="flex items-center gap-3"
            >
                <label
                    for="year"
                    class="text-sm font-medium text-gray-600"
                >
                    Tahun
                </label>

                <select
                    name="year"
                    id="year"
                    onchange="this.form.submit()"
                    class="rounded-xl border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                >
                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                        <option
                            value="{{ $y }}"
                            {{ (int) $year === $y ? 'selected' : '' }}
                        >
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </form>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F7F7F5] py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- INTRO --}}
            <div class="mb-8">
                <div class="rounded-3xl bg-[#06330A] p-6 text-white shadow-sm sm:p-8">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                        <div class="max-w-2xl">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/60">
                                Ringkasan Bisnis
                            </p>

                            <h1 class="mt-2 text-2xl font-bold tracking-tight sm:text-3xl">
                                Insight Bisnis Yama Golf Store
                            </h1>

                            <p class="mt-3 max-w-xl text-sm leading-6 text-white/75">
                                Gunakan data pelanggan, transaksi, produk, feedback, dan layanan
                                untuk memahami kondisi bisnis serta mendukung evaluasi penjualan.
                            </p>
                        </div>

                        <div class="hidden lg:flex h-20 w-20 items-center justify-center rounded-2xl bg-white/10">
                            <svg
                                class="h-10 w-10 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M3 3v18h18M7 16l4-5 3 3 5-7"
                                />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>

            {{-- RINGKASAN --}}
            <div class="mb-8">
                <div class="mb-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                        Ringkasan
                    </p>

                    <h3 class="mt-1 text-lg font-bold text-[#06330A]">
                        Ikhtisar Data {{ $year }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- TOTAL PELANGGAN --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Total Pelanggan
                                </p>

                                <p class="mt-3 text-3xl font-bold text-[#06330A]">
                                    {{ $totalCustomers }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Seluruh pelanggan terdaftar
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#06330A]/10">
                                <svg
                                    class="h-5 w-5 text-[#06330A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8zm6 4a3 3 0 10-6 0"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL PESANAN --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Pesanan {{ $year }}
                                </p>

                                <p class="mt-3 text-3xl font-bold text-[#06330A]">
                                    {{ $totalOrders }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Seluruh status pesanan
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#06330A]/10">
                                <svg
                                    class="h-5 w-5 text-[#06330A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M9 5h6M9 3h6a2 2 0 012 2v1h1a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h1V5a2 2 0 012-2zM8 11h8M8 15h5"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- PESANAN SELESAI --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Pesanan Selesai
                                </p>

                                <p class="mt-3 text-3xl font-bold text-[#06330A]">
                                    {{ $completedOrders }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Transaksi completed {{ $year }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                                <svg
                                    class="h-5 w-5 text-emerald-700"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M5 12l4 4L19 6"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL PENJUALAN --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">
                                    Total Penjualan
                                </p>

                                <p class="mt-3 text-2xl font-bold text-[#06330A]">
                                    Rp {{ number_format($totalSales, 0, ',', '.') }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Dari pesanan selesai
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#06330A]/10">
                                <svg
                                    class="h-5 w-5 text-[#06330A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M12 8c-2.5 0-4 1-4 2.5S9.5 13 12 13s4 1 4 2.5S14.5 18 12 18m0-12v12m7-6a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- PENJUALAN BULANAN --}}
            <div class="mb-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                            Sales Analytics
                        </p>

                        <h3 class="mt-1 text-xl font-bold text-[#06330A]">
                            Tren Penjualan Bulanan
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Total penjualan dari transaksi yang telah selesai pada tahun {{ $year }}.
                        </p>
                    </div>

                    <div class="rounded-full bg-[#06330A]/5 px-3 py-1.5 text-xs font-medium text-[#06330A]">
                        Tahun {{ $year }}
                    </div>
                </div>

                <div class="relative h-80">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>

            {{-- MEMBERSHIP + FEEDBACK --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- MEMBERSHIP --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                    <div class="mb-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                            Customer Analytics
                        </p>

                        <h3 class="mt-1 text-xl font-bold text-[#06330A]">
                            Distribusi Membership
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Jumlah pelanggan berdasarkan tingkat membership.
                        </p>
                    </div>

                    <div class="relative h-64">
                        <canvas id="membershipChart"></canvas>
                    </div>

                    <div class="mt-6 divide-y divide-gray-100 rounded-xl border border-gray-100">

                        <div class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-gray-300"></span>
                                <span class="text-sm text-gray-600">Non-Member</span>
                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $membership['none'] ?? 0 }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                                <span class="text-sm text-gray-600">Bronze</span>
                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $membership['bronze'] ?? 0 }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                <span class="text-sm text-gray-600">Silver</span>
                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $membership['silver'] ?? 0 }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-yellow-500"></span>
                                <span class="text-sm text-gray-600">Gold</span>
                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $membership['gold'] ?? 0 }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- FEEDBACK --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                    <div class="mb-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                            Customer Feedback
                        </p>

                        <h3 class="mt-1 text-xl font-bold text-[#06330A]">
                            Analisis Feedback
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Ringkasan feedback pelanggan pada tahun {{ $year }}.
                        </p>
                    </div>

                    <div class="relative mb-6 h-64">
                        <canvas id="ratingChart"></canvas>
                    </div>

                    <div class="rounded-xl bg-[#F7F7F5] p-4">
                        <div class="flex items-start gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#06330A]/10">
                                <svg
                                    class="h-4 w-4 text-[#06330A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-[#06330A]">
                                    Insight Feedback
                                </p>

                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    {{ $feedbackInsight }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-4">

                        <div class="rounded-xl border border-gray-100 p-4">
                            <p class="text-xs text-gray-500">
                                Jumlah Feedback
                            </p>

                            <p class="mt-1 text-2xl font-bold text-[#06330A]">
                                {{ $feedbackCount }}
                            </p>
                        </div>

                        <div class="rounded-xl border border-gray-100 p-4">
                            <p class="text-xs text-gray-500">
                                Rata-rata Rating
                            </p>

                            <p class="mt-1 text-2xl font-bold text-[#06330A]">
                                {{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                                <span class="text-sm font-medium text-gray-400">/ 5</span>
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            {{-- PRODUK + CUSTOM FITTING --}}
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- PRODUK TERLARIS --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:col-span-2">

                    <div class="mb-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                            Product Analytics
                        </p>

                        <h3 class="mt-1 text-xl font-bold text-[#06330A]">
                            Produk Terlaris
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Berdasarkan jumlah produk yang terjual pada tahun {{ $year }}.
                        </p>
                    </div>

                    @if ($bestSellingProducts->count())

                        <div class="overflow-hidden rounded-xl border border-gray-100">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-[#F7F7F5]">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold text-gray-500">
                                                Produk
                                            </th>

                                            <th class="px-4 py-3 text-right font-semibold text-gray-500">
                                                Terjual
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach ($bestSellingProducts as $item)
                                            <tr class="transition hover:bg-[#F7F7F5]">
                                                <td class="px-4 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#06330A]/10">
                                                            <svg
                                                                class="h-4 w-4 text-[#06330A]"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="1.6"
                                                                    d="M6 4h12M7 4v4a5 5 0 0010 0V4M8 20h8M12 13v7"
                                                                />
                                                            </svg>
                                                        </div>

                                                        <span class="font-medium text-gray-800">
                                                            {{ $item->product->name ?? 'Produk dihapus' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td class="px-4 py-4 text-right">
                                                    <span class="rounded-full bg-[#06330A]/5 px-3 py-1 text-xs font-semibold text-[#06330A]">
                                                        {{ $item->total_quantity }} unit
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @else

                        <div class="rounded-xl bg-[#F7F7F5] p-5">
                            <p class="text-sm text-gray-500">
                                Belum ada data penjualan selesai pada tahun {{ $year }}.
                            </p>
                        </div>

                    @endif

                </div>

                {{-- CUSTOM FITTING --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                        Service Analytics
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-[#06330A]">
                        Layanan Custom Fitting
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Jumlah layanan custom fitting pada tahun {{ $year }}.
                    </p>

                    <div class="mt-8 rounded-2xl bg-[#06330A] p-6 text-white">
                        <p class="text-sm text-white/65">
                            Total Custom Fitting
                        </p>

                        <p class="mt-2 text-4xl font-bold">
                            {{ $customFittingCount }}
                        </p>

                        <p class="mt-2 text-xs text-white/60">
                            Layanan tercatat pada {{ $year }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- Business insights --}}
            <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                <div class="flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#06330A]/10">
                        <svg
                            class="h-5 w-5 text-[#06330A]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M9 17v-2a4 4 0 014-4h2m0 0V7m0 4l-3-3m3 3l3-3M5 21h14a2 2 0 002-2V7.5a2 2 0 00-.59-1.41l-3.5-3.5A2 2 0 0015.5 2H5a2 2 0 00-2 2v15a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]/60">
                            Analisis Penjualan
                        </p>

                        <h3 class="mt-1 text-xl font-bold text-[#06330A]">
                            Insight Analisis Produk
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Interpretasi berdasarkan data transaksi tahun {{ $year }}.
                        </p>
                    </div>

                </div>

                <div class="mt-6">

                    @if ($topProduct)

                        <div class="rounded-2xl bg-[#F7F7F5] p-5">

                            <p class="text-sm leading-7 text-gray-600">
                                Hasil analisis menunjukkan bahwa
                                <span class="font-semibold text-[#06330A]">
                                    {{ $topProduct->product->name ?? 'Produk dihapus' }}
                                </span>
                                merupakan produk dengan jumlah penjualan tertinggi pada tahun
                                {{ $year }}.
                            </p>

                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                                <div class="rounded-xl border border-gray-200 bg-white p-4">
                                    <p class="text-xs text-gray-500">
                                        Jumlah Terjual
                                    </p>

                                    <p class="mt-1 text-2xl font-bold text-[#06330A]">
                                        {{ $topProduct->total_quantity }}
                                        <span class="text-sm font-medium text-gray-400">
                                            unit
                                        </span>
                                    </p>
                                </div>

                                <div class="rounded-xl border border-gray-200 bg-white p-4">
                                    <p class="text-xs text-gray-500">
                                        Pemanfaatan Informasi
                                    </p>

                                    <p class="mt-1 text-sm leading-6 text-gray-600">
                                        Bahan evaluasi stok dan strategi penjualan.
                                    </p>
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="rounded-xl bg-[#F7F7F5] p-5">
                            <p class="text-sm text-gray-500">
                                Belum tersedia data transaksi selesai untuk menghasilkan insight produk.
                            </p>
                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>

    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // =========================
        // GRAFIK PENJUALAN BULANAN
        // =========================

        const monthlySales = @json($monthlySales);
        const salesData = [];

        for (let month = 1; month <= 12; month++) {
            salesData.push(monthlySales[month] ?? 0);
        }

        new Chart(document.getElementById('monthlySalesChart'), {
            type: 'bar',

            data: {
                labels: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Agu',
                    'Sep',
                    'Okt',
                    'Nov',
                    'Des'
                ],

                datasets: [{
                    label: 'Penjualan',
                    data: salesData,
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            callback: function(value) {
                                return 'Rp ' +
                                    new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' +
                                    new Intl.NumberFormat('id-ID')
                                        .format(context.raw);
                            }
                        }
                    }
                }
            }
        });


        // =========================
        // GRAFIK MEMBERSHIP
        // =========================

        const membershipData = {
            labels: [
                'Non-Member',
                'Bronze',
                'Silver',
                'Gold'
            ],

            values: [
                {{ $membership['none'] ?? 0 }},
                {{ $membership['bronze'] ?? 0 }},
                {{ $membership['silver'] ?? 0 }},
                {{ $membership['gold'] ?? 0 }}
            ]
        };

        new Chart(document.getElementById('membershipChart'), {
            type: 'pie',

            data: {
                labels: membershipData.labels,

                datasets: [{
                    data: membershipData.values,
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });


        // =========================
        // GRAFIK RATING FEEDBACK
        // =========================

        const ratingData = {
            labels: [
                '1 Bintang',
                '2 Bintang',
                '3 Bintang',
                '4 Bintang',
                '5 Bintang'
            ],

            values: [
                {{ $ratingDistribution[1] ?? 0 }},
                {{ $ratingDistribution[2] ?? 0 }},
                {{ $ratingDistribution[3] ?? 0 }},
                {{ $ratingDistribution[4] ?? 0 }},
                {{ $ratingDistribution[5] ?? 0 }}
            ]
        };

        new Chart(document.getElementById('ratingChart'), {
            type: 'bar',

            data: {
                labels: ratingData.labels,

                datasets: [{
                    label: 'Jumlah Feedback',
                    data: ratingData.values,
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            stepSize: 1
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

</x-app-layout>