<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $products = Product::orderByDesc("updated_at")->paginate(60);
            return response()->json($products);
        }
        $products = Product::paginate(20);
        return view("products.index", ["products" => $products]);
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
            // Validate input
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:products,name',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|integer|min:0',
                'image' => 'nullable|sometimes|image|max:2048',
            ]);
            $slug = Str::slug($validated['name'], '-');
            $slug = $this->generateUniqueSlug($slug);
            // Create product
            $product = new Product($validated);
            $product->slug = $slug;
            $product->sku = (function () {
                $id = Product::max('id') + 1;
                $f = "";
                $n = intdiv($id, 1000);
                while ($n > 0) {
                    $f = chr($n % 26 + 65) . $f;
                    $n = intdiv($n, 26);
                }
                $f = Str::padLeft($f, 3, "A");
                return "SKU-$f-1" . Str::padLeft($id % 1000, 3, "0");
            })();
            if ($request->hasFile('image')) {
                try {
                    $imageName = $slug . '-' . time() . '.' . $request->file('image')->extension();
                    $product->image = "/storage/" . $request->file('image')->storeAs('products', $imageName, 'public');
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Image upload failed. Please try again.',
                        'error' => $e->getMessage()
                    ], 400);
                }
            }
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'data' => $product
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // General error
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (request()->wantsJson()) {
            $product->load('category.parent');
            return response()->json($product);
        }
        $recommendations = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4) // Limit to 4 similar items
            ->get();
        return view("products.show", compact('product', 'recommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:products,name,' . $product->id,
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|integer|min:0',
                'image' => 'nullable|sometimes|image|max:2048',
            ]);

            $slug = Str::slug($validated['name'], '-');
            if ($slug !== $product->slug) {
                $slug = $this->generateUniqueSlug($slug);
            }

            // Update product
            $product->fill($validated);
            $product->slug = $slug;

            if ($request->hasFile('image')) {
                // Handle image upload
                try {
                    if ($product->image) {
                        //Storage::disk('public')->delete($product->image);
                    }
                    $imageName = $slug . '-' . time() . '.' . $request->file('image')->extension();
                    $product->image_url = "/storage/" . $request->file('image')->storeAs('products', $imageName, 'public');
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Image upload failed. Please try again.',
                        'error' => $e->getMessage()
                    ], 400);
                }
            }
            // Save the product
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'data' => $product
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // General error
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    private function generateUniqueSlug($slug, $id = null)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Product::where('slug', $slug)->when($id, function ($query, $id) {
            return $query->where('id', '!=', $id);
        })->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Delete the associated image file if it exists
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }

            // Delete the product
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
