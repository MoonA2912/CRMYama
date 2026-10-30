<x-customer-layout>


<x-slot name="header">

    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feedback Saya
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Lihat feedback yang pernah Anda berikan kepada Yama Golf Store.
        </p>
    </div>

</x-slot>


<div class="py-8">

    <div class="max-w-5xl mx-auto px-6">


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="mb-6 rounded-xl bg-green-50 border border-green-200
                        px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERROR MESSAGE --}}
        @if(session('error'))

            <div class="mb-6 rounded-xl bg-red-50 border border-red-200
                        px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif


        @if($feedbacks->count() > 0)

            <div class="space-y-5">

                @foreach($feedbacks as $feedback)

                    <div class="bg-white rounded-2xl border border-gray-200
                                shadow-sm overflow-hidden">


                        {{-- HEADER --}}
                        <div class="p-6 border-b border-gray-100">

                            <div class="flex flex-col sm:flex-row
                                        sm:items-center sm:justify-between gap-3">

                                <div>

                                    <p class="text-xs text-gray-400">
                                        Tanggal Feedback
                                    </p>

                                    <p class="text-sm font-medium text-gray-800 mt-1">
                                        {{ $feedback->created_at->format('d M Y, H:i') }}
                                    </p>

                                </div>

                                @if($feedback->order)

                                    <div class="inline-flex items-center
                                                px-3 py-1.5 rounded-full
                                                bg-[#06330A]/5
                                                text-[#06330A]
                                                text-xs font-medium">

                                        Pesanan #{{ $feedback->order->order_number }}

                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- ISI FEEDBACK --}}
                        <div class="p-6">


                            {{-- DETAIL PESANAN --}}
                            @if($feedback->order)

                                <div class="mb-6">

                                    <div class="flex items-center gap-2 mb-3">

                                        <div class="w-8 h-8 rounded-lg
                                                    bg-[#06330A]/5
                                                    flex items-center justify-center
                                                    text-[#06330A]">
                                            🛍️
                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-gray-900">
                                                Detail Pesanan
                                            </p>

                                            <p class="text-xs text-gray-400">
                                                Produk yang terkait dengan feedback ini
                                            </p>

                                        </div>

                                    </div>


                                    <div class="bg-gray-50 rounded-xl
                                                border border-gray-200
                                                overflow-hidden">

                                        {{-- ORDER INFO --}}
                                        <div class="px-4 py-3 border-b border-gray-200
                                                    flex flex-col sm:flex-row
                                                    sm:items-center sm:justify-between gap-2">

                                            <div>

                                                <p class="text-xs text-gray-400">
                                                    Nomor Pesanan
                                                </p>

                                                <p class="text-sm font-semibold text-gray-800 mt-1">
                                                    {{ $feedback->order->order_number }}
                                                </p>

                                            </div>


                                            <div class="sm:text-right">

                                                <p class="text-xs text-gray-400">
                                                    Tanggal Pesanan
                                                </p>

                                                <p class="text-sm text-gray-700 mt-1">
                                                    {{ $feedback->order->order_date
                                                        ? $feedback->order->order_date->format('d M Y')
                                                        : '-' }}
                                                </p>

                                            </div>

                                        </div>


                                        {{-- ORDER ITEMS --}}
                                        @if($feedback->order->items->count() > 0)

                                            <div class="divide-y divide-gray-200">

                                                @foreach($feedback->order->items as $item)

                                                    <div class="p-4 flex items-center gap-4">

                                                        {{-- PRODUCT IMAGE --}}
                                                        <div class="w-16 h-16 rounded-xl
                                                                    bg-white
                                                                    border border-gray-200
                                                                    overflow-hidden
                                                                    flex-shrink-0">

                                                            @if($item->product && $item->product->image)

                                                                <img
                                                                    src="{{ \App\Support\StoredMediaUrl::resolve($item->product->image) }}"
                                                                    alt="{{ $item->product->name }}"
                                                                    class="w-full h-full object-cover"
                                                                >

                                                            @else

                                                                <div class="w-full h-full
                                                                            flex items-center justify-center
                                                                            text-gray-300 text-xl">
                                                                    🏌️
                                                                </div>

                                                            @endif

                                                        </div>


                                                        {{-- PRODUCT INFO --}}
                                                        <div class="min-w-0 flex-1">

                                                            <p class="text-sm font-medium text-gray-800">
                                                                {{ $item->product->name ?? 'Produk' }}
                                                            </p>

                                                            <p class="text-xs text-gray-400 mt-1">
                                                                Qty {{ $item->quantity }}
                                                                ×
                                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                                            </p>


                                                            @if($item->print_custom)

                                                                <span
                                                                    class="inline-flex mt-2
                                                                    px-2.5 py-1
                                                                    rounded-lg
                                                                    bg-green-50
                                                                    text-green-700
                                                                    text-[11px]
                                                                    font-medium"
                                                                >
                                                                    ✓ Custom Print
                                                                </span>

                                                            @endif

                                                        </div>


                                                        {{-- SUBTOTAL --}}
                                                        <div class="text-right flex-shrink-0">

                                                            <p class="text-xs text-gray-400">
                                                                Subtotal
                                                            </p>

                                                            <p class="text-sm font-semibold text-gray-800 mt-1">
                                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                            </p>

                                                        </div>

                                                    </div>

                                                @endforeach

                                            </div>

                                        @endif


                                        {{-- TOTAL --}}
                                        <div class="px-4 py-4 border-t border-gray-200
                                                    flex items-center justify-between">

                                            <span class="text-sm text-gray-500">
                                                Total Pesanan
                                            </span>

                                            <span class="text-base font-semibold text-[#06330A]">
                                                Rp {{ number_format($feedback->order->total_amount, 0, ',', '.') }}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- RATING --}}
                            <div class="mb-5">

                                <p class="text-xs text-gray-400 mb-2">
                                    Rating
                                </p>

                                <div class="flex items-center gap-1">

                                    @for($i = 1; $i <= 5; $i++)

                                        <span
                                            class="text-xl
                                            {{ $i <= $feedback->rating
                                                ? 'text-yellow-400'
                                                : 'text-gray-300' }}"
                                        >
                                            ★
                                        </span>

                                    @endfor

                                    <span class="ml-2 text-sm text-gray-500">
                                        {{ $feedback->rating }}/5
                                    </span>

                                </div>

                            </div>


                            {{-- PESAN --}}
                            <div class="mb-5">

                                <p class="text-xs text-gray-400 mb-2">
                                    Feedback Anda
                                </p>

                                <div class="bg-gray-50 rounded-xl p-4">

                                    <p class="text-sm text-gray-700 leading-6">
                                        {{ $feedback->message ?: '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- RESPONSE ADMIN --}}
                            <div>

                                <p class="text-xs text-gray-400 mb-2">
                                    Tanggapan Yama Golf Store
                                </p>


                                @if($feedback->response)

                                    <div class="bg-blue-50 border border-blue-100
                                                rounded-xl p-4">

                                        <p class="text-sm text-gray-700 leading-6">
                                            {{ $feedback->response }}
                                        </p>

                                    </div>

                                @else

                                    <div class="bg-gray-50 border border-gray-200
                                                rounded-xl p-4">

                                        <p class="text-sm text-gray-400">
                                            Belum ada tanggapan dari Yama Golf Store.
                                        </p>

                                    </div>

                                @endif

                            </div>


                        </div>

                    </div>

                @endforeach

            </div>


        @else

            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm p-12 text-center">

                <div class="text-5xl mb-4">
                    💬
                </div>

                <h3 class="text-lg font-semibold text-gray-900">
                    Belum ada feedback
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Feedback yang Anda berikan akan muncul di halaman ini.
                </p>

            </div>

        @endif


    </div>

</div>

</x-customer-layout>
