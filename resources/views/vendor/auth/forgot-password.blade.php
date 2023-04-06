@extends('vendor.layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
            <div class="p-5 w-100">
                <div class="main-signin-header">
                    <h2>Forgot Password!</h2>
                    <h4>Please enter your email to continue</h4>
                    @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div> 
                            @endif
                             @if(Session::has('message1'))
                            <div class="alert alert-success">
                                {{Session::get('message1')}}
                            </div> 
                            @endif
                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div> 
                            @endif
    
                            
                           
             
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                   
                    
                    <form name="forgot-password" id="forgot-password" method="POST" action="{{route('vendor.forgot-password')}}">
                            @csrf 
                            <div class="form-group">
                                <label>Email: <span class="text-danger">*</span></label>
                               
                                    <input type="email" class="form-control" name="email" id="email" value="{{Request::old('email')}}" placeholder="" required>
                                                            
                           </div>
                         
                            
                            <button type="submit" class="btn btn-main-primary btn-block"><span>Send Email To Reset Password  </span></button>
                       
                         </form>
                </div>
               
            </div>
        </div>
    </div>
@endsection()
