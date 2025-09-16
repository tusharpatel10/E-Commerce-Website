@extends('layout_user')
@section('content')
    <div class="container-fluid" style="width: 40%">
        <div class="album py-5" style="...">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="card border-dark" style="...">
                    <div>
                        <h2>Reset Password</h2>
                        <a href="{{ route('login') }}" class="float-end btn btn-outline-dark" style="...">Login</a>
                    </div>
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
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('reset_password_data') }}" method="post" name="resetPasswordData"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="form-group">
                                    <input type="hidden" value="{{ $email }}" name="email">
                                    <input type="password" class="form-control" name="password" id="password"
                                        required="required" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" required="required" placeholder="Enter confirm password">
                                </div>
                            </div>
                            <br>
                            <input type="submit" name="reset_pass_btn" class="btn btn-outline-dark" value="Reset Password">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
