

@extends('vendor.layouts.app')

@section('title', 'Product Inventory')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-content-body d-flex flex-column">
                        <!-- breadcrumb -->
                        <div class="main-content-breadcrumb"> <span>Vendor</span> <span>Products</span>
                            <span>Product Inventory</span>
                            <div class="main-content-title mb-0 ml-auto">Product Inventory</div>
                        </div> <!-- /breadcrumb -->

                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">Products</div>
                                <p class="mg-b-20">Here is all Available Product. You can Import and Customize Price</p>
                                <div class="col-6 float-left p-0 mb-3">
                                    <button class="btn btn-primary" type="button" id="btn-import">
                                        <i class="fas fa-file-import"></i>
                                        Add Part +
                                    </button>
                                    {{-- <button class="btn btn-info ms-3" type="button" data-target="#importModal"
                                        data-toggle="modal">
                                        <i class="fas fa-upload"></i>
                                        Upload Excel
                                    </button> --}}
                                </div>
                                <form method="GET" class="col-md-4 col-6 mb-3 p-0 float-right">
                                    <div class="input-group">
                                        <input class="form-control" name="search" placeholder="Search" type="text">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">
                                                <span class="input-group-btn">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table id="example-1" class="table table-striped table-bordered nowrap text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <input type="checkbox" name="" id="check-all">
                                                </th>
                                                <th class="border-bottom-0">Year</th>
                                                <th class="border-bottom-0">Make</th>
                                                <th class="border-bottom-0">Model</th>
                                                <th class="border-bottom-0">Type</th>
                                                <th class="border-bottom-0">Part Number</th>
                                                <th class="border-bottom-0">Brand</th>
                                                <th class="border-bottom-0">Description</th>
                                                <th class="border-bottom-0">Part Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <input type="checkbox" value="{{ $product->id }}" name=""
                                                            class="product-checked">
                                                    </td>
                                                    <td>{{ $product->year }}</td>
                                                    <td>{{ $product->make }}</td>
                                                    <td>{{ $product->model }}</td>
                                                    <td>{{ $product->type }}</td>
                                                    <td>{{ $product->part_number }}</td>
                                                    <td>{{ $product->brand }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>{{ $product->part_description }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @include('components.admin.pagination', ['paginator' => $products])
                            </div>
                        </div>
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.vendor.import')
    @if ($products->count() == 0)
        @include('components.vendor.single')
    @endif
@endsection()

@section('script')
    <script id="script" data-src="{{ route('vendor.product.import') }}" data-csrf="{{ csrf_token() }}"></script>
    <script src="{{ asset('vendors') }}/assets/js/product.js"></script>
    @if ($products->count() == 0)
       <script>
            $('#singleModal').modal('show');
       </script>
    @endif
@endsection()
