@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-2">Brands</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" active><a href="{{ route('product.index') }}">product-List</a></li>
                <li class="breadcrumb-item" active>Product</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i><b>Register Product</b>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-primary sm float-end">Back</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="container col-10 mb-5">
                        <div class="border mt-2 border-dark rounded-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <hr class="border-dark mx-5">
                            @endif

                            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="container-fluid">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="name" class=" col-form-label">Product Name</label>
                                            <input type="text" class="form-control border-dark " name="name"
                                                id="name" />
                                        </div>
                                        <div class="col">
                                            <label for="price" class=" col-form-label">Price</label>
                                            <input type="text" class="form-control border-dark" name="price"
                                                id="price" />
                                        </div>
                                        <div class="col">
                                            <label for="sale_price" class=" col-form-label">Sale Price</label>
                                            <input type="text" class="form-control border-dark " name="sale_price"
                                                id="sale_price" />
                                        </div>
                                        <div class="col">
                                            <label for="color" class="col-form-label">Color</label>
                                            <select name="color" id="color" class="form-select border-dark">
                                                <Option selected disabled>Selected</Option>
                                                @foreach (Config::get('color_function') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="my-3 row">
                                        <div class="col">
                                            <label for="brand" class="form-label">Brand</label>
                                            <select class="form-select border-dark" name="brand_id" id="brand_id">
                                                <option selected disabled>Select</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="prod_code" class=" col-form-label">Product Code</label>
                                            <input type="text" class="form-control border-dark " name="product_code"
                                                id="product_code" />
                                        </div>
                                        <div class="col">
                                            <label for="gender" class="col-form-label"><b>Gender :</b></label>
                                            <div class="check">
                                                <input class="form-check-input border-dark " type="radio" name="gender"
                                                    id="male" value="Male" required="" />
                                                <label class="form-check-label" for="male">Male</label>
                                                <input class="form-check-input border-dark " type="radio" name="gender"
                                                    id="female" value="Female" required="" />
                                                <label class="form-check-label" for="female">Female</label>
                                                <input class="form-check-input border-dark " type="radio" name="gender"
                                                    id="children" value="Children" required="" />
                                                <label class="form-check-label" for="children">Children</label>
                                                <input class="form-check-input border-dark " type="radio" name="gender"
                                                    id="unisex" value="Unisex" required="" />
                                                <label class="form-check-label" for="unisex">Unisex</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <label for="function" class="form-label">Function</label>
                                            <select name="function" id="function" class="form-select border-dark">
                                                <option selected disabled>Select</option>
                                                @foreach (Config::get('watch_function') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="stock" class="form-label">Stock</label>
                                            <input type="number" class="form-control border-dark" name="stock"
                                                id="stock" />
                                        </div>
                                        <div class="col">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" rows="3" class="form-control border-dark"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3 my-3">
                                        <div class="col">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" name="image" id="image"
                                                class="form-control-file">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col">
                                    <div class="offset-sm-1 col-sm-2">
                                        <button name="add" id="add" type="submit" value="add"
                                            class="btn btn-dark">
                                            Add Brand
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
