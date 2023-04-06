@extends('vendor.layouts.app')

@section('title', 'Payment and Invoice')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="main-content-left main-content-left-invoice">
                <!-- breadcrumb -->
                <div class="main-content-breadcrumb mg-b-10"> <span>Vendor</span> <span>Purchase</span> <span>Payment</span>
                    <div class="main-content-title ml-auto mb-0">Payment & Invoice</div>
                </div> <!-- breadcrumb -->
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card print_subject  @if ($order->status >= 3) paid_stamp @endif()">
                            <div class="card-body">
                                <div class="main-content-body main-content-body-invoice">
                                    <div class="card-invoice">
                                        <div class="card-body p-0">
                                            <div class="invoice-header">
                                                <h1 class="invoice-title">Invoice</h1>
                                                <div>
                                                    <h4>{{ $order->unique_id }}</h4>
                                                </div>
                                            </div><!-- invoice-header -->
                                            <div class="row mg-t-20">
                                                <div class="col-md"> <label class="tx-gray-600">Billed To</label>
                                                    <div class="billed-to">
                                                        <h6>{{ $order->user->name }}</h6>
                                                        <p>
                                                            {{ $order->user->company }}<br>
                                                            {{ $order->user->address }}<br>
                                                            Contact No:
                                                            {{ $order->user->phone == null ? 'Not Available' : $order->user->phone }}<br>
                                                            Email: {{ $order->user->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="billed-from text-md-right"> <label
                                                            class="tx-gray-600">Billed From</label>
                                                        <h6>Glass Inventory</h6>
                                                        <p>
                                                            {{ $order->vendor->company }}<br>
                                                            {{ $order->vendor->address }}<br>
                                                            Contact No:
                                                            {{ $order->vendor->phone == null ? 'Not Available' : $order->vendor->phone }}<br>
                                                            Email: {{ $order->vendor->email }}
                                                        </p>
                                                    </div><!-- billed-from -->
                                                </div>
                                            </div>
                                            <div class="table-responsive mg-t-40">
                                                <table class="table table-invoice border text-md-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Year</th>
                                                            <th class="text-center">Make</th>
                                                            <th class="text-center">Model</th>
                                                            <th class="text-center">Type</th>
                                                            <th class="text-center">Part Number</th>
                                                            <th class="wd-40p">Description</th>
                                                            <th class="tx-center">QNTY</th>
                                                            <th class="tx-right">Unit Price</th>
                                                            <th class="tx-right">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $totalAmount = $order->vendor_product->commercial_price * $order->qty;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $order->vendor_product->product->year }}</td>
                                                            <td>{{ $order->vendor_product->product->make }}</td>
                                                            <td>{{ $order->vendor_product->product->model }}</td>
                                                            <td>{{ $order->vendor_product->product->type }}</td>
                                                            <td>{{ $order->vendor_product->product->part_number }}</td>
                                                            <td>{{ $order->vendor_product->description }}</td>
                                                            <td>{{ $order->qty }}</td>
                                                            <td>{{ $order->vendor_product->commercial_price }}$</td>
                                                            <td>{{ $totalAmount }}$</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="tx-right" colspan="6">Sub-Total</td>
                                                            <td class="tx-right" colspan="2">{{ $totalAmount }}$</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tx-right tx-uppercase tx-bold tx-inverse"
                                                                colspan="6">Total
                                                            </td>
                                                            <td class="tx-right" colspan="2">
                                                                <h4 class="tx-primary tx-bold">
                                                                    {{ $totalAmount }}<sup>$</sup>
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @if ($order->status < 3)
                                                <button class="btn btn-primary float-right mg-t-20" type="button"
                                                    data-target="#paymentModal" data-toggle="modal">Pay Now</button>
                                            @else()
                                                <button class="btn btn-primary float-right mg-t-20" type="button"
                                                    onclick="window.print()">Print</button>
                                            @endif()
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /row -->
            </div>
        </div>
    </div>
    @include('components.vendor.payment')
@endsection()

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Set your publishable key: remember to change this to your live publishable key in production
        // See your keys here: https://dashboard.stripe.com/apikeys
        const stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
        const options = {
            clientSecret: $('[data-secret]').attr('data-secret'),
            // Fully customizable with appearance API.
        };
        // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 2
        const elements = stripe.elements(options);

        // Create and mount the Payment Element
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-elements');
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const {
                error
            } = await stripe.confirmPayment({
                //`Elements` instance that was used to create the Payment Element
                elements,
                confirmParams: {
                    return_url: '{{ route('vendor.order.confirm', ['id' => $order->id]) }}',
                },
            });
            if (error) {
                // This point will only be reached if there is an immediate error when
                // confirming the payment. Show error to your customer (for example, payment
                // details incomplete)
                const messageContainer = document.querySelector('#error-message');
                messageContainer.textContent = error.message;
            }
        })
    </script>
@endsection()
