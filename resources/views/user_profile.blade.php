@extends('layout_user')
@section('content')
    <!-- Section-->
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
                    {{-- Profile Picture Card --}}
                    <div class="card mb-4 mb-xl-0">
                        <div class="card">
                            <div class="card-header">
                                <h5>Profile Picture</h5>
                            </div>
                            <div class="card-body">

                                {{-- Profile Picture Image --}}
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="#img"
                                    class="img-account-profile rounded-circle mb-2">
                                {{-- Profile picture help block --}}
                                <div class="small font-italic text-muted mb-4">JPG or PNG no Larger than 5 MB</div>
                                {{-- Profile picture upload button --}}
                                <button class="btn btn-outline-primary" type="button">Upload New Image</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Account Details</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('userProfileUpdate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="container">
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control border-dark col-4" name="firstName"
                                                id="firstName" value="{{ $user->firstName }}" required="" />
                                        </div>
                                        <div class="col-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control border-dark col-4" name="lastName"
                                                id="lastName" value="{{ $user->lastName }}" required="" />
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control border-dark col-4" name="email"
                                                id="email" value="{{ $user->email }}" required="" />
                                        </div>

                                        <div class="col-6">
                                            <label for="contact" class="form-label">Contact Number</label>
                                            <input type="tel" class="form-control border-dark col-4" name="contact"
                                                id="contact" value="{{ $user->contact }}" maxlength="10" pattern="[0-9]+"
                                                required="" />
                                        </div>
                                        <div class="col-6">
                                            <label for="gender" class="form-label">Gender</label>
                                            <div class="check">
                                                <input class="form-check-input border-dark " type="radio" name="gender"
                                                    id="male" value="Male"
                                                    @if ($user->gender == 'Male') {{ 'checked' }} @endif
                                                    required="" />
                                                <label class="form-check-label" for="male"> Male </label>
                                                <input class="form-check-input border-dark " type="radio" name="gender"
                                                    id="female" value="Female"
                                                    @if ($user->gender == 'Female') {{ 'checked' }} @endif
                                                    required="" />
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-6">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control border-dark" name="address" id="address" required="">{{ $user->address }}</textarea>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="country" class="form-label border-dark">State</label>
                                                <select name="country" class="form-select border-dark form-select-sm"
                                                    id="country" required="">
                                                    <option selected disabled>Selected</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            @if ($user->country == $country->id) {{ 'selected' }} @endif>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-6">
                                            <button name="update" id="update" type="submit" value="update profile"
                                                class="btn btn-dark form-group px-3 mt-3">
                                                Updation Profile
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
@endsection
