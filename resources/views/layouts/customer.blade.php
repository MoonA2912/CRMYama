<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yama Golf Store') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 p-0 bg-[#F7F7F5] text-gray-900 antialiased">

    {{-- CUSTOMER NAVBAR --}}
    <nav class="bg-[#F7F7F5] border-b border-gray-200">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex items-center justify-between">

            {{-- LOGO + BRAND --}}
            <a href="{{ route('catalog') }}" class="flex items-center gap-3">

                <img
                    src="{{ asset('logo-yama-green.png') }}"
                    alt="Yama Golf Store"
                    class="h-12 w-12 object-contain"
                >

                <div class="hidden sm:block">
                    <p class="text-[10px] tracking-[0.3em] uppercase text-[#06330A]/50">
                        Yama Golf Store
                    </p>

                    <p class="text-sm font-semibold text-[#06330A]">
                        Golf Store
                    </p>
                </div>

            </a>


            {{-- NAVIGATION --}}
            <div class="hidden md:flex items-center gap-1">

                {{-- CATALOG --}}
                <a
                    href="{{ route('catalog') }}"
                    class="px-4 py-2 text-sm rounded-md
                    {{ request()->routeIs('catalog*')
                        ? 'text-[#06330A] bg-[#06330A]/5 font-medium'
                        : 'text-gray-500 hover:text-[#06330A]' }}
                    transition"
                >
                    Catalog
                </a>


                @auth

                {{-- ORDERS --}}
                @if(Route::has('customer.orders'))

                    <a
                        href="{{ route('customer.orders') }}"
                        class="px-4 py-2 text-sm rounded-md
                        {{ request()->routeIs('customer.orders*')
                            ? 'text-[#06330A] bg-[#06330A]/5 font-medium'
                            : 'text-gray-500 hover:text-[#06330A]' }}
                        transition"
                    >
                        Orders
                    </a>

                @endif


                {{-- CUSTOM FITTING --}}
                @if(Route::has('customer.custom-fittings'))

                    <a
                        href="{{ route('customer.custom-fittings') }}"
                        class="px-4 py-2 text-sm rounded-md
                        {{ request()->routeIs('customer.custom-fittings*')
                            ? 'text-[#06330A] bg-[#06330A]/5 font-medium'
                            : 'text-gray-500 hover:text-[#06330A]' }}
                        transition"
                    >
                        Custom Fitting
                    </a>

                @endif


                {{-- FEEDBACK --}}
                @if(Route::has('customer.feedback'))

                    <a
                        href="{{ route('customer.feedback') }}"
                        class="px-4 py-2 text-sm rounded-md
                        {{ request()->routeIs('customer.feedback*')
                            ? 'text-[#06330A] bg-[#06330A]/5 font-medium'
                            : 'text-gray-500 hover:text-[#06330A]' }}
                        transition"
                    >
                        Feedback
                    </a>

                @endif


                {{-- PROFILE --}}
                @if(Route::has('profile.edit'))

                    <a
                        href="{{ route('profile.edit') }}"
                        class="px-4 py-2 text-sm rounded-md
                        {{ request()->routeIs('profile.*')
                            ? 'text-[#06330A] bg-[#06330A]/5 font-medium'
                            : 'text-gray-500 hover:text-[#06330A]' }}
                        transition"
                    >
                        Profile
                    </a>

                @endif


                {{-- CART --}}
                @if(Route::has('cart.index'))

                    <a
                        href="{{ route('cart.index') }}"
                        class="ml-2 inline-flex items-center gap-2
                        px-4 py-2 rounded-full
                        bg-[#06330A] text-white
                        text-sm font-medium
                        hover:bg-[#06330A]/90
                        transition"
                    >

                        <span>Cart</span>

                        @auth

                            @php
                                $cartCount = auth()->user()->carts()->sum('quantity');
                            @endphp

                            @if($cartCount > 0)

                                <span
                                    class="min-w-5 h-5 px-1.5
                                    rounded-full bg-white
                                    text-[#06330A]
                                    text-[10px] font-semibold
                                    flex items-center justify-center"
                                >
                                    {{ $cartCount }}
                                </span>

                            @endif

                        @endauth

                    </a>

                @endif

                @endauth

            </div>


            {{-- USER --}}
            <div class="hidden md:flex items-center gap-4">

                @auth

                    <div class="text-right">

                        <p class="text-[10px] uppercase tracking-wide text-gray-400">
                            Welcome
                        </p>

                        <p class="text-sm font-medium text-[#06330A]">
                            {{ auth()->user()->name }}
                        </p>

                    </div>


                    {{-- LOGOUT --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="text-xs text-gray-400
                            hover:text-[#06330A]
                            transition"
                        >
                            Logout
                        </button>

                    </form>

                @endauth

                @guest

                    <a
                        href="{{ route('login') }}"
                        class="px-4 py-2 text-sm text-gray-500 hover:text-[#06330A]"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-full bg-[#06330A] px-4 py-2 text-sm font-medium text-white hover:bg-[#06330A]/90"
                    >
                        Register
                    </a>

                @endguest

            </div>


            {{-- MOBILE BUTTON --}}
            <button
                type="button"
                class="md:hidden w-10 h-10
                rounded-md border border-gray-300
                text-[#06330A]
                hover:bg-white transition"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
            >
                ☰
            </button>

        </div>


        {{-- MOBILE MENU --}}
        <div
            id="mobile-menu"
            class="hidden md:hidden border-t border-gray-200"
        >

            <div class="px-6 py-4 space-y-1">

                {{-- CATALOG --}}
                <a
                    href="{{ route('catalog') }}"
                    class="block px-4 py-3 rounded-md
                    text-sm text-[#06330A]"
                >
                    Catalog
                </a>


                @auth

                {{-- ORDERS --}}
                @if(Route::has('customer.orders'))

                    <a
                        href="{{ route('customer.orders') }}"
                        class="block px-4 py-3 rounded-md
                        text-sm text-gray-500"
                    >
                        Orders
                    </a>

                @endif


                {{-- CUSTOM FITTING --}}
                @if(Route::has('customer.custom-fittings'))

                    <a
                        href="{{ route('customer.custom-fittings') }}"
                        class="block px-4 py-3 rounded-md
                        text-sm text-gray-500"
                    >
                        Custom Fitting
                    </a>

                @endif


                {{-- FEEDBACK --}}
                @if(Route::has('customer.feedback'))

                    <a
                        href="{{ route('customer.feedback') }}"
                        class="block px-4 py-3 rounded-md
                        text-sm text-gray-500"
                    >
                        Feedback
                    </a>

                @endif


                {{-- PROFILE --}}
                @if(Route::has('profile.edit'))

                    <a
                        href="{{ route('profile.edit') }}"
                        class="block px-4 py-3 rounded-md
                        text-sm text-gray-500"
                    >
                        Profile
                    </a>

                @endif


                {{-- CART --}}
                @if(Route::has('cart.index'))

                    <a
                        href="{{ route('cart.index') }}"
                        class="block px-4 py-3 rounded-md
                        text-sm text-gray-500"
                    >
                        Cart
                    </a>

                @endif

                @endauth


                @auth

                    <div class="border-t border-gray-200 mt-3 pt-3">

                        <p class="px-4 text-xs text-gray-400">
                            Signed in as
                        </p>

                        <p class="px-4 mt-1 text-sm font-medium text-[#06330A]">
                            {{ auth()->user()->name }}
                        </p>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="mt-2"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="w-full text-left
                                px-4 py-3
                                text-sm text-gray-500
                                hover:text-[#06330A]"
                            >
                                Logout
                            </button>

                        </form>

                    </div>

                @endauth

                @guest

                    <div class="border-t border-gray-200 mt-3 pt-3">
                        <a
                            href="{{ route('login') }}"
                            class="block px-4 py-3 text-sm text-gray-500 hover:text-[#06330A]"
                        >
                            Login
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="block px-4 py-3 text-sm font-medium text-[#06330A]"
                        >
                            Register
                        </a>
                    </div>

                @endguest

            </div>

        </div>

    </nav>


    {{-- PAGE HEADER --}}
    @if (isset($header))

        <header class="bg-[#F7F7F5]">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
                {{ $header }}
            </div>

        </header>

    @endif


    {{-- MAIN CONTENT --}}
    <main>
        {{ $slot }}
    </main>

</body>

</html>