@extends('vendor.layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
            <div class="p-5 w-100">
                <div class="main-signin-header">
                    <h2>Reset Password!</h2>
                    <h4>Please enter your password to continue</h4>
                    @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div> 
                            @endif
                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div> 
                            @endif
                    @if (Session::has('error'))
                        <div class="alert alert-solid-danger mb-3" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Error : </strong>{{ Session::get('error')}}
                        </div>
                    @endif()
                    
                    <form name="reset-password" id="reset-password" method="POST" action="{{ route('vendor.reset-password',$token_data['token']) }}">

                        @csrf
                        <input type="hidden"   name="id"  value="{{$member['id']}}">
                        <input type="hidden"   name="token"  value="{{$token_data['token']}}">
                        
                        <div class="form-group">
                            <label>Email: <span class="text-danger">*</span></label>
                            <div class="banner__inputlist">
                                <input type="email" readonly class="form-control" name="email" id="email" value="{{$member['email']}}" placeholder="">
                            </div>                              
                       </div>
                       <div class="form-group">
                        <label>New password: <span class="text-danger">*</span></label>
                        <div class="banner__inputlist">
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter Your New password">
                        </div>                              
                     </div>
                     <div class="form-group">
                        <label>Confirm New password: <span class="text-danger">*</span></label>
                        <div class="banner__inputlist">
                            <input type="password" class="form-control" id="cpassword" name="cpassword"  placeholder="Enter Your New password">
                        </div>                              
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-main-primary btn-block" style="background: #f52394;"><span>Reset Password</span></button>
                        <!--<button type="button" class="default-btn reverse rounded-pill mt-2 m-auto ms-2"><span>Update</span></button>-->
                    </div>
                        
                     </form>
                </div>
               
            </div>
        </div>
    </div>
@endsection()
