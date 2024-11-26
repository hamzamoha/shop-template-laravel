<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("orders.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address_id = ($request->input("address_id") == "-1") ?
            Auth::user()->addresses()->create([
                'name' => $request->has("alias") ? $request->input("name") : null,
                'address_line_1' => $request->input("address_line_1"),
                'address_line_2' => $request->input("address_line_2"),
                'city' => $request->input("city"),
                'state' => $request->input("state"),
                'postal_code' => $request->input("postal_code"),
                'country' => $request->input("country"),
                'phone' => $request->input("phone"),
                'is_default' => false
            ])->id : $request->input("address_id");
        $order = Auth::user()->orders()->create([
            'order_number' => time(),
            'total_amount' => Auth::user()->cart()->join('products', 'carts.product_id', '=', 'products.id')->selectRaw('SUM(products.price * carts.quantity) as total')->value('total'),
            'shipping_address_id' => $address_id,
            'billing_address_id' => $address_id,
            'payment_method' => "COD",
            'shipping_method' => "DEFAULT",
            'shipping_cost' => 15
        ]);
        $order->update([
            'order_number' => (function ($id) {
                $f = "";
                $n = intdiv($id, 1000);
                while ($n > 0) {
                    $f = chr($n % 26 + 65) . $f;
                    $n = intdiv($n, 26);
                }
                $f = Str::padLeft($f, 3, "A");
                return "ORD-$f-1" . Str::padLeft($id % 1000, 3, "0");
            })($order->id)
        ]);
        Auth::user()->cart()->with('product')->get()->map(function ($item) use ($order) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity
            ]);
        });
        Auth::user()->cart->map(function ($item) {
            $item->delete();
        });
        return response()->redirectToRoute("orders.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
