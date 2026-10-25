<x-dynamic-component :component="'customer-layout'">

    <div class="min-h-screen bg-[#F7F7F5] py-10">
        <div class="max-w-3xl mx-auto px-6">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('customer.custom-fittings') }}"
                   class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 transition mb-5">
                    ← Kembali ke Custom Fitting
                </a>

                <h1 class="text-3xl font-semibold text-gray-900">
                    Booking Custom Fitting
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Pilih jadwal custom fitting yang sesuai dengan waktu Anda.
                </p>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 sm:p-8">

                <form method="POST"
      action="{{ route('customer.custom-fittings.store') }}"
      class="space-y-6">

                    @csrf

                    {{-- Data Customer --}}
                    <div>
                        <h2 class="text-base font-semibold text-gray-900 mb-4">
                            Data Pelanggan
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama
                                </label>

                                <input type="text"
                                       value="{{ $customer->name }}"
                                       readonly
                                       class="w-full rounded-xl border-gray-200 bg-gray-100 text-gray-600 cursor-not-allowed">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    WhatsApp
                                </label>

                                <input type="text"
                                       value="{{ $customer->phone ?: '-' }}"
                                       readonly
                                       class="w-full rounded-xl border-gray-200 bg-gray-100 text-gray-600 cursor-not-allowed">
                            </div>

                        </div>
                    </div>

                    {{-- Jadwal --}}
                    <div class="pt-2">
                        <h2 class="text-base font-semibold text-gray-900 mb-4">
                            Jadwal Custom Fitting
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div>
                                <label for="fitting_date"
                                       class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal
                                </label>

                                <input type="date"
                                       id="fitting_date"
                                       name="fitting_date"
                                       min="{{ now()->format('Y-m-d') }}"
                                       required
                                       class="w-full rounded-xl border-gray-200 focus:border-green-700 focus:ring-green-700">
                            </div>

                            <div>
                                <label for="booking_time"
                                       class="block text-sm font-medium text-gray-700 mb-2">
                                    Jam
                                </label>

                                <input type="time"
                                       id="booking_time"
                                       name="booking_time"
                                       required
                                       class="w-full rounded-xl border-gray-200 focus:border-green-700 focus:ring-green-700">
                            </div>

                        </div>
                    </div>

                    {{-- Jenis Fitting --}}
                    <div>
                        <label for="fitting_type"
                               class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Custom Fitting
                        </label>

                        <select id="fitting_type"
                                name="fitting_type"
                                required
                                class="w-full rounded-xl border-gray-200 focus:border-green-700 focus:ring-green-700">

                            <option value="">Pilih jenis fitting</option>
                            <option value="Club Fitting">Club Fitting</option>
                            <option value="Grip & Shaft">Grip & Shaft</option>
                            <option value="Pengecekan Spesifikasi">Pengecekan Spesifikasi</option>
                            <option value="Konsultasi Peralatan">Konsultasi Peralatan</option>
                            <option value="Lainnya">Lainnya</option>

                        </select>
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <label for="notes"
                               class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan / Kebutuhan
                        </label>

                        <textarea id="notes"
                                  name="notes"
                                  rows="4"
                                  placeholder="Contoh: ingin menyesuaikan club dengan kebutuhan bermain..."
                                  class="w-full rounded-xl border-gray-200 focus:border-green-700 focus:ring-green-700"></textarea>

                        <p class="text-xs text-gray-400 mt-2">
                            Sampaikan kebutuhan atau keluhan yang ingin dibahas saat fitting.
                        </p>
                    </div>

                    {{-- Info --}}
                    <div class="rounded-2xl bg-green-50 border border-green-100 p-4">
                        <p class="text-sm text-green-800">
                            <span class="font-semibold">Catatan:</span>
                            Booking akan berstatus <strong>menunggu konfirmasi</strong>.
                            Tim Yama Golf Store akan memproses jadwal Anda.
                        </p>
                    </div>

                    {{-- Button --}}
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">

                        <a href="{{ route('customer.custom-fittings') }}"
                           class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex justify-center items-center px-6 py-3 rounded-xl bg-[#164A22] hover:bg-[#103719] text-white text-sm font-semibold transition">
                            Ajukan Booking
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-dynamic-component>