<header>
	<ul class="flex h-16 items-center gap-3 px-1 py-2 shadow-sm md:h-20 md:px-2 md:py-4 lg:gap-5 lg:px-5">
		<a href="{{ route("home") }}" class="h-full w-24 md:w-32 lg:w-40">
			<img src="/images/logo.png" alt="Logo" class="h-full w-full object-contain">
		</a>
		<li class="h-full flex-1">
			<form action="/search" class="relative h-full">
				<input type="text" name="q" id="q" class="h-full w-full max-w-[800px] rounded-full border-0 bg-gray-200 pl-12 shadow-sm transition-background placeholder:text-gray-400 focus:bg-gray-100 focus:outline-none focus:ring-0" placeholder="What are you looking for?">
				<label for="q" class="absolute left-0 top-0 flex h-full w-12 items-center justify-center text-center text-gray-400"><i class="fa-solid fa-magnifying-glass"></i></label>
			</form>
		</li>
		@auth
			<li class="relative shrink-0 text-lg lg:text-xl">
				<a href="{{ route("cart.index") }}" class="block">
					<i class="fa-solid fa-cart-shopping"></i>
					<span id="cart_count" class="absolute -bottom-2 -left-2 flex h-4 w-4 items-center justify-center rounded-full bg-cyan-600 text-center text-xs font-bold text-white">{{ auth()->user()->cart->count() }}</span>
				</a>
			</li>
			<li class="relative shrink-0 text-lg lg:text-xl">
				<a href="{{ route("wishlist.index") }}" class="block">
					<i class="fa-regular fa-heart"></i>
					<span id="wishlist_count" class="absolute -bottom-2 -left-2 flex h-4 w-4 items-center justify-center rounded-full bg-cyan-600 text-center text-xs font-bold text-white">{{ 0 }}</span>
				</a>
			</li>
			<li class="hidden shrink-0 px-2 sm:block lg:px-4"><span class="block h-10 w-0.5 bg-slate-300"></span></li>
			<li class="relative h-20 shrink-0">
				<button id="nav-account-link" class="flex h-full items-center gap-2 transition-all hover:bg-gray-100 lg:px-2">
					<div class="h-10 w-10 rounded-full bg-cyan-600"></div>
					<div class="hidden md:block">
						<div class="text-xs text-gray-500">Welcome Back!</div>
						<div class="text-lg font-bold">{{ auth()->user()->name }}</div>
					</div>
					<div><i class="fa-solid fa-chevron-down"></i></div>
				</button>
				<ul class="absolute right-0 top-full z-[2] flex hidden flex-col gap-2 rounded border bg-white py-2 shadow">
					<li class="whitespace-nowrap"><a class="block px-2 py-4 transition-all hover:bg-neutral-100" href="#">Account</a></li>
					<li class="whitespace-nowrap"><a class="block px-2 py-4 transition-all hover:bg-neutral-100" href="{{ route("orders.index") }}">Orders</a></li>
					<li class="whitespace-nowrap"><a class="block px-2 py-4 transition-all hover:bg-neutral-100" href="{{ route("wishlist.index") }}">Wish List</a></li>
					<li class="whitespace-nowrap"><a class="block px-2 py-4 transition-all hover:bg-neutral-100" href="#">Recommendations</a></li>
					<li class="whitespace-nowrap"><a class="block px-2 py-4 transition-all hover:bg-neutral-100" href="#">Browsing History</a></li>
					<li class="whitespace-nowrap">
						<form action="{{ route("logout") }}" method="POST">
							@csrf
							<button class="block w-full px-2 py-4 text-left text-red-500 transition-all hover:bg-neutral-100" type="submit">Logout</button>
						</form>
					</li>
				</ul>
			</li>
		@endauth
		@guest
			<li class="shrink-0"><a href="{{ route("login") }}" class="block rounded-full border bg-gray-600 px-6 py-2 font-medium text-white transition-all hover:bg-gray-500"><i class="fa-solid fa-lock"></i> Login</a></li>
			<li>OR</li>
			<li class="shrink-0"><a href="{{ route("register") }}" class="block rounded-full border bg-cyan-600 px-6 py-2 font-medium text-white transition-all hover:bg-cyan-500"><i class="fa-solid fa-user-plus"></i> Register</a></li>
		@endguest
	</ul>
</header>
