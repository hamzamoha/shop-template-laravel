<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response()->json(Discount::orderByDesc('id')->get()->loadCount("products")->append(['is_active']));
        }
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:flat,percentage',
                'value' => 'required|numeric|min:0',
                'code' => 'nullable|string|unique:discounts,code',
                'starts_at' => 'nullable|date|after_or_equal:today',
                'ends_at' => 'nullable|date|after_or_equal:starts_at',
            ]);

            $discount = Discount::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Discount created successfully.',
                'data' => $discount->append('is_active'),
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:flat,percentage',
                'value' => 'required|numeric|min:0',
                'code' => 'nullable|string|unique:discounts,code,' . $discount->id,
                'starts_at' => 'nullable|date|after_or_equal:today',
                'ends_at' => 'nullable|date|after_or_equal:starts_at',
            ]);

            $discount->fill($validatedData);

            $discount->save();

            return response()->json([
                'success' => true,
                'message' => 'Discount created successfully.',
                'data' => $discount->append('is_active'),
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        try {
            $discount->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Discount deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the discount.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
