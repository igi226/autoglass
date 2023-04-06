<div class="modal" id="singleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body pd-y-20 pd-x-20">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">×</span></button>
                <div class="prev-message tx-center">
                    <i class="icon ion-ios-alert tx-100 tx-primary lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-primary tx-semibold mg-b-20">Oops!! This Product is not available</h4>
                    <p class="mg-b-20 mg-x-20" id="successText">Want this product? Request Now</p>
                    <button class="btn btn-primary pd-x-25 import_now" type="button">Request
                        Now</button>
                </div>
                <form id="import_form" method="POST" action="{{ route('vendor.product.import_one') }}"
                    class="card card-body shadow-none">
                    @csrf()
                    <h5 class="card-title mg-b-20">Product Details</h5>
                    <div class="my-2">
                        <label for="" class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Make</label>
                        <input type="text" name="make" class="form-control" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Part Number</label>
                        <input type="text" name="part_number" class="form-control" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Commercial Price</label>
                        <input type="number" name="commercial_price" class="form-control" placeholder="$" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Retail Price</label>
                        <input type="number" name="retail_price" class="form-control" placeholder="$" required/>
                    </div>
                    <div class="my-2">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" rows="6" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-main-primary btn-block mt-3">Request Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
