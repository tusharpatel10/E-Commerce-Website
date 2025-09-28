@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-2">Brands</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" active><a href="{{ route('brand.index') }}">Brands-List</a></li>
                <li class="breadcrumb-item" active>Brands</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i><b>Register Brands</b>
                    <a href="{{ route('brand.index') }}" class="btn btn-outline-primary sm float-end">Back</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="container col-8 mb-5">
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

                            <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="container col-10">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="name" class="col-3 col-form-label">Name</label>
                                            <input type="text" class="form-control border-dark col-4" name="name"
                                                id="name" placeholder="Title"  />
                                        </div>
                                    </div>
                                    <div class="my-3 row">
                                        <div class="col">
                                            <label for="description" class="col-3 col-form-label">Description</label>
                                            <textarea class="form-control border-dark" name="description" placeholder="Description" id="description" ></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="border-dark" name="image" id="image"
                                                aria-describedby="helpId" placeholder="" />
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
