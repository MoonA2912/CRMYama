<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mt-1">
            Custom Fitting
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Kelola booking dan riwayat custom fitting pelanggan.
        </p>
    </div>
</x-slot>


<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

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

            {{-- Card Header --}}
            <div class="px-6 py-5 border-b border-gray-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-[#06330A]/10 flex items-center justify-center">

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
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                                       M9 5a3 3 0 006 0M9 5h6"
                                />
                            </svg>

                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Data Custom Fitting
                            </h3>

                            <p class="text-xs text-gray-500 mt-0.5">
                                Daftar booking dan riwayat fitting pelanggan.
                            </p>
                        </div>

                    </div>


                    {{-- Add Button --}}
                    <a
                        href="{{ route('custom-fittings.create') }}"
                        class="inline-flex items-center justify-center gap-2
                               px-4 py-2.5
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
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        Tambah Custom Fitting

                    </a>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                No
                            </th>

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                Pelanggan
                            </th>

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                Tanggal
                            </th>

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                Jam
                            </th>

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                Jenis Fitting
                            </th>

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                Status
                            </th>

                            <th class="px-5 py-4 text-left font-semibold text-gray-600 whitespace-nowrap">
                                Aksi
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse ($customFittings as $fitting)

                            @php

                                $statusClasses = match($fitting->status) {
                                    'pending' =>
                                        'bg-amber-50 text-amber-700 border border-amber-200',

                                    'confirmed' =>
                                        'bg-blue-50 text-blue-700 border border-blue-200',

                                    'completed' =>
                                        'bg-green-50 text-green-700 border border-green-200',

                                    'cancelled',
                                    'rejected' =>
                                        'bg-red-50 text-red-700 border border-red-200',

                                    default =>
                                        'bg-gray-100 text-gray-700 border border-gray-200',
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


                            <tr class="hover:bg-gray-50/70 transition">


                                {{-- No --}}
                                <td class="px-5 py-5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- Customer --}}
                                <td class="px-5 py-5">

                                    <div class="flex items-center gap-3 min-w-[180px]">

                                        <div class="w-10 h-10 rounded-full bg-[#06330A]/10
                                                    flex items-center justify-center
                                                    text-sm font-bold text-[#06330A]">
                                            {{ strtoupper(substr($fitting->customer->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $fitting->customer->name }}
                                            </p>

                                            @if($fitting->customer->phone)

                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $fitting->customer->phone }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Date --}}
                                <td class="px-5 py-5 whitespace-nowrap">

                                    <p class="font-medium text-gray-800">
                                        {{ $fitting->fitting_date->format('d/m/Y') }}
                                    </p>

                                </td>


                                {{-- Time --}}
                                <td class="px-5 py-5 whitespace-nowrap">

                                    @if($fitting->booking_time)

                                        <span class="inline-flex items-center gap-1.5 text-gray-700">

                                            <svg
                                                class="w-4 h-4 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>

                                            {{ \Carbon\Carbon::parse($fitting->booking_time)->format('H:i') }}

                                        </span>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- Type --}}
                                <td class="px-5 py-5">

                                    @if($fitting->fitting_type)

                                        <span class="inline-flex items-center px-3 py-1
                                                     rounded-lg
                                                     bg-[#06330A]/5
                                                     text-[#06330A]
                                                     text-xs font-semibold">
                                            {{ $fitting->fitting_type }}
                                        </span>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-5 whitespace-nowrap">

                                    <span
                                        class="inline-flex items-center px-3 py-1.5
                                               rounded-full
                                               text-xs font-semibold
                                               {{ $statusClasses }}"
                                    >
                                        {{ $statusLabel }}
                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-5">

                                    <div class="flex flex-wrap items-center gap-2">

                                        {{-- Confirm --}}
                                        @if($fitting->status === 'pending')

                                            <form
                                                action="{{ route('custom-fittings.confirm', $fitting) }}"
                                                method="POST"
                                                onsubmit="return confirm('Konfirmasi booking custom fitting ini?')"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-1.5
                                                           bg-[#06330A]
                                                           hover:bg-[#052807]
                                                           text-white
                                                           text-xs font-semibold
                                                           rounded-lg
                                                           transition"
                                                >

                                                    <svg
                                                        class="w-4 h-4"
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

                                                    Konfirmasi

                                                </button>

                                            </form>

                                        @endif


                                        {{-- Detail --}}
                                        <a
                                            href="{{ route('custom-fittings.show', $fitting) }}"
                                            class="inline-flex items-center
                                                   px-3 py-1.5
                                                   bg-gray-100
                                                   hover:bg-gray-200
                                                   text-gray-700
                                                   text-xs font-semibold
                                                   rounded-lg
                                                   transition"
                                        >
                                            Detail
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('custom-fittings.edit', $fitting) }}"
                                            class="inline-flex items-center
                                                   px-3 py-1.5
                                                   bg-gray-100
                                                   hover:bg-gray-200
                                                   text-gray-700
                                                   text-xs font-semibold
                                                   rounded-lg
                                                   transition"
                                        >
                                            Edit
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('custom-fittings.destroy', $fitting) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data custom fitting ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center
                                                       px-3 py-1.5
                                                       bg-red-50
                                                       hover:bg-red-100
                                                       text-red-600
                                                       text-xs font-semibold
                                                       rounded-lg
                                                       transition"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="w-14 h-14 rounded-2xl
                                                    bg-[#06330A]/10
                                                    flex items-center justify-center
                                                    mb-4">

                                            <svg
                                                class="w-7 h-7 text-[#06330A]"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                                                       M9 5a3 3 0 006 0"
                                                />
                                            </svg>

                                        </div>

                                        <p class="font-semibold text-gray-900">
                                            Belum ada data custom fitting
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Data booking dan riwayat fitting akan muncul di sini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


</x-app-layout>
