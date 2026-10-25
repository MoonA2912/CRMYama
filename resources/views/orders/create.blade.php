<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Tambah Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan data pesanan pelanggan ke dalam sistem.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- PAGE HEADER --}}
            <div class="mb-7">

                <h3 class="text-xl font-bold text-gray-900">
                    Informasi Pesanan
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi informasi berikut untuk membuat pesanan baru.
                </p>

            </div>


            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <div class="p-6 sm:p-8">

                    <form action="{{ route('orders.store') }}" method="POST">

                        @csrf


                        {{-- CUSTOMER --}}
                        <div class="mb-6">

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
                                       focus:ring-[#06330A]
                                       text-sm"
                            >

                                <option value="">
                                    -- Pilih Pelanggan --
                                </option>

                                @foreach ($customers as $customer)

                                    <option
                                        value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                    >
                                        {{ $customer->name }} - {{ $customer->phone }}
                                    </option>

                                @endforeach

                            </select>

                            <p class="mt-2 text-xs text-gray-400">
                                Pilih pelanggan yang melakukan transaksi.
                            </p>

                            @error('customer_id')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- ORDER DATE --}}
                        <div class="mb-6">

                            <label
                                for="order_date"
                                class="block text-sm font-semibold text-gray-800 mb-2"
                            >
                                Tanggal Pesanan
                            </label>

                            <input
                                type="datetime-local"
                                name="order_date"
                                id="order_date"
                                value="{{ old('order_date', now()->format('Y-m-d\TH:i')) }}"
                                required
                                class="w-full rounded-xl border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]
                                       text-sm"
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Tanggal dan waktu saat pesanan dibuat.
                            </p>

                            @error('order_date')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- STATUS --}}
                        <div class="mb-8">

                            <label
                                for="status"
                                class="block text-sm font-semibold text-gray-800 mb-2"
                            >
                                Status Pesanan
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full rounded-xl border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]
                                       text-sm"
                            >

                                <option
                                    value="pending"
                                    {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="paid"
                                    {{ old('status') === 'paid' ? 'selected' : '' }}
                                >
                                    Paid
                                </option>

                                <option
                                    value="processing"
                                    {{ old('status') === 'processing' ? 'selected' : '' }}
                                >
                                    Processing
                                </option>

                                <option
                                    value="shipped"
                                    {{ old('status') === 'shipped' ? 'selected' : '' }}
                                >
                                    Shipped
                                </option>

                                <option
                                    value="completed"
                                    {{ old('status') === 'completed' ? 'selected' : '' }}
                                >
                                    Completed
                                </option>

                                <option
                                    value="cancelled"
                                    {{ old('status') === 'cancelled' ? 'selected' : '' }}
                                >
                                    Cancelled
                                </option>

                            </select>

                            <p class="mt-2 text-xs text-gray-400">
                                Status dapat diperbarui kembali melalui halaman edit pesanan.
                            </p>

                            @error('status')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- ACTIONS --}}
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                            <a
                                href="{{ route('orders.index') }}"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-gray-100
                                       text-gray-700
                                       text-sm font-semibold
                                       hover:bg-gray-200
                                       transition"
                            >
                                Kembali
                            </a>


                            <button
                                type="submit"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-[#06330A]
                                       text-white
                                       text-sm font-semibold
                                       hover:bg-[#052808]
                                       transition shadow-sm"
                            >
                                Simpan & Lanjutkan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

