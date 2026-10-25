@php
use App\Models\Order;
use App\Models\CustomFitting;
use App\Models\Feedback;

$pendingOrdersCount = 0;
$pendingFittingsCount = 0;
$unansweredFeedbackCount = 0;

if (auth()->check() && auth()->user()->role === 'admin') {
    $pendingOrdersCount = Order::where('status', 'pending')->count();

    $pendingFittingsCount = CustomFitting::where('status', 'pending')->count();

    $unansweredFeedbackCount = Feedback::where(function ($query) {
        $query->whereNull('response')
              ->orWhere('response', '');
    })->count();
}


@endphp

<nav
    x-data="{ open: false }"
    class="bg-[#F7F7F5] border-b border-gray-200"
>

<!-- Desktop Navigation -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex justify-between h-20">

        <!-- Logo -->
        <div class="flex items-center">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3"
            >

                <img
                    src="{{ asset('storage/images/logo-yama-green.png') }}"
                    alt="Yama Golf Store"
                    class="w-11 h-11 object-contain"
                >

                <div class="leading-tight">

                    <p class="text-sm font-bold tracking-wide text-[#06330A]">
                        YAMA GOLF STORE
                    </p>

                    <p class="text-[10px] text-gray-400 tracking-[0.18em] uppercase">
                        Palembang
                    </p>

                </div>

            </a>

        </div>


        <!-- Desktop Menu -->
        <div class="hidden sm:flex items-center gap-1">

            <!-- Dashboard -->
            <a
                href="{{ route('dashboard') }}"
                class="px-4 py-2 rounded-xl text-sm font-medium transition
                    {{ request()->routeIs('dashboard')
                        ? 'bg-[#06330A] text-white'
                        : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
            >
                Dashboard
            </a>


            @if(auth()->user()->role === 'admin')

                <!-- Pelanggan -->
                <a
                    href="{{ route('customers.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('customers.*')
                            ? 'bg-[#06330A] text-white'
                            : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
                >
                    Pelanggan
                </a>


                <!-- Produk -->
                <a
                    href="{{ route('products.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('products.*')
                            ? 'bg-[#06330A] text-white'
                            : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
                >
                    Produk
                </a>


                <!-- Pesanan -->
                <a
                    href="{{ route('orders.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('orders.*')
                            ? 'bg-[#06330A] text-white'
                            : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
                >

                    <span class="inline-flex items-center gap-2">
                        Pesanan

                        @if($pendingOrdersCount > 0)
                            <span
                                class="inline-flex items-center justify-center
                                       min-w-[20px] h-5 px-1.5
                                       rounded-full
                                       bg-red-500 text-white
                                       text-[10px] font-bold"
                            >
                                {{ $pendingOrdersCount > 99 ? '99+' : $pendingOrdersCount }}
                            </span>
                        @endif

                    </span>

                </a>


                <!-- Custom Fitting -->
                <a
                    href="{{ route('custom-fittings.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('custom-fittings.*')
                            ? 'bg-[#06330A] text-white'
                            : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
                >

                    <span class="inline-flex items-center gap-2">
                        Custom Fitting

                        @if($pendingFittingsCount > 0)
                            <span
                                class="inline-flex items-center justify-center
                                       min-w-[20px] h-5 px-1.5
                                       rounded-full
                                       bg-red-500 text-white
                                       text-[10px] font-bold"
                            >
                                {{ $pendingFittingsCount > 99 ? '99+' : $pendingFittingsCount }}
                            </span>
                        @endif

                    </span>

                </a>


                <!-- Feedback -->
                <a
                    href="{{ route('feedback.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('feedback.*')
                            ? 'bg-[#06330A] text-white'
                            : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
                >

                    <span class="inline-flex items-center gap-2">
                        Feedback

                        @if($unansweredFeedbackCount > 0)
                            <span
                                class="inline-flex items-center justify-center
                                       min-w-[20px] h-5 px-1.5
                                       rounded-full
                                       bg-red-500 text-white
                                       text-[10px] font-bold"
                            >
                                {{ $unansweredFeedbackCount > 99 ? '99+' : $unansweredFeedbackCount }}
                            </span>
                        @endif

                    </span>

                </a>


                <!-- Laporan -->
                <a
                    href="{{ route('reports.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('reports.*')
                            ? 'bg-[#06330A] text-white'
                            : 'text-gray-600 hover:bg-white hover:text-[#06330A]' }}"
                >
                    Laporan
                </a>

            @endif

        </div>


        <!-- User -->
        <div class="hidden sm:flex items-center">

            <x-dropdown align="right" width="48">

                <x-slot name="trigger">

                    <button
                        class="flex items-center gap-3 px-3 py-2 rounded-xl
                               hover:bg-white transition"
                    >

                        <div
                            class="w-9 h-9 rounded-full bg-[#06330A]
                                   text-white flex items-center justify-center
                                   text-sm font-semibold"
                        >
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="text-left leading-tight">

                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-[11px] text-gray-400">
                                Administrator
                            </p>

                        </div>

                        <svg
                            class="w-4 h-4 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="m19 9-7 7-7-7"
                            />
                        </svg>

                    </button>

                </x-slot>


                <x-slot name="content">

                    <x-dropdown-link :href="route('profile.edit')">
                        Profile
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <x-dropdown-link
                            :href="route('logout')"
                            onclick="event.preventDefault();
                                this.closest('form').submit();"
                        >
                            Log Out
                        </x-dropdown-link>

                    </form>

                </x-slot>

            </x-dropdown>

        </div>


        <!-- Mobile Button -->
        <div class="-me-2 flex items-center sm:hidden">

            <button
                @click="open = ! open"
                class="inline-flex items-center justify-center
                       p-2 rounded-xl text-gray-500
                       hover:bg-white transition"
            >

                <svg
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                >

                    <path
                        :class="{ 'hidden': open, 'inline-flex': !open }"
                        class="inline-flex"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />

                    <path
                        :class="{ 'hidden': !open, 'inline-flex': open }"
                        class="hidden"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />

                </svg>

            </button>

        </div>

    </div>

