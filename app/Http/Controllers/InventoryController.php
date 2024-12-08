<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            $sku = request()->get('sku');
            $status = request()->get('status');
            $name = request()->get('name');
            $inventory = Product::with('category.parent')
                ->where("sku", "like", "%$sku%")
                ->where("name", "like", "%$name%");
            switch ($status) {
                case 'in':
                    $inventory = $inventory->where("stock", ">", 5);
                    break;
                case 'low':
                    $inventory = $inventory->whereBetween("stock", [1, 4]);
                    break;
                case 'out':
                    $inventory = $inventory->where("stock", "<=", 0);
                    break;
            }
            $inventory = $inventory->orderByDesc("updated_at")->paginate(200, ['id', 'sku', 'slug', 'category_id', 'stock', 'price', 'name', 'updated_at']);
            return response()->json($inventory);
        }
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->stock = $request->input('stock');
        $product->save();
        return response()->json([
            "success" => true
        ]);
    }
}
