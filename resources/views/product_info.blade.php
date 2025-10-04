@extends('layout_user')
@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 md-0" src="{{ asset('products') . '/' . $product->image }}" alt="#productImg"
                        style="width: 70%" />
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">{{ $product->product_code }}</div>
                    <h1 class="display-5 fw-bolder">{{ Str::of($product->name)->replace('_', ' ')->title() }}</h1>
                    <div class="fs-5 mb-5">
                        @if (empty($product->sale_price))
                            {{-- <span class="text-decoration-line-through">₹{{ $relatedProduct->price }}</span> --}}
                            <span>₹{{ $product->price }}</span>
                        @else
                            <span class="text-decoration-line-through">₹{{ $product->price }}</span>
                            <span>₹{{ $product->sale_price }}</span>
                        @endif
                    </div>
                    <p class="lead">{{ $product->description }}</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                            style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            @if ($relatedProduct->sale_price && $relatedProduct->stock != 0)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    Sale
                                </div>
                            @elseif ($relatedProduct->stock == 0)
                                <div class="badge bg-danger text-white position-absolute"
                                    style="top: 0.5rem; right: 0.5rem">
                                    Out of Stock
                                </div>
                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('products') . '/' . $relatedProduct->image }}"
                                alt="#img" />
                            {{-- <img class="card-img-top"
                                src="{{ url('http://127.0.0.1:8000/products') . '/' . $relatedProduct->image }}"
                                alt="#img" /> --}}
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $relatedProduct->name }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    @if (!empty($relatedProduct->sale_price) == 0)
                                        <span
                                            class="text-muted text-decoration-line-through">{{ '$' . $relatedProduct->price }}</span>
                                        {{ '$' . $relatedProduct->sale_price }}
                                    @else
                                        {{ '$' . $relatedProduct->price }}
                                    @endif
                                    <h6>{{ 'for: ' . $relatedProduct->gender }}</h6>
                                    <h6>{{ 'for: ' . $relatedProduct->function }}</h6>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('product-info', ['product' => $relatedProduct->name]) }}">View
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
