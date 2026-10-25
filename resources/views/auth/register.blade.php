<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register — Yama Golf Store</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 p-0 text-white antialiased">

    <main
        class="min-h-screen w-full relative flex items-center justify-center px-6
               bg-cover bg-center"
        style="background-image: url('{{ asset('storage/images/Landing.png') }}');"
    >

        {{-- DARK GREEN OVERLAY --}}
        <div class="absolute inset-0 bg-[#06330A]/85"></div>


        {{-- CONTENT --}}
        <div class="relative z-10 w-full max-w-md py-10">


            {{-- LOGO --}}
            <div class="flex justify-center mb-4">

                <a href="{{ url('/') }}" class="inline-block">

                    <img
                        src="{{ asset('storage/images/logo-yama.png') }}"
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
                    Create account
                </span>

                <div class="h-px flex-1 bg-white/15"></div>

            </div>


            {{-- REGISTER FORM --}}
            <form method="POST" action="{{ route('register') }}">

                @csrf


                {{-- NAME --}}
                <div>

                    <x-input-label
                        for="name"
                        :value="__('Full name')"
                        class="text-xs font-medium tracking-wide text-white"
                    />

                    <x-text-input
                        id="name"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
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
                        :messages="$errors->get('name')"
                        class="mt-2"
                    />

                </div>


                {{-- EMAIL --}}
                <div class="mt-5">

                    <x-input-label
                        for="email"
                        :value="__('Email address')"
                        class="text-xs font-medium tracking-wide text-white"
                    />

                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
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


                {{-- PASSWORD --}}
                <div class="mt-5">

                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="text-xs font-medium tracking-wide text-white"
                    />

                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
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
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />

                </div>


                {{-- CONFIRM PASSWORD --}}
                <div class="mt-5">

                    <x-input-label
                        for="password_confirmation"
                        :value="__('Confirm password')"
                        class="text-xs font-medium tracking-wide text-white"
                    />

                    <x-text-input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
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
                        :messages="$errors->get('password_confirmation')"
                        class="mt-2"
                    />

                </div>


                {{-- REGISTER BUTTON --}}
                <div class="mt-8">

                    <x-primary-button
                        class="w-full
                               h-12 justify-center 
                               bg-[#06330A] 
                               hover:bg-[#0A4710] 
                               text-white 
                               rounded-md 
                               text-xs 
                               font-semibold 
                               tracking-[0.12em] 
                               uppercase 
                               shadow-none 
                               transition"
                    >
                        {{ __('Create account') }}
                    </x-primary-button>

                </div>

            </form>


            {{-- LOGIN --}}
            <div class="text-center mt-8">

                <p class="text-sm text-white/55">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        class="ml-1 text-white
                               hover:text-white/75
                               underline
                               underline-offset-4
                               transition"
                    >
                        Sign in
                    </a>

                </p>

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