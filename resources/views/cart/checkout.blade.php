<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Checkout - Easy Shop - Affordable Online Shopping for Everyone</title>
    @include('includes.head')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("input[name='address_id']").forEach(e => {
                e.addEventListener("change", () => {
                    if (document.querySelector("input[name='address_id']:checked").value == -1) {
                        document.querySelector("#new_address").style.maxHeight = document
                            .querySelector("#new_address").scrollHeight + "px";
                        document.querySelectorAll("#new_address [aria-required='true']").forEach(
                            e => {
                                e.required = true
                            })
                    } else {
                        document.querySelector("#new_address").style.maxHeight = null;
                        document.querySelectorAll("#new_address [aria-required='true']").forEach(
                            e => {
                                e.required = false
                            })
                    }
                })
            })
            document.querySelector("input[name='address_id']").checked = true
            document.querySelector("input[name='address_id']").dispatchEvent(new Event("change"))
        })
    </script>
</head>

<body>
    @include('includes.header')
    <main>
        <div class="max-w-screen-xl w-full mx-auto py-10">
            <h1 class="text-4xl font-bold mb-5">Checkout</h1>
            @if (count(auth()->user()->cart) > 0)
                <div class="flex gap-5">
                    <form method="POST" class="flex-1" action="{{ route('orders.store') }}">
                        {{ csrf_field() }}
                        <div class="flex-1 flex flex-col gap-3 mb-3">
                            <h2 class="text-3xl font-bold mb-5">Address</h2>
                            <div class="flex gap-2">
                                @foreach (auth()->user()->addresses as $address)
                                    <label for="address_id_{{ $address->id }}"
                                        class="p-3 gap-3 border rounded flex select-none items-center">
                                        <div><input type="radio" name="address_id" id="address_id_{{ $address->id }}"
                                                value="{{ $address->id }}"></div>
                                        <div>
                                            <div>{{ $address->name }}</div>
                                            <div>{{ $address->country }}</div>
                                            <div>{{ $address->city }}, {{ $address->postal_code }}</div>
                                            <div>{{ $address->address_line_1 }}, {{ $address->address_line_2 }}</div>
                                            <div>{{ $address->phone }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <div class="py-1 text-2xl font-bold">
                                <input type="radio" name="address_id" id="address_id_" value="-1">
                                <label for="address_id_">New Address</label>
                            </div>
                            <div id="new_address" class="max-h-0 overflow-hidden transition-all">
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <div>
                                        <label for="country" class="text-sm block pb-1">Country <span
                                                class="text-red-500">*</span></label>
                                        <input aria-readonly="true" value="Morocco" readonly name="country"
                                            id="country" required aria-required="true"
                                            class="block w-full h-10 bg-gray-200 rounded border-0 focus:ring-0 focus:outline-none">
                                    </div>
                                    <div>
                                        <label for="state" class="text-sm block pb-1">State <span
                                                class="text-red-500">*</span></label>
                                        <select name="state" id="state" required aria-required="true"
                                            class="w-full h-10 bg-gray-200 focus:bg-gray-100 transition-background rounded border-none focus:ring-0 focus:outline-none">
                                            <option value="" disabled selected hidden>-- Select a State --
                                            </option>
                                            <option value="Béni Mellal-Khénifra">Béni Mellal-Khénifra</option>
                                            <option value="Casablanca-Settat">Casablanca-Settat</option>
                                            <option value="Dakhla-Oued Ed-Dahab">Dakhla-Oued Ed-Dahab</option>
                                            <option value="Drâa-Tafilalet">Drâa-Tafilalet</option>
                                            <option value="Fès-Meknès">Fès-Meknès</option>
                                            <option value="Guelmim-Oued Noun">Guelmim-Oued Noun</option>
                                            <option value="Laâyoune-Sakia El Hamra">Laâyoune-Sakia El Hamra</option>
                                            <option value="Marrakesh-Safi">Marrakesh-Safi</option>
                                            <option value="Oriental">Oriental</option>
                                            <option value="Rabat-Salé-Kénitra">Rabat-Salé-Kénitra</option>
                                            <option value="Souss-Massa">Souss-Massa</option>
                                            <option value="Tanger-Tetouan-Al Hoceima">Tanger-Tetouan-Al Hoceima</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="city" class="text-sm block pb-1">Prefecture / Province <span
                                                class="text-red-500">*</span></label>
                                        <select name="city" id="city" required aria-required="true"
                                            class="w-full h-10 bg-gray-200 focus:bg-gray-100 transition-background rounded border-none focus:ring-0 focus:outline-none">
                                            <option value="" disabled selected hidden>-- Select a City --</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="postal_code" class="text-sm block pb-1">ZIP Code (Postal Code) <span
                                                class="text-red-500">*</span></label>
                                        <input placeholder="e.g. 73000" required aria-required="true" name="postal_code"
                                            id="postal_code"
                                            class="block w-full h-10 bg-gray-200 rounded border-0 focus:ring-0 focus:outline-none">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="address_line_1" class="text-sm block pb-1">Address Line 1 <span
                                            class="text-red-500">*</span></label>
                                    <input placeholder="e.g. 123 Main St" required aria-required="true"
                                        name="address_line_1" id="address_line_1"
                                        class="block w-full h-10 bg-gray-200 rounded border-0 focus:ring-0 focus:outline-none">
                                </div>
                                <div class="mb-2">
                                    <label for="address_line_2" class="text-sm block pb-1">Address Line 2</label>
                                    <input placeholder="e.g. Apartment 4B" name="address_line_2" id="address_line_2"
                                        class="block w-full h-10 bg-gray-200 rounded border-0 focus:ring-0 focus:outline-none">
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="text-sm block pb-1">Phone Number</label>
                                    <input placeholder="e.g. +1 123-456-7890" required aria-required="true"
                                        name="phone" id="phone"
                                        class="block w-full h-10 bg-gray-200 rounded border-0 focus:ring-0 focus:outline-none">
                                </div>
                                <div class="flex items-center gap-1 h-14">
                                    <input type="checkbox" name="alias" id="alias"
                                        class="peer focus:ring-0 focus:outline-none">
                                    <label for="alias" class="text-sm">Alias?</label>
                                    <input type="text" name="name" id="name"
                                        class="peer-checked:block hidden h-10 bg-gray-100 rounded border-0 focus:ring-0 focus:outline-none text-sm"
                                        placeholder="e.g. Home, Work">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end">
                            <button
                                class="block px-4 py-2 rounded bg-cyan-600 text-white transition-all hover:bg-cyan-500 font-bold text-lg"
                                type="submit">Order Now <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </form>
                    <div class="max-w-1/3 w-[300px]">
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
                                <div class="ml-auto font-bold">
                                    ${{ number_format($total * (1 + $tva) + $shipping, 2) }}
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