<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-sm font-medium text-[#06330A]">
            Yama Golf Store
        </p>

        <h2 class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">
            Feedback Pelanggan
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Kelola masukan, penilaian, dan tanggapan dari pelanggan.
        </p>
    </div>
</x-slot>

<div class="min-h-screen bg-[#F7F7F5] py-8">

    <div class="mx-auto max-w-7xl px-6">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
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


        {{-- MAIN CARD --}}
        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

            {{-- CARD HEADER --}}
            <div class="flex flex-col gap-4 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#06330A]/10 text-xl text-[#06330A]">
                        💬
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-900">
                            Data Feedback
                        </h3>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Riwayat masukan dan balasan pelanggan.
                        </p>
                    </div>

                </div>

                <div class="rounded-full bg-gray-100 px-4 py-2 text-sm text-gray-600">
                    {{ $feedbacks->count() }} Feedback
                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="bg-gray-50/80">

                        <tr class="border-b border-gray-200">

                            <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-700">
                                No
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-700">
                                Pelanggan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-700">
                                Pesanan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-700">
                                Rating
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-700">
                                Feedback
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-700">
                                Balasan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-right font-semibold text-gray-700">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($feedbacks as $feedback)

                            <tr class="border-b border-gray-100 transition hover:bg-gray-50">

                                {{-- NO --}}
                                <td class="whitespace-nowrap px-6 py-4 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- CUSTOMER --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#06330A]/10 font-semibold text-[#06330A]">
                                            {{ strtoupper(substr($feedback->customer->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $feedback->customer->name }}
                                            </p>

                                            @if($feedback->customer->phone)
                                                <p class="mt-0.5 text-xs text-gray-500">
                                                    {{ $feedback->customer->phone }}
                                                </p>
                                            @endif
                                        </div>

                                    </div>

                                </td>


                                {{-- ORDER --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    @if($feedback->order?->order_number)

                                        <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">
                                            {{ $feedback->order->order_number }}
                                        </span>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- RATING --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <span class="text-base tracking-wide text-yellow-500">
                                            {{ str_repeat('★', $feedback->rating) }}
                                        </span>

                                        <span class="text-xs text-gray-400">
                                            {{ $feedback->rating }}/5
                                        </span>

                                    </div>

                                </td>


                                {{-- FEEDBACK --}}
                                <td class="max-w-xs px-6 py-4">

                                    @if($feedback->message)

                                        <p
                                            class="line-clamp-2 text-gray-700"
                                            title="{{ $feedback->message }}"
                                        >
                                            {{ $feedback->message }}
                                        </p>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- RESPONSE --}}
                                <td class="max-w-xs px-6 py-4">

                                    @if($feedback->response)

                                        <div class="flex items-start gap-2">

                                            <span class="mt-0.5 text-[#06330A]">
                                                ↳
                                            </span>

                                            <p
                                                class="line-clamp-2 text-gray-700"
                                                title="{{ $feedback->response }}"
                                            >
                                                {{ $feedback->response }}
                                            </p>

                                        </div>

                                    @else

                                        <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-amber-700">
                                            Belum dibalas
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-end gap-3">

                                        <a
                                            href="{{ route('feedback.show', $feedback) }}"
                                            class="rounded-lg px-3 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-50 hover:text-blue-800"
                                        >
                                            Detail
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('feedback.destroy', $feedback) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus feedback ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 hover:text-red-800"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-2xl">
                                            💬
                                        </div>

                                        <h4 class="mt-4 font-semibold text-gray-900">
                                            Belum ada feedback
                                        </h4>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Feedback pelanggan akan muncul di halaman ini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


</x-app-layout>
