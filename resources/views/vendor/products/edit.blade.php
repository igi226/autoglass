@extends('vendor.layouts.app')

@section('title', 'Edit Product')

@section('content')

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-content-body d-flex flex-column">
                        <!-- breadcrumb -->
                        <div class="main-content-breadcrumb"> <span>Vendor</span> <span>Products</span>
                            <span>Edit Product</span>
                            <div class="main-content-title mb-0 ml-auto">Edit Product</div>
                        </div> <!-- /breadcrumb -->

                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">Edit Product </div>
                                <p class="mg-b-20">You Can Customize your Product From Here</p>
                                <form method="POST" class="row"
                                    action="{{ route('vendor.product.update', ['id' => $product->id]) }}"
                                    enctype="multipart/form-data">

                                    @csrf()
                                    <div class="col-lg-6 mx-auto">

                                        <div class="form-group">
                                            <label class="form-label mb-2">Comercial Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="number" value="{{ $product->commercial_price }}"
                                                    class="form-control dollerr" name="commercial_price" placeholder="$"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label mb-2">Retail Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                              
                                                <input type="number" value="{{ $product->retail_price }}" class="form-control"
                                                    name="retail_price" placeholder="$" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label mb-2">Quantity in Stock</label>
                                            <input type="number" value="{{ $product->qty }}" class="form-control"
                                                name="qty" placeholder="0" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label mb-2">Description</label>
                                            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label mb-2">Location</label>
                                            <input type="text" value="{{ @$product->location }}" class="form-control"
                                                name="location" placeholder="Enter location" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label mb-2">Current Image</label>
                                            <img src="{{ asset('storage/PartImage/' . @$product->image) }}" height="130"
                                                width="212">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label mb-2">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label mb-2">Color</label>
                                            <select class="form-control" name="color">
                                                <option value="GTY"
                                                    @if ($product->color == 'GTY') selected="selected" @endif>GTY
                                                </option>
                                                <option value="BTY"
                                                    @if ($product->color == 'BTY') selected="selected" @endif>BTY
                                                </option>
                                                <option value="ZTY"
                                                    @if ($product->color == 'ZTY') selected="selected" @endif>ZTY
                                                </option>
                                                <option value="GBY"
                                                    @if ($product->color == 'GBY') selected="selected" @endif>GBY
                                                </option>
                                                <option value="GYY"
                                                    @if ($product->color == 'GYY') selected="selected" @endif>GYY
                                                </option>
                                                <option value="ZTN"
                                                    @if ($product->color == 'ZTN') selected="selected" @endif>ZTN
                                                </option>
                                                <option value="GTN"
                                                    @if ($product->color == 'GTN') selected="selected" @endif>GTN
                                                </option>
                                                <option value="GBN"
                                                    @if ($product->color == 'GBN') selected="selected" @endif>GBN
                                                </option>
                                                <option value="YPN"
                                                    @if ($product->color == 'YPN') selected="selected" @endif>YPN
                                                </option>
                                                <option value="YPY"
                                                    @if ($product->color == 'YPY') selected="selected" @endif>YPY
                                                </option>
                                                <option value="GPN"
                                                    @if ($product->color == 'GPN') selected="selected" @endif>GPN
                                                </option>
                                                <option value="GPY"
                                                    @if ($product->color == 'GPY') selected="selected" @endif>GPY
                                                </option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
