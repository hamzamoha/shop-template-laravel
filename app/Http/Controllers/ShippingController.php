<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        if (request()->wantsJson())
            return response()->json([
                "methods" => ShippingRate::all(),
                "regions" => Region::all(),
            ]);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|nullable|numeric|min:0',
                'region' => 'nullable|numeric',
            ]);
            $data = ShippingRate::create([
                'method' => $validated['name'],
                'cost' => $validated['cost'],
                'region_id' => $validated['region'] > 0 ? $validated['region'] : null,
            ]);
            return response()->json([
                "success" => true,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "error" => $th->getMessage()
            ]);
        }
    }
    public function update(Request $request, int $id)
    {
        try {
            $validated = $request->validate([
                'method' => 'required|string|max:255',
                'cost' => 'required|nullable|numeric|min:0',
                'region_id' => 'nullable|numeric',
            ]);
            $shippingRate = ShippingRate::findOrFail($id);
            $shippingRate->update([
                'method' => $validated['method'],
                'cost' => $validated['cost'],
                'region_id' => $validated['region_id'] > 0 ? $validated['region_id'] : null,
            ]);
            return response()->json([
                "success" => true,
                "data" => $shippingRate
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "error" => $th->getMessage()
            ]);
        }
    }
}
