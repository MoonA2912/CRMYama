@php
    $catalogLayout = auth()->check() && auth()->user()->role === 'admin'
        ? 'app-layout'
        : 'customer-layout';
@endphp

<x-dynamic-component :component="$catalogLayout">

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <section class="bg-[#F7F7F5]">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-12 pb-8">

            <div class="w-full">

                <p class="text-[11px]
                          tracking-[0.28em]
                          uppercase
                          text-[#06330A]/50
                          font-medium">
                    Yama Golf Store
                </p>

                <h1 class="mt-3
                           text-3xl
                           md:text-4xl
                           font-semibold
                           tracking-tight
                           text-[#06330A]">
                    Golf Equipment
                </h1>

                <p class="mt-3
                          text-sm
                          md:text-base
                          leading-7
                          text-gray-500">
                    Explore our collection of golf equipment and services
                    designed to support your game.
                </p>
                <form
    method="GET"
    action="{{ route('catalog') }}"
    class="mt-6 w-full"
>
    <div class="relative">

        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Search products..."
            class="w-full
                   h-12
                   pl-4
                   pr-24
                   rounded-xl
                   border border-gray-200
                   bg-white
                   text-sm
                   text-gray-900
                   placeholder-gray-400
                   focus:border-[#06330A]
                   focus:ring-1
                   focus:ring-[#06330A]
                   outline-none
                   transition"
        >

        <button
            type="submit"
            class="absolute
                   right-1.5
                   top-1.5
                   h-9
                   px-4
                   rounded-lg
                   bg-[#06330A]
                   text-white
                   text-xs
                   font-medium
                   hover:bg-[#06330A]/90
                   transition"
        >
            Search
        </button>

    </div>
</form>
{{-- CATEGORY FILTER --}}
@if($categories->count() > 0)

    <div class="mt-4 flex flex-wrap items-center gap-2">

        <a
            href="{{ route('catalog', ['search' => $search]) }}"
            class="px-4 py-2
                   rounded-full
                   text-xs
                   font-medium
                   transition
                   {{ empty($category)
                        ? 'bg-[#06330A] text-white'
                        : 'bg-white text-gray-500 border border-gray-200 hover:text-[#06330A]' }}"
        >
            All
        </a>

        @foreach($categories as $item)

            <a
                href="{{ route('catalog', [
                    'search' => $search,
                    'category' => $item
                ]) }}"
                class="px-4 py-2
                       rounded-full
                       text-xs
                       font-medium
                       transition
                       {{ $category === $item
                            ? 'bg-[#06330A] text-white'
                            : 'bg-white text-gray-500 border border-gray-200 hover:text-[#06330A]' }}"
            >
                {{ $item }}
            </a>

        @endforeach

    </div>

@endif
            </div>

        </div>

    </section>


    {{-- =========================
        PRODUCT CATALOG
    ========================== --}}
    <section class="bg-[#F7F7F5] pb-16">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            @if($products->count() > 0)

                <div class="grid
                            grid-cols-2
                            sm:grid-cols-2
                            lg:grid-cols-4
                            gap-x-5
                            gap-y-8">

                    @foreach($products as $product)

                        <a
                            href="{{ route('catalog.show', $product) }}"
                            class="group block"
                        >

                            {{-- PRODUCT IMAGE --}}
                            <div
                                class="relative
                                       aspect-square
                                       bg-white
                                       rounded-2xl
                                       overflow-hidden
                                       border border-gray-200/70
                                       flex items-center justify-center
                                       transition duration-300
                                       group-hover:shadow-md
                                       group-hover:-translate-y-1"
                            >

                                @if($product->image)

                                    <img
                                        src="{{ \App\Support\StoredMediaUrl::resolve($product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-[75%]
                                               h-[75%]
                                               object-contain
                                               transition duration-500
                                               group-hover:scale-105"
                                    >

                                @else

                                    <div class="text-center">

                                        <div class="text-xs text-gray-400">
                                            No image
                                        </div>

                                    </div>

                                @endif

                            </div>


                            {{-- PRODUCT INFORMATION --}}
                            <div class="pt-4 px-1">

                                <p class="text-[10px]
                                          uppercase
                                          tracking-[0.18em]
                                          text-gray-400">
                                    {{ $product->category }}
                                </p>

                                <h2
                                    class="mt-1
                                           text-sm
                                           font-medium
                                           text-gray-900
                                           leading-5
                                           group-hover:text-[#06330A]
                                           transition"
                                >
                                    {{ $product->name }}
                                </h2>

                                <p
                                    class="mt-2
                                           text-sm
                                           font-semibold
                                           text-[#06330A]"
                                >
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                @if($product->stock > 0)

                                    <p class="mt-1 text-[11px] text-gray-400">
                                        {{ $product->stock }} available
                                    </p>

                                @else

                                    <p class="mt-1 text-[11px] text-red-500">
                                        Out of stock
                                    </p>

                                @endif

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div
                    class="bg-white
                           border border-gray-200
                           rounded-2xl
                           py-20
                           text-center"
                >

                    <p class="text-sm text-gray-500">
                        Belum ada produk tersedia.
                    </p>

                </div>

            @endif

        </div>

    </section>

</x-dynamic-component>