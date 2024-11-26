<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cart'));
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
        $product = Product::findOrFail($request->id);

        // Save to database
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();
        if ($cartItem) {
            // Update quantity if the product is already in the cart
            $cartItem->update(['quantity' => $cartItem->quantity + $request->quantity]);
        } else {
            // Add new item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }
        return response()->json([
            "cart_count" => Auth::user()->cart->count()
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id == Auth::id()) {
            $cart->update(['quantity' => $request->quantity]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
            if ($cart->user_id == Auth::id()) {
                $cart->delete();
                return redirect()->route("cart.index");
            }
    }

    public function checkout()
    {
        return view("cart.checkout");
    }
}
