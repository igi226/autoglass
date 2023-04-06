@extends('vendor.layouts.app')

@section('title', 'Order History')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-content-body d-flex flex-column">
                        <!-- breadcrumb -->
                        <div class="main-content-breadcrumb"> <span>Vendor</span> <span>Orders</span>
                            <span>Order History</span>
                            <div class="main-content-title mb-0 ml-auto">Order History</div>
                        </div> <!-- /breadcrumb -->

                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">Order History</div>
                                <p class="mg-b-20">Here is the Record of All Orders</p>
                                <form method="GET" class="col-md-4 col-6 mb-3 p-0 float-right">
                                    <div class="input-group">
                                        <input class="form-control" name="search" placeholder="Search Order Reference"
                                            type="text">
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
                                                    #
                                                </th>
                                                <th class="border-bottom-0">Order Reference</th>
                                                <th class="border-bottom-0">Product</th>
                                                <th class="border-bottom-0">Quantity</th>
                                                <th class="border-bottom-0">Total Price</th>
                                                <th class="border-bottom-0">Earning (Excluding Platform Commission
                                                    {{ get_platform_commission() }}%)</th>
                                                <th class="border-bottom-0">Current Status</th>
                                                <th class="border-bottom-0">Date and Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = generate_count($orders);
                                            @endphp
                                            @foreach ($orders as $order)
                                                @php
                                                    $totalAmount = $order->payments()->where('status', 1)->first()->amount;
                                                    $earning = $totalAmount - (get_platform_commission()/ 100 * $totalAmount);
                                                @endphp
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        {{ $i++ }}
                                                    </td>
                                                    <td>{{ $order->unique_id }}</td>
                                                    <td>{{ $order->vendor_product->product->part_number }}</td>
                                                    <td>{{ $order->qty }}</td>
                                                    <td>{{ $totalAmount }}
                                                        {{ env('CURRENCY') }}
                                                    </td>
                                                    <td>{{ $earning }}  {{ env('CURRENCY') }}</td>
                                                    <td>
                                                        <a href="javascript:void" data-action="{{ route('vendor.order.status.update', ['id' => $order->id]) }}" data-placement="left" data-toggle="tooltip" title="Click to Update!" class="badge order_update badge-info py-1 px-2">
                                                            {{ get_order_status($order->status) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $order->created_at->format('d F, H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @include('components.admin.pagination', ['paginator' => $orders])
                            </div>
                        </div>
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.vendor.update')
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
