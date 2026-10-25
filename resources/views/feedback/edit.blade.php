<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-sm font-medium text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
            Edit Feedback
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui data feedback dan tanggapan pelanggan.
        </p>
    </div>
</x-slot>


<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="mx-auto max-w-4xl px-6">

        {{-- VALIDATION ERROR --}}
        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-semibold">
                        !
                    </div>

                    <div>

                        <p class="font-medium">
                            Terjadi kesalahan
                        </p>

                        <ul class="mt-1 list-disc space-y-1 pl-5 text-sm">

                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- MAIN CARD --}}
        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">


            {{-- CARD HEADER --}}
            <div class="border-b border-gray-100 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#06330A]/10 text-xl text-[#06330A]">
                        ✎
                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-900">
                            Data Feedback
                        </h3>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Silakan perbarui informasi feedback sesuai kebutuhan.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <form
                    method="POST"
                    action="{{ route('feedback.update', $feedback) }}"
                >

                    @csrf
                    @method('PUT')


                    {{-- CUSTOMER --}}
                    <div class="border-b border-gray-100 pb-6">

                        <div class="mb-4">

                            <h3 class="font-semibold text-gray-900">
                                Informasi Pelanggan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Pilih pelanggan yang memberikan feedback.
                            </p>

                        </div>


                        <label
                            for="customer_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Pelanggan
                        </label>

                        <select
                            name="customer_id"
                            id="customer_id"
                            required
                            class="mt-2 w-full rounded-xl border-gray-300 bg-white text-sm
                                   shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >

                            <option value="">
                                -- Pilih Pelanggan --
                            </option>

                            @foreach ($customers as $customer)

                                <option
                                    value="{{ $customer->id }}"
                                    {{ old('customer_id', $feedback->customer_id) == $customer->id ? 'selected' : '' }}
                                >
                                    {{ $customer->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('customer_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- ORDER --}}
                    <div class="border-b border-gray-100 py-6">

                        <div class="mb-4">

                            <h3 class="font-semibold text-gray-900">
                                Informasi Pesanan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Hubungkan feedback dengan pesanan pelanggan jika ada.
                            </p>

                        </div>


                        <label
                            for="order_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Pesanan
                        </label>

                        <select
                            name="order_id"
                            id="order_id"
                            class="mt-2 w-full rounded-xl border-gray-300 bg-white text-sm
                                   shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >

                            <option value="">
                                -- Tidak terkait pesanan --
                            </option>

                            @foreach ($orders as $order)

                                <option
                                    value="{{ $order->id }}"
                                    {{ old('order_id', $feedback->order_id) == $order->id ? 'selected' : '' }}
                                >
                                    {{ $order->order_number }}
                                    - {{ $order->customer->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('order_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- RATING --}}
                    <div class="border-b border-gray-100 py-6">

                        <div class="mb-4">

                            <h3 class="font-semibold text-gray-900">
                                Penilaian Pelanggan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Perbarui rating yang diberikan pelanggan.
                            </p>

                        </div>


                        <label
                            for="rating"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Rating
                        </label>

                        <select
                            name="rating"
                            id="rating"
                            required
                            class="mt-2 w-full rounded-xl border-gray-300 bg-white text-sm
                                   shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >

                            @for ($i = 1; $i <= 5; $i++)

                                <option
                                    value="{{ $i }}"
                                    {{ old('rating', $feedback->rating) == $i ? 'selected' : '' }}
                                >
                                    {{ $i }} / 5
                                </option>

                            @endfor

                        </select>

                        @error('rating')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- FEEDBACK MESSAGE --}}
                    <div class="border-b border-gray-100 py-6">

                        <div class="mb-4">

                            <h3 class="font-semibold text-gray-900">
                                Isi Feedback
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Masukan, kritik, atau saran dari pelanggan.
                            </p>

                        </div>


                        <label
                            for="message"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Feedback / Kritik / Saran
                        </label>

                        <textarea
                            name="message"
                            id="message"
                            rows="5"
                            placeholder="Masukkan feedback pelanggan..."
                            class="mt-2 w-full rounded-2xl border-gray-300 bg-white text-sm
                                   leading-6 shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >{{ old('message', $feedback->message) }}</textarea>

                        @error('message')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="border-b border-gray-100 py-6">

                        <div class="mb-4">

                            <h3 class="font-semibold text-gray-900">
                                Status Feedback
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Tentukan status penanganan feedback pelanggan.
                            </p>

                        </div>


                        <label
                            for="status"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            required
                            class="mt-2 w-full rounded-xl border-gray-300 bg-white text-sm
                                   shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >

                            <option
                                value="baru"
                                {{ old('status', $feedback->status) == 'baru' ? 'selected' : '' }}
                            >
                                Baru
                            </option>

                            <option
                                value="dibaca"
                                {{ old('status', $feedback->status) == 'dibaca' ? 'selected' : '' }}
                            >
                                Dibaca
                            </option>

                            <option
                                value="ditindaklanjuti"
                                {{ old('status', $feedback->status) == 'ditindaklanjuti' ? 'selected' : '' }}
                            >
                                Ditindaklanjuti
                            </option>

                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- RESPONSE --}}
                    <div class="py-6">

                        <div class="mb-4">

                            <h3 class="font-semibold text-gray-900">
                                Tanggapan Admin
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Perbarui tanggapan yang diberikan kepada pelanggan.
                            </p>

                        </div>


                        <label
                            for="response"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Tanggapan Admin
                        </label>

                        <textarea
                            name="response"
                            id="response"
                            rows="5"
                            placeholder="Masukkan tanggapan admin..."
                            class="mt-2 w-full rounded-2xl border-gray-300 bg-white text-sm
                                   leading-6 shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >{{ old('response', $feedback->response) }}</textarea>

                        @error('response')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- BUTTONS --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('feedback.show', $feedback) }}"
                            class="rounded-xl border border-gray-300 px-5 py-3 text-center
                                   text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="rounded-xl bg-[#06330A] px-5 py-3 text-sm font-medium
                                   text-white transition hover:bg-[#042406]"
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
