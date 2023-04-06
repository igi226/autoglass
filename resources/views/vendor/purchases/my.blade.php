@extends('vendor.layouts.app')

@section('title', 'My Purchase')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content-breadcrumb"> <span>Vendor</span><span>My Purchase</span>
                        <div class="main-content-title ml-auto mb-0">My Purchase</div>
                    </div>
                    <div class="main-content-header container p-4 bg-white">
                        <div>
                            <h6 class="main-content-title tx-18 mg-b-5 mg-t-5">My Purchase</h6>
                            <p class="main-content-text tx-13 mg-b-5">This is a Dedicated page for your Purchase history. You
                                can Details or Confirm their payment from here</p>
                        </div>
                    </div>
                    <div class="main-content-body d-flex flex-column">
                        <div class="row row-sm row-cards row-deck">
                            @foreach ($purchases as $purchase)
                                <div class="col-lg-6 req-card">
                                    <div class="card mg-b-20 card-aside">
                                        <div class="card-body d-flex flex-column">
                                            @if ($purchase->status > 2)
                                                <span class="badge badge-danger ribbon">
                                                    {{ get_order_status($purchase->status) }}
                                                </span>
                                            @endif()
                                            <h4>
                                                <a href="#" class="text-dark tx-15">
                                                    {{ $purchase->vendor_product->product->model }} -
                                                    {{ $purchase->vendor_product->product->year }}
                                                </a>
                                            </h4>
                                            <div class="text-muted">
                                                <span class="text-dark">Manufactered By -
                                                    {{ $purchase->vendor_product->product->make }}</span> &nbsp;
                                                <span class="text-dark">Part Number -
                                                    {{ $purchase->vendor_product->product->part_number }}</span>
                                                <br>
                                                {{ $purchase->vendor_product->description }}
                                                Quantity : {{ $purchase->qty }}
                                            </div>
                                            <div class="text-primary d-flex mt-2 align-items-center">
                                                @php
                                                    $totalAmount = $purchase->vendor_product->commercial_price * $purchase->qty;
                                                @endphp
                                                Total :
                                                <h3 class="col-md-6 my-0 p-0 mx-2">
                                                    {{ $totalAmount }}<sup>$</sup>
                                                </h3>

                                                @if ($purchase->status == 1)
                                                    <button class="btn btn-danger ml-auto"
                                                        data-cancel="{{ route('vendor.purchase.cancel', ['id' => $purchase->id]) }}"
                                                        type="button">Cancel</button>
                                                    <button class="btn btn-primary ml-1"
                                                        data-redirect-to="{{ route('vendor.order.invoice', ['id' => $purchase->id]) }}"
                                                        type="button">Pay
                                                        {{ $totalAmount }}<sup>$</sup></button>
                                                @else()
                                                    <button class="btn btn-primary ml-auto"
                                                        data-redirect-to="{{ route('vendor.order.track', ['access' => csrf_token(), 'identity' => $purchase->unique_id]) }}"
                                                        type="button">Details
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div> <!-- row -->
                        @include('components.admin.pagination', ['paginator' => $purchases])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.vendor.success')
@endsection()
