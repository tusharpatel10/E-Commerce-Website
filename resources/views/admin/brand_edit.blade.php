@extends('admin.admin_layout')
@section('content')
    <!-- Section-->
    <div class="container-fluid">
        <h2 class="mt-4"><b>Edit {{ ucfirst($brand->name) }}</b>
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brand List</a></li>
            <li class="breadcrumb-item" active>Brand</li>
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
                                    <h5>Brand Picture</h5>
                                </div>
                                <div class="card-body text-center">
                                    {{-- Brand image --}}
                                    <img src="{{ asset('brands') . '/' . $brand->image }}" alt="#img"
                                        class="img-account-image rounded-circle mb-2"
                                        width="250">
                                    {{-- Brand picture help block --}}
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no Larger than 5 MB</div>
                                    <form action="{{ route('admin-brand-image-change',['id'=>$brand->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <input type="file" class="form-control border-dark col-4" name="image"
                                            id="image" value="{{ $brand->image }}" required />
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
                                <h5>Brand Details</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="container">
                                        <div class="mb-3 row">
                                            <div class="col">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control border-dark col-4" name="name"
                                                    id="name" value="{{ $brand->name }}"  />
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col">
                                                <label for="address" class="form-label">Description</label>
                                                <textarea class="form-control border-dark" name="description" id="description" required="">{{ $brand->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-6">
                                                <button name="update" id="update" type="submit" value="update detail"
                                                    class="btn btn-dark form-group px-3 mt-3">
                                                    Update Detail
                                                </button>
                                            </div>
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
