@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image align-content-center text-center">
                    <img src="{{asset('img/undraw_rocket.svg')}}" class="img-fluid w-50 h-50" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>

                        <form class="user" method="POST" action={{route('registerUser')}}>
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user @error('name')
                                is-invalid
                                @enderror" id="exampleFirstName"
                                    placeholder="Full Name" value="{{ old('name') }}" name="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user @error('email')
                                is-invalid
                                @enderror" id="exampleInputEmail"
                                    placeholder="Email Address" value="{{ old('email') }}" name="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user @error('password')
                                    is-invalid
                                    @enderror"
                                        id="exampleInputPassword" placeholder="Password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user @error('password')
                                    is-invalid
                                    @enderror"
                                        id="exampleRepeatPassword" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>
                            <button type="submit" href={{route('registerUser')}} class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