</div>


<!-- Mobile Navigation -->
<div
    :class="{ 'block': open, 'hidden': !open }"
    class="hidden sm:hidden border-t border-gray-200 bg-white"
>

    <div class="px-4 py-4 space-y-1">

        <!-- Dashboard -->
        <a
            href="{{ route('dashboard') }}"
            class="block px-4 py-3 rounded-xl text-sm font-medium
                {{ request()->routeIs('dashboard')
                    ? 'bg-[#06330A] text-white'
                    : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
        >
            Dashboard
        </a>


        @if(auth()->user()->role === 'admin')

            <!-- Pelanggan -->
            <a
                href="{{ route('customers.index') }}"
                class="flex items-center justify-between
                       px-4 py-3 rounded-xl text-sm font-medium
                       {{ request()->routeIs('customers.*')
                           ? 'bg-[#06330A] text-white'
                           : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
            >
                <span>Pelanggan</span>
            </a>


            <!-- Produk -->
            <a
                href="{{ route('products.index') }}"
                class="flex items-center justify-between
                       px-4 py-3 rounded-xl text-sm font-medium
                       {{ request()->routeIs('products.*')
                           ? 'bg-[#06330A] text-white'
                           : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
            >
                <span>Produk</span>
            </a>


            <!-- Pesanan -->
            <a
                href="{{ route('orders.index') }}"
                class="flex items-center justify-between
                       px-4 py-3 rounded-xl text-sm font-medium
                       {{ request()->routeIs('orders.*')
                           ? 'bg-[#06330A] text-white'
                           : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
            >

                <span>Pesanan</span>

                @if($pendingOrdersCount > 0)
                    <span
                        class="inline-flex items-center justify-center
                               min-w-[22px] h-5 px-1.5
                               rounded-full
                               bg-red-500 text-white
                               text-[10px] font-bold"
                    >
                        {{ $pendingOrdersCount > 99 ? '99+' : $pendingOrdersCount }}
                    </span>
                @endif

            </a>


            <!-- Custom Fitting -->
            <a
                href="{{ route('custom-fittings.index') }}"
                class="flex items-center justify-between
                       px-4 py-3 rounded-xl text-sm font-medium
                       {{ request()->routeIs('custom-fittings.*')
                           ? 'bg-[#06330A] text-white'
                           : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
            >

                <span>Custom Fitting</span>

                @if($pendingFittingsCount > 0)
                    <span
                        class="inline-flex items-center justify-center
                               min-w-[22px] h-5 px-1.5
                               rounded-full
                               bg-red-500 text-white
                               text-[10px] font-bold"
                    >
                        {{ $pendingFittingsCount > 99 ? '99+' : $pendingFittingsCount }}
                    </span>
                @endif

            </a>


            <!-- Feedback -->
            <a
                href="{{ route('feedback.index') }}"
                class="flex items-center justify-between
                       px-4 py-3 rounded-xl text-sm font-medium
                       {{ request()->routeIs('feedback.*')
                           ? 'bg-[#06330A] text-white'
                           : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
            >

                <span>Feedback</span>

                @if($unansweredFeedbackCount > 0)
                    <span
                        class="inline-flex items-center justify-center
                               min-w-[22px] h-5 px-1.5
                               rounded-full
                               bg-red-500 text-white
                               text-[10px] font-bold"
                    >
                        {{ $unansweredFeedbackCount > 99 ? '99+' : $unansweredFeedbackCount }}
                    </span>
                @endif

            </a>


            <!-- Laporan -->
            <a
                href="{{ route('reports.index') }}"
                class="flex items-center justify-between
                       px-4 py-3 rounded-xl text-sm font-medium
                       {{ request()->routeIs('reports.*')
                           ? 'bg-[#06330A] text-white'
                           : 'text-gray-600 hover:bg-[#F7F7F5]' }}"
            >
                <span>Laporan</span>
            </a>

        @endif

    </div>


    <!-- Mobile User -->
    <div class="border-t border-gray-100 px-4 py-4">

        <div class="flex items-center gap-3 mb-4">

            <div
                class="w-10 h-10 rounded-full bg-[#06330A]
                       text-white flex items-center justify-center
                       font-semibold"
            >
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div>

                <p class="text-sm font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ Auth::user()->email }}
                </p>

            </div>

        </div>


        <div class="space-y-1">

            <a
                href="{{ route('profile.edit') }}"
                class="block px-4 py-3 rounded-xl text-sm
                       text-gray-600 hover:bg-[#F7F7F5]"
            >
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="w-full text-left px-4 py-3 rounded-xl
                           text-sm text-gray-600 hover:bg-[#F7F7F5]"
                >
                    Log Out
                </button>

            </form>

        </div>

    </div>

</div>


</nav>
