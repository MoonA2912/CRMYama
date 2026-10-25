<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Tambah Produk
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan produk baru ke katalog Yama Golf Store.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                {{-- FORM HEADER --}}
                <div
                    class="px-6 py-6 sm:px-8
                           border-b border-gray-100"
                >

                    <div class="flex items-center gap-4">

                        <div
                            class="w-12 h-12 rounded-2xl
                                   bg-green-50
                                   text-[#06330A]
                                   flex items-center justify-center
                                   flex-shrink-0"
                        >
                            <svg
                                class="w-6 h-6"
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

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Informasi Produk
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Lengkapi informasi produk yang akan ditampilkan
                                dalam katalog.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FORM --}}
                <div class="p-6 sm:p-8">

                    <form
                        method="POST"
                        action="{{ route('products.store') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf


                        {{-- NAMA PRODUK --}}
                        <div class="mb-6">

                            <label
                                for="name"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Contoh: Titleist Pro V1 Golf Ball"
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       text-gray-900
                                       placeholder-gray-400
                                       shadow-sm
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >

                            @error('name')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- KATEGORI --}}
                        <div class="mb-6">

                            <label
                                for="category"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Kategori
                            </label>

                            <select
                                id="category"
                                name="category"
                                required
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       text-gray-900
                                       shadow-sm
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >

                                <option value="">
                                    Pilih kategori produk
                                </option>

                                <option
                                    value="Golf Club"
                                    {{ old('category') === 'Golf Club' ? 'selected' : '' }}
                                >
                                    Golf Club
                                </option>

                                <option
                                    value="Golf Ball"
                                    {{ old('category') === 'Golf Ball' ? 'selected' : '' }}
                                >
                                    Golf Ball
                                </option>

                                <option
                                    value="Golf Glove"
                                    {{ old('category') === 'Golf Glove' ? 'selected' : '' }}
                                >
                                    Golf Glove
                                </option>

                                <option
                                    value="Golf Equipment"
                                    {{ old('category') === 'Golf Equipment' ? 'selected' : '' }}
                                >
                                    Golf Equipment
                                </option>

                            </select>

                            <p class="text-xs text-gray-400 mt-2">
                                Produk dengan kategori Golf Ball dapat digunakan
                                untuk layanan Printed Golf Balls.
                            </p>

                            @error('category')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- HARGA + STOK --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">

                            {{-- HARGA --}}
                            <div>

                                <label
                                    for="price"
                                    class="block text-sm font-semibold
                                           text-gray-700 mb-2"
                                >
                                    Harga
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-4 top-1/2
                                               -translate-y-1/2
                                               text-sm font-medium
                                               text-gray-400"
                                    >
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="price"
                                        name="price"
                                        value="{{ old('price') }}"
                                        min="0"
                                        step="0.01"
                                        required
                                        placeholder="0"
                                        class="w-full rounded-xl
                                               border-gray-200
                                               bg-[#FAFAF8]
                                               text-gray-900
                                               placeholder-gray-400
                                               shadow-sm
                                               pl-12
                                               focus:border-[#06330A]
                                               focus:ring-[#06330A]"
                                    >

                                </div>

                                @error('price')
                                    <p class="text-sm text-red-600 mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- STOK --}}
                            <div>

                                <label
                                    for="stock"
                                    class="block text-sm font-semibold
                                           text-gray-700 mb-2"
                                >
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    min="0"
                                    required
                                    placeholder="0"
                                    class="w-full rounded-xl
                                           border-gray-200
                                           bg-[#FAFAF8]
                                           text-gray-900
                                           placeholder-gray-400
                                           shadow-sm
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                <p class="text-xs text-gray-400 mt-2">
                                    Masukkan jumlah stok yang tersedia.
                                </p>

                                @error('stock')
                                    <p class="text-sm text-red-600 mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- DESKRIPSI --}}
                        <div class="mb-6">

                            <label
                                for="description"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Deskripsi Produk
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Jelaskan spesifikasi atau informasi produk..."
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       text-gray-900
                                       placeholder-gray-400
                                       shadow-sm
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- FOTO PRODUK --}}
                        <div class="mb-6">

                            <label
                                for="image"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Foto Produk
                            </label>

                            <div
                                class="rounded-2xl
                                       border-2 border-dashed
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       p-6"
                            >

                                <div class="text-center">

                                    <div
                                        class="w-12 h-12 rounded-2xl
                                               bg-green-50
                                               text-[#06330A]
                                               flex items-center
                                               justify-center
                                               mx-auto"
                                    >
                                        <svg
                                            class="w-6 h-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2 1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-8h.01M5 20h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"
                                            />
                                        </svg>
                                    </div>

                                    <p class="text-sm font-semibold
                                              text-gray-700 mt-3">
                                        Upload foto produk
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        JPG, JPEG, PNG, atau WEBP · Maksimal 2 MB
                                    </p>

                                    <input
                                        type="file"
                                        id="image"
                                        name="image"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="mt-4 block w-full text-sm
                                               text-gray-500
                                               file:mr-4
                                               file:py-2
                                               file:px-4
                                               file:rounded-xl
                                               file:border-0
                                               file:text-sm
                                               file:font-semibold
                                               file:bg-green-50
                                               file:text-[#06330A]
                                               hover:file:bg-green-100"
                                    >

                                </div>

                            </div>

                            @error('image')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- STATUS --}}
                        <div class="mb-8">

                            <label
                                for="is_active"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Status Produk
                            </label>

                            <select
                                id="is_active"
                                name="is_active"
                                required
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       text-gray-900
                                       shadow-sm
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >

                                <option
                                    value="1"
                                    {{ old('is_active', '1') == '1' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    {{ old('is_active') == '0' ? 'selected' : '' }}
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                            <p class="text-xs text-gray-400 mt-2">
                                Produk aktif akan ditampilkan kepada pelanggan
                                dalam katalog.
                            </p>

                            @error('is_active')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- BUTTONS --}}
                        <div
                            class="flex flex-col-reverse
                                   sm:flex-row
                                   sm:items-center
                                   gap-3 pt-6
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
                                Batal
                            </a>


                            <button
                                type="submit"
                                class="inline-flex items-center
                                       justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-[#06330A]
                                       text-white
                                       text-sm font-semibold
                                       hover:bg-[#052808]
                                       transition shadow-sm"
                            >
                                Simpan Produk
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>