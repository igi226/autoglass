@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('style')
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/jquery-selectric/selectric.css">
@endsection()

@section('content')
    <div class="main-content" style="min-height: 702px;">
        <section class="section">
            <div class="section-header">
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item"><a href="#">User Management</a></div>
                    <div class="breadcrumb-item">Edit User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <form class="card needs-validation" method="POST" action="{{ route('admin.user.update', ['id' => $user->id]) }}"
                            novalidate>
                            @csrf()
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Name <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                        <div class="invalid-feedback">Name is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Email <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                                        <div class="invalid-feedback">Email is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Mobile No.
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="tel" name="phone" value="{{ $user->phone }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Address
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea type="text" name="address" class="form-control" rows="4">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Company
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="company" class="form-control" value="{{ $user->company }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Owner
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="owner" class="form-control" value="{{ $user->owner }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Tax Id
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="tax_id" class="form-control" value="{{ $user->tax_id }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User
                                        Category</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="type" tabindex="-1">
                                            <option value="0" @if($user->type == 0) selected @endif()>General Consumer</option>
                                            <option value="1"  @if($user->type == 1) selected @endif()>Vendor/Buyer</option>
                                            <option value="2"  @if($user->type == 2) selected @endif()>Administrator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection()

@section('script')
    <script src="{{ asset('admins') }}/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script>
        $('#generate').on('click', function() {
            let password = (Math.random() + 1).toString(36).substring(2);

            $('#password').val(password)
        })
    </script>
@endsection()
