<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Laravel</title>
    @include('includes.head')
</head>

<body>
    @include('includes.header')
    <main>
        <div class="max-w-screen-xl w-full mx-auto py-10">
            <h1 class="text-4xl font-bold mb-5">Orders</h1>
            @if (count(auth()->user()->orders) > 0)
                <table class="w-full text-sm mb-5">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-1 px-2">Order Number</th>
                            <th class="text-left py-1 px-2">Status</th>
                            <th class="text-left py-1 px-2">Total</th>
                            <th class="text-left py-1 px-2">Payment Method</th>
                            <th class="text-left py-1 px-2">Address</th>
                        </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(odd)]:bg-gray-100">
                        @foreach (auth()->user()->orders()->with('shippingAddress')->with('items')->get() as $order)
                            <tr class="border-b">
                                <td class="py-1 px-2">{{ $order->order_number }}</td>
                                <td class="py-1 px-2">{{ $order->status }}</td>
                                <td class="py-1 px-2">{{ $order->total_amount }}</td>
                                <td class="py-1 px-2">{{ $order->payment_method }}</td>
                                <td class="py-1 px-2">
                                    <div>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->postal_code }}
                                    </div>
                                    <div>{{ $order->shippingAddress->address_line_1 }},
                                        {{ $order->shippingAddress->address_line_2 }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-gray-400 text-3xl font-medium">You didn't place any order yet!</div>
            @endif
        </div>
    </main>
    @include('includes.footer')
</body>

</html>
