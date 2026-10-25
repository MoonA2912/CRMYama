<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Edit Pesanan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi dan status pesanan pelanggan.
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
                    Pastikan informasi pesanan sudah sesuai sebelum menyimpan perubahan.
                </p>

            </div>


            {{-- FORM CARD --}}
            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div class="p-6 sm:p-8">

                    {{-- ERROR VALIDATION --}}
                    @if ($errors->any())

                        <div
                            class="mb-6 rounded-xl
                                   bg-red-50
                                   border border-red-200
                                   px-5 py-4"
                        >

                            <p class="text-sm font-semibold text-red-700 mb-2">
                                Periksa kembali data yang dimasukkan:
                            </p>

                            <ul
                                class="list-disc list-inside
                                       text-sm text-red-600 space-y-1"
                            >

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        method="POST"
                        action="{{ route('orders.update', $order) }}"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')


                        {{-- ORDER NUMBER --}}
                        <div class="mb-6">

                            <label
                                class="block text-sm font-semibold
                                       text-gray-800 mb-2"
                            >
                                Nomor Pesanan
                            </label>

                            <input
                                type="text"
                                value="{{ $order->order_number }}"
                                disabled
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-gray-50
                                       text-gray-500
                                       text-sm"
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Nomor pesanan tidak dapat diubah.
                            </p>

                        </div>


                        {{-- CUSTOMER --}}
                        <div class="mb-6">

                            <label
                                for="customer_id"
                                class="block text-sm font-semibold
                                       text-gray-800 mb-2"
                            >
                                Pelanggan
                            </label>

                            <select
                                name="customer_id"
                                id="customer_id"
                                required
                                class="w-full rounded-xl
                                       border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]
                                       text-sm"
                            >

                                @foreach ($customers as $customer)

                                    <option
                                        value="{{ $customer->id }}"
                                        {{ $order->customer_id == $customer->id ? 'selected' : '' }}
                                    >
                                        {{ $customer->name }} - {{ $customer->phone }}
                                    </option>

                                @endforeach

                            </select>

                            <p class="mt-2 text-xs text-gray-400">
                                Pilih pelanggan yang terkait dengan pesanan ini.
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
                                class="block text-sm font-semibold
                                       text-gray-800 mb-2"
                            >
                                Tanggal Pesanan
                            </label>

                            <input
                                type="datetime-local"
                                name="order_date"
                                id="order_date"
                                value="{{ $order->order_date->format('Y-m-d\TH:i') }}"
                                required
                                class="w-full rounded-xl
                                       border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]
                                       text-sm"
                            >

                            @error('order_date')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- STATUS --}}
                        <div class="mb-6">

                            <label
                                for="status"
                                class="block text-sm font-semibold
                                       text-gray-800 mb-2"
                            >
                                Status Pesanan
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full rounded-xl
                                       border-gray-300
                                       focus:border-[#06330A]
                                       focus:ring-[#06330A]
                                       text-sm"
                            >

                                @foreach ([
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'processing' => 'Processing',
                                    'shipped' => 'Shipped',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ] as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        {{ $order->status === $value ? 'selected' : '' }}
                                    >
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                            <p class="mt-2 text-xs text-gray-400">
                                Perbarui status sesuai dengan kondisi pesanan saat ini.
                            </p>

                            @error('status')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- PAYMENT PROOF --}}
                        <div class="mb-8">

                            <div class="flex items-center gap-3 mb-4">

                                <div
                                    class="w-9 h-9 rounded-xl
                                           bg-green-50
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
                                            d="M12 6v12m-3-3h6m5-12H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-base font-bold text-gray-900">
                                        Bukti Pembayaran
                                    </h3>

                                    <p class="text-xs text-gray-400 mt-0.5">
                                        Kelola bukti pembayaran pesanan.
                                    </p>

                                </div>

                            </div>


                            @if ($order->payment_proof)

                                <div
                                    class="rounded-xl
                                           bg-[#F7F7F5]
                                           border border-gray-100
                                           p-4 mb-4"
                                >

                                    <div
                                        class="flex flex-col sm:flex-row
                                               sm:items-center
                                               sm:justify-between
                                               gap-3"
                                    >

                                        <div>

                                            <p class="text-xs text-gray-400">
                                                Bukti pembayaran saat ini
                                            </p>

                                            <p
                                                class="text-sm font-semibold
                                                       text-gray-800 mt-1"
                                            >
                                                File pembayaran tersedia
                                            </p>

                                        </div>


                                        <a
                                            href="{{ asset('storage/' . $order->payment_proof) }}"
                                            target="_blank"
                                            class="inline-flex items-center
                                                   justify-center
                                                   px-4 py-2 rounded-xl
                                                   bg-green-50
                                                   text-[#06330A]
                                                   text-xs font-semibold
                                                   hover:bg-green-100
                                                   transition"
                                        >
                                            📄 Lihat Bukti Pembayaran
                                        </a>

                                    </div>

                                </div>


                            @else

                                <div
                                    class="rounded-xl
                                           bg-gray-50
                                           border border-dashed
                                           border-gray-200
                                           px-5 py-4 mb-4"
                                >

                                    <p class="text-sm text-gray-400">
                                        Belum ada bukti pembayaran.
                                    </p>

                                </div>

                            @endif


                            <label
                                for="payment_proof"
                                class="block text-sm font-semibold
                                       text-gray-800 mb-2"
                            >
                                Upload Bukti Pembayaran Baru
                            </label>

                            <input
                                type="file"
                                name="payment_proof"
                                id="payment_proof"
                                accept=".jpg,.jpeg,.png,.webp,.pdf"
                                class="w-full rounded-xl
                                       border border-gray-300
                                       px-3 py-2.5
                                       text-sm text-gray-600
                                       file:mr-4
                                       file:rounded-lg
                                       file:border-0
                                       file:bg-green-50
                                       file:px-4
                                       file:py-2
                                       file:text-xs
                                       file:font-semibold
                                       file:text-[#06330A]
                                       hover:file:bg-green-100"
                            >

                            <p class="text-xs text-gray-400 mt-2">
                                Kosongkan jika tidak ingin mengganti bukti pembayaran.
                                Format JPG, JPEG, PNG, WEBP, atau PDF. Maksimal 2 MB.
                            </p>

                            @error('payment_proof')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- ACTIONS --}}
                        <div
                            class="border-t border-gray-100
                                   pt-6
                                   flex flex-col-reverse
                                   sm:flex-row
                                   sm:justify-end
                                   gap-3"
                        >

                            <a
                                href="{{ route('orders.show', $order) }}"
                                class="inline-flex items-center
                                       justify-center
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
