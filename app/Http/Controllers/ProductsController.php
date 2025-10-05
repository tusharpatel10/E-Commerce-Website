<?php

namespace App\Http\Controllers;

use App\Models\brands;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::all();
        return view('admin.products_list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = brands::all();
        return view('admin.product_add', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:3',
            'gender' => 'required|in:Male,Female,Children,Unisex',
            'function' => 'nullable|string|max:50',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:500',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ]);

        $requestData = $request->except(['_token', 'add']);
        $imgName = Str::snake($request->name) . '.' . $request->image->extension();
        $request->image->move(public_path('products/'), $imgName);
        $requestData['image'] = $imgName;
        $product = products::create($requestData);
        return redirect()->route('product.index', [], 301)->with('success', 'Product has been Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $product)
    {
        $brands = brands::all();
        return view('admin.product_edit', compact('product', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $product)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:3',
            'gender' => 'required|in:Male,Female,Children,Unisex',
            'function' => 'nullable|string|max:50',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:500'
        ]);
        $requestData = $request->except(['_token', '_method', 'updateProduct']);
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->sale_price = $request->sale_price ?? $product->sale_price;
        $product->color = $request->color ?? $product->color;
        $product->brand_id = $request->brand_id ?? $product->brand_id;
        $product->product_code = $request->product_code ?? $product->product_code;
        $product->gender = $request->gender ?? $product->gender;
        $product->function = $request->function ?? $product->function;
        $product->stock = $request->stock ?? $product->stock;
        $product->description = $request->description ?? $product->description;
        $product->save();
        return redirect()->route('product.index', [], 301)->with('primary', 'Product has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $products)
    {
        //
    }

    public function changeProductImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,gif'
        ]);
        $requestData = $request->except(['_token', '_method', 'updateImage']);
        $products = products::find($id);
        $imgName = Str::snake($products->name) . '.'  . $request->image->extension();
        $requestData['image'] = Str::snake($imgName);
        if (!empty($products)) {
            $request->image->move(public_path('products/'), $imgName);
            $products->update($requestData);
            return redirect()->route('product.index')->with('success', 'Products Picture has been update Successfully.');
        } else {
            return redirect()->route('product.index')->with('danger', 'Something went.');
        }
    }

    public function changeProductStatus(Request $request, $id, $status = 1)
    {
        $products = products::find($id);
        if (!empty($products)) {
            $products->is_active = $status;
            $products->save();
            return redirect()->route('product.index')->with('success', 'Product status has been change successfully');
        } else {
            return redirect()->route('product.index')->with('danger', 'Something went wrong');
        }
    }
}
