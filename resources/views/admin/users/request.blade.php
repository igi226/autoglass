@extends('admin.layouts.app')

@section('title', 'User Management')

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
                <h1>User Management</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item">Registration Requests</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
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
                                                    <th>Avatar</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No.</th>
                                                    <th>User Category</th>
                                                    <th>Approval Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = generate_count($users);
                                                @endphp
                                                @foreach ($users as $user)
                                                    <tr role="row">
                                                        <td class="sorting_1">
                                                            {{ $i++ }}
                                                        </td>
                                                        <td>
                                                            @if ($user->avatar == null)
                                                                <img alt="image"
                                                                    src="{{ asset('admins') }}/assets/img/avatar/avatar-3.png"
                                                                    class="rounded-circle" width="35">
                                                            @else()
                                                                <img alt="image"
                                                                    src="{{ asset('storage/avatars') }}/{{ $user->avatar }}"
                                                                    class="rounded-circle" width="35">
                                                            @endif()
                                                        </td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>
                                                            @if ($user->type == 0)
                                                                <a href="javascript:void"
                                                                    class="badge badge-info">Customer</a>
                                                            @elseif($user->type == 1)
                                                                <a href="javascript:void"
                                                                    class="badge badge-info">Vendor</a>
                                                            @else()
                                                                <a href="javascript:void"
                                                                    class="badge badge-info">Administrator
                                                                    <i class="fas fa-star"></i>
                                                                </a>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="javascript:void" class="badge badge-info">Pending</a>
                                                        </td>
                                                        <td>{{ $user->created_at->format('d F, Y') }}</td>
                                                        <td class="text-nowrap">
                                                            @if ($user->type != 2)
                                                                <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}"
                                                                    class="btn btn-sm btn-icon text-danger"><i
                                                                        class="fas fa-trash"></i></a>
                                                            @endif
                                                            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                                                class="btn btn-sm btn-icon text-primary"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <a href="{{ route('admin.user.approve', ['id' => $user->id]) }}"
                                                                class="btn btn-sm btn-icon text-info"><i
                                                                    class="fas fa-check-circle"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('components.admin.pagination', ['paginator' => $users])
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
