<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-sm font-medium text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
            Detail Feedback
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Lihat masukan pelanggan, detail pesanan, dan berikan tanggapan.
        </p>
    </div>
</x-slot>


<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="mx-auto max-w-4xl px-6">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-700">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100">
                    ✓
                </div>

                <div>
                    <p class="font-medium">
                        Berhasil
                    </p>

                    <p class="mt-0.5 text-sm">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        @endif


        {{-- ERROR MESSAGE --}}
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
                        💬
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-900">
                            Feedback Pelanggan
                        </h3>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Informasi lengkap feedback dan konteks transaksi pelanggan.
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-6">


                {{-- CUSTOMER --}}
                <div class="border-b border-gray-100 pb-5">

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Pelanggan
                    </p>

                    <div class="mt-2 flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#06330A]/10 font-semibold text-[#06330A]">
                            {{ strtoupper(substr($feedback->customer->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ $feedback->customer->name }}
                            </p>

                            @if($feedback->customer->phone)
                                <p class="mt-0.5 text-xs text-gray-500">
                                    {{ $feedback->customer->phone }}
                                </p>
                            @endif
                        </div>

                    </div>

                </div>


                {{-- ORDER DETAIL --}}
                <div class="border-b border-gray-100 py-6">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Pesanan
                            </p>

                            @if($feedback->order)

                                <h3 class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ $feedback->order->order_number }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $feedback->order->order_date->format('d M Y, H:i') }}
                                </p>

                            @else

                                <p class="mt-1 text-sm text-gray-400">
                                    Feedback tidak terkait dengan pesanan.
                                </p>

                            @endif

                        </div>


                        @if($feedback->order)

                            @php
                                $statusClasses = match($feedback->order->status) {
                                    'pending' => 'bg-amber-50 text-amber-700',
                                    'confirmed' => 'bg-blue-50 text-blue-700',
                                    'processing' => 'bg-purple-50 text-purple-700',
                                    'shipped' => 'bg-indigo-50 text-indigo-700',
                                    'completed' => 'bg-green-50 text-green-700',
                                    'cancelled' => 'bg-red-50 text-red-700',
                                    'rejected' => 'bg-red-50 text-red-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };

                                $statusLabel = match($feedback->order->status) {
                                    'pending' => 'Menunggu',
                                    'confirmed' => 'Dikonfirmasi',
                                    'processing' => 'Diproses',
                                    'shipped' => 'Dikirim',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                    'rejected' => 'Ditolak',
                                    default => ucfirst($feedback->order->status),
                                };
                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-medium {{ $statusClasses }}">
                                {{ $statusLabel }}
                            </span>

                        @endif

                    </div>


                    @if($feedback->order)

                        {{-- ORDER ITEMS --}}
                        <div class="mt-5 overflow-hidden rounded-2xl border border-gray-200">

                            <div class="border-b border-gray-100 bg-gray-50 px-4 py-3">

                                <p class="text-sm font-semibold text-gray-900">
                                    Produk dalam Pesanan
                                </p>

                            </div>


                            <div class="divide-y divide-gray-100">

                                @forelse($feedback->order->items as $item)

                                    <div class="flex flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

                                        <div class="flex items-start gap-3">

                                            {{-- PRODUCT IMAGE --}}
                                            <div class="h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                                                @if($item->product?->image)

                                                    <img
                                                        src="{{ \App\Support\StoredMediaUrl::resolve($item->product->image) }}"
                                                        alt="{{ $item->product->name }}"
                                                        class="h-full w-full object-cover"
                                                    >

                                                @else

                                                    <div class="flex h-full w-full items-center justify-center text-lg text-gray-400">
                                                        ⛳
                                                    </div>

                                                @endif

                                            </div>


                                            <div>

                                                <p class="font-medium text-gray-900">
                                                    {{ $item->product?->name ?? 'Produk tidak tersedia' }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500">
                                                    {{ $item->quantity }} ×
                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </p>


                                                @if($item->print_custom)

                                                    <span class="mt-2 inline-flex rounded-full bg-[#06330A]/10 px-2.5 py-1 text-xs font-medium text-[#06330A]">
                                                        Custom Print
                                                    </span>

                                                    @if($item->print_price > 0)

                                                        <span class="ml-1 text-xs text-gray-500">
                                                            + Rp {{ number_format($item->print_price, 0, ',', '.') }}
                                                        </span>

                                                    @endif

                                                @endif

                                            </div>

                                        </div>


                                        <p class="font-semibold text-gray-900 sm:text-right">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </p>

                                    </div>

                                @empty

                                    <div class="px-4 py-6 text-center text-sm text-gray-500">
                                        Tidak ada detail produk pada pesanan ini.
                                    </div>

                                @endforelse

                            </div>


                            {{-- ORDER SUMMARY --}}
                            <div class="border-t border-gray-200 bg-gray-50 px-4 py-4">

                                @if($feedback->order->discount_amount > 0)

                                    <div class="flex items-center justify-between text-sm text-gray-500">

                                        <span>
                                            Diskon
                                            @if($feedback->order->discount_percentage > 0)
                                                ({{ number_format($feedback->order->discount_percentage, 0) }}%)
                                            @endif
                                        </span>

                                        <span>
                                            - Rp {{ number_format($feedback->order->discount_amount, 0, ',', '.') }}
                                        </span>

                                    </div>

                                @endif


                                <div class="mt-2 flex items-center justify-between">

                                    <span class="font-semibold text-gray-900">
                                        Total Pesanan
                                    </span>

                                    <span class="text-lg font-bold text-[#06330A]">
                                        Rp {{ number_format($feedback->order->total_amount, 0, ',', '.') }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- VIEW ORDER BUTTON --}}
                        <div class="mt-4">

                            <a
                                href="{{ route('orders.show', $feedback->order) }}"
                                class="inline-flex items-center gap-2 rounded-xl border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                            >
                                Lihat Detail Pesanan
                                <span>→</span>
                            </a>

                        </div>

                    @endif

                </div>


                {{-- RATING --}}
                <div class="border-b border-gray-100 py-5">

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Rating
                    </p>

                    <div class="mt-2 flex items-center gap-3">

                        <span class="text-xl tracking-wide text-yellow-500">
                            {{ str_repeat('★', $feedback->rating) }}
                        </span>

                        <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-medium text-yellow-700">
                            {{ $feedback->rating }}/5
                        </span>

                    </div>

                </div>


                {{-- CUSTOMER FEEDBACK --}}
                <div class="border-b border-gray-100 py-5">

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Feedback Pelanggan
                    </p>

                    <div class="mt-3 rounded-2xl border border-gray-200 bg-gray-50 p-5">

                        <p class="text-sm leading-6 text-gray-700 whitespace-pre-line">
                            {{ $feedback->message ?: 'Pelanggan tidak memberikan pesan.' }}
                        </p>

                    </div>

                </div>


                {{-- PREVIOUS RESPONSE --}}
                @if($feedback->response)

                    <div class="border-b border-gray-100 py-5">

                        <div class="flex items-center gap-2">

                            <span class="text-[#06330A]">
                                ↳
                            </span>

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Balasan Admin
                            </p>

                        </div>

                        <div class="mt-3 rounded-2xl border border-blue-100 bg-blue-50 p-5">

                            <p class="text-sm leading-6 text-gray-700 whitespace-pre-line">
                                {{ $feedback->response }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- RESPONSE FORM --}}
                <div class="pt-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#06330A]/10 text-[#06330A]">
                            ✎
                        </div>

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                {{ $feedback->response ? 'Ubah Balasan' : 'Balas Feedback' }}
                            </h3>

                            <p class="mt-0.5 text-sm text-gray-500">
                                {{ $feedback->response
                                    ? 'Perbarui tanggapan yang diberikan kepada pelanggan.'
                                    : 'Berikan tanggapan atas masukan pelanggan.'
                                }}
                            </p>

                        </div>

                    </div>


                    <form
                        action="{{ route('feedback.update', $feedback) }}"
                        method="POST"
                        class="mt-5"
                    >

                        @csrf
                        @method('PUT')


                        {{-- HIDDEN DATA --}}
                        <input
                            type="hidden"
                            name="customer_id"
                            value="{{ $feedback->customer_id }}"
                        >

                        <input
                            type="hidden"
                            name="order_id"
                            value="{{ $feedback->order_id }}"
                        >

                        <input
                            type="hidden"
                            name="rating"
                            value="{{ $feedback->rating }}"
                        >

                        <input
                            type="hidden"
                            name="status"
                            value="{{ $feedback->status }}"
                        >


                        <label
                            for="response"
                            class="text-sm font-medium text-gray-700"
                        >
                            Tanggapan Admin
                        </label>

                        <textarea
                            id="response"
                            name="response"
                            rows="5"
                            placeholder="Tulis balasan untuk pelanggan..."
                            class="mt-2 w-full rounded-2xl border-gray-300 bg-white text-sm
                                   shadow-sm focus:border-[#06330A] focus:ring-[#06330A]"
                        >{{ old('response', $feedback->response) }}</textarea>


                        <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row">

                            <a
                                href="{{ route('feedback.index') }}"
                                class="flex-1 rounded-xl border border-gray-300 px-4 py-3
                                       text-center text-sm font-medium text-gray-700
                                       transition hover:bg-gray-50"
                            >
                                Kembali
                            </a>


                            <button
                                type="submit"
                                class="flex-1 rounded-xl bg-[#06330A] px-4 py-3
                                       text-center text-sm font-medium text-white
                                       transition hover:bg-[#042406]"
                            >
                                {{ $feedback->response ? 'Simpan Balasan' : 'Kirim Balasan' }}
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


</x-app-layout>
