<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password — Yama Golf Store</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 p-0 text-white antialiased">

    <main
        class="min-h-screen w-full relative flex items-center justify-center px-6
               bg-cover bg-center"
        style="background-image: url('{{ asset('Landing.png') }}');"
    >

        {{-- DARK GREEN OVERLAY --}}
        <div class="absolute inset-0 bg-[#06330A]/85"></div>


        {{-- CONTENT --}}
        <div class="relative z-10 w-full max-w-md">


            {{-- LOGO --}}
            <div class="flex justify-center mb-4">

                <a href="{{ url('/') }}" class="inline-block">

                    <img
                        src="{{ asset('logo-yama.png') }}"
                        alt="Yama Golf Store"
                        class="h-28 w-28 object-contain"
                    >

                </a>

            </div>


            {{-- BRAND --}}
            <div class="text-center">

                <p class="text-[11px] tracking-[0.4em] uppercase text-white/70">
                    Yama Golf Store
                </p>

            </div>


            {{-- DIVIDER --}}
            <div class="flex items-center gap-4 my-7">

                <div class="h-px flex-1 bg-white/15"></div>

                <span class="text-[10px] tracking-[0.2em] uppercase text-white/35">
                    Reset password
                </span>

                <div class="h-px flex-1 bg-white/15"></div>

            </div>


            {{-- DESCRIPTION --}}
            <div class="text-center mb-7">

                <p class="text-sm leading-6 text-white/60">
                    Enter your email address and we'll send you a link
                    to reset your password.
                </p>

            </div>


            {{-- SESSION STATUS --}}
            <x-auth-session-status
                class="mb-5 text-sm text-white"
                :status="session('status')"
            />


            {{-- FORGOT PASSWORD FORM --}}
            <form method="POST" action="{{ route('password.email') }}">

                @csrf


                {{-- EMAIL --}}
                <div>

                    <x-input-label
                        for="email"
                        :value="__('Email address')"
                        class="text-xs font-medium tracking-wide text-white/80"
                    />

                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        class="block mt-3 w-full
                               h-12
                               bg-black/20
                               border border-white/25
                               text-white
                               placeholder-white/30
                               rounded-md
                               px-4
                               text-sm
                               shadow-none
                               focus:border-white/60
                               focus:ring-0
                               focus:bg-black/30
                               transition"
                    />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2"
                    />

                </div>


                {{-- SEND BUTTON --}}
                <div class="mt-8">

                    <x-primary-button
                        class="w-full
                               h-12
                               justify-center
                               bg-white
                               hover:bg-white/90
                               text-[#06330A]
                               rounded-md
                               text-xs
                               font-semibold
                               tracking-[0.12em]
                               uppercase
                               shadow-none
                               transition"
                    >
                        {{ __('Email password reset link') }}
                    </x-primary-button>

                </div>

            </form>


            {{-- BACK TO LOGIN --}}
            <div class="text-center mt-8">

                <a
                    href="{{ route('login') }}"
                    class="text-sm text-white/55
                           hover:text-white
                           underline
                           underline-offset-4
                           transition"
                >
                    ← Back to sign in
                </a>

            </div>


            {{-- BACK TO HOME --}}
            <div class="text-center mt-7">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-2
                           text-[10px]
                           tracking-[0.18em]
                           uppercase
                           text-white/40
                           hover:text-white/80
                           transition"
                >
                    <span>←</span>
                    Back to Yama
                </a>

            </div>

        </div>

    </main>

</body>
</html>