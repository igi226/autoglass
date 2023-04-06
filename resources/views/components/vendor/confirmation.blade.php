<div class="modal" id="confirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20" id="prevStep"> <button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button> <i
                    class="icon ion-ios-information-circle-outline tx-100 tx-info lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-info tx-semibold mg-b-20">Confirm your Order</h4>
                <p class="mg-b-20 mg-x-20">
                    Order is Delivered to your Address. Are you happy with the product?
                </p>
                <button data-redirect-to="{{ route('vendor.order.complete', ['id' => $order->id]) }}"
                    class="btn btn-info pd-x-25" type="button">Yes</button>

                <button class="btn btn-danger pd-x-25 next-step" type="button">No</button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ route('vendor.order.request.refund', ['id' => $order->id]) }}" class="modal-body pd-y-20 pd-x-20" id="nextStep" style="display: none;">
                @csrf()
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">×</span></button>
                <h5 class="mg-b-20">Request a Refund</h5>
                <div class="col-12 p-0 mb-3">
                    <label for="" class="form-label">Upload Relevant Image</label>
                    <div class="custom-file">
                        <input class="custom-file-input" id="customFile" type="file" accept=".png, .jpg, .jpeg" name="file" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Explain your Issue</label>
                    <textarea name="issue" rows-="6" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary pd-x-25" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
