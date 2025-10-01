@extends('admin.admin_layout')
@section('content')
    <!-- Section-->
    <div class="container-fluid">
        <h2 class="mt-4"><b>Edit {{ ucfirst($product->name) }}</b>
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product List</a></li>
            <li class="breadcrumb-item" active>Product</li>
        </ol>
        <div class="container h-100 mb-5">
            <div class="container-xl px-4 mt-4">
                @include('flash_data')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-4">
                        {{-- image Picture Card --}}
                        <div class="card mb-4 mb-xl-0">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Product Picture</h5>
                                </div>
                                <div class="card-body text-center">
                                    {{-- Product image --}}
                                    <img src="{{ asset('products') . '/' . $product->image }}" alt="#productImage"
                                        class="img-account-image rounded-circle mb-2" width="250">
                                    {{-- Product picture help block --}}
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no Larger than 5 MB</div>
                                    <form action="{{ route('admin-product-image-change', ['id' => $product->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <input type="file" class="form-control border-dark col-4" name="image"
                                            id="image" value="{{ $product->image }}" required />
                                        <button name="updateimage" id="update" type="submit" value="updateimageImage"
                                            class="btn btn-dark form-group px-3 mt-3">
                                            Update Image
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>Product Details</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <label for="name" class="form-label"><b>Product Name</b></label>
                                                <input type="text" class="form-control border-dark " name="name"
                                                    value="{{ $product->name }}" id="name" />
                                            </div>
                                            <div class="col">
                                                <label for="price" class="form-label"><b>Price</b></label>
                                                <input type="text" class="form-control border-dark" name="price"
                                                    value="{{ $product->price }}" id="price" />
                                            </div>
                                            <div class="col">
                                                <label for="sale_price" class="form-label"><b>Sale Price</b></label>
                                                <input type="text" class="form-control border-dark " name="sale_price"
                                                    value="{{ $product->sale_price }}" id="sale_price" />
                                            </div>

                                        </div>
                                        <div class="my-3 row">
                                            <div class="col">
                                                <label for="color" class="form-label"><b>Color</b></label>
                                                <select name="color" id="color" class="form-select border-dark">
                                                    <Option value="{{ $product->color }}" disabled>Selected</Option>
                                                    @foreach (Config::get('color_function') as $value)
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="brand" class="form-label"><b>Brand</b></label>
                                                <select class="form-select border-dark" name="brand_id" id="brand_id">
                                                    <option value="{{ $product->brand }}" disabled>Select</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="prod_code" class="form-label"><b>Product Code</b></label>
                                                <input type="text" class="form-control border-dark " name="product_code"
                                                    id="product_code" value="{{ $product->product_code }}" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="gender" class="col-form-label"><b>Gender :</b></label>
                                                <div class="check">
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="gender" id="male" value="Male"
                                                        @if ($product->gender == 'Male') {{ 'checked' }} @endif
                                                        required="" />
                                                    <label class="form-check-label" for="male">Male</label>
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="gender" id="female" value="Female"
                                                        @if ($product->gender == 'Female') {{ 'checked' }} @endif
                                                        required="" />
                                                    <label class="form-check-label" for="female">Female</label>
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="gender" id="children" value="Children"
                                                        @if ($product->gender == 'Children') {{ 'checked' }} @endif
                                                        required="" />
                                                    <label class="form-check-label" for="children">Children</label>
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="gender" id="unisex" value="Unisex"
                                                        @if ($product->gender == 'Unisex') {{ 'checked' }} @endif
                                                        required="" />
                                                    <label class="form-check-label" for="unisex">Unisex</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="function" class="form-label"><b>Function</b></label>
                                                <select name="function" id="function" class="form-select border-dark">
                                                    <option value="{{ $product->function }}" disabled>Select</option>
                                                    @foreach (Config::get('watch_function') as $value)
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col-4">
                                                <label for="stock" class="form-label"><b>Stock</b></label>
                                                <input type="number" class="form-control border-dark" name="stock"
                                                    id="stock" value="{{ $product->stock }}" />
                                            </div>
                                            <div class="col">
                                                <label for="description" class="form-label"><b>Description</b></label>
                                                <textarea name="description" id="description" rows="3" class="form-control border-dark">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-2">
                                        <div class="offset-sm-1 col-sm-3">
                                            <button name="updateProduct" id="updateProduct" type="submit" value="updateProduct"
                                                class="btn btn-dark">
                                                Update Product
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
