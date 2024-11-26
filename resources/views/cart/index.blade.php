<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Cart - Easy Shop - Affordable Online Shopping for Everyone</title>
    @include('includes.head')
</head>

<body>
    @include('includes.header')
    <main>
        <div class="max-w-screen-xl w-full mx-auto py-10">
            <h1 class="text-4xl font-bold mb-5">Your Cart</h1>
            @if (count($cart) > 0)
                @php
                    $total = auth()
                        ->user()
                        ->cart()
                        ->join('products', 'carts.product_id', '=', 'products.id')
                        ->selectRaw('SUM(products.price * carts.quantity) as total')
                        ->value('total');
                    $tva = 0.1;
                    $shipping = 15;
                @endphp
                <div class="flex gap-5">
                    <div class="flex-1">
                        <div class="flex-1 flex flex-col gap-3 mb-3">
                            @foreach ($cart as $item)
                                <div class="flex h-40 rounded border relative">
                                    <div class="w-40 h-full">
                                        <img class="w-full h-full object-cover" src="{{ $item->product->image_url }}"
                                            alt="{{ $item->product->name }}">
                                    </div>
                                    <div class="pl-5">
                                        <h2 class="text-xl font-semibold mb-2">{{ $item->product->name }}</h2>
                                        <div>Quantity: {{ $item->quantity }}</div>
                                        <div>price: ${{ number_format($item->product->price * $item->quantity, 2) }}
                                        </div>
                                    </div>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <button
                                            class="absolute top-0 right-0 w-10 h-10 text-2xl text-gray-500 transition-all hover:text-red-500"
                                            type="submit"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-end">
                            <a class="block px-4 py-2 rounded bg-cyan-600 text-white transition-all hover:bg-cyan-500 font-bold text-lg"
                                href="{{ route('checkout') }}">Check Out <i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                    <div class="max-w-1/3 w-[300px]">
                        <div class="border rounded bg-gray-100 p-2">
                            <div class="flex items-center font-bold text-lg mb-2">
                                <div>Total</div>
                                <div class="ml-auto font-bold">${{ number_format($total, 2) }}</div>
                            </div>
                            <div class="flex items-center font-bold text-lg mb-2">
                                <div>TVA ({{ floor($tva * 100) }}%)</div>
                                <div class="ml-auto font-bold">${{ number_format($tva * $total, 2) }}</div>
                            </div>
                            <div class="flex items-center font-bold text-lg mb-2">
                                <div>Delivery</div>
                                <div class="ml-auto font-bold">${{ number_format($shipping, 2) }}</div>
                            </div>
                            <div class="h-0.5 bg-black mb-2"></div>
                            <div class="flex items-center font-bold text-xl mb-2">
                                <div>Total</div>
                                <div class="ml-auto font-bold">${{ number_format($total * (1 + $tva) + $shipping, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center text-gray-400 text-3xl font-medium">Your Cart is Empty!</div>
            @endif
        </div>
    </main>
    @include('includes.footer')
</body>

</html>
