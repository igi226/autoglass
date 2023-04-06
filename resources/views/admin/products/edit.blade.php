@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('style')
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/jquery-selectric/selectric.css">
@endsection()

@section('content')
    <div class="main-content" style="min-height: 702px;">
        <section class="section">
            <div class="section-header">
                <h1>Edit Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item"><a href="#">Part Inventory</a></div>
                    <div class="breadcrumb-item">Edit Product</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <form class="card needs-validation" method="POST" action="{{ route('admin.product.update', ['id'=>$product->id]) }}" novalidate>
                            @csrf()
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Year <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="year" value="{{ $product->year }}" class="form-control"  required>
                                        <div class="invalid-feedback">Year is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Make <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" value="{{ $product->make }}" name="make" class="form-control"  required>
                                        <div class="invalid-feedback">Make is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Model <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" value="{{ $product->model }}" name="model" class="form-control"  required>
                                        <div class="invalid-feedback">Model is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Type <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="type" value="{{ $product->type }}" class="form-control" required>
                                        <div class="invalid-feedback">Type is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Part Number <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="part_number" value="{{ $product->part_number }}" class="form-control" required>
                                        <div class="invalid-feedback">Part Number is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Brand
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="brand" value="{{ $product->brand }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="summernote-simple" name="description">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Part Description</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="summernote-simple" name="part_description">{{ $product->part_description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Cost <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" value="{{ $product->price }}" name="price" class="form-control" placeholder="$" required>
                                        <div class="invalid-feedback">Cost is Required</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="status" tabindex="-1">
                                            <option value="1" @if($product->status == 1) selected @endif()>Active</option>
                                            <option value="0" @if($product->status == 0) selected @endif()>Inactive</option>
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
    <script src="{{ asset('admins') }}/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
@endsection()
