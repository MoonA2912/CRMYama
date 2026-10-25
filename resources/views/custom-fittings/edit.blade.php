<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mt-1">
            Edit Custom Fitting
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui booking dan hasil custom fitting pelanggan.
        </p>
    </div>
</x-slot>


<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Validation Error --}}
        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100">

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
                                d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3.14l-7.5-13a2 2 0 00-3.42 0z"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-red-800">
                            Terdapat kesalahan pada data.
                        </p>

                        <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">

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

            <form
                method="POST"
                action="{{ route('custom-fittings.update', $customFitting) }}"
            >

                @csrf
                @method('PUT')


                {{-- FORM HEADER --}}
                <div class="px-6 sm:px-8 py-6 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-[#06330A]/10
                                    flex items-center justify-center">

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
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                       M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-base font-semibold text-gray-900">
                                Informasi Custom Fitting
                            </h3>

                            <p class="text-xs text-gray-500 mt-0.5">
                                Perbarui data booking dan hasil fitting pelanggan.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="px-6 sm:px-8 py-7">


                    {{-- DATA PELANGGAN --}}
                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-base font-semibold text-gray-900">
                                Data Pelanggan
                            </h3>

                            <p class="text-xs text-gray-500 mt-1">
                                Pilih pelanggan yang melakukan custom fitting.
                            </p>

                        </div>


                        <label
                            for="customer_id"
                            class="block text-sm font-medium text-gray-700 mb-2"
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
                                    {{ old('customer_id', $customFitting->customer_id) == $customer->id ? 'selected' : '' }}
                                >
                                    {{ $customer->name }}

                                    @if($customer->phone)
                                        - {{ $customer->phone }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        @error('customer_id')

                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- DATA BOOKING --}}
                    <div class="mb-8">

                        <div class="mb-4">

                            <h3 class="text-base font-semibold text-gray-900">
                                Data Booking
                            </h3>

                            <p class="text-xs text-gray-500 mt-1">
                                Perbarui jadwal, jenis fitting, dan status booking.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            {{-- TANGGAL --}}
                            <div>

                                <label
                                    for="fitting_date"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Tanggal Custom Fitting
                                </label>

                                <input
                                    type="date"
                                    name="fitting_date"
                                    id="fitting_date"
                                    value="{{ old('fitting_date', $customFitting->fitting_date?->format('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                @error('fitting_date')

                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- JAM --}}
                            <div>

                                <label
                                    for="booking_time"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Jam Booking
                                </label>

                                <input
                                    type="time"
                                    name="booking_time"
                                    id="booking_time"
                                    value="{{ old('booking_time', $customFitting->booking_time ? \Carbon\Carbon::parse($customFitting->booking_time)->format('H:i') : '') }}"
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                @error('booking_time')

                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- JENIS FITTING --}}
                            <div>

                                <label
                                    for="fitting_type"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Jenis Custom Fitting
                                </label>

                                <select
                                    name="fitting_type"
                                    id="fitting_type"
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                    <option value="">
                                        -- Pilih Jenis Fitting --
                                    </option>

                                    <option
                                        value="Club Fitting"
                                        {{ old('fitting_type', $customFitting->fitting_type) === 'Club Fitting' ? 'selected' : '' }}
                                    >
                                        Club Fitting
                                    </option>

                                    <option
                                        value="Grip & Shaft"
                                        {{ old('fitting_type', $customFitting->fitting_type) === 'Grip & Shaft' ? 'selected' : '' }}
                                    >
                                        Grip & Shaft
                                    </option>

                                    <option
                                        value="Pengecekan Spesifikasi"
                                        {{ old('fitting_type', $customFitting->fitting_type) === 'Pengecekan Spesifikasi' ? 'selected' : '' }}
                                    >
                                        Pengecekan Spesifikasi
                                    </option>

                                    <option
                                        value="Konsultasi Peralatan"
                                        {{ old('fitting_type', $customFitting->fitting_type) === 'Konsultasi Peralatan' ? 'selected' : '' }}
                                    >
                                        Konsultasi Peralatan
                                    </option>

                                    <option
                                        value="Lainnya"
                                        {{ old('fitting_type', $customFitting->fitting_type) === 'Lainnya' ? 'selected' : '' }}
                                    >
                                        Lainnya
                                    </option>

                                </select>

                                @error('fitting_type')

                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- STATUS --}}
                            <div>

                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Status Booking
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    required
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                    <option
                                        value="pending"
                                        {{ old('status', $customFitting->status) === 'pending' ? 'selected' : '' }}
                                    >
                                        Menunggu Konfirmasi
                                    </option>

                                    <option
                                        value="confirmed"
                                        {{ old('status', $customFitting->status) === 'confirmed' ? 'selected' : '' }}
                                    >
                                        Dikonfirmasi
                                    </option>

                                    <option
                                        value="completed"
                                        {{ old('status', $customFitting->status) === 'completed' ? 'selected' : '' }}
                                    >
                                        Selesai
                                    </option>

                                    <option
                                        value="cancelled"
                                        {{ old('status', $customFitting->status) === 'cancelled' ? 'selected' : '' }}
                                    >
                                        Dibatalkan
                                    </option>

                                    <option
                                        value="rejected"
                                        {{ old('status', $customFitting->status) === 'rejected' ? 'selected' : '' }}
                                    >
                                        Ditolak
                                    </option>

                                </select>

                                @error('status')

                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- CATATAN --}}
                        <div class="mt-5">

                            <label
                                for="notes"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Catatan Booking
                            </label>

                            <textarea
                                name="notes"
                                id="notes"
                                rows="3"
                                placeholder="Catatan atau kebutuhan yang disampaikan pelanggan saat booking."
                                class="w-full rounded-xl border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >{{ old('notes', $customFitting->notes) }}</textarea>

                            @error('notes')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- HASIL CUSTOM FITTING --}}
                    <div>

                        <div class="mb-5">

                            <h3 class="text-base font-semibold text-gray-900">
                                Hasil Custom Fitting
                            </h3>

                            <p class="text-xs text-gray-500 mt-1">
                                Data berikut diisi atau diperbarui oleh admin setelah proses custom fitting.
                            </p>

                        </div>


                        {{-- DATA FISIK --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                            <div>

                                <label
                                    for="height"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Tinggi Badan
                                </label>

                                <input
                                    type="text"
                                    name="height"
                                    id="height"
                                    value="{{ old('height', $customFitting->height) }}"
                                    placeholder="Contoh: 160 cm"
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                @error('height')

                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            <div>

                                <label
                                    for="weight"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Berat Badan
                                </label>

                                <input
                                    type="text"
                                    name="weight"
                                    id="weight"
                                    value="{{ old('weight', $customFitting->weight) }}"
                                    placeholder="Contoh: 61 kg"
                                    class="w-full rounded-xl border-gray-300
                                           focus:border-[#06330A]
                                           focus:ring-[#06330A]"
                                >

                                @error('weight')

                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- KEBUTUHAN --}}
                        <div class="mb-5">

                            <label
                                for="customer_needs"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Kebutuhan / Keluhan Pelanggan
                            </label>

                            <textarea
                                name="customer_needs"
                                id="customer_needs"
                                rows="4"
                                placeholder="Masukkan kebutuhan atau keluhan pelanggan."
                                class="w-full rounded-xl border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >{{ old('customer_needs', $customFitting->customer_needs) }}</textarea>

                            @error('customer_needs')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- HASIL FITTING --}}
                        <div class="mb-5">

                            <label
                                for="fitting_result"
                                class="block text-sm font-medium text-gray-700 mb-2"
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
                            >{{ old('fitting_result', $customFitting->fitting_result) }}</textarea>

                            @error('fitting_result')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- REKOMENDASI --}}
                        <div>

                            <label
                                for="recommendation"
                                class="block text-sm font-medium text-gray-700 mb-2"
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
                            >{{ old('recommendation', $customFitting->recommendation) }}</textarea>

                            @error('recommendation')

                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="px-6 sm:px-8 py-5 bg-gray-50 border-t border-gray-100">

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                        <a
                            href="{{ route('custom-fittings.show', $customFitting) }}"
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
                                    d="M5 12h14M12 5l7 7-7 7"
                                />
                            </svg>

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


</x-app-layout>
