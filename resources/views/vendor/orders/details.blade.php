@extends('vendor.layouts.app')

@section('title', 'Track Your Order')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content-breadcrumb"> <span>Vendor</span><span>Track Order</span>
                        <div class="main-content-title ml-auto mb-0">Track Order</div>
                    </div>
                    <div class="main-content-header container p-4 bg-white">
                        <div>
                            <h6 class="main-content-title tx-18 mg-b-5 mg-t-5">Track your Order</h6>
                            <p class="main-content-text tx-13 mg-b-5">Track the current Status of your Order from here.</p>
                        </div>
                    </div>
                    @php
                        $order_statuses = $order->order_statuses;
                        $last_status = $order
                            ->order_statuses()
                            ->orderBy('id', 'desc')
                            ->first();
                        $default_status = ['ordered', 'Dispatched', 'Delivered'];
                        $placeholder = $order_statuses->count();
                    @endphp
                    <div class="main-content-header container p-4 bg-white">
                        <div class="row w-100">
                            <div class="w-100 pt45 pb20">
                                <div class="row justify-content-between">
                                    @foreach ($order_statuses as $key => $order_status)
                                        @if ($key > 2)
                                            @break
                                        @endif()
                                    <div class="order-tracking completed">
                                        <span class="is-complete"></span>
                                        <p>{{ $order_status->status }}<br><span>{{ $order_status->created_at->format('H:i, d F') }}</span>
                                        </p>
                                    </div>
                                @endforeach
                                @if ($placeholder < 3)
                                    @foreach (array_slice($default_status, $placeholder) as $order_status)
                                        <div class="order-tracking">
                                            <span class="is-complete"></span>
                                            <p>{{ $order_status }}<br><span>Pending</span></p>
                                        </div>
                                    @endforeach
                                @endif()
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content-body d-flex flex-column">
                    <div class="row row-sm row-cards row-deck">
                        <div class="col-lg-4">
                            <div class="card bd-0 mg-b-20">
                                <div class="card-body text-success">
                                    <div class="main-error-wrapper"> <i class="si si-check mg-b-20 tx-50"></i>
                                        <h4 class="mg-b-20">{{ $last_status->status }}</h4>
                                        <p class="text-muted">
                                            {{ $last_status->comment }}
                                            <br>
                                            Updated At : {{ $last_status->created_at->format('H:i, d F') }}
                                        </p>
                                        <a class="btn btn-success btn-sm btn-rounded"
                                            href="{{ route('vendor.order.invoice', ['id' => $order->id]) }}">Click to
                                            view
                                            Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mg-b-20 card-aside">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Date and Time</th>
                                                    <th>Status</th>
                                                    <th>Message</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_statuses as $order_status)
                                                    <tr>
                                                        <td>{{ $order_status->created_at->format('d F, H:i') }}</td>
                                                        <td>{{ $order_status->status }}</td>
                                                        <td>{{ $order_status->comment }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($order->status == 6)
    @include('components.vendor.confirmation')
@endif()
@endsection()

@section('script')
<script>
    @if ($order->status == 6)
        $('#confirmModal').modal('show');
        $('.next-step').on('click', function() {
            $('#prevStep').hide();
            $('#nextStep').show();
        })
    @endif ()
</script>
@endsection()
