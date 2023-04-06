@extends('vendor.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="main-content px-0">
        <div class="main-content-header container p-4 bg-white">
            <div>
                <h6 class="main-content-title tx-18 mg-b-5 mg-t-5">Welcome to {{ env('APP_NAME') }}</h6>
                <p class="main-content-text tx-13 mg-b-5">Hi, welcome back! Here's your details of Sales and Orders.</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <label class="main-content-label">Total Sale</label>
                                    <h1 class="card-title">${{ $totalEarning }}</h1><small class="main-content-text">
                                        *Reports are generated after every Orders and Purchase
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mg-b-20">
                                <div class="card-body p-4">
                                    <div> <label class="main-content-label">Quick Ratio Of Sales</label>
                                        <h5 class="mg-b-5">{{ $orderCount }}:{{ $saleCount }}</h5>
                                        @php
                                            if ($saleCount != 0 && $orderCount != 0) {
                                                $percent = ($saleCount / $orderCount) * 100;
                                            } else {
                                                $percent = 0;
                                            }
                                        @endphp
                                        <div class="progress ht-10 mg-b-5">
                                            <div aria-valuemax="{{ $orderCount }}" aria-valuemin="0"
                                                aria-valuenow="{{ $saleCount }}" class="progress-bar bg-pink"
                                                role="progressbar" style="width: {{ $percent }}%;"></div>
                                        </div><span class="tx-12 tx-gray-500">Quick Ratio Sales: 1.0 or higher</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card p-4">
                                <div class="card-title my-0">Order and Sales in {{ now()->year }}</div>
                                <p class="my-1">A Representation of Order and Sales.</p>
                                <div class="card-body w-100 sales-bar" id="salesbar">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card--events card">
                        <div class="">
                            <div class="list-group">
                                <label class="main-content-label p-3">Recent Orders</label>
                                @foreach ($orders as $order)
                                    <div class="list-group-item">
                                        <div class="event-indicator bg-info"></div><label>{{ $order->created_at->format('d, F') }}</label>
                                        <h6>{{ $order->unique_id }}</h6>
                                        <p class="mb-0">
                                            Product : {{ $order->vendor_product->product->part_number }} &nbsp;
                                            Quantity : {{ $order->qty }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script src="{{ asset('vendors/assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ route('vendor.charts') }}"></script>
@endsection()
