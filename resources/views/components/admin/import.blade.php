<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Excel File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Download Excel Format
                    <a href="{{ asset('admins') }}/assets/downloads/part_format.xlsx" download=""
                        class="btn text-warning btn-sm btn-icon">
                        <i class="fas fa-download"></i>
                    </a>
                </p>

                <form action="{{ route('admin.product.import') }}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept=".xlsx,.xls" id="customFile"  name="file" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>
