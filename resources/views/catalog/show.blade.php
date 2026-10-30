@php
    $catalogLayout = auth()->user()->role === 'admin'
        ? 'app-layout'
        : 'customer-layout';
@endphp

<x-dynamic-component :component="$catalogLayout">

    @if($catalogLayout === 'app-layout')

        <x-slot name="header">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Produk
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi produk dan pemesanan.
                </p>
            </div>

        </x-slot>

    @endif


    <div class="min-h-screen bg-[#F7F7F5] py-10">

        <div class="max-w-6xl mx-auto px-6 lg:px-8">


            {{-- FLASH MESSAGE --}}
            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>

            @endif


            {{-- VALIDATION ERROR --}}
            @if($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl">

                    <ul class="list-disc list-inside text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- BREADCRUMB --}}
            <div class="mb-5">

                <a
                    href="{{ route('catalog') }}"
                    class="text-sm text-gray-500 hover:text-[#06330A] transition"
                >
                    ← Kembali ke Katalog
                </a>

            </div>


            {{-- PRODUCT DETAIL --}}
            <div class="bg-white rounded-3xl border border-gray-200
                        overflow-hidden shadow-sm">

                <div class="grid grid-cols-1 lg:grid-cols-2">


                    {{-- =========================
                        GAMBAR PRODUK
                    ========================== --}}
                    <div class="bg-[#F7F7F5] p-8 lg:p-12
                                flex items-center justify-center">

                        <div class="w-full aspect-square max-w-lg
                                    bg-white rounded-2xl
                                    flex items-center justify-center
                                    overflow-hidden">

                            @if($product->image)

                                <img
                                    src="{{ \App\Support\StoredMediaUrl::resolve($product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain
                                           p-8 transition duration-300
                                           hover:scale-105"
                                >

                            @else

                                <div class="text-gray-400 text-sm">
                                    Tidak ada gambar produk
                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- =========================
                        INFORMASI PRODUK
                    ========================== --}}
                    <div class="p-8 lg:p-12">


                        {{-- CATEGORY --}}
                        <p class="text-xs font-semibold
                                  text-[#06330A]
                                  uppercase tracking-[0.18em]">

                            {{ $product->category }}

                        </p>


                        {{-- NAME --}}
                        <h1 class="text-3xl lg:text-4xl
                                   font-semibold text-gray-900
                                   mt-3 leading-tight">

                            {{ $product->name }}

                        </h1>


                        {{-- PRICE --}}
                        <p class="text-2xl font-semibold
                                  text-[#06330A] mt-5">

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </p>


                        {{-- DESCRIPTION --}}
                        @if($product->description)

                            <div class="mt-7">

                                <p class="text-sm font-semibold text-gray-900 mb-2">
                                    Deskripsi
                                </p>

                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ $product->description }}
                                </p>

                            </div>

                        @endif


                        {{-- STOCK --}}
                        <div class="mt-6">

                            @if($product->stock > 0)

                                <span
                                    class="inline-flex items-center
                                           px-3 py-1.5 rounded-full
                                           bg-green-50 text-green-700
                                           text-xs font-medium"
                                >
                                    Stok tersedia: {{ $product->stock }}
                                </span>

                            @else

                                <span
                                    class="inline-flex items-center
                                           px-3 py-1.5 rounded-full
                                           bg-red-50 text-red-700
                                           text-xs font-medium"
                                >
                                    Stok habis
                                </span>

                            @endif

                        </div>


                        {{-- =========================
                            ADD TO CART
                        ========================== --}}
                        @if($product->stock > 0)

                            <form
                                action="{{ route('cart.add', $product) }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="mt-7"
                            >

                                @csrf


                                {{-- QUANTITY --}}
                                <div>

                                    <label
                                        for="quantity"
                                        class="block text-sm font-medium
                                               text-gray-700 mb-2"
                                    >
                                        Jumlah
                                    </label>


                                    <div class="flex items-center w-36">

                                        <button
                                            type="button"
                                            onclick="decreaseQuantity()"
                                            class="w-10 h-10
                                                   border border-gray-300
                                                   rounded-l-lg
                                                   bg-gray-50
                                                   hover:bg-gray-100
                                                   text-gray-700"
                                        >
                                            −
                                        </button>


                                        <input
                                            type="number"
                                            name="quantity"
                                            id="quantity"
                                            value="1"
                                            min="1"
                                            max="{{ $product->stock }}"
                                            class="w-16 h-10
                                                   text-center
                                                   border-t border-b
                                                   border-gray-300
                                                   focus:ring-0
                                                   focus:border-gray-300"
                                        >


                                        <button
                                            type="button"
                                            onclick="increaseQuantity()"
                                            class="w-10 h-10
                                                   border border-gray-300
                                                   rounded-r-lg
                                                   bg-gray-50
                                                   hover:bg-gray-100
                                                   text-gray-700"
                                        >
                                            +
                                        </button>

                                    </div>

                                </div>


                                {{-- =========================
                                    PRINTED GOLF BALL
                                ========================== --}}
                                @if($product->category === 'Golf Ball')

                                    <div class="mt-6 border border-gray-200
                                                rounded-2xl p-5">

                                        <div class="flex items-start gap-3">

                                            <input
                                                type="checkbox"
                                                name="print_custom"
                                                id="print_custom"
                                                value="1"
                                                onchange="togglePrintOption()"
                                                class="mt-1 rounded
                                                       border-gray-300
                                                       text-[#06330A]
                                                       focus:ring-[#06330A]"
                                            >


                                            <div class="flex-1">

                                                <label
                                                    for="print_custom"
                                                    class="text-sm font-semibold
                                                           text-gray-900
                                                           cursor-pointer"
                                                >
                                                    🎨 Printed Golf Balls
                                                </label>


                                                <p class="text-xs text-gray-500 mt-1">
                                                    Tambahkan custom print pada golf ball.
                                                </p>


                                                <p class="text-xs font-medium
                                                          text-gray-700 mt-2">
                                                    Biaya: Rp 5.000 per bola
                                                </p>

                                            </div>

                                        </div>


                                        {{-- UPLOAD DESIGN --}}
                                        <div
                                            id="design-container"
                                            class="hidden mt-5"
                                        >

                                            <label
                                                for="design_image"
                                                class="block text-sm font-medium
                                                       text-gray-700 mb-2"
                                            >
                                                Upload Desain
                                            </label>


                                            <input
                                                type="file"
                                                name="design_image"
                                                id="design_image"
                                                accept=".jpg,.jpeg,.png,.webp"
                                                class="block w-full text-sm
                                                       text-gray-600
                                                       border border-gray-300
                                                       rounded-lg px-3 py-2"
                                            >


                                            <p class="text-xs text-gray-400 mt-2">
                                                JPG, JPEG, PNG, atau WEBP.
                                                Maksimal 2 MB.
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                {{-- ADD TO CART BUTTON --}}
                                <button
                                    type="submit"
                                    class="w-full mt-6 px-5 py-3.5
                                           rounded-xl
                                           bg-[#06330A]
                                           hover:bg-[#06330A]/90
                                           text-white text-sm
                                           font-medium
                                           transition"
                                >
                                    Tambahkan ke Keranjang
                                </button>


                            </form>

                        @else

                            <button
                                disabled
                                class="w-full mt-7 px-5 py-3.5
                                       rounded-xl
                                       bg-gray-200 text-gray-400
                                       text-sm font-medium
                                       cursor-not-allowed"
                            >
                                Stok Habis
                            </button>

                        @endif


                        {{-- BACK --}}
                        <a
                            href="{{ route('catalog') }}"
                            class="block w-full mt-3 px-5 py-3.5
                                   rounded-xl
                                   border border-gray-300
                                   text-gray-700 text-sm font-medium
                                   text-center
                                   hover:bg-gray-50 transition"
                        >
                            Kembali ke Katalog
                        </a>


                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        JAVASCRIPT
    ========================== --}}
    <script>

        function togglePrintOption() {

            const checkbox =
                document.getElementById('print_custom');

            const container =
                document.getElementById('design-container');

            const designInput =
                document.getElementById('design_image');


            if (!checkbox || !container || !designInput) {
                return;
            }


            if (checkbox.checked) {

                container.classList.remove('hidden');

                designInput.required = true;

            } else {

                container.classList.add('hidden');

                designInput.required = false;

                designInput.value = '';

            }

        }


        function increaseQuantity() {

            const input =
                document.getElementById('quantity');

            const max =
                parseInt(input.max);

            let value =
                parseInt(input.value) || 1;


            if (value < max) {

                input.value = value + 1;

            }

        }


        function decreaseQuantity() {

            const input =
                document.getElementById('quantity');

            let value =
                parseInt(input.value) || 1;


            if (value > 1) {

                input.value = value - 1;

            }

        }

    </script>

</x-dynamic-component>