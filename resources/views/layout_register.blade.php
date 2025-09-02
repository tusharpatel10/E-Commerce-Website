@extends('layout_user')
@section('content')
    <main>
        <div class="container col-8 mb-5">
            <div class="border mt-5 border-dark">
                <a href="#" class="display-flex float-end btn btn-outline-dark mt-3 me-5">Login</a>
                <div>
                    <h1 class="text-start m-3 mt-3">Registration</h1>
                </div>
                <hr class="border-dark mx-5">

                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container col-10">
                        <form>
                            <div class="mb-3 row">
                                <div class="col-6">
                                    <label for="firstName" class="col-3 col-form-label">First Name</label>
                                    <input type="text" class="form-control border-dark col-4" name="firstName"
                                        id="firstName" placeholder="" required="" />
                                </div>
                                <div class="col-6">
                                    <label for="lastName" class="col-3 col-form-label">Last Name</label>
                                    <input type="text" class="form-control border-dark col-4" name="lastName"
                                        id="lastName" placeholder="" required="" />
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-6">
                                    <label for="email" class="col-2 col-form-label">Email</label>
                                    <input type="text" class="form-control border-dark col-4" name="email"
                                        id="email" placeholder="" required="" />
                                </div>

                                <div class="col-6">
                                    <label for="password" class="col-2 col-form-label">Password</label>
                                    <input type="text" class="form-control border-dark col-4" name="password"
                                        id="password" placeholder="" required="" />
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-6">
                                    <label for="contact" class="col-4 col-form-label">Contact Number</label>
                                    <input type="text" class="form-control border-dark col-4" name="contact"
                                        id="contact" placeholder="" maxlength="10" pattern="[0-9]+" required="" />
                                </div>
                                <div class="col-6">
                                    <label for="gender" class="col-3 col-form-label">Gender</label>
                                    <div class="check">
                                        <input class="form-check-input border-dark " type="radio" name="gender"
                                            id="male" value="Male" required="" />
                                        <label class="form-check-label" for="male"> Male </label>
                                        <input class="form-check-input border-dark " type="radio" name="gender"
                                            id="female" value="female" required="" />
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-6">
                                    <label for="address" class="col-3 col-form-label">Address</label>
                                    <textarea class="form-control border-dark" name="address" id="address" required=""></textarea>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="country" class="form-label border-dark">State</label>
                                        <select name="country" class="form-select border-dark form-select-sm" id="country"
                                            required="">
                                            <option selected disabled>Selected</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
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
                            </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-1 col-sm-1">
                            <button name="regist" id="regist" type="submit" value="regist" class="btn btn-dark">
                                Registration
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
