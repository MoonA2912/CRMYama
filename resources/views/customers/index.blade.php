<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Data Pelanggan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola informasi pelanggan dalam sistem CRM Yama Golf Store.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- PAGE HEADER --}}
            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between
                        gap-4 mb-7">

                <div>
                    <h3 class="text-xl font-bold text-gray-900">
                        Daftar Pelanggan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Data pelanggan yang terdaftar dalam sistem CRM.
                    </p>
                </div>


                <a
                    href="{{ route('customers.create') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-xl
                           bg-[#06330A] text-white
                           text-sm font-semibold
                           hover:bg-[#052808]
                           transition shadow-sm"
                >
                    + Tambah Pelanggan
                </a>

            </div>


            {{-- CUSTOMER TABLE --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-[#F7F7F5]">

                            <tr>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    No
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Nama
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    No. Telepon
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Alamat
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Tanggal Lahir
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Membership
                                </th>

                                <th
                                    class="px-6 py-4 text-center
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($customers as $customer)

                                <tr class="hover:bg-[#FAFAF8] transition">

                                    {{-- No --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-sm text-gray-500"
                                    >
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- Name --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >
                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 rounded-full
                                                       bg-[#06330A]
                                                       text-white
                                                       flex items-center
                                                       justify-center
                                                       text-sm font-semibold
                                                       flex-shrink-0"
                                            >
                                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <p
                                                    class="text-sm font-semibold
                                                           text-gray-900"
                                                >
                                                    {{ $customer->name }}
                                                </p>

                                                <p
                                                    class="text-xs text-gray-400
                                                           mt-0.5"
                                                >
                                                    Pelanggan
                                                </p>
                                            </div>

                                        </div>
                                    </td>


                                    {{-- Phone --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-sm text-gray-600"
                                    >
                                        {{ $customer->phone ?? '-' }}
                                    </td>


                                    {{-- Address --}}
                                    <td
                                        class="px-6 py-4
                                               text-sm text-gray-600
                                               max-w-xs"
                                    >
                                        <span class="line-clamp-2">
                                            {{ $customer->address ?? '-' }}
                                        </span>
                                    </td>


                                    {{-- Birth Date --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-sm text-gray-600"
                                    >
                                        @if($customer->birth_date)
                                            {{ $customer->birth_date->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>


                                    {{-- Membership --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        @switch($customer->membership_level)

                                            @case('bronze')
                                                <span
                                                    class="inline-flex items-center
                                                           px-3 py-1 rounded-full
                                                           text-xs font-semibold
                                                           bg-orange-50
                                                           text-orange-700"
                                                >
                                                    Bronze
                                                </span>
                                                @break

                                            @case('silver')
                                                <span
                                                    class="inline-flex items-center
                                                           px-3 py-1 rounded-full
                                                           text-xs font-semibold
                                                           bg-gray-100
                                                           text-gray-700"
                                                >
                                                    Silver
                                                </span>
                                                @break

                                            @case('gold')
                                                <span
                                                    class="inline-flex items-center
                                                           px-3 py-1 rounded-full
                                                           text-xs font-semibold
                                                           bg-yellow-50
                                                           text-yellow-700"
                                                >
                                                    Gold
                                                </span>
                                                @break

                                            @default
                                                <span
                                                    class="inline-flex items-center
                                                           px-3 py-1 rounded-full
                                                           text-xs font-semibold
                                                           bg-gray-50
                                                           text-gray-500"
                                                >
                                                    Non-Member
                                                </span>

                                        @endswitch

                                    </td>


                                    {{-- Actions --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-center"
                                    >

                                        <div
                                            class="flex items-center
                                                   justify-center gap-2"
                                        >

                                            <a
                                                href="{{ route('customers.show', $customer) }}"
                                                class="px-3 py-1.5 rounded-lg
                                                       bg-green-50
                                                       text-[#06330A]
                                                       text-xs font-semibold
                                                       hover:bg-green-100
                                                       transition"
                                            >
                                                Detail
                                            </a>


                                            <a
                                                href="{{ route('customers.edit', $customer) }}"
                                                class="px-3 py-1.5 rounded-lg
                                                       bg-gray-100
                                                       text-gray-600
                                                       text-xs font-semibold
                                                       hover:bg-gray-200
                                                       transition"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('customers.destroy', $customer) }}"
                                                method="POST"
                                                class="inline"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')"
                                                    class="px-3 py-1.5 rounded-lg
                                                           bg-red-50
                                                           text-red-600
                                                           text-xs font-semibold
                                                           hover:bg-red-100
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
                                        class="px-6 py-12 text-center"
                                    >

                                        <div class="max-w-sm mx-auto">

                                            <div
                                                class="w-12 h-12 rounded-2xl
                                                       bg-green-50
                                                       flex items-center
                                                       justify-center
                                                       mx-auto"
                                            >
                                                <svg
                                                    class="w-6 h-6 text-[#06330A]"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 10-6 0"
                                                    />
                                                </svg>
                                            </div>

                                            <p
                                                class="text-sm font-semibold
                                                       text-gray-800 mt-4"
                                            >
                                                Belum ada data pelanggan
                                            </p>

                                            <p
                                                class="text-xs text-gray-400
                                                       mt-1"
                                            >
                                                Tambahkan pelanggan untuk mulai
                                                mengelola data CRM.
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