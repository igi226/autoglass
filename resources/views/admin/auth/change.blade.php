@extends('admin.layouts.auth')

@section('title', 'Admin Login')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                Welcome Admin!
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.password.change') }}" class="needs-validation" novalidate="">
                        @csrf()
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">New Password</label>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                required>
                            <div class="invalid-feedback">
                                please fill in your password
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Update Credentials
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="simple-footer">
                Copyright &copy; {{ env('APP_NAME') }} 
                <script>
                    document.write((new Date()).getFullYear())
                </script>
            </div>
        </div>
    </div>

@endsection()
