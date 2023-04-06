<div class="modal" id="paymentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <form id="payment-form" data-secret="{{ $intent->client_secret }}" class="card card-body pd-20 pd-md-40 border shadow-none">
                @csrf()
                <h5 class="card-title mg-b-20">Your Payment Details</h5>
                <div id="payment-elements"></div>
                <button class="btn btn-main-primary btn-block mt-3">Complete Payment</button>
                <div id="error-message" class="text-primary mt-3"></div>
            </form>
        </div>
    </div>
</div>
