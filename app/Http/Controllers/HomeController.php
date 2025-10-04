<?php

namespace App\Http\Controllers;

use App\Models\products;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now()->firstOfMonth();
        $endDate = Carbon::now()->lastOfMonth();
        $products = products::whereBetween('created_at', [$startDate, $endDate])->inRandomOrder()->limit(12)->get();
        return view('index', compact('products'));
    }

    public function productInfo(Request $request, products $product)
    {
        $relatedProducts = products::where('gender', $product->gender)->where('function', $product->function)->inRandomOrder()->limit(4)->get();
        return view('product_info', compact('product', 'relatedProducts'));
    }
}
