<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
	<title>Easy Shop - Affordable Online Shopping for Everyone</title>
	@include("includes.head")
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
	@include("includes.header")
	<div id="hero">
		<div class="swiper h-[350px] w-full sm:h-[400px] md:h-[500px]">
			<div class="swiper-wrapper">
				<div class="swiper-slide"><img class="block h-full w-full object-cover" alt="Hero" src="/images/hero/hero-1.jpg"></div>
				<div class="swiper-slide"><img class="block h-full w-full object-cover" alt="Hero" src="/images/hero/hero-2.jpg"></div>
				<div class="swiper-slide"><img class="block h-full w-full object-cover" alt="Hero" src="/images/hero/hero-3.jpg"></div>
				<div class="swiper-slide"><img class="block h-full w-full object-cover" alt="Hero" src="/images/hero/hero-4.jpg"></div>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
	<main class="mx-auto w-full max-w-screen-xl overflow-hidden">
		<div id="categories" class="py-6 sm:py-8 md:py-10">
			<h2 class="mb-6 flex items-center justify-center gap-4 sm:mb-8 md:mb-10">
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
				<span class="font-display text-2xl font-semibold text-cyan-600">Categories</span>
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
			</h2>
			<div class="grid grid-cols-3 gap-5 px-1 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6">
				@foreach ($categories as $category)
					<a class="block flex h-14 items-center rounded-lg border border-cyan-600 p-2 text-sm transition-all hover:bg-gray-100 sm:h-16 sm:text-base" href="{{ route("products.index") }}">
						<span class="icon-furniture mr-2 text-2xl text-cyan-600 sm:text-3xl"></span>
						<span>{{ $category->name }}</span>
					</a>
				@endforeach
			</div>
		</div>
		<div id="new_arrivals" class="py-6 sm:py-8 md:py-10">
			<h2 class="mb-6 flex items-center justify-center gap-4 sm:mb-8 md:mb-10">
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
				<span class="font-display text-2xl font-semibold text-cyan-600">New Arrivals</span>
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
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
								<a class="relative mb-2 block overflow-hidden rounded-lg pt-[100%]" href="{{ route("products.show", $product->slug) }}">
									<img class="absolute inset-0 block h-full w-full object-cover" alt="{{ $product->name }}" src="{{ $product->image_url }}">
								</a>
								<div class="flex items-center">
									<span class="text-sm font-medium italic text-gray-400 underline">{{ $product->category->parent->name }}</span>
									<span class="ml-auto text-lg font-bold">${{ number_format($product->price, 2) }}</span>
								</div>
								<a class="block h-14 overflow-hidden text-lg font-semibold" href="{{ route("products.show", $product->slug) }}">{{ $product->name }}</a>
							</div>
						</div>
					@endforeach
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</div>
		<div id="banner_1" class="relative mb-10 overflow-hidden rounded pt-[60%] md:pt-[40%] lg:pt-[28.12%]">
			<img class="absolute inset-0 h-full w-full object-cover" alt="Banner" src="/images/banner-1.jpg">
			<div class="absolute inset-0 flex h-full w-full items-center justify-end bg-gradient-to-l from-black to-black/20 p-10">
				<h1 class="w-4/5 text-right font-display text-4xl font-bold uppercase leading-tight text-white md:w-2/3 md:text-5xl lg:w-1/2 lg:text-6xl">enjoy a big screen in your living room</h1>
			</div>
		</div>
		<div class="mb-10 flex flex-wrap gap-5 sm:h-[400px] sm:flex-nowrap md:h-[600px] lg:h-[800px]">
			<div class="flex h-full w-full items-center rounded-lg bg-cyan-400 sm:w-2/5 sm:flex-col sm:gap-10">
				<img class="w-1/2" alt="Watch" src="/images/delivery.png">
				<h3 class="w-1/2 px-5 text-4xl font-bold leading-tight text-white sm:w-full sm:text-5xl md:text-6xl lg:text-7xl">Your Style,<br>Delivered.<br>Exclusively<br>Online.</h3>
			</div>
			<div class="flex h-full max-h-full flex-1 flex-col gap-5 overflow-hidden">
				<div class="flex h-60 rounded-lg bg-gray-100 sm:h-1/2 md:h-2/5">
					<img class="h-full" alt="Watch" src="/images/watch.png">
					<div class="flex flex-1 flex-col items-start justify-center gap-0 px-2 md:gap-1 lg:gap-2 lg:px-5">
						<div class="text-sm font-light sm:text-base md:text-lg lg:text-xl">Timeless Elegance</div>
						<h3 class="text-2xl font-bold md:text-3xl lg:text-4xl">Discover our accessories collection</h3>
						<a class="group relative overflow-hidden rounded bg-cyan-500 px-4 py-2 font-medium text-white lg:mt-5 lg:py-3" href="#">
							<span class="absolute left-0 top-full h-full w-full bg-cyan-600 transition-all group-hover:top-0"></span>
							<span class="relative">Shop Now</span>
						</a>
					</div>
				</div>
				<div class="flex h-60 items-center overflow-hidden rounded-lg bg-gray-100/50 sm:flex-1">
					<div class="flex flex-1 flex-col items-start justify-center gap-0 px-2 md:gap-1 lg:gap-2 lg:px-5">
						<div class="text-sm font-light sm:text-base md:text-lg lg:text-xl">Find your perfect pair</div>
						<h3 class="text-2xl font-bold md:text-3xl lg:text-4xl">Explore our shoes collection</h3>
						<a class="group relative overflow-hidden rounded bg-cyan-500 px-4 py-2 font-medium text-white lg:mt-5 lg:py-3" href="#">
							<span class="absolute left-0 top-full h-full w-full bg-cyan-600 transition-all group-hover:top-0"></span>
							<span class="relative">Shop Now</span>
						</a>
					</div>
					<img class="h-2/3" alt="Watch" src="/images/shoe.png">
				</div>
			</div>
		</div>
		<div>
			<h2 class="mb-10 flex items-center justify-center gap-4">
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
				<span class="font-display text-2xl font-semibold text-cyan-600">Featured Deals</span>
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
			</h2>
			<div class="mb-10 grid grid-cols-1 gap-5 sm:grid-cols-2">
				<div class="flex gap-3 rounded-lg bg-blue-500 p-3 md:gap-5 md:p-5 lg:gap-10">
					<div class="flex flex-1 flex-col items-start">
						<img class="mb-5 w-40" alt="Logo White" src="images/logo-white.png">
						<h3 class="text-2xl font-bold text-teal-100 md:text-3xl lg:text-4xl">Welcome offer just for you</h3>
						<p class="text:sm my-2 font-light text-teal-100 sm:my-3 sm:text-base md:my-5 md:text-lg">Enjoy a special descount on your first purchase.</p>
						<a class="group relative mt-5 overflow-hidden rounded bg-cyan-500 px-4 py-2 font-medium text-white lg:py-3" href="#">
							<span class="absolute left-0 top-full h-full w-full bg-cyan-600 transition-all group-hover:top-0"></span>
							<span class="relative">Shop Now</span>
						</a>
					</div>
					<div class="flex items-center justify-center">
						<img class="w-40 lg:w-48" src="/images/shopping-bags.png">
					</div>
				</div>
				<div class="flex gap-3 rounded-lg bg-cyan-500 p-3 md:gap-5 md:p-5">
					<div class="flex flex-1 flex-col items-start">
						<img class="mb-5 w-40" alt="Logo White" src="images/logo-white.png">
						<h3 class="text-2xl font-bold text-white md:text-3xl lg:text-4xl">Free delivery offer awaiting for you</h3>
						<p class="text:sm my-2 font-light text-white sm:my-3 sm:text-base md:my-5 md:text-lg">Free delivery on all the electronics.</p>
						<a class="group relative mt-5 overflow-hidden rounded bg-blue-500 px-4 py-2 font-medium text-white lg:py-3" href="#">
							<span class="absolute left-0 top-full h-full w-full bg-blue-600 transition-all group-hover:top-0"></span>
							<span class="relative">Shop Now</span>
						</a>
					</div>
					<div class="flex items-center justify-center">
						<img class="w-40 lg:w-60" src="/images/free-delivery.png">
					</div>
				</div>
			</div>
		</div>
		<div id="brands" class="py-6 sm:py-8 md:py-10">
			<h2 class="mb-10 flex items-center justify-center gap-4">
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
				<span class="font-display text-2xl font-semibold text-cyan-600">Brands</span>
				<span class="flex items-center gap-0.5 text-sm text-gray-500">
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
					<i class="fa-solid fa-ellipsis-vertical"></i>
				</span>
			</h2>
			<div class="grid grid-cols-3 gap-5 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6">
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Armani" src="/images/brands/armani.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Asus" src="/images/brands/asus.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="BlackBerry" src="/images/brands/blackberry.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Boss" src="/images/brands/boss.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Burton" src="/images/brands/burton.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Calvin" src="/images/brands/calvin.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Converse" src="/images/brands/converse.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Fila" src="/images/brands/fila.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Converse" src="/images/brands/htc.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Lenovo" src="/images/brands/lenovo.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Samsung" src="/images/brands/samsung.png">
				</a>
				<a class="block flex h-28 items-center rounded-lg border p-5 transition-all hover:border-black" href="#">
					<img class="h-full w-full object-cover" alt="Sony" src="/images/brands/sony.png">
				</a>
			</div>
		</div>
	</main>
	@include("includes.footer")
</body>

</html>
