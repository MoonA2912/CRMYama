<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Data Produk
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola produk dan ketersediaan barang dalam sistem CRM.
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
                        Daftar Produk
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Produk yang tersedia dalam katalog Yama Golf Store.
                    </p>

                </div>


                <a
                    href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-xl
                           bg-[#06330A]
                           text-white
                           text-sm font-semibold
                           hover:bg-[#052808]
                           transition shadow-sm"
                >
                    + Tambah Produk
                </a>

            </div>


            {{-- PRODUCT TABLE --}}
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
                                    Produk
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Kategori
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Harga
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-semibold
                                           text-gray-500 uppercase
                                           tracking-wider"
                                >
                                    Stok
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

                            @forelse ($products as $product)

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


                                    {{-- PRODUCT --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        <div class="flex items-center gap-3">

                                            {{-- IMAGE --}}
                                            <div
                                                class="w-12 h-12 rounded-xl
                                                       bg-[#F7F7F5]
                                                       border border-gray-100
                                                       overflow-hidden
                                                       flex-shrink-0"
                                            >

                                                @if($product->image)

                                                    <img
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-full h-full
                                                               object-cover"
                                                    >

                                                @else

                                                    <div
                                                        class="w-full h-full
                                                               flex items-center
                                                               justify-center"
                                                    >
                                                        <svg
                                                            class="w-6 h-6 text-gray-300"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.8"
                                                                d="m3 16 5-5 4 4 3-3 6 6M5 20h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"
                                                            />
                                                        </svg>
                                                    </div>

                                                @endif

                                            </div>


                                            <div>

                                                <p
                                                    class="text-sm font-semibold
                                                           text-gray-900"
                                                >
                                                    {{ $product->name }}
                                                </p>

                                                <p
                                                    class="text-xs text-gray-400
                                                           mt-0.5"
                                                >
                                                    Produk Yama Golf Store
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- CATEGORY --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        <span
                                            class="inline-flex
                                                   px-3 py-1 rounded-full
                                                   bg-green-50
                                                   text-[#06330A]
                                                   text-xs font-semibold"
                                        >
                                            {{ $product->category }}
                                        </span>

                                    </td>


                                    {{-- PRICE --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-sm font-semibold
                                               text-gray-900"
                                    >
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>


                                    {{-- STOCK --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap"
                                    >

                                        @if($product->stock <= 0)

                                            <span
                                                class="text-sm font-semibold
                                                       text-red-600"
                                            >
                                                Habis
                                            </span>

                                        @elseif($product->stock <= 5)

                                            <span
                                                class="text-sm font-semibold
                                                       text-orange-600"
                                            >
                                                {{ $product->stock }}
                                            </span>

                                            <span
                                                class="text-xs text-gray-400
                                                       ml-1"
                                            >
                                                tersisa
                                            </span>

                                        @else

                                            <span
                                                class="text-sm font-semibold
                                                       text-gray-700"
                                            >
                                                {{ $product->stock }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td
                                        class="px-6 py-4 whitespace-nowrap
                                               text-center"
                                    >

                                        @if($product->is_active)

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-green-50
                                                       text-green-700
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-green-500"
                                                ></span>

                                                Aktif
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5
                                                       px-3 py-1 rounded-full
                                                       bg-gray-100
                                                       text-gray-600
                                                       text-xs font-semibold"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-gray-400"
                                                ></span>

                                                Tidak Aktif
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
                                                href="{{ route('products.show', $product) }}"
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
                                                href="{{ route('products.edit', $product) }}"
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
                                                action="{{ route('products.destroy', $product) }}"
                                                method="POST"
                                                class="inline"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
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
                                                Belum ada data produk
                                            </p>


                                            <p
                                                class="text-xs text-gray-400
                                                       mt-1"
                                            >
                                                Tambahkan produk untuk mulai
                                                mengelola katalog Yama Golf Store.
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