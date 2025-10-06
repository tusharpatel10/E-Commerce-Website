<?php

namespace App\Http\Controllers;

use App\Models\brands;
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

    public function productList(Request $request)
    {
        // $brands = brands::select('id', 'name')->get();
        $brands = brands::pluck('name', 'id');
        $requestData = $request->all();
        $products = products::query();
        if (isset($requestData['gender']) && !empty($requestData['gender'])) {
            $products = $products->where('gender', $requestData['gender']);
            echo "<pre>";
            print_r($products);exit;
        }
        if (isset($requestData['price']) && !empty($requestData['price'])) {
            if ($requestData['price'] == 'less_than_1500') {
                // Optional requirements
                // $products = $products->where(function ($query) use ($requestData) {
                //     $query->where('price', '<', 1500);
                //     $query->orWhere('sale_price', '<', 1500);
                // });
                $products = $products->where('price', '<', 1500);
            } elseif ($requestData['price'] == 'between_1500_5k') {
                // Optional requirements
                // $products = $products->where(function ($query) use ($requestData) {
                //     $query->whereBetween('price', [1500, 5000]);
                //     $query->whereBetwee('sale_price', [1500,5000]);
                // });
                $products = $products->whereBetween('price', [1500, 5000]);
            } elseif ($requestData['price'] == 'between_5k_10k') {
                // Optional requirements
                // $products = $products->where(function ($query) use ($requestData) {
                //     $query->whereBetween('price', [5000, 10000]);
                //     $query->whereBetween('sale_price',[5000,10000]);
                // });
                $products = $products->whereBetween('price', [5000, 10000]);
            } elseif ($requestData['price'] == 'between_10k_30k') {
                // Optional requirements
                // $products = $products->where(function ($query) use ($requestData) {
                //     $query->whereBetween('price', [10000, 30000]);
                //     $query->whereBetween('sale_price', [10000,30000]);
                // });
                $products = $products->whereBetween('price', [5000, 10000]);
            } elseif ($requestData['price'] == 'between_10k_30k') {
                // Optional requirements
                // $products = $products->where(function ($query) use ($requestData) {
                //     $query->where('price','>',30000);
                //     $query->where('sale_price', '>',30000);
                // });
                $products = $products->where('price', '>', 30000);
            }
        }

        if (isset($requestData['color']) && !empty($requestData['color'])) {
            $products = $products->where('color', $requestData['color']);
        }
        if (isset($requestData['function']) && !empty($requestData['function'])) {
            $products = $products->where('function', $requestData['function']);
        }
        if (isset($requestData['brand']) && !empty($requestData['brand'])) {
            $products = $products->where('brand_id', $requestData['brand']);
        }
        if (isset($requestData['sort_by']) && !empty($requestData['sort_by'])) {
            if ($requestData['sort_by'] == 'lower_to_higher') {
                $products = $products->orderBy('price', 'ASC');
            } elseif ($requestData['sort_by'] == 'higher_to_lower') {
                $products = $products->orderBy('price', 'DESC');
            } elseif ($requestData['sort_by'] == 'model_a_z') {
                $products = $products->orderBy('name', 'ASC');
            } elseif ($requestData['sort_by'] == 'model_z_a') {
                $products = $products->orderBy('name', 'DESC');
            }
        }
        $products = products::paginate(8);
        return view('product-list', compact('brands', 'products'));
    }
}
