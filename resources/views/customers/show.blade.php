<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase
                      tracking-[0.2em] text-[#06330A]">
                Yama Golf Store
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mt-1">
                Detail Pelanggan
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Informasi dan riwayat hubungan pelanggan dalam sistem CRM.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F7F7F5] py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =========================
                CUSTOMER PROFILE
            ========================== --}}

            <div
                class="bg-white rounded-3xl
                       border border-gray-100
                       shadow-sm overflow-hidden mb-8"
            >

                <div class="p-6 sm:p-8">

                    <div class="flex flex-col lg:flex-row
                                lg:items-start lg:justify-between
                                gap-6">

                        {{-- Identity --}}
                        <div class="flex items-center gap-5">

                            <div
                                class="w-16 h-16 rounded-2xl
                                       bg-[#06330A]
                                       text-white
                                       flex items-center justify-center
                                       text-2xl font-bold
                                       flex-shrink-0"
                            >
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase
                                          tracking-[0.18em]
                                          text-gray-400">
                                    Profil Pelanggan
                                </p>

                                <h1 class="text-2xl font-bold
                                           text-gray-900 mt-1">
                                    {{ $customer->name }}
                                </h1>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $customer->phone ?? 'Nomor telepon belum tersedia' }}
                                </p>

                            </div>

                        </div>


                        {{-- Membership --}}
                        <div>

                            @switch($customer->membership_level)

                                @case('bronze')

                                    <span
                                        class="inline-flex items-center
                                               px-4 py-2 rounded-full
                                               bg-orange-50
                                               text-orange-700
                                               text-sm font-semibold"
                                    >
                                        Bronze Member
                                    </span>

                                    @break

                                @case('silver')

                                    <span
                                        class="inline-flex items-center
                                               px-4 py-2 rounded-full
                                               bg-gray-100
                                               text-gray-700
                                               text-sm font-semibold"
                                    >
                                        Silver Member
                                    </span>

                                    @break

                                @case('gold')

                                    <span
                                        class="inline-flex items-center
                                               px-4 py-2 rounded-full
                                               bg-yellow-50
                                               text-yellow-700
                                               text-sm font-semibold"
                                    >
                                        Gold Member
                                    </span>

                                    @break

                                @default

                                    <span
                                        class="inline-flex items-center
                                               px-4 py-2 rounded-full
                                               bg-gray-50
                                               text-gray-500
                                               text-sm font-semibold"
                                    >
                                        Non-Member
                                    </span>

                            @endswitch

                        </div>

                    </div>


                    {{-- Customer Information --}}
                    <div
                        class="grid grid-cols-1
                               sm:grid-cols-2
                               lg:grid-cols-4
                               gap-4 mt-8"
                    >

                        <div
                            class="rounded-2xl bg-[#F7F7F5]
                                   p-5"
                        >
                            <p class="text-xs text-gray-400">
                                Nomor Telepon
                            </p>

                            <p class="text-sm font-semibold
                                      text-gray-900 mt-2">
                                {{ $customer->phone ?? '-' }}
                            </p>
                        </div>


                        <div
                            class="rounded-2xl bg-[#F7F7F5]
                                   p-5"
                        >
                            <p class="text-xs text-gray-400">
                                Tanggal Lahir
                            </p>

                            <p class="text-sm font-semibold
                                      text-gray-900 mt-2">
                                @if($customer->birth_date)
                                    {{ $customer->birth_date->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>


                        <div
                            class="rounded-2xl bg-[#F7F7F5]
                                   p-5 sm:col-span-2"
                        >
                            <p class="text-xs text-gray-400">
                                Alamat
                            </p>

                            <p class="text-sm font-semibold
                                      text-gray-900 mt-2">
                                {{ $customer->address ?? '-' }}
                            </p>
                        </div>

                    </div>


                    {{-- Actions --}}
                    <div
                        class="flex flex-wrap items-center
                               gap-3 mt-7 pt-6
                               border-t border-gray-100"
                    >

                        <a
                            href="{{ route('customers.index') }}"
                            class="inline-flex items-center
                                   px-4 py-2.5 rounded-xl
                                   bg-gray-100
                                   text-gray-600
                                   text-sm font-semibold
                                   hover:bg-gray-200
                                   transition"
                        >
                            ← Kembali
                        </a>


                        <a
                            href="{{ route('customers.edit', $customer) }}"
                            class="inline-flex items-center
                                   px-4 py-2.5 rounded-xl
                                   bg-[#06330A]
                                   text-white
                                   text-sm font-semibold
                                   hover:bg-[#052808]
                                   transition shadow-sm"
                        >
                            Edit Pelanggan
                        </a>

                    </div>

                </div>

            </div>



            {{-- =========================
                CUSTOM FITTING
            ========================== --}}

            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden mb-8"
            >

                <div
                    class="p-6 sm:p-8
                           border-b border-gray-100"
                >

                    <div class="flex flex-col sm:flex-row
                                sm:items-center sm:justify-between
                                gap-4">

                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-[0.18em]
                                      text-[#06330A]">
                                Customer Service History
                            </p>

                            <h3 class="text-xl font-bold
                                       text-gray-900 mt-1">
                                Custom Fitting
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Riwayat layanan custom fitting pelanggan.
                            </p>

                        </div>


                        <a
                            href="{{ route('custom-fittings.create') }}"
                            class="inline-flex items-center justify-center
                                   px-4 py-2.5 rounded-xl
                                   bg-[#06330A]
                                   text-white
                                   text-sm font-semibold
                                   hover:bg-[#052808]
                                   transition"
                        >
                            + Tambah Fitting
                        </a>

                    </div>

                </div>


                <div class="p-6 sm:p-8">

                    @if ($customer->customFittings->count())

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead>

                                    <tr
                                        class="border-b border-gray-100"
                                    >

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Tanggal
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Tinggi
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Berat
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Kebutuhan
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Rekomendasi
                                        </th>

                                        <th
                                            class="px-4 py-4 text-center
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($customer->customFittings as $fitting)

                                        <tr
                                            class="hover:bg-[#FAFAF8]
                                                   transition"
                                        >

                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       whitespace-nowrap"
                                            >
                                                {{ $fitting->fitting_date->format('d M Y') }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600"
                                            >
                                                {{ $fitting->height ?: '-' }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600"
                                            >
                                                {{ $fitting->weight ?: '-' }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       max-w-xs"
                                            >
                                                {{ $fitting->customer_needs ?: '-' }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       max-w-xs"
                                            >
                                                {{ $fitting->recommendation ?: '-' }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-center
                                                       whitespace-nowrap"
                                            >
                                                <a
                                                    href="{{ route('custom-fittings.show', $fitting) }}"
                                                    class="inline-flex
                                                           px-3 py-1.5
                                                           rounded-lg
                                                           bg-green-50
                                                           text-[#06330A]
                                                           text-xs
                                                           font-semibold
                                                           hover:bg-green-100
                                                           transition"
                                                >
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="py-8 text-center">

                            <p class="text-sm text-gray-500">
                                Belum ada riwayat custom fitting.
                            </p>

                        </div>

                    @endif

                </div>

            </div>



            {{-- =========================
                ORDER HISTORY
            ========================== --}}

            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden mb-8"
            >

                <div
                    class="p-6 sm:p-8
                           border-b border-gray-100"
                >

                    <div>

                        <p class="text-xs font-semibold uppercase
                                  tracking-[0.18em]
                                  text-[#06330A]">
                            Transaction History
                        </p>

                        <h3 class="text-xl font-bold
                                   text-gray-900 mt-1">
                            Riwayat Pesanan
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Riwayat transaksi pelanggan.
                        </p>

                    </div>

                </div>


                <div class="p-6 sm:p-8">

                    @if ($customer->orders->count())

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead>

                                    <tr
                                        class="border-b border-gray-100"
                                    >

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            No. Pesanan
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Tanggal
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Total
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Status
                                        </th>

                                        <th
                                            class="px-4 py-4 text-center
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($customer->orders->sortByDesc('order_date') as $order)

                                        <tr
                                            class="hover:bg-[#FAFAF8]
                                                   transition"
                                        >

                                            <td
                                                class="px-4 py-4
                                                       text-sm font-semibold
                                                       text-gray-900
                                                       whitespace-nowrap"
                                            >
                                                {{ $order->order_number }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       whitespace-nowrap"
                                            >
                                                {{ $order->order_date->format('d M Y H:i') }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm font-semibold
                                                       text-gray-900
                                                       whitespace-nowrap"
                                            >
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       whitespace-nowrap"
                                            >

                                                @php
                                                    $statusClasses = match($order->status) {
                                                        'pending' => 'bg-yellow-50 text-yellow-700',
                                                        'paid' => 'bg-blue-50 text-blue-700',
                                                        'processing' => 'bg-purple-50 text-purple-700',
                                                        'shipped' => 'bg-indigo-50 text-indigo-700',
                                                        'completed' => 'bg-green-50 text-green-700',
                                                        'cancelled' => 'bg-red-50 text-red-600',
                                                        default => 'bg-gray-50 text-gray-600',
                                                    };
                                                @endphp

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           rounded-full
                                                           text-xs
                                                           font-semibold
                                                           {{ $statusClasses }}"
                                                >
                                                    {{ ucfirst($order->status) }}
                                                </span>

                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-center
                                                       whitespace-nowrap"
                                            >

                                                <a
                                                    href="{{ route('orders.show', $order) }}"
                                                    class="inline-flex
                                                           px-3 py-1.5
                                                           rounded-lg
                                                           bg-green-50
                                                           text-[#06330A]
                                                           text-xs
                                                           font-semibold
                                                           hover:bg-green-100
                                                           transition"
                                                >
                                                    Detail
                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="py-8 text-center">

                            <p class="text-sm text-gray-500">
                                Belum ada riwayat pesanan.
                            </p>

                        </div>

                    @endif

                </div>

            </div>



            {{-- =========================
                FEEDBACK HISTORY
            ========================== --}}

            <div
                class="bg-white rounded-2xl
                       border border-gray-100
                       shadow-sm overflow-hidden"
            >

                <div
                    class="p-6 sm:p-8
                           border-b border-gray-100"
                >

                    <div class="flex flex-col sm:flex-row
                                sm:items-center sm:justify-between
                                gap-4">

                        <div>

                            <p class="text-xs font-semibold uppercase
                                      tracking-[0.18em]
                                      text-[#06330A]">
                                Customer Feedback
                            </p>

                            <h3 class="text-xl font-bold
                                       text-gray-900 mt-1">
                                Riwayat Feedback
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Penilaian dan masukan dari pelanggan.
                            </p>

                        </div>


                        <a
                            href="{{ route('feedback.create') }}"
                            class="inline-flex items-center justify-center
                                   px-4 py-2.5 rounded-xl
                                   bg-[#06330A]
                                   text-white
                                   text-sm font-semibold
                                   hover:bg-[#052808]
                                   transition"
                        >
                            + Tambah Feedback
                        </a>

                    </div>

                </div>


                <div class="p-6 sm:p-8">

                    @if ($customer->feedbacks->count())

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead>

                                    <tr
                                        class="border-b border-gray-100"
                                    >

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Tanggal
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Pesanan
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Rating
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Feedback
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Status
                                        </th>

                                        <th
                                            class="px-4 py-4 text-center
                                                   text-xs font-semibold
                                                   text-gray-400 uppercase
                                                   tracking-wider"
                                        >
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($customer->feedbacks as $feedback)

                                        <tr
                                            class="hover:bg-[#FAFAF8]
                                                   transition"
                                        >

                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       whitespace-nowrap"
                                            >
                                                {{ $feedback->created_at->format('d M Y') }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       whitespace-nowrap"
                                            >
                                                {{ $feedback->order?->order_number ?? '-' }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       whitespace-nowrap"
                                            >

                                                <span
                                                    class="inline-flex
                                                           items-center
                                                           px-3 py-1
                                                           rounded-full
                                                           bg-yellow-50
                                                           text-yellow-700
                                                           text-xs
                                                           font-semibold"
                                                >
                                                    ★ {{ $feedback->rating }}/5
                                                </span>

                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-sm text-gray-600
                                                       max-w-sm"
                                            >
                                                {{ \Illuminate\Support\Str::limit($feedback->message, 60) }}
                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       whitespace-nowrap"
                                            >

                                                @php
                                                    $feedbackStatusClasses = match($feedback->status) {
                                                        'new' => 'bg-blue-50 text-blue-700',
                                                        'read' => 'bg-gray-100 text-gray-600',
                                                        'responded' => 'bg-green-50 text-green-700',
                                                        default => 'bg-gray-50 text-gray-600',
                                                    };
                                                @endphp

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           rounded-full
                                                           text-xs
                                                           font-semibold
                                                           {{ $feedbackStatusClasses }}"
                                                >
                                                    {{ ucfirst($feedback->status) }}
                                                </span>

                                            </td>


                                            <td
                                                class="px-4 py-4
                                                       text-center
                                                       whitespace-nowrap"
                                            >

                                                <a
                                                    href="{{ route('feedback.show', $feedback) }}"
                                                    class="inline-flex
                                                           px-3 py-1.5
                                                           rounded-lg
                                                           bg-green-50
                                                           text-[#06330A]
                                                           text-xs
                                                           font-semibold
                                                           hover:bg-green-100
                                                           transition"
                                                >
                                                    Detail
                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="py-8 text-center">

                            <p class="text-sm text-gray-500">
                                Belum ada feedback dari pelanggan ini.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


        </div>

    </div>

</x-app-layout>