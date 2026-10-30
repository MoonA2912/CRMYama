<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Edit Pelanggan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi pelanggan.
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
                                    d="M15 19a4 4 0 0 0-8 0M11 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6 8v-1a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Perbarui Informasi Pelanggan
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Pastikan data pelanggan tetap akurat dan terbaru.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FORM --}}
                <div class="p-6 sm:p-8">

                    <form
                        method="POST"
                        action="{{ route('customers.update', $customer) }}"
                    >
                        @csrf
                        @method('PUT')


                        {{-- NAMA --}}
                        <div class="mb-6">

                            <label
                                for="name"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Nama Pelanggan
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $customer->name) }}"
                                required
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


                        {{-- TELEPON --}}
                        <div class="mb-6">

                            <label
                                for="phone"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $customer->phone) }}"
                                required
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
                                Gunakan nomor yang dapat dihubungi pelanggan.
                            </p>

                            @error('phone')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ALAMAT --}}
                        <div class="mb-6">

                            <label
                                for="address"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Alamat
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       text-gray-900
                                       placeholder-gray-400
                                       shadow-sm
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >{{ old('address', $customer->address) }}</textarea>

                            @error('address')
                                <p class="text-sm text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- TANGGAL LAHIR --}}
                        <div class="mb-8">

                            <label
                                for="birth_date"
                                class="block text-sm font-semibold
                                       text-gray-700 mb-2"
                            >
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date', optional($customer->birth_date)->format('Y-m-d')) }}"
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-[#FAFAF8]
                                       text-gray-900
                                       shadow-sm
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]"
                            >

                            <p class="text-xs text-gray-400 mt-2">
                                Data tanggal lahir dapat digunakan untuk
                                pemberian Birthday Reward.
                            </p>

                            @error('birth_date')
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
                                href="{{ route('customers.index') }}"
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
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>