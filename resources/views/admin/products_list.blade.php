@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">All Product</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <a href="{{ route('product.create') }}" class="btn btn-outline-primary sm float-end"> +
                        Add-Product</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-warning text-center" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Color</th>
                                    <th>Brand</th>
                                    <th>Gender</th>
                                    <th>Function</th>
                                    <th>Stock</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::title($product->name) }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->color }}</td>
                                        <td>{{ $product->getBrandData->name }}</td>
                                        <td>{{ $product->gender }}</td>
                                        <td>{{ $product->function }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td class="d-flex flex-column align-items-center">
                                            {{-- </td>
                                            <td> --}}
                                                <img src="{{ url('products') . '/' . $product->image }}"
                                                alt="{{ $product->name ?? 'product' }} Image" class="d-flex" width="90">
                                                <small class="fs-6 fst-italic">{{ $product->description }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('admin-change-product-status', ['id' => $product->id, 'status' => $product->is_active == 1 ? 0 : 1]) }}"
                                                class="btn btn-sm my-2 btn-{{ $product->is_active == 1 ? 'danger' : 'success' }}">{{ $product->is_active == 1 ? 'Deactivate' : 'Activate' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

    </main>
    <script>
        let table = new DataTable('#datatablesSimple');
    </script>
@endsection
