@extends('layout')

@section('main')
    <div class="max-w-screen-xl w-full mx-auto py-10">
        <h1 class="text-4xl font-bold mb-5">Wishlist</h1>
        @if (count(auth()->user()->wishlist) > 0)
            <div class="flex-1 flex flex-col gap-3 mb-3">
                @foreach (auth()->user()->wishlist()->with('product')->get() as $item)
                    <div class="flex h-40 rounded border relative">
                        <div class="w-40 h-full">
                            <img class="w-full h-full object-cover" src="{{ $item->product->image_url }}"
                                alt="{{ $item->product->name }}">
                        </div>
                        <div class="pl-5">
                            <h2 class="text-xl font-semibold mb-2">{{ $item->product->name }}</h2>
                            <div>price: ${{ number_format($item->product->price, 2) }}
                            </div>
                        </div>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button
                                class="absolute top-0 right-0 w-10 h-10 text-2xl text-gray-500 transition-all hover:text-red-500"
                                type="submit"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-400 text-3xl font-medium">Your Wishlist is Empty!</div>
        @endif
    </div>
@endsection
