<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Laravel</title>
    @include('includes.head')
</head>

<body>
    @include('includes.header')
    <main>
        <div class="max-w-screen-xl w-full mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-10 mb-3 sm:mb-4 md:mb-5">
                <div>
                    <div class="pt-[100%] relative">
                        <div class="absolute inset-0 w-full h-full">
                            <img class="w-full h-full object-contain rounded border" src="{{ $product->image_url }}"
                                alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-3 sm:mb-4 md:mb-5 text-cyan-600">
                        {{ $product->name }}</h1>
                    <span
                        class="block mb-3 sm:mb-4 md:mb-5 text-2xl sm:text-3xl md:text-4xl font-bold">${{ $product->price }}</span>
                    <p class="mb-5">{{ $product->description }}</p>
                    <div class="flex flex-wrap gap-2 mb-5">
                        <input type="number" min="1" step="1" value="1"
                            class="h-12 bg-gray-100 w-16 px-2 text-center outline-none">
                        @auth
                            <button id="add_to_cart" data-product-id="{{ $product->id }}"
                                class="bg-cyan-600 text-white font-medium text-xl h-12 px-6 rounded outline-none transition-all hover:bg-cyan-500"><i
                                    class="fa-solid fa-plus"></i> Add to Cart</button>
                        @endauth
                        @guest
                            <button
                                class="bg-cyan-600 text-white font-medium text-xl h-12 px-6 rounded outline-none hover:bg-gray-200 hover:text-black group">
                                <span class="group-hover:block hidden">Login Required</span>
                                <span class="group-hover:hidden block"><i class="fa-solid fa-plus"></i> Add to Cart</span>
                            </button>
                        @endguest
                        <button
                            class="bg-cyan-600 rounded text-xl text-white h-12 w-12 transition-all hover:bg-cyan-500"><i
                                class="fa-solid fa-heart"></i></button>
                    </div>
                    <div class="text-3xl">
                        @php
                            $rating = round(rand(100, 500) / 100, 1); // Average rating
                            $fullStars = floor($rating); // Full stars
                            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0; // Half star
                            $emptyStars = 5 - $fullStars - $halfStar; // Remaining empty stars
                        @endphp

                        {{-- Full stars --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fa-solid fa-star text-yellow-500"></i>
                        @endfor

                        {{-- Half star --}}
                        @if ($halfStar)
                            <i class="fa-regular fa-star-half-stroke text-yellow-500"></i>
                        @endif

                        {{-- Empty stars --}}
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-regular fa-star text-gray-300"></i>
                        @endfor

                        <span>({{ $rating }})</span> <!-- Show numeric rating -->
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-medium mb-2">You might also like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 gap-5 mb-3 sm:mb-4 md:mb-5">
                    @foreach ($recommendations as $item)
                        <div class="border rounded p-2">
                            <a href="{{ route('products.show', $item->slug) }}" class="block pt-[100%] relative mb-1">
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                    class="absolute inset-0 w-full h-full object-contain">
                            </a>
                            <div>
                                <a href="{{ route('products.show', $item->slug) }}"
                                    class="block font-medium text-cyan-600">{{ $item->name }}</a>
                                <span class="block text-lg font-medium">${{ number_format($item->price, 2) }}</span>
                            </div>
                            <div>
                                <button id="add_to_cart" data-product-id="{{ $item->id }}"
                                    class="bg-cyan-600 text-white py-1 block w-full rounded transition-all hover:bg-cyan-500">Add
                                    to Cart</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>

</html>
