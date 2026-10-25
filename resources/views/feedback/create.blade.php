<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Feedback
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('feedback.store') }}">
                        @csrf

                        {{-- Pelanggan --}}
                        <div class="mb-6">
                            <label for="customer_id"
                                   class="block font-medium text-sm text-gray-700 mb-1">
                                Pelanggan
                            </label>

                            <select name="customer_id"
                                    id="customer_id"
                                    required
                                    class="w-full border-gray-300 rounded-md">

                                <option value="">-- Pilih Pelanggan --</option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('customer_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pesanan --}}
                        <div class="mb-6">
                            <label for="order_id"
                                   class="block font-medium text-sm text-gray-700 mb-1">
                                Pesanan
                            </label>

                            <select name="order_id"
                                    id="order_id"
                                    class="w-full border-gray-300 rounded-md">

                                <option value="">-- Tidak terkait pesanan --</option>

                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}"
                                        {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                        {{ $order->order_number }} -
                                        {{ $order->customer->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('order_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Rating --}}
                        <div class="mb-6">
                            <label for="rating"
                                   class="block font-medium text-sm text-gray-700 mb-1">
                                Rating
                            </label>

                            <select name="rating"
                                    id="rating"
                                    required
                                    class="w-full border-gray-300 rounded-md">

                                <option value="">-- Pilih Rating --</option>

                                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>
                                    5 - Sangat Puas
                                </option>

                                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>
                                    4 - Puas
                                </option>

                                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>
                                    3 - Cukup
                                </option>

                                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>
                                    2 - Kurang Puas
                                </option>

                                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>
                                    1 - Tidak Puas
                                </option>

                            </select>

                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Feedback --}}
                        <div class="mb-6">
                            <label for="message"
                                   class="block font-medium text-sm text-gray-700 mb-1">
                                Feedback / Kritik / Saran
                            </label>

                            <textarea name="message"
                                      id="message"
                                      rows="5"
                                      placeholder="Masukkan feedback pelanggan..."
                                      class="w-full border-gray-300 rounded-md">{{ old('message') }}</textarea>

                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-6">
                            <label for="status"
                                   class="block font-medium text-sm text-gray-700 mb-1">
                                Status
                            </label>

                            <select name="status"
                                    id="status"
                                    required
                                    class="w-full border-gray-300 rounded-md">

                                <option value="baru"
                                    {{ old('status', 'baru') == 'baru' ? 'selected' : '' }}>
                                    Baru
                                </option>

                                <option value="dibaca"
                                    {{ old('status') == 'dibaca' ? 'selected' : '' }}>
                                    Dibaca
                                </option>

                                <option value="ditindaklanjuti"
                                    {{ old('status') == 'ditindaklanjuti' ? 'selected' : '' }}>
                                    Ditindaklanjuti
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Response --}}
                        <div class="mb-6">
                            <label for="response"
                                   class="block font-medium text-sm text-gray-700 mb-1">
                                Tanggapan Admin
                            </label>

                            <textarea name="response"
                                      id="response"
                                      rows="5"
                                      placeholder="Masukkan tanggapan atau tindak lanjut dari admin..."
                                      class="w-full border-gray-300 rounded-md">{{ old('response') }}</textarea>

                            @error('response')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="flex justify-end gap-3 mt-6">

                            <a href="{{ route('feedback.index') }}"
                               class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                                Simpan Feedback
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>