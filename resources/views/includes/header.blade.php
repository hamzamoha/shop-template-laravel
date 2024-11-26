<header>
    <ul class="flex h-16 py-2 md:h-20 md:py-4 items-center gap-3 lg:gap-5 px-1 md:px-2 lg:px-5 shadow-sm">
        <a href="{{ route('home') }}" class="w-24 md:w-32 lg:w-40 h-full">
            <img src="/images/logo.png" alt="Logo" class="w-full h-full object-contain">
        </a>
        <li class="flex-1 h-full">
            <form action="/search" class="h-full relative">
                <input type="text" name="q" id="q" class="bg-gray-200 focus:bg-gray-100 shadow-sm max-w-[800px] w-full rounded-full transition-background h-full pl-12 placeholder:text-gray-400 focus:outline-none border-0 focus:ring-0"
                    placeholder="What are you looking for?">
                <label for="q"
                    class="absolute top-0 left-0 w-12 h-full flex items-center justify-center text-center text-gray-400"><i
                        class="fa-solid fa-magnifying-glass"></i></label>
            </form>
        </li>
        @auth
            <li class="shrink-0 text-lg lg:text-xl relative">
                <a href="{{ route('cart.index') }}" class="block">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span id="cart_count" class="absolute -bottom-2 -left-2 bg-cyan-600 text-xs text-white font-bold rounded-full h-4 w-4 flex justify-center items-center text-center">{{ auth()->user()->cart->count() }}</span>
                </a>
            </li>
            <li class="shrink-0 text-lg lg:text-xl relative">
                <a href="{{ route('wishlist.index') }}" class="block">
                    <i class="fa-regular fa-heart"></i>
                    <span id="cart_count" class="absolute -bottom-2 -left-2 bg-cyan-600 text-xs text-white font-bold rounded-full h-4 w-4 flex justify-center items-center text-center">{{ 0 }}</span>
                </a>
            </li>
            <li class="shrink-0 px-2 lg:px-4 hidden sm:block"><span class="block w-0.5 h-10 bg-slate-300"></span></li>
            <li class="shrink-0 h-20 relative">
                <button id="nav-account-link"
                    class="flex items-center gap-2 lg:px-2 transition-all hover:bg-gray-100 h-full">
                    <div class="h-10 w-10 rounded-full bg-cyan-600"></div>
                    <div class="hidden md:block">
                        <div class="text-xs text-gray-500">Welcome Back!</div>
                        <div class="font-bold text-lg">{{ auth()->user()->name }}</div>
                    </div>
                    <div><i class="fa-solid fa-chevron-down"></i></div>
                </button>
                <ul class="absolute top-full right-0 bg-white z-[2] rounded border shadow py-2 hidden flex flex-col gap-2">
                    <li class="whitespace-nowrap"><a class="px-2 py-4 transition-all hover:bg-neutral-100 block" href="#">Account</a></li>
                    <li class="whitespace-nowrap"><a class="px-2 py-4 transition-all hover:bg-neutral-100 block" href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="whitespace-nowrap"><a class="px-2 py-4 transition-all hover:bg-neutral-100 block" href="{{ route('wishlist.index') }}">Wish List</a></li>
                    <li class="whitespace-nowrap"><a class="px-2 py-4 transition-all hover:bg-neutral-100 block" href="#">Recommendations</a></li>
                    <li class="whitespace-nowrap"><a class="px-2 py-4 transition-all hover:bg-neutral-100 block" href="#">Browsing History</a></li>
                    <li class="whitespace-nowrap">
                        <form action="{{ route("logout") }}" method="POST">
                            @csrf
                            <button class="px-2 py-4 transition-all hover:bg-neutral-100 block text-red-500 w-full text-left" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        @endauth
        @guest
            <li class="shrink-0"><a href="{{ route("login") }}" class="px-6 block rounded-full bg-gray-600 text-white font-medium transition-all hover:bg-gray-500 border py-2"><i class="fa-solid fa-lock"></i> Login</a></li>
            <li>OR</li>
            <li class="shrink-0"><a href="{{ route("register") }}" class="px-6 block rounded-full bg-cyan-600 text-white font-medium transition-all hover:bg-cyan-500 border py-2"><i class="fa-solid fa-user-plus"></i> Register</a></li>
        @endguest
    </ul>
</header>
