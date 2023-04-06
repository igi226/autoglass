@extends('admin.layouts.app')

@section('title', 'Part Inventory')

@section('style')
    <link rel="stylesheet" href="{{ asset('admins') }}/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="{{ asset('admins') }}/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('admins') }}/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
@endsection()

@section('content')
    <div class="main-content" style="min-height: 702px;">
        <section class="section">
            <div class="section-header">
                <h1>Product Requests</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item">Part Invenory</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row card-body">

                                <div class="col-6">
                                    <a href="{{ route('admin.product.approve.all') }}" class="btn btn-info">
                                        Approve All <i class="fa fa-check"></i>
                                    </a>
                                    <a href="{{ route('admin.product.decline.all') }}" type="button"
                                        class="btn btn-danger">
                                        Decline All <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="form-inline float-right" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <div id="table-2_wrapper"
                                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <table class="table table-striped dataTable no-footer" id="table-2" role="grid"
                                            aria-describedby="table-2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Year</th>
                                                    <th>Make</th>
                                                    <th>Model</th>
                                                    <th>Type</th>
                                                    <th>Part Number</th>
                                                    <th>Brand</th>
                                                    <th>Cost</th>
                                                    <th>Approval Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = generate_count($products);
                                                @endphp
                                                @foreach ($products as $product)
                                                    <tr role="row">
                                                        <td class="sorting_1">
                                                            {{ $i++ }}
                                                        </td>
                                                        <td>{{ $product->year }}</td>
                                                        <td>{{ $product->make }}</td>
                                                        <td>{{ $product->model }}</td>
                                                        <td>{{ $product->type }}</td>
                                                        <td>{{ $product->part_number }}</td>
                                                        <td>{{ $product->brand }}</td>
                                                        <td>{{ $product->price }}$</td>
                                                        <td>
                                                            @if ($product->approved == 0)
                                                                <a href="javascript:void"
                                                                    class="badge badge-info">Pending</a>
                                                            @elseif($product->approved == 2)
                                                                <a href="javascript:void"
                                                                    class="badge badge-danger">Declined</a>
                                                            @endif()
                                                        </td>
                                                        <td>{{ $product->created_at->format('d F, Y') }}</td>
                                                        <td class="text-nowrap">
                                                            <a href="{{ route('admin.product.decline', ['id' => $product->id]) }}"
                                                                class="btn btn-sm btn-icon text-danger"><i
                                                                    class="fas fa-times-circle"></i></a>
                                                            <a href="{{ route('admin.product.approve', ['id' => $product->id]) }}"
                                                                class="btn btn-icon btn-sm text-info"><i
                                                                    class="fas fa-check-circle"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('components.admin.pagination', ['paginator' => $products])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('components.admin.import')
@endsection()

@section('script')
    <script src="{{ asset('admins') }}/assets/modules/datatables/datatables.min.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="{{ asset('admins') }}/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('admins') }}/assets/modules/sweetalert/sweetalert.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('admins') }}/assets/js/page/product.js"></script>
@endsection()
