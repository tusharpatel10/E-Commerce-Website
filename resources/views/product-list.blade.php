@extends('layout_user')
@section('content')
    <!-- Filters-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="card box" style="width: 75rem;">
                <h5 class="card-header">FILTER BY</h5>
                <div class="card-body">
                    <form action="{{ route('product-list') }}" name="search_by_detail" method="get"
                        enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md m-1">
                                <label><b>Gender:</b></label>
                                <select class="form-select" name="gender" id="gender" aria-label="gender filter">
                                    <option selected disabled>Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="children">Children</option>
                                    <option value="children">Unisex</option>
                                </select>
                            </div>
                            <div class="form-group col-md m-1">
                                <label><b>Price:</b></label>
                                <select class="form-select" name="price" id="price" aria-label="price filter">
                                    <option selected disabled>Select</option>
                                    <option value="less_than_1500">Less than ₹1500</option>
                                    <option value="between_1500_5k">₹1500 - ₹5000</option>
                                    <option value="between_5k_10k">₹5000 - ₹10,000</option>
                                    <option value="between_10k_30k">₹10,000 - ₹30,000</option>
                                    <option value="greater_than_30k">More than ₹30,000</option>
                                </select>
                            </div>
                            <div class="form-group col-md m-1">
                                <label><b>Color:</b></label>
                                <select class="form-select" name="color" id="color" aria-label="color filter">
                                    <option selected disabled>Select</option>
                                    @foreach (Config::get('color_function') as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md m-1">
                                <label><b>Function:</b></label>
                                <select class="form-select" name="function" id="function" aria-label="function filter">
                                    <option selected disabled>Select</option>
                                    @foreach (Config::get('watch_function') as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md m-1">
                                <label><b>Brand:</b></label>
                                <select class="form-select" name="brand" id="brand" aria-label="brand filter">
                                    <option selected disabled>Select</option>
                                    @foreach ($brands as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ Str::of($value)->replace('-', ' ')->title()->value() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md m-1">
                                <label><b>Sort By:</b></label>
                                <select class="form-select" name="sort_by" id="sort_by" aria-label="sort filter">
                                    <option selected disabled>Select</option>
                                    <option value="lower_to_higher">Price Lower to Higher</option>
                                    <option value="higher_to_lower">Price Higher to Lower</option>
                                    <option value="model_a_z">Model (A-Z)</option>
                                    <option value="model_z_a">Model (Z-A)</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <input type="submit" class="btn btn-success btn-sm" name="search" value="Search"
                                id="search" style="width:8rem;color: #ffffff">
                            <input type="reset" class="btn btn-warning btn-sm" name="reset_filters" value="Clear Filters"
                                id="reset_filters" style="width:8rem;color: #ffffff">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Section-->
    @include('flash_data')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            @if ($product->sale_price && $product->stock != 0)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    Sale
                                </div>
                            @elseif ($product->stock == 0)
                                <div class="badge bg-danger text-white position-absolute"
                                    style="top: 0.5rem; right: 0.5rem">
                                    Out of Stock
                                </div>
                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('products') . '/' . $product->image }}"
                                alt="#img" />
                            {{-- <img class="card-img-top"
                                src="{{ url('http://127.0.0.1:8000/products') . '/' . $product->image }}"
                                alt="#img" /> --}}
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    @if (empty($product->sale_price) == 0)
                                        <span
                                            class="text-muted text-decoration-line-through">{{ '$' . $product->price }}</span>
                                        {{ '$' . $product->sale_price }}
                                    @else
                                        {{ '$' . $product->price }}
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('product-info', ['product' => $product->name]) }}">View Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
               {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .form-inline .form-control {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        label {
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
