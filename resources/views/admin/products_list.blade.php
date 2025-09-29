@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">All Brands</h1>
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
                        <table class="table table-primary text-center" id="datatablesSimple">
                            <thead>
                                <tr>
                                </tr>
                            </thead>
                            <tbody>
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
