@extends('vendor.layouts.app')

@section('title', 'Order Requests')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content-breadcrumb"> <span>Vendor</span><span>Order Requests</span>
                        <div class="main-content-title ml-auto mb-0">Order Requests</div>
                    </div>
                    <div class="main-content-header container p-4 bg-white">
                        <div>
                            <h6 class="main-content-title tx-18 mg-b-5 mg-t-5">Order Requests</h6>
                            <p class="main-content-text tx-13 mg-b-5">Here is Order Requests fro Other Commercial or Retail Buyer. Check Availability of the products and Accept The Order.</p>
                        </div>
                    </div>
                    <div class="main-content-body d-flex flex-column">
                        <div class="row row-sm row-cards row-deck">
                            @foreach ($orders as $order)
                                <div class="col-lg-6 req-card">
                                    <div class="card mg-b-20 card-aside">
                                        <div class="card-body d-flex flex-column">
                                            <h4>
                                                <a href="#" class="text-dark tx-15">
                                                    {{ $order->vendor_product->product->model }} - {{ $order->vendor_product->product->year }}
                                                </a>
                                            </h4>
                                            <div class="text-muted">
                                                <span class="text-dark">Manufactered By -
                                                    {{ $order->vendor_product->product->make }}</span> &nbsp;
                                                <span class="text-dark">Part Number -
                                                    {{ $order->vendor_product->product->part_number }}</span>
                                                <br>
                                                Quantity Required : {{ $order->qty }}
                                            </div>
                                            <div class="row py-2 align-items-center">
                                                <div class="col-md-6 mt-3">
                                                    <button class="btn btn-sm btn-primary" data-accept="{{ route('vendor.orders.requests.accept', ['id' => $order->id]) }}" type="button">
                                                        Accept
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" data-decline="{{ route('vendor.orders.requests.decline', ['id' => $order->id]) }}" type="button">
                                                        Decline
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div> <!-- row -->
                        @include('components.admin.pagination', ['paginator' => $orders])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.vendor.success')
@endsection()
