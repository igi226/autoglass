@extends('vendor.layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
            <div class="p-5 w-100">
                <div class="main-signin-header">
                    <h2>Create an Account!</h2>
                    <h4>Register to Glass Inventory</h4>
                    @if (Session::has('error'))
                        <div class="alert alert-solid-danger mb-3" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Error :<br> </strong>
                           {!! Session::get('error') !!}
                        
                        </div>
                    @elseif(Session::has('success'))
                        <div class="alert alert-solid-success mb-3" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ Session::get('success') }}
                        </div>
                    @endif()
                    
                   
                    <form action="{{ route('vendor.register') }}" method="POST">
                        @csrf()
                        <div class="form-group"> <label>Full Name</label> <input class="form-control"
                                placeholder="Enter your name" type="text" name="name" value="{{ old('name') }}" required> </div>
                        <div class="form-group"> <label>Email</label> <input class="form-control"
                                placeholder="Enter your email" type="email" name="email" value="{{ old('email') }}" required> </div>
                        <div class="form-group"> <label>Password</label> <input class="form-control"
                                placeholder="Enter your password" type="password" name="password" value="{{ old('password') }}" required> </div>
                        <div class="form-group"> <label>Confirm Password</label> <input class="form-control"
                                placeholder="Enter your confirm password" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required> </div>
                                
                                <script src="https://www.google.com/recaptcha/api.js"></script>
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback="correctCaptcha"></div>
                               <script>
                                var correctCaptcha = function(response) {
                                    
                                     document.getElementById('g-recaptcha-response').value = response;
                                };
                                </script>
                                 

                        <button class="btn btn-main-primary btn-block">Sign Up</button>
                    </form>
                    

                </div>
                <div class="main-signin-footer mg-t-5">
                    <p>Already have an account? <a href="{{ route('vendor.login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection()
