<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Detail Produk
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap produk Yama Golf Store.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- PRODUCT CARD --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div
                    class="grid grid-cols-1
                           lg:grid-cols-2"
                >

                    {{-- IMAGE --}}
                    <div
                        class="bg-[#FAFAF8]
                               p-6 sm:p-8
                               flex items-center justify-center
                               min-h-[320px]"
                    >

                        <div
                            class="w-full max-w-md
                                   aspect-square
                                   rounded-2xl
                                   bg-white
                                   border border-gray-100
                                   overflow-hidden
                                   shadow-sm"
                        >

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                >

                            @else

                                <div
                                    class="w-full h-full
                                           flex flex-col
                                           items-center
                                           justify-center
                                           text-gray-300"
                                >

                                    <svg
                                        class="w-16 h-16"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2 1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-8h.01M5 20h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2-2Z"
                                        />
                                    </svg>

                                    <p class="text-sm mt-3">
                                        Belum ada foto produk
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- PRODUCT INFORMATION --}}
                    <div class="p-6 sm:p-8 lg:p-10">

                        {{-- CATEGORY + STATUS --}}
                        <div
                            class="flex flex-wrap
                                   items-center gap-2"
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

                        </div>


                        {{-- PRODUCT NAME --}}
                        <h1
                            class="text-2xl sm:text-3xl
                                   font-bold text-gray-900
                                   mt-5 leading-tight"
                        >
                            {{ $product->name }}
                        </h1>


                        {{-- PRICE --}}
                        <div class="mt-5">

                            <p class="text-xs text-gray-400">
                                Harga
                            </p>

                            <p
                                class="text-2xl sm:text-3xl
                                       font-bold
                                       text-[#06330A]
                                       mt-1"
                            >
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                        </div>


                        {{-- STOCK --}}
                        <div
                            class="mt-6
                                   p-4 rounded-xl
                                   bg-[#F7F7F5]"
                        >

                            <div
                                class="flex items-center
                                       justify-between gap-4"
                            >

                                <div>

                                    <p class="text-xs text-gray-400">
                                        Ketersediaan Stok
                                    </p>

                                    @if($product->stock <= 0)

                                        <p
                                            class="text-sm font-bold
                                                   text-red-600 mt-1"
                                        >
                                            Habis
                                        </p>

                                    @elseif($product->stock <= 5)

                                        <p
                                            class="text-sm font-bold
                                                   text-orange-600 mt-1"
                                        >
                                            {{ $product->stock }} tersisa
                                        </p>

                                    @else

                                        <p
                                            class="text-sm font-bold
                                                   text-gray-800 mt-1"
                                        >
                                            {{ $product->stock }} unit
                                        </p>

                                    @endif

                                </div>


                                <div
                                    class="w-10 h-10
                                           rounded-xl
                                           bg-white
                                           flex items-center
                                           justify-center"
                                >

                                    <svg
                                        class="w-5 h-5 text-[#06330A]"
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

                            </div>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="mt-7">

                            <h3
                                class="text-sm font-bold
                                       text-gray-900"
                            >
                                Deskripsi Produk
                            </h3>

                            <div
                                class="mt-3
                                       text-sm leading-6
                                       text-gray-600"
                            >
                                @if($product->description)

                                    {{ $product->description }}

                                @else

                                    <span class="text-gray-400">
                                        Belum ada deskripsi produk.
                                    </span>

                                @endif
                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div
                            class="flex flex-col-reverse
                                   sm:flex-row
                                   gap-3
                                   mt-8 pt-6
                                   border-t border-gray-100"
                        >

                            <a
                                href="{{ route('products.index') }}"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-gray-100
                                       text-gray-600
                                       text-sm font-semibold
                                       hover:bg-gray-200
                                       transition"
                            >
                                Kembali
                            </a>


                            <a
                                href="{{ route('products.edit', $product) }}"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-[#06330A]
                                       text-white
                                       text-sm font-semibold
                                       hover:bg-[#052808]
                                       transition shadow-sm"
                            >
                                Edit Produk
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>