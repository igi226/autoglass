<div class="modal" id="checkModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Check Availabily</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    Please Enter the number of Products you want. Vendor will notify you after checking the availability of Product.
                </p>
                <form action="#" method="POST" id="checkForm">
                    @csrf()
                    <div class="col-12 p-0 mb-3">
                        <input type="number" name="qty" value="1" placeholder="Number of products" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Check Availability</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{ asset('vendors') }}/assets/js/marketplace.js"></script>
@endsection()
