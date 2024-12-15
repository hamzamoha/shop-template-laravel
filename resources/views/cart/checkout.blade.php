<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
	<title>Checkout - Easy Shop - Affordable Online Shopping for Everyone</title>
	@include("includes.head")
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
	@include("includes.header")
	<main>
		<div class="mx-auto w-full max-w-screen-xl py-10">
			<h1 class="mb-5 text-4xl font-bold">Checkout</h1>
			@if (count(auth()->user()->cart) > 0)
				<div class="flex gap-5">
					<form method="POST" class="flex-1" action="{{ route('orders.store', [], false) }}">
						{{ csrf_field() }}
						<div class="mb-3 flex flex-1 flex-col gap-3">
							<h2 class="mb-5 text-3xl font-bold">Address</h2>
							<div class="flex gap-2">
								@foreach (auth()->user()->addresses as $address)
									<label for="address_id_{{ $address->id }}" class="flex select-none items-center gap-3 rounded border p-3">
										<div><input type="radio" name="address_id" id="address_id_{{ $address->id }}" value="{{ $address->id }}"></div>
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
								<div class="mb-2 grid grid-cols-2 gap-2">
									<div>
										<label for="country" class="block pb-1 text-sm">Country <span class="text-red-500">*</span></label>
										<input aria-readonly="true" value="Morocco" readonly name="country" id="country" required aria-required="true" class="block h-10 w-full rounded border-0 bg-gray-200 focus:outline-none focus:ring-0">
									</div>
									<div>
										<label for="state" class="block pb-1 text-sm">State <span class="text-red-500">*</span></label>
										<select name="state" id="state" required aria-required="true" class="h-10 w-full rounded border-none bg-gray-200 transition-background focus:bg-gray-100 focus:outline-none focus:ring-0">
											<option value="" disabled selected hidden>-- Select a State --</option>
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
										<label for="city" class="block pb-1 text-sm">Prefecture / Province <span class="text-red-500">*</span></label>
										<select name="city" id="city" required aria-required="true" class="h-10 w-full rounded border-none bg-gray-200 transition-background focus:bg-gray-100 focus:outline-none focus:ring-0">
											<option value="" disabled selected hidden>-- Select a City --</option>
										</select>
									</div>
									<div>
										<label for="postal_code" class="block pb-1 text-sm">ZIP Code (Postal Code) <span class="text-red-500">*</span></label>
										<input placeholder="e.g. 73000" required aria-required="true" name="postal_code" id="postal_code" class="block h-10 w-full rounded border-0 bg-gray-200 focus:outline-none focus:ring-0">
									</div>
								</div>
								<div class="mb-2">
									<label for="address_line_1" class="block pb-1 text-sm">Address Line 1 <span class="text-red-500">*</span></label>
									<input placeholder="e.g. 123 Main St" required aria-required="true" name="address_line_1" id="address_line_1" class="block h-10 w-full rounded border-0 bg-gray-200 focus:outline-none focus:ring-0">
								</div>
								<div class="mb-2">
									<label for="address_line_2" class="block pb-1 text-sm">Address Line 2</label>
									<input placeholder="e.g. Apartment 4B" name="address_line_2" id="address_line_2" class="block h-10 w-full rounded border-0 bg-gray-200 focus:outline-none focus:ring-0">
								</div>
								<div class="mb-2">
									<label for="phone" class="block pb-1 text-sm">Phone Number</label>
									<input placeholder="e.g. +1 123-456-7890" required aria-required="true" name="phone" id="phone" class="block h-10 w-full rounded border-0 bg-gray-200 focus:outline-none focus:ring-0">
								</div>
								<div class="flex h-14 items-center gap-1">
									<input type="checkbox" name="alias" id="alias" class="peer focus:outline-none focus:ring-0">
									<label for="alias" class="text-sm">Alias?</label>
									<input type="text" name="name" id="name" class="hidden h-10 rounded border-0 bg-gray-100 text-sm focus:outline-none focus:ring-0 peer-checked:block" placeholder="e.g. Home, Work">
								</div>
							</div>
						</div>
						<div class="flex items-center justify-end">
							<button class="block rounded bg-cyan-600 px-4 py-2 text-lg font-bold text-white transition-all hover:bg-cyan-500" type="submit">Order Now <i class="fa-solid fa-angles-right"></i></button>
						</div>
					</form>
					<div class="max-w-1/3 w-[300px]">
						@php
							$total = auth()->user()->cart()->join("products", "carts.product_id", "=", "products.id")->selectRaw("SUM(products.price * carts.quantity) as total")->value("total");
							$tva = 0.1;
							$shipping = 15;
						@endphp
						<div class="rounded border bg-gray-100 p-2">
							<div class="mb-2 flex items-center text-lg font-bold">
								<div>Total</div>
								<div class="ml-auto font-bold">${{ number_format($total, 2) }}</div>
							</div>
							<div class="mb-2 flex items-center text-lg font-bold">
								<div>TVA ({{ floor($tva * 100) }}%)</div>
								<div class="ml-auto font-bold">${{ number_format($tva * $total, 2) }}</div>
							</div>
							<div class="mb-2 flex items-center text-lg font-bold">
								<div>Delivery</div>
								<div class="ml-auto font-bold">${{ number_format($shipping, 2) }}</div>
							</div>
							<div class="mb-2 h-0.5 bg-black"></div>
							<div class="mb-2 flex items-center text-xl font-bold">
								<div>Total</div>
								<div class="ml-auto font-bold">${{ number_format($total * (1 + $tva) + $shipping, 2) }}</div>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="text-center text-3xl font-medium text-gray-400">Your Cart is Empty!</div>
			@endif
		</div>
	</main>
	@include("includes.footer")
</body>

</html>
