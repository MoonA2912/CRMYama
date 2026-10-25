<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mt-1">
            Tambah Custom Fitting
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan data dan hasil custom fitting pelanggan.
        </p>
    </div>
</x-slot>


<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Validation Error --}}
        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="w-9 h-9 rounded-full bg-red-100
                                flex items-center justify-center shrink-0">

                        <svg
                            class="w-5 h-5 text-red-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86l-7.4 12.82A2 2 0 004.63 19.68h14.74a2 2 0 001.74-3L13.71 3.86a2 2 0 00-3.42 0z"
                            />
                        </svg>

                    </div>

                    <div>
                        <p class="text-sm font-semibold text-red-800">
                            Terdapat kesalahan pada data
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-700 list-disc list-inside">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>

                </div>

            </div>

        @endif


        {{-- Main Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- Card Header --}}
            <div class="px-6 sm:px-8 py-6 border-b border-gray-100">

                <div class="flex items-center gap-4">

                    <div class="w-11 h-11 rounded-xl bg-[#06330A]/10
                                flex items-center justify-center">

                        <svg
                            class="w-6 h-6 text-[#06330A]"
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

                        <h3 class="text-lg font-semibold text-gray-900">
                            Informasi Custom Fitting
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Isi data pelanggan, tanggal fitting, kebutuhan,
                            hasil, dan rekomendasi.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form
                method="POST"
                action="{{ route('custom-fittings.store') }}"
            >

                @csrf


                <div class="px-6 sm:px-8 py-7 space-y-7">


                    {{-- Customer --}}
                    <div>

                        <label
                            for="customer_id"
                            class="block text-sm font-semibold text-gray-800 mb-2"
                        >
                            Pelanggan
                        </label>

                        <select
                            name="customer_id"
                            id="customer_id"
                            required
                            class="w-full rounded-xl border-gray-300
                                   focus:border-[#06330A]
                                   focus:ring-[#06330A]"
                        >

                            <option value="">
                                -- Pilih Pelanggan --
                            </option>

                            @foreach ($customers as $customer)

                                <option
                                    value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                >
                                    {{ $customer->name }}

                                    @if($customer->phone)
                                        - {{ $customer->phone }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        <p class="text-xs text-gray-400 mt-2">
                            Pilih pelanggan yang melakukan custom fitting.
                        </p>

                        @error('customer_id')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Date --}}
                    <div>

                        <label
                            for="fitting_date"
                            class="block text-sm font-semibold text-gray-800 mb-2"
                        >
                            Tanggal Custom Fitting
                        </label>

                        <input
                            type="date"
                            name="fitting_date"
                            id="fitting_date"
                            value="{{ old('fitting_date', date('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border-gray-300
                                   focus:border-[#06330A]
                                   focus:ring-[#06330A]"
                        >

                        <p class="text-xs text-gray-400 mt-2">
                            Masukkan tanggal pelaksanaan custom fitting.
                        </p>

                        @error('fitting_date')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Height & Weight --}}
                    <div>

                        <div class="mb-4">

                            <h4 class="text-sm font-semibold text-gray-900">
                                Data Fisik Pelanggan
                            </h4>

                            <p class="text-xs text-gray-500 mt-1">
                                Data yang dapat digunakan sebagai bagian dari
                                pertimbangan custom fitting.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Height --}}
                            <div>

                                <label
                                    for="height"
                                    class="block text-sm font-semibold text-gray-800 mb-2"
                                >
                                    Tinggi Badan
                                </label>

                                <input
                                    type="text"
                                    name="height"
                                    id="height"
                                    value="{{ old('height') }}"
                                    placeholder="Contoh: 160 cm"
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                @error('height')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Weight --}}
                            <div>

                                <label
                                    for="weight"
                                    class="block text-sm font-semibold text-gray-800 mb-2"
                                >
                                    Berat Badan
                                </label>

                                <input
                                    type="text"
                                    name="weight"
                                    id="weight"
                                    value="{{ old('weight') }}"
                                    placeholder="Contoh: 61 kg"
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                @error('weight')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Customer Needs --}}
                    <div>

                        <label
                            for="customer_needs"
                            class="block text-sm font-semibold text-gray-800 mb-2"
                        >
                            Kebutuhan / Keluhan Pelanggan
                        </label>

                        <textarea
                            name="customer_needs"
                            id="customer_needs"
                            rows="4"
                            placeholder="Contoh: Ingin stik yang lebih nyaman digunakan dan sesuai dengan kebutuhan bermain."
                            class="w-full rounded-xl border-gray-300
                                   focus:border-[#06330A]
                                   focus:ring-[#06330A]"
                        >{{ old('customer_needs') }}</textarea>

                        <p class="text-xs text-gray-400 mt-2">
                            Catat kebutuhan, kendala, atau keluhan yang disampaikan pelanggan.
                        </p>

                        @error('customer_needs')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Fitting Result --}}
                    <div>

                        <label
                            for="fitting_result"
                            class="block text-sm font-semibold text-gray-800 mb-2"
                        >
                            Hasil Custom Fitting
                        </label>

                        <textarea
                            name="fitting_result"
                            id="fitting_result"
                            rows="4"
                            placeholder="Masukkan hasil custom fitting pelanggan."
                            class="w-full rounded-xl border-gray-300
                                   focus:border-[#06330A]
                                   focus:ring-[#06330A]"
                        >{{ old('fitting_result') }}</textarea>

                        <p class="text-xs text-gray-400 mt-2">
                            Tuliskan hasil fitting atau penyesuaian yang diperoleh.
                        </p>

                        @error('fitting_result')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Recommendation --}}
                    <div>

                        <label
                            for="recommendation"
                            class="block text-sm font-semibold text-gray-800 mb-2"
                        >
                            Rekomendasi
                        </label>

                        <textarea
                            name="recommendation"
                            id="recommendation"
                            rows="4"
                            placeholder="Masukkan rekomendasi produk atau spesifikasi."
                            class="w-full rounded-xl border-gray-300
                                   focus:border-[#06330A]
                                   focus:ring-[#06330A]"
                        >{{ old('recommendation') }}</textarea>

                        <p class="text-xs text-gray-400 mt-2">
                            Masukkan rekomendasi produk, spesifikasi, atau tindak lanjut untuk pelanggan.
                        </p>

                        @error('recommendation')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                </div>


                {{-- Form Footer --}}
                <div class="px-6 sm:px-8 py-5 bg-gray-50 border-t border-gray-100">

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                        <a
                            href="{{ route('custom-fittings.index') }}"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-white
                                   border border-gray-200
                                   text-gray-700
                                   text-sm font-semibold
                                   hover:bg-gray-100
                                   transition"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-2.5
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
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            Simpan Custom Fitting

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


</x-app-layout>
