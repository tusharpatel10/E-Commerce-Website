<?php

namespace App\Http\Controllers;

use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = brands::all();
        return view('admin.brand_list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand_register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:20|string',
            'desctiption' => 'nullable|string|max:100',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', 'add']);
        $imgName = Str::snake($request->name) . "." . $request->image->extension();
        $request->image->move(public_path('brands/'), $imgName);
        $requestData['image'] = $imgName;
        $brands = brands::create($requestData);
        // WelcomeMail::dispatch($user);
        if (!empty($brands)) {
            $brands->update($requestData);
            return redirect()->route('brand.index')->with('success', 'Brand has been Added Successfully.');
        } else {
            return redirect()->route('brand.index')->with('danger', 'Something went.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(brands $brand)
    {
        return view('admin.brand_edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, brands $brand)
    {
        $request->validate([
            'name' => 'required|min:2|max:30|string',
            'description' => 'nullable|string'
        ]);
        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(brands $brands)
    {
        //
    }

    public function changeBrandImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,gif'
        ]);
        $requestData = $request->except(['_token', '_method', 'updateProfile']);
        $brand = brands::find($id);
        if (!empty($brand)) {
            $imgName = $brand->name . '.'  . $request->image->extension();
            $request->image->move(public_path('brands/'), $imgName);
            $requestData['image'] = $imgName;
            $brand->update($requestData);
            return redirect()->route('brand.index')->with('success', 'Brand has been New Picture update Successfully.');
        } else {
            return redirect()->route('brand.index')->with('danger', 'Something went.');
        }
    }

    public function changeBrandStatus(Request $request, $id, $status = 1)
    {
        $brands = brands::find($id);
        if (!empty($brands)) {
            $brands->is_active = $status;
            $brands->save();
            return redirect()->route('brand.index')->with('success', 'Brand status has been change successfully');
        } else {
            return redirect()->route('brand.index')->with('danger', 'Something went wrong');
        }
    }
}
