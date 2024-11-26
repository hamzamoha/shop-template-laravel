<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Products</title>
    @include('includes.head')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("aside button[toggle-menu]").forEach(e => {
                e.addEventListener("click", function() {
                    let menu = document.querySelector(
                        `aside [toggle-menu-data='${e.getAttribute('toggle-menu')}']`)
                    if (menu.style.maxHeight) {
                        menu.style.maxHeight = null;
                    } else {
                        menu.style.maxHeight = menu.scrollHeight + "px";
                    }
                })
            })
        })
    </script>
</head>

<body>
    @include('includes.header')
    <main>
        <div class="max-w-screen-xl w-full mx-auto">
            <div class="flex gap-5 p-5">
                <aside class="w-1/5 flex flex-col gap-2">
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button toggle-menu="categories"
                            class="bg-gray-200 py-1.5 w-full text-sm font-medium">Categories</button>
                        <div class="max-h-0 transition-all" toggle-menu-data="categories">
                            <div class="flex flex-col gap-1 text-gray-500 py-1">
                                <label for="cat-1" class="block cursor-pointer px-2"><input type="checkbox"
                                        class="w-3" name="cat" id="cat-1"> Cat 1</label>
                                <label for="cat-2" class="block cursor-pointer px-2"><input type="checkbox"
                                        class="w-3" name="cat" id="cat-2"> Cat 2</label>
                                <label for="cat-3" class="block cursor-pointer px-2"><input type="checkbox"
                                        class="w-3" name="cat" id="cat-3"> Cat 3</label>
                                <label for="cat-4" class="block cursor-pointer px-2"><input type="checkbox"
                                        class="w-3" name="cat" id="cat-4"> Cat 4</label>
                                <label for="cat-5" class="block cursor-pointer px-2"><input type="checkbox"
                                        class="w-3" name="cat" id="cat-5"> Cat 5</label>
                                <label for="cat-6" class="block cursor-pointer px-2"><input type="checkbox"
                                        class="w-3" name="cat" id="cat-6"> Cat 6</label>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button toggle-menu="price" class="bg-gray-200 py-1.5 w-full text-sm font-medium">Price</button>
                        <div class="max-h-0 transition-all" toggle-menu-data="price">
                            <div class="grid grid-cols-2 px-1 py-2 text-gray-500 text-sm gap-1">
                                <div>
                                    <div class="text-center">Min</div>
                                    <div class="text-center"><input type="number" min="0" step="1"
                                            class="p-1 text-xs w-full bg-white outline-none border rounded-lg"></div>
                                </div>
                                <div>
                                    <div class="text-center">Max</div>
                                    <div class="text-center"><input type="number" min="0" step="1"
                                            class="p-1 text-xs w-full bg-white outline-none border rounded-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="flex-1">
                    @isset($products)
                        @if (count($products) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                                @foreach ($products as $product)
                                    <div class="border rounded p-2">
                                        <a href="{{ route('products.show', ['product' => $product->slug]) }}"
                                            class="block pt-[100%] relative mb-1">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                title="{{ $product->name }}"
                                                class="absolute inset-0 w-full h-full object-contain bg-slate-200">
                                        </a>
                                        <div>
                                            <a href="{{ route('products.show', ['product' => $product->slug]) }}"
                                                class="block font-medium text-cyan-600 h-6 truncate"
                                                title="{{ $product->name }}">{{ $product->name }}</a>
                                            <span class="block text-lg font-medium">${{ $product->price }}</span>
                                        </div>
                                        <div>
                                            @auth
                                                <button id="add_to_cart" data-product-id="{{ $product->id }}"
                                                    class="bg-cyan-600 text-white py-1 block w-full rounded transition-all hover:bg-cyan-500">Add
                                                    to Cart</button>
                                            @endauth
                                            @guest
                                                <a href="{{ route('login') }}"
                                                    class="block text-white py-1 w-full text-center bg-cyan-600 rounded hover:bg-gray-200 hover:text-black group">
                                                    <span class="group-hover:block hidden">Login Required</span>
                                                    <span class="group-hover:hidden block">Add to Cart</span>
                                                </a>
                                            @endguest
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-center items-center gap-1 py-3 mb-5">
                                @php
                                    $start = max(1, $products->currentPage() - 2);
                                    $end = min($start + 4, $products->lastPage());
                                    $start = max(1, $end - 4);
                                @endphp
                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $products->currentPage())
                                        <span class="px-2 py-1 rounded bg-gray-200 text-black">{{ $i }}</span>
                                    @else
                                        <a class="px-2 py-1 rounded bg-cyan-600 text-white" href="{{ $products->url($i) }}">{{ $i }}</a>
                                    @endif
                                @endfor
                            </div>
                        @endif
                    @endisset
                    <div></div>
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>

</html>
