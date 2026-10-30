<x-customer-layout>


<div class="min-h-screen bg-[#F7F7F5] py-8">
    <div class="max-w-3xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-green-700">
                Yama Golf Store
            </p>

            <h1 class="mt-2 text-2xl font-semibold text-[#06330A]">
                Beri Feedback
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Sampaikan pengalaman Anda terhadap pesanan.
            </p>
        </div>

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 px-4 py-3 rounded-2xl">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($order)

            {{-- DETAIL PESANAN --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center
                                sm:justify-between gap-3">

                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Pesanan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-900">
                                {{ $order->order_number }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ $order->order_date->format('d M Y, H:i') }}
                            </p>
                        </div>

                        <span class="inline-flex items-center px-3 py-1.5
                                     rounded-full bg-green-50 text-green-700
                                     text-xs font-semibold w-fit">
                            Pesanan Selesai
                        </span>

                    </div>
                </div>

                {{-- PRODUK --}}
                <div class="px-6 py-5">

                    <p class="text-sm font-semibold text-gray-800 mb-4">
                        Produk dalam Pesanan
                    </p>

                    <div class="space-y-4">

                        @foreach ($order->items as $item)

                            <div class="flex gap-4 p-4 rounded-xl
                                        border border-gray-100 bg-gray-50">

                                {{-- GAMBAR PRODUK --}}
                                <div class="w-20 h-20 flex-shrink-0
                                            rounded-xl overflow-hidden
                                            bg-white border border-gray-200">

                                    @if ($item->product?->image)
                                        <img
                                            src="{{ \App\Support\StoredMediaUrl::resolve($item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center
                                                    justify-center text-gray-300">
                                            <svg class="w-8 h-8"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.5"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif

                                </div>

                                {{-- INFORMASI PRODUK --}}
                                <div class="min-w-0 flex-1">

                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $item->product?->name ?? 'Produk' }}
                                    </p>

                                    <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1">
                                        <span class="text-xs text-gray-500">
                                            {{ $item->quantity }} ×
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>

                                        @if ($item->print_custom)
                                            <span class="inline-flex items-center
                                                         px-2 py-1 rounded-lg
                                                         bg-green-50 text-green-700
                                                         text-[11px] font-semibold">
                                                Custom Print
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-2 text-sm font-semibold text-gray-900">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    {{-- TOTAL --}}
                    <div class="mt-5 pt-4 border-t border-gray-100
                                flex items-center justify-between">

                        <span class="text-sm text-gray-500">
                            Total Pesanan
                        </span>

                        <span class="text-base font-bold text-[#06330A]">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>

                    </div>

                </div>
            </div>


            {{-- FORM FEEDBACK --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm p-6">

                <input
                    type="hidden"
                    name="order_id"
                    value="{{ $order->id }}"
                    form="feedback-form"
                >

                {{-- RATING --}}
                <div class="mb-6">

                    <label
                        for="rating"
                        class="block text-sm font-semibold text-gray-800 mb-2"
                    >
                        Rating
                    </label>

                    <select
                        name="rating"
                        id="rating"
                        required
                        form="feedback-form"
                        class="w-full border-gray-300 rounded-xl
                               focus:border-[#06330A]
                               focus:ring-[#06330A]"
                    >
                        <option value="">
                            Pilih rating
                        </option>

                        <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>
                            ★☆☆☆☆ — Sangat Tidak Puas
                        </option>

                        <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>
                            ★★☆☆☆ — Tidak Puas
                        </option>

                        <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>
                            ★★★☆☆ — Cukup
                        </option>

                        <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>
                            ★★★★☆ — Puas
                        </option>

                        <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>
                            ★★★★★ — Sangat Puas
                        </option>
                    </select>

                </div>


                {{-- PESAN --}}
                <div class="mb-6">

                    <label
                        for="message"
                        class="block text-sm font-semibold text-gray-800 mb-2"
                    >
                        Pesan / Masukan
                    </label>

                    <textarea
                        name="message"
                        id="message"
                        rows="5"
                        form="feedback-form"
                        placeholder="Ceritakan pengalaman Anda terhadap pesanan ini..."
                        class="w-full border-gray-300 rounded-xl
                               focus:border-[#06330A]
                               focus:ring-[#06330A]"
                    >{{ old('message') }}</textarea>

                </div>


                {{-- INFO --}}
                <div class="mb-6 bg-green-50 border border-green-100
                            rounded-xl p-4">

                    <p class="text-sm font-semibold text-[#06330A]">
                        💡 Masukan Anda membantu kami
                    </p>

                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                        Feedback yang Anda berikan akan membantu
                        Yama Golf Store meningkatkan kualitas produk
                        dan pelayanan.
                    </p>

                </div>


                {{-- FORM --}}
                <form
                    id="feedback-form"
                    action="{{ route('customer.feedback.store') }}"
                    method="POST"
                >

                    @csrf

                    <div class="flex flex-col sm:flex-row items-center gap-3">

                        <a
                            href="{{ route('customer.feedback') }}"
                            class="w-full sm:flex-1 px-4 py-2.5
                                   text-center text-sm font-medium
                                   border border-gray-300
                                   rounded-xl text-gray-700
                                   hover:bg-gray-50 transition"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="w-full sm:flex-1 px-4 py-2.5
                                   text-center text-sm font-semibold
                                   bg-[#06330A] text-white
                                   rounded-xl
                                   hover:bg-green-900 transition"
                        >
                            Kirim Feedback
                        </button>

                    </div>

                </form>

            </div>

        @else

            {{-- TIDAK ADA ORDER --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm p-8 text-center">

                <div class="w-14 h-14 mx-auto rounded-full
                            bg-yellow-50 flex items-center justify-center">

                    <span class="text-2xl">!</span>

                </div>

                <h2 class="mt-4 text-base font-semibold text-gray-900">
                    Belum ada pesanan yang dapat diberi feedback
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Feedback dapat diberikan melalui detail pesanan
                    yang telah selesai.
                </p>

                <a
                    href="{{ route('customer.orders') }}"
                    class="inline-flex mt-6 px-5 py-2.5
                           rounded-xl bg-[#06330A]
                           text-white text-sm font-semibold
                           hover:bg-green-900 transition"
                >
                    Lihat Pesanan
                </a>

            </div>

        @endif

    </div>
</div>


</x-customer-layout>
