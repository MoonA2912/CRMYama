
@php
    $profileLayout = auth()->user()->role === 'admin'
        ? 'app-layout'
        : 'customer-layout';
@endphp

<x-dynamic-component :component="$profileLayout">

    @if($profileLayout === 'app-layout')
        <x-slot name="header">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Profile') }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola informasi akun Anda.
                </p>
            </div>
        </x-slot>
    @endif

    <div class="min-h-screen bg-[#F7F7F5] py-10">
        <div class="max-w-5xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="mb-8">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#06330A]">
                    Yama Golf Store
                </p>

                <h1 class="text-3xl font-bold text-gray-900 mt-2">
                    Profil Saya
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Kelola informasi akun dan keamanan Anda.
                </p>
            </div>

            {{-- NOTIFIKASI BERHASIL MENYIMPAN PROFIL --}}
            @if(session('status') === 'profile-updated')
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4"
                     role="status">
                    <p class="text-sm font-medium text-green-800">
                        Profil berhasil diperbarui.
                    </p>
                </div>
            @endif

            {{-- MEMBERSHIP DAN BIRTHDAY VOUCHER UNTUK PELANGGAN --}}
            @if($profileLayout === 'customer-layout')

                @php
                    $membershipLabels = [
                        'none' => 'Yama Member',
                        'bronze' => 'Bronze Member',
                        'silver' => 'Silver Member',
                        'gold' => 'Gold Member',
                    ];

                    $membershipDiscounts = [
                        'none' => 0,
                        'bronze' => 5,
                        'silver' => 10,
                        'gold' => 15,
                    ];

                    $membershipLevel = $customer?->membership_level ?? 'none';

                    $membershipLabel = $membershipLabels[$membershipLevel] ?? 'Yama Member';
                    $membershipDiscount = $membershipDiscounts[$membershipLevel] ?? 0;

                    $totalTransaction = $customer
                        ? $customer->orders()
                            ->where('status', 'completed')
                            ->whereYear('order_date', now()->year)
                            ->sum('total_amount')
                        : 0;

                    $birthdayVouchers = $customer
                        ? $customer->vouchers()
                            ->where('type', 'birthday')
                            ->where('is_used', false)
                            ->whereDate('valid_until', '>=', today())
                            ->latest()
                            ->get()
                        : collect();
                @endphp

                {{-- MEMBERSHIP CARD --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]">
                                Membership
                            </p>

                            <h3 class="text-xl font-bold text-gray-900 mt-2">
                                {{ $membershipLabel }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Benefit membership Yama Golf Store
                            </p>
                        </div>

                        <div class="text-left sm:text-right">
                            <p class="text-xs text-gray-400">
                                Diskon transaksi
                            </p>

                            <p class="text-2xl font-bold text-[#06330A] mt-1">
                                {{ $membershipDiscount }}%
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 mt-6 pt-5">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                Total transaksi {{ now()->year }}
                            </span>

                            <span class="text-sm font-semibold text-gray-900">
                                Rp {{ number_format($totalTransaction, 0, ',', '.') }}
                            </span>
                        </div>

                        @if($membershipLevel === 'none')
                            <p class="text-xs text-gray-400 mt-3">
                                Capai total transaksi Rp5.000.000 dalam tahun berjalan
                                untuk mendapatkan Bronze Member.
                            </p>
                        @elseif($membershipLevel === 'bronze')
                            <p class="text-xs text-gray-400 mt-3">
                                Bronze Member mendapatkan diskon 5% untuk transaksi.
                            </p>
                        @elseif($membershipLevel === 'silver')
                            <p class="text-xs text-gray-400 mt-3">
                                Silver Member mendapatkan diskon 10% untuk transaksi.
                            </p>
                        @elseif($membershipLevel === 'gold')
                            <p class="text-xs text-gray-400 mt-3">
                                Gold Member mendapatkan diskon 15% untuk transaksi.
                            </p>
                        @endif
                    </div>
                </div>

                {{-- NOTIFIKASI PROFIL BELUM LENGKAP: DI BAWAH MEMBERSHIP CARD --}}
                @if(session('error'))
                    <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-5"
                         role="alert">
                        <div class="flex items-start gap-3">
                            <span class="text-xl" aria-hidden="true">⚠️</span>

                            <div>
                                <h3 class="font-semibold text-amber-900">
                                    Profil Belum Lengkap
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-amber-800">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- BIRTHDAY VOUCHER --}}
                @if($birthdayVouchers->count())
                    <div class="bg-white rounded-2xl border border-green-200 shadow-sm p-6 sm:p-8 mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]">
                                    Birthday Reward
                                </p>

                                <h3 class="text-xl font-bold text-gray-900 mt-2">
                                    Birthday Voucher 🎂
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Voucher spesial ulang tahun Anda dari Yama Golf Store.
                                </p>
                            </div>

                            <div class="text-left sm:text-right">
                                <p class="text-xs text-gray-400">
                                    Diskon
                                </p>

                                <p class="text-2xl font-bold text-[#06330A] mt-1">
                                    {{ rtrim(rtrim(number_format($birthdayVouchers->first()->discount_percent, 2, ',', '.'), '0'), ',') }}%
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 mt-6 pt-5">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <p class="text-xs text-gray-400">
                                        Kode voucher
                                    </p>

                                    <p class="text-lg font-bold tracking-wider text-gray-900 mt-1">
                                        {{ $birthdayVouchers->first()->code }}
                                    </p>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-xs text-gray-400">
                                        Berlaku sampai
                                    </p>

                                    <p class="text-sm font-semibold text-gray-900 mt-1">
                                        {{ $birthdayVouchers->first()->valid_until->format('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <p class="text-xs text-gray-400 mt-4">
                                Voucher dapat digunakan satu kali pada transaksi selama masa berlaku.
                            </p>
                        </div>
                    </div>
                @endif

            @endif

            {{-- PROFILE INFORMATION --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8 mb-6">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8 mb-6">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- DELETE ACCOUNT --}}
            <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-6 sm:p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

</x-dynamic-component>