@extends('layout_user')
@section('content')
    <div class="container my-5" style="width: 40%;">
        <div class="border mt-5 border-dark">
            <h1 class="text-center mt-5">Login</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <hr class="border-dark mx-5">
            <form method="post" action="{{ route('authenticate') }}">
                @csrf
                <div class="mb-3 mx-5">
                    <label for="login" class="form-label">Email</label>
                    <input type="email" name="email" id="" class="form-control border-dark"
                        placeholder="enter the Email Address" aria-describedby="helpId" required />
                </div>
                <div class="mb-3 mx-5">
                    <label for="login" class="form-label">Password</label>
                    <input type="text" name="password" id="" class="form-control border-dark"
                        placeholder="Enter the Password" aria-describedby="helpId" required />
                </div>
                <button class="btn btn-dark mb-3 mx-5" type="login" name="login">login</button>
            </form>
            <div class="me-5 mb-3" style="...">&nbsp;
                <a href="{{ route('register') }}" class="float-end ms-3 ">New User</a>&nbsp;
                <a href="{{ route('forgotPassword') }}" class="float-end">Forgot Password</a>
            </div>
        </div>
    </div>
@endsection
