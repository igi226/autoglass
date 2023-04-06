@extends('vendor.layouts.app')

@section('title', 'Refund Requests')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-content-body d-flex flex-column">
                        <!-- breadcrumb -->
                        <div class="main-content-breadcrumb"> <span>Vendor</span> <span>Orders</span>
                            <span>Refund Requests</span>
                            <div class="main-content-title mb-0 ml-auto">Refund Requests</div>
                        </div> <!-- /breadcrumb -->

                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">Refund Requests</div>
                                <p class="mg-b-20">Refund Requests for Orders</p>
                                <div class="table-responsive">
                                    <table id="example-1" class="table table-striped table-bordered nowrap text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">
                                                    #
                                                </th>
                                                <th class="border-bottom-0">Relevant Image</th>
                                                <th>Customer</th>
                                                <th class="border-bottom-0">Order Reference</th>
                                                <th class="border-bottom-0">Product</th>
                                                <th class="border-bottom-0">Quantity</th>
                                                <th class="border-bottom-0">Cause</th>
                                                <th class="border-bottom-0">Current Status</th>
                                                <th class="border-bottom-0">Date and Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = generate_count($refunds);
                                            @endphp
                                            @foreach ($refunds as $refund)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage') }}/refunds/{{ $refund->image }}"
                                                            target="_blank">
                                                            <img class="w-100"
                                                                src="{{ asset('storage') }}/refunds/{{ $refund->image }}"
                                                                alt="">
                                                        </a>
                                                    </td>
                                                    <td>{{ $refund->order->user->name }}</td>
                                                    <td>{{ $refund->order->unique_id }}</td>
                                                    <td>{{ $refund->order->vendor_product->product->part_description }}
                                                    </td>
                                                    <td>{{ $refund->order->qty }}</td>
                                                    <td>{{ $refund->issue }}</td>
                                                    <td>
                                                        <a href="javascript:void"
                                                            data-action="{{ route('vendor.refund.action', ['id' => $refund->order->id]) }}"
                                                            data-placement="left" data-toggle="tooltip"
                                                            title="Click to Update!"
                                                            class="badge order_update badge-info py-1 px-2">
                                                            {{ get_order_status($refund->order->status) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $refund->created_at->format('d F, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @include('components.admin.pagination', ['paginator' => $refunds])
                            </div>
                        </div>
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.vendor.refund')
@endsection()

@section('script')
    <script>
        $('.order_update').on('click', (e) => {
            e.preventDefault();
            $('#updateForm').attr('action', e.target.dataset.action);
            $('#updateModal').modal('show');
        })
    </script>
@endsection()
