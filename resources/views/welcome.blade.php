<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yama Golf Store</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white">

    {{-- =========================
        HERO
    ========================== --}}
    <section
        class="relative min-h-screen bg-cover bg-center overflow-hidden"
        style="background-image: url('{{ asset('Landing.png') }}');"
    >

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/35"></div>


        {{-- =========================
            NAVBAR
        ========================== --}}
        <nav class="absolute top-0 left-0 right-0 z-20">

            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-6
                        flex items-center">

                {{-- LOGO --}}
                <a href="{{ url('/') }}" class="block">

                    <img
                    src="{{ asset('logo-yama.png') }}"
                    alt="Yama Golf Store"
                    class="h-14 w-14 object-contain"
                    >

                </a>


                {{-- MENU KANAN --}}
                <div class="ml-auto flex items-center gap-2 sm:gap-3">

                    {{-- KATALOG --}}
                    <a
                        href="{{ route('catalog') }}"
                        class="hidden sm:inline-flex
                               px-5 py-2.5
                               border border-white/80
                               rounded-full
                               text-sm font-medium
                               text-white
                               bg-transparent
                               hover:bg-white
                               hover:text-black
                               transition duration-300"
                    >
                        Katalog
                    </a>


                    @guest

                        {{-- LOGIN --}}
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex
                                   px-5 py-2.5
                                   border border-white/80
                                   rounded-full
                                   text-sm font-medium
                                   text-white
                                   bg-transparent
                                   hover:bg-white
                                   hover:text-black
                                   transition duration-300"
                        >
                            Login
                        </a>


                        {{-- REGISTER --}}
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex
                                   px-5 py-2.5
                                   border border-white/80
                                   rounded-full
                                   text-sm font-medium
                                   text-white
                                   bg-transparent
                                   hover:bg-white
                                   hover:text-black
                                   transition duration-300"
                        >
                            Register
                        </a>

                    @else

                        {{-- SUDAH LOGIN --}}
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex
                                   px-5 py-2.5
                                   border border-white/80
                                   rounded-full
                                   text-sm font-medium
                                   text-white
                                   bg-transparent
                                   hover:bg-white
                                   hover:text-black
                                   transition duration-300"
                        >
                            Masuk
                        </a>

                    @endguest

                </div>

            </div>

        </nav>


        {{-- =========================
            HERO CONTENT
        ========================== --}}
        <div class="relative z-10 min-h-screen
                    flex items-center justify-center
                    text-center px-6">

            <div class="max-w-xl">

                {{-- SMALL TEXT --}}
                <p class="text-xs sm:text-sm
                          tracking-[0.4em]
                          uppercase
                          text-white/90">
                    Yama Golf Store
                </p>


                {{-- TITLE --}}
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl
                           font-semibold
                           tracking-tight
                           text-white
                           mt-4"
                >
                    Play Your Game.
                </h1>


                {{-- SUBTITLE --}}
                <p class="text-sm sm:text-base
                          text-white/85
                          mt-4">
                    Golf equipment & custom services.
                </p>


                {{-- BUTTON --}}
                <a
                    href="{{ route('catalog') }}"
                    class="inline-flex
                           mt-7
                           px-7 py-3
                           border border-white
                           rounded-full
                           text-sm font-medium
                           text-white
                           bg-transparent
                           hover:bg-white
                           hover:text-black
                           transition duration-300"
                >
                    Explore Store
                </a>

            </div>

        </div>


        {{-- =========================
            SCROLL INDICATOR
        ========================== --}}
        <div
            class="absolute bottom-7
                   left-1/2
                   -translate-x-1/2
                   z-10"
        >

            <div class="w-px h-8 bg-white/70"></div>

        </div>

    </section>


    {{-- =========================
        FOOTER
    ========================== --}}
    <footer class="bg-black py-6">

        <div
            class="max-w-7xl mx-auto
                   px-6 lg:px-10
                   flex flex-col sm:flex-row
                   items-center
                   justify-between
                   gap-3"
        >

            {{-- COPYRIGHT --}}
            <p class="text-xs text-gray-500">
                © {{ date('Y') }} Yama Golf Store · Palembang
            </p>


            {{-- SOCIAL MEDIA --}}
            <div class="flex items-center gap-5">

                {{-- INSTAGRAM --}}
                <a
                    href="https://www.instagram.com/yamagolf.id"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-xs text-gray-500
                           hover:text-white
                           transition"
                >
                    Instagram
                </a>


                {{-- WHATSAPP --}}
                <a
                    href="https://wa.me/6282175559111"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-xs text-gray-500
                           hover:text-white
                           transition"
                >
                    WhatsApp
                </a>

            </div>

        </div>

    </footer>

</body>
</html>