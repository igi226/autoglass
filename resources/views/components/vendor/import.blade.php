<div class="modal" id="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Import Excel</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    Download Excel File as Reference 
                    <a href="{{ asset('admins/assets/downloads/document.xlsx') }}" class="text-primary" download="">
                        <i class="fa fa-download"></i>
                    </a>
                </p>
                <form action="{{ route('vendor.product.import.bulk') }}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="col-12 p-0 mb-3">
                        <div class="custom-file">
                            <input class="custom-file-input" id="customFile" type="file" accept=".xlsx, .xls" name="file" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>
