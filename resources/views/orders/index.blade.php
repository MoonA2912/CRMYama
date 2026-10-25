<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola pesanan pelanggan dan status transaksi.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- PAGE HEADER --}}
            <div
                class="flex flex-col sm:flex-row
                       sm:items-center sm:justify-between
                       gap-4 mb-7"
            >

                <div>
                    <h3 class="text-xl font-bold text-gray-900">
                        Daftar Pesanan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Pantau transaksi pelanggan Yama Golf Store.
                    </p>
                </div>


                <a
                    href="{{ route('orders.create') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-xl
                           bg-[#06330A]
                           text-white
                           text-sm font-semibold
                           hover:bg-[#052808]
                           transition shadow-sm"
                >
                    + Tambah Pesanan
                </a>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div
                    class="mb-6
                           rounded-xl
                           border border-green-200
                           bg-green-50
                           px-5 py-4
                           text-sm text-green-700"
                >
                    {{ session('success') }}
                </div>

            @endif


            {{-- ORDERS TABLE --}}
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
                                    No. Pesanan
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Pelanggan
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Tanggal
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Total
                                </th>

                                <th
                                    class="px-6 py-4 text-center
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Status
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

                            @forelse ($orders as $order)

                                <tr
                                    class="hover:bg-[#FAFAF8]
                                           transition"
                                >

                                    {{-- NO --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-sm text-gray-500"
                                    >
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- ORDER NUMBER --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        <p
                                            class="text-sm font-semibold
                                                   text-[#06330A]"
                                        >
                                            {{ $order->order_number }}
                                        </p>

                                    </td>


                                    {{-- CUSTOMER --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 rounded-full
                                                       bg-green-50
                                                       text-[#06330A]
                                                       flex items-center
                                                       justify-center
                                                       text-xs font-bold"
                                            >
                                                {{ strtoupper(
                                                    substr(
                                                        $order->customer->name ?? '-',
                                                        0,
                                                        1
                                                    )
                                                ) }}
                                            </div>

                                            <div>

                                                <p
                                                    class="text-sm font-semibold
                                                           text-gray-800"
                                                >
                                                    {{ $order->customer->name ?? '-' }}
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


                                    {{-- DATE --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        <p
                                            class="text-sm text-gray-700"
                                        >
                                            {{ $order->order_date->format('d/m/Y') }}
                                        </p>

                                        <p
                                            class="text-xs text-gray-400
                                                   mt-0.5"
                                        >
                                            {{ $order->order_date->format('H:i') }}
                                        </p>

                                    </td>


                                    {{-- TOTAL --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        <p
                                            class="text-sm font-semibold
                                                   text-gray-900"
                                        >
                                            Rp {{ number_format(
                                                $order->total_amount,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>

                                    </td>


                                    {{-- STATUS --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-center"
                                    >

                                        @if($order->status === 'completed')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-green-50
                                                       text-green-700
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                           bg-green-500"
                                                ></span>

                                                Selesai
                                            </span>

                                        @elseif($order->status === 'cancelled')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-red-50
                                                       text-red-600
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                           bg-red-500"
                                                ></span>

                                                Dibatalkan
                                            </span>

                                        @elseif($order->status === 'paid')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-blue-50
                                                       text-blue-700
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                           bg-blue-500"
                                                ></span>

                                                Dibayar
                                            </span>

                                        @elseif($order->status === 'processing')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-orange-50
                                                       text-orange-700
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                           bg-orange-500"
                                                ></span>

                                                Diproses
                                            </span>

                                        @elseif($order->status === 'shipped')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-purple-50
                                                       text-purple-700
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                           bg-purple-500"
                                                ></span>

                                                Dikirim
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-yellow-50
                                                       text-yellow-700
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                           bg-yellow-500"
                                                ></span>

                                                {{ ucfirst($order->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-center"
                                    >

                                        <div
                                            class="flex items-center
                                                   justify-center gap-2"
                                        >

                                            <a
                                                href="{{ route('orders.show', $order) }}"
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
                                                href="{{ route('orders.edit', $order) }}"
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
                                                action="{{ route('orders.destroy', $order) }}"
                                                method="POST"
                                                class="inline"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')"
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
                                                        d="M20 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2ZM8 7V5a4 4 0 0 1 8 0v2"
                                                    />
                                                </svg>

                                            </div>


                                            <p
                                                class="text-sm font-semibold
                                                       text-gray-800 mt-4"
                                            >
                                                Belum ada data pesanan
                                            </p>


                                            <p
                                                class="text-xs text-gray-400
                                                       mt-1"
                                            >
                                                Pesanan pelanggan akan muncul
                                                di halaman ini.
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