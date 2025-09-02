@extends('layout_user')
@section('content')
    <div class="container-fluid" style="width: 40%">
        <div class="album py-5" style="...">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="card border-dark" style="...">
                    <div>
                        <h2>Forgot Password</h2>
                        <a href="{{ route('login') }}" class="float-end btn btn-outline-dark" style="...">Login</a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form action="#" method="post" name="forgotPassword" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" required="required"
                                    placeholder="Enter Email">
                            </div>
                            <br>
                            <input type="submit" name="forgot_pass_btn" class="btn btn-outline-dark">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
