@extends('vendor.layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
            <div class="p-5 w-100">
                <div class="main-signin-header">
                    <h2>Welcome back!</h2>
                    <h4>Please Sign in to continue</h4>
                    @if (Session::has('message2'))
                        <div class="alert alert-success">
                            {{ Session::get('message2') }}
                        </div>
                    @endif
                    @if (Session::has('message1'))
                        <div class="alert alert-danger">
                            {{ Session::get('message1') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-solid-danger mb-3" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Error : </strong>{{ Session::get('error') }}
                        </div>
                    @endif()
                    <form action="{{ route('vendor.login') }}" method="POST">
                        @csrf()
                        <div class="form-group"> <label>Email</label> <input class="form-control"
                                placeholder="Enter your email" type="email" name="email" required> </div>
                        <div class="form-group"> <label>Password</label> <input class="form-control"
                                placeholder="Enter your password" type="password" name="password" required> </div>




                        <script src="https://www.google.com/recaptcha/api.js"></script>
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                            data-callback="correctCaptcha"></div>
                        <script>
                            var correctCaptcha = function(response) {

                                document.getElementById('g-recaptcha-response').value = response;
                            };
                        </script>







                        <button class="btn btn-main-primary btn-block">Sign In</button>
                        <div class="main-signin-footer mg-t-5">
                            <p><a href="{{ route('vendor.forgot-password') }}">Forgot password?</a></p>
                            <p>Don't have an account? <a href="{{ route('vendor.register') }}">Create an Account</a></p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection()
