<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
	<title>Laravel</title>
	@include("includes.head")
</head>

<body>
	@include("includes.header")
	<main>
		<div class="mx-auto w-full max-w-screen-xl">
			<div class="mb-3 grid grid-cols-1 gap-5 pt-10 sm:mb-4 sm:grid-cols-2 md:mb-5">
				<div>
					<div class="relative pt-[100%]">
						<div class="absolute inset-0 h-full w-full">
							<img class="h-full w-full rounded border object-contain" src="{{ $product->image_url }}" alt="{{ $product->name }}">
						</div>
					</div>
				</div>
				<div>
					<h1 class="mb-3 text-xl font-semibold text-cyan-600 sm:mb-4 sm:text-2xl md:mb-5 md:text-3xl">
						{{ $product->name }}</h1>
					<span class="mb-3 block text-2xl font-bold sm:mb-4 sm:text-3xl md:mb-5 md:text-4xl">${{ $product->price }}</span>
					<p class="mb-5">{{ $product->description }}</p>
					<div class="mb-5 flex flex-wrap gap-2">
						<input type="number" min="1" step="1" value="1" class="h-12 w-16 bg-gray-100 px-2 text-center outline-none">
						@auth
							<button id="add_to_cart" data-product-id="{{ $product->id }}" class="h-12 rounded bg-cyan-600 px-6 text-xl font-medium text-white outline-none transition-all hover:bg-cyan-500"><i class="fa-solid fa-plus"></i> Add to Cart</button>
						@endauth
						@guest
							<button class="group h-12 rounded bg-cyan-600 px-6 text-xl font-medium text-white outline-none hover:bg-gray-200 hover:text-black">
								<span class="hidden group-hover:block">Login Required</span>
								<span class="block group-hover:hidden"><i class="fa-solid fa-plus"></i> Add to Cart</span>
							</button>
						@endguest
						<button class="h-12 w-12 rounded bg-cyan-600 text-xl text-white transition-all hover:bg-cyan-500"><i class="fa-solid fa-heart"></i></button>
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
				<h2 class="mb-2 text-xl font-medium sm:text-2xl">You might also like</h2>
				<div class="mb-3 grid grid-cols-2 gap-2 gap-5 sm:mb-4 md:mb-5 md:grid-cols-4">
					@foreach ($recommendations as $item)
						<div class="rounded border p-2">
							<a href="{{ route("products.show", $item->slug) }}" class="relative mb-1 block pt-[100%]">
								<img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="absolute inset-0 h-full w-full object-contain">
							</a>
							<div>
								<a href="{{ route("products.show", $item->slug) }}" class="block font-medium text-cyan-600">{{ $item->name }}</a>
								<span class="block text-lg font-medium">${{ number_format($item->price, 2) }}</span>
							</div>
							<div>
								<button id="add_to_cart" data-product-id="{{ $item->id }}" class="block w-full rounded bg-cyan-600 py-1 text-white transition-all hover:bg-cyan-500">Add
									to Cart</button>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</main>
	@include("includes.footer")
</body>

</html>
