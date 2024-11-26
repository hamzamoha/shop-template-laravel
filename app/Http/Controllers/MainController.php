<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    function index(): View
    {
        $categories = Category::withCount("products")->orderBy("products_count", "desc")->take(10)->get();
        $new_arrivals = Product::orderBy("updated_at", "desc")->take(10)->get();
        return view('index', compact('categories', 'new_arrivals'));
    }
}
