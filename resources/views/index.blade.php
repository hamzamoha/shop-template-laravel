<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Easy Shop - Affordable Online Shopping for Everyone</title>
    @include('includes.head')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const swiper = new Swiper('#hero .swiper', {
                slidesPerView: 1,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                    pauseOnMouseEnter: true,
                }
            });
        })
        document.addEventListener("DOMContentLoaded", () => {
            const swiper = new Swiper('#new_arrivals .swiper', {
                slidesPerView: 2,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                    pauseOnMouseEnter: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    1024: {
                        slidesPerView: 5
                    },
                    1280: {
                        slidesPerView: 6
                    }
                }
            });
        })
    </script>
</head>

<body>
    @include('includes.header')
    <div id="hero">
        <div class="swiper w-full h-[350px] sm:h-[400px] md:h-[500px]">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="/images/hero/hero-1.jpg" alt="Hero"
                        class="block object-cover h-full w-full"></div>
                <div class="swiper-slide"><img src="/images/hero/hero-2.jpg" alt="Hero"
                        class="block object-cover h-full w-full"></div>
                <div class="swiper-slide"><img src="/images/hero/hero-3.jpg" alt="Hero"
                        class="block object-cover h-full w-full"></div>
                <div class="swiper-slide"><img src="/images/hero/hero-4.jpg" alt="Hero"
                        class="block object-cover h-full w-full"></div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <main class="max-w-screen-xl w-full mx-auto overflow-hidden">
        <div id="categories" class="py-6 sm:py-8 md:py-10">
            <h2 class="mb-6 sm:mb-8 md:mb-10 flex items-center gap-4 justify-center">
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
                <span class="text-2xl font-display text-cyan-600 font-semibold">Categories</span>
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
            </h2>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-5 px-1">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index') }}"
                        class="block text-sm sm:text-base rounded-lg border border-cyan-600 p-2 h-14 sm:h-16 flex items-center transition-all hover:bg-gray-100">
                        <span class="icon-furniture text-cyan-600 text-2xl sm:text-3xl mr-2"></span>
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        <div id="new_arrivals" class="py-6 sm:py-8 md:py-10">
            <h2 class="mb-6 sm:mb-8 md:mb-10 flex items-center gap-4 justify-center">
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
                <span class="text-2xl font-display text-cyan-600 font-semibold">New Arrivals</span>
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
            </h2>
            <div class="swiper w-full">
                <div class="swiper-wrapper">
                    @foreach ($new_arrivals as $product)
                        <div class="swiper-slide">
                            <div>
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="block relative pt-[100%] overflow-hidden rounded-lg mb-2">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                        class="absolute inset-0 block object-cover w-full h-full">
                                </a>
                                <div class="flex items-center">
                                    <span
                                        class="text-sm text-gray-400 font-medium italic underline">{{ $product->category->parent->name }}</span>
                                    <span
                                        class="text-lg font-bold ml-auto">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="block text-lg font-semibold h-14 overflow-hidden">{{ $product->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <div id="banner_1" class="pt-[60%] md:pt-[40%] lg:pt-[28.12%] relative overflow-hidden rounded mb-10">
            <img src="/images/banner-1.jpg" alt="Banner" class="absolute w-full h-full object-cover inset-0">
            <div
                class="absolute inset-0 w-full h-full bg-gradient-to-l from-black to-black/20 flex items-center justify-end p-10">
                <h1
                    class="w-4/5 md:w-2/3 lg:w-1/2 font-display text-white font-bold text-right uppercase text-4xl md:text-5xl lg:text-6xl leading-tight">
                    enjoy a big screen in your living room</h1>
            </div>
        </div>
        <div class="flex gap-5 sm:h-[400px] md:h-[600px] lg:h-[800px] mb-10 flex-wrap sm:flex-nowrap">
            <div class="w-full sm:w-2/5 bg-cyan-400 rounded-lg h-full flex sm:flex-col items-center sm:gap-10">
                <img src="/images/delivery.png" alt="Watch" class="w-1/2">
                <h3
                    class="w-1/2 sm:w-full text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold px-5 leading-tight">
                    Your Style,<br>Delivered.<br>Exclusively<br>Online.</h3>
            </div>
            <div class="flex-1 overflow-hidden flex flex-col h-full max-h-full gap-5">
                <div class="h-60 sm:h-1/2 md:h-2/5 rounded-lg bg-gray-100 flex">
                    <img src="/images/watch.png" alt="Watch" class="h-full">
                    <div class="flex-1 flex flex-col justify-center gap-0 md:gap-1 lg:gap-2 px-2 lg:px-5 items-start">
                        <div class="font-light text-sm sm:text-base md:text-lg lg:text-xl">Timeless Elegance</div>
                        <h3 class="font-bold text-2xl md:text-3xl lg:text-4xl">Discover our accessories collection</h3>
                        <a href="#"
                            class="overflow-hidden group relative py-2 lg:py-3 px-4 rounded bg-cyan-500 font-medium text-white lg:mt-5">
                            <span
                                class="absolute w-full h-full left-0 top-full group-hover:top-0 transition-all bg-cyan-600"></span>
                            <span class="relative">Shop Now</span>
                        </a>
                    </div>
                </div>
                <div class="h-60 sm:flex-1 overflow-hidden rounded-lg bg-gray-100/50 flex items-center">
                    <div class="flex-1 flex flex-col justify-center gap-0 md:gap-1 lg:gap-2 px-2 lg:px-5 items-start">
                        <div class="font-light text-sm sm:text-base md:text-lg lg:text-xl">Find your perfect pair</div>
                        <h3 class="font-bold text-2xl md:text-3xl lg:text-4xl">Explore our shoes collection</h3>
                        <a href="#"
                            class="overflow-hidden group relative py-2 lg:py-3 px-4 rounded bg-cyan-500 font-medium text-white lg:mt-5">
                            <span
                                class="absolute w-full h-full left-0 top-full group-hover:top-0 transition-all bg-cyan-600"></span>
                            <span class="relative">Shop Now</span>
                        </a>
                    </div>
                    <img src="/images/shoe.png" alt="Watch" class="h-2/3">
                </div>
            </div>
        </div>
        <div>
            <h2 class="mb-10 flex items-center gap-4 justify-center">
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
                <span class="text-2xl font-display text-cyan-600 font-semibold">Featured Deals</span>
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-10">
                <div class="rounded-lg bg-blue-500 p-3 md:p-5 flex gap-3 md:gap-5 lg:gap-10">
                    <div class="flex-1 flex flex-col items-start">
                        <img src="images/logo-white.png" alt="Logo White" class="w-40 mb-5">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-teal-100">Welcome offer just for you
                        </h3>
                        <p class="font-light text-teal-100 my-2 sm:my-3 md:my-5 text:sm sm:text-base md:text-lg">Enjoy
                            a special descount on your first purchase.</p>
                        <a href="#"
                            class="overflow-hidden group relative py-2 lg:py-3 px-4 rounded bg-cyan-500 font-medium text-white mt-5">
                            <span
                                class="absolute w-full h-full left-0 top-full group-hover:top-0 transition-all bg-cyan-600"></span>
                            <span class="relative">Shop Now</span>
                        </a>
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="/images/shopping-bags.png" class="w-40 lg:w-48">
                    </div>
                </div>
                <div class="rounded-lg bg-cyan-500 p-3 md:p-5 flex gap-3 md:gap-5">
                    <div class="flex-1 flex flex-col items-start">
                        <img src="images/logo-white.png" alt="Logo White" class="w-40 mb-5">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white">Free delivery offer awaiting
                            for you</h3>
                        <p class="font-light text-white my-2 sm:my-3 md:my-5 text:sm sm:text-base md:text-lg">Free
                            delivery on all the electronics.</p>
                        <a href="#"
                            class="overflow-hidden group relative py-2 lg:py-3 px-4 rounded bg-blue-500 font-medium text-white mt-5">
                            <span
                                class="absolute w-full h-full left-0 top-full group-hover:top-0 transition-all bg-blue-600"></span>
                            <span class="relative">Shop Now</span>
                        </a>
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="/images/free-delivery.png" class="w-40 lg:w-60">
                    </div>
                </div>
            </div>
        </div>
        <div id="brapy-6 sm:py-8 md:nds" class="py-10">
            <h2 class="mb-10 flex items-center gap-4 justify-center">
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
                <span class="text-2xl font-display text-cyan-600 font-semibold">Brands</span>
                <span class="text-sm text-gray-500 flex gap-0.5 items-center">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </span>
            </h2>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-5">
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/armani.png" alt="Armani" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/asus.png" alt="Asus" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/blackberry.png" alt="BlackBerry" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/boss.png" alt="Boss" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/burton.png" alt="Burton" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/calvin.png" alt="Calvin" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/converse.png" alt="Converse" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/fila.png" alt="Fila" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/htc.png" alt="Converse" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/lenovo.png" alt="Lenovo" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/samsung.png" alt="Samsung" class="w-full h-full object-cover">
                </a>
                <a href="#"
                    class="block rounded-lg border p-5 h-28 flex items-center transition-all hover:border-black">
                    <img src="/images/brands/sony.png" alt="Sony" class="w-full h-full object-cover">
                </a>
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>

</html>
