<div class="modal" id="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header">
                <h6 class="modal-title">Update Order Status</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    Attach a Note to let your customer know better about Delivery Status
                </p>
                <form action="#" method="POST" id="updateForm">
                    @csrf()
                    <div class="col-12 p-0 mb-3">
                        <select name="status" class="form-control" required>
                            <option value="" hidden>Select</option>
                            <option value="5">Order Dispatched</option>
                            <option value="6">Order Delivered</option>
                        </select>
                    </div>
                    <div class="col-12 p-0 mb-3">
                        <textarea name="comment" rows="6" class="form-control" placeholder="Note for User" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
