@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-2">Users</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" active><a href="{{ route('userList') }}">User-List</a></li>
                <li class="breadcrumb-item" active>User</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i><b>Register User</b>
                    <a href="{{ route('userList') }}" class="btn btn-outline-primary sm float-end">Back</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="container col-8 mb-5">
                        <div class="border mt-2 border-dark rounded-3">
                            @include('flash_data')
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

                            <form action="{{ route('admin-user-profile-register-data') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container col-10">
                                    <form>
                                        <div class="mb-2 row">
                                            <div class="col-6">
                                                <label for="firstName" class="col-3 col-form-label">First Name</label>
                                                <input type="text" class="form-control border-dark col-4"
                                                    name="firstName" id="firstName" placeholder="" required="" />
                                            </div>
                                            <div class="col-6">
                                                <label for="lastName" class="col-3 col-form-label">Last Name</label>
                                                <input type="text" class="form-control border-dark col-4" name="lastName"
                                                    id="lastName" placeholder="" required="" />
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-6">
                                                <label for="email" class="col-3 col-form-label">Email</label>
                                                <input type="text" class="form-control border-dark col-4" name="email"
                                                    id="email" placeholder="" required="" />
                                            </div>

                                            <div class="col-6">
                                                <label for="password" class="col-3 col-form-label">Password</label>
                                                <input type="text" class="form-control border-dark col-4" name="password"
                                                    id="password" placeholder="" required="" />
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-6">
                                                <label for="contact" class="col-6 col-form-label">Contact Number</label>
                                                <input type="tel" class="form-control border-dark col-4" name="contact"
                                                    id="contact" placeholder="" maxlength="10" pattern="[0-9]+"
                                                    required="" />
                                            </div>
                                            <div class="col-6">
                                                <label for="address" class="col-3 col-form-label">Address</label>
                                                <textarea class="form-control border-dark" name="address" id="address" required=""></textarea>

                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-6">
                                                <label for="gender" class="col-6 col-form-label"><b>Gender :</b></label>
                                                <div class="check">
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="gender" id="male" value="Male" required="" />
                                                    <label class="form-check-label" for="male"> Male </label>
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="gender" id="female" value="Female" required="" />
                                                    <label class="form-check-label" for="female">Female</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="gender" class="col-6 col-form-label"><b>Roles :</b></label>
                                                <div class="check">
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="role_id" id="role_id" value="0" required="" />
                                                    <label class="form-check-label" for="admin">Admin </label>
                                                    <input class="form-check-input border-dark " type="radio"
                                                        name="role_id" id="role_id" value="1" required="" />
                                                    <label class="form-check-label" for="user"> User</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="profile" class="form-label">Profile</label>
                                                    <input type="file" class="form-control border-dark" name="profile"
                                                        id="" aria-describedby="helpId" placeholder="" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="country" class="form-label border-dark">State</label>
                                                    <select name="country" class="form-select border-dark form-select-sm"
                                                        id="country" required="">
                                                        <option selected disabled>Selected</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="offset-sm-1 col-sm-1">
                                        <button name="regist" id="regist" type="submit" value="regist"
                                            class="btn btn-dark">
                                            Registration
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
