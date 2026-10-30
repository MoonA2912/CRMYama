<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    @php
        $customer = $customer ?? auth()->user()->customer;
    @endphp

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- NAMA --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button
                            form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- NOMOR TELEPON --}}
        <div>
            <x-input-label for="phone" value="Nomor Telepon" />

            <x-text-input
                id="phone"
                name="phone"
                type="tel"
                class="mt-1 block w-full"
                :value="old('phone', $customer?->phone)"
                required
                autocomplete="tel"
            />

            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        {{-- ALAMAT --}}
        <div>
            <x-input-label for="address" value="Alamat" />

            <textarea
                id="address"
                name="address"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-800 focus:ring-green-800"
                autocomplete="street-address"
            >{{ old('address', $customer?->address) }}</textarea>

            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        {{-- TANGGAL LAHIR --}}
        <div>
            <x-input-label for="birth_date" value="Tanggal Lahir" />

            <x-text-input
                id="birth_date"
                name="birth_date"
                type="date"
                class="mt-1 block w-full"
                :value="old('birth_date', $customer?->birth_date?->format('Y-m-d'))"
            />

            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>