@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">All Brands</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <a href="{{ route('brand.create') }}" class="btn btn-outline-primary sm float-end"> +
                        Add-Brand</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary text-center" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th class="text-center">Sr.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->description }}</td>
                                        <td><img src="{{ url('brands') . '/' . $brand->image }}"
                                                alt="{{ $brand->name ?? 'brand' }} Image" width="100"></td>

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
