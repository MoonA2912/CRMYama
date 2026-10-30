<div x-data="{ visible: false }" class="relative">
    <x-text-input
        {{ $attributes->merge(['class' => 'pr-12']) }}
        x-bind:type="visible ? 'text' : 'password'"
    />

    <button
        type="button"
        class="absolute inset-y-0 right-2 flex items-center rounded px-2 text-current hover:opacity-70 focus:outline-none focus-visible:ring-2 focus-visible:ring-current"
        x-on:click="visible = !visible"
        x-bind:aria-label="visible ? @js(__('Hide password')) : @js(__('Show password'))"
        x-bind:aria-pressed="visible.toString()"
    >
        <svg
            x-show="!visible"
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6-9.75-6-9.75-6Z" />
            <circle cx="12" cy="12" r="3" stroke-width="1.5" />
        </svg>

        <svg
            x-show="visible"
            style="display: none;"
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3l18 18M10.58 10.59a2 2 0 0 0 2.83 2.83M9.88 5.09A10.7 10.7 0 0 1 12 4.88c6.25 0 9.75 7.12 9.75 7.12a16.9 16.9 0 0 1-3.05 3.78M6.61 6.61C3.85 8.4 2.25 12 2.25 12s3.5 7.12 9.75 7.12a10.7 10.7 0 0 0 4.18-.83" />
        </svg>
    </button>
</div>
