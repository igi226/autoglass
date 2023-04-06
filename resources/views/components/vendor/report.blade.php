<div class="modal" id="reportModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm report_modal_conetnt">
            <form id="report_form" method="POST" action="{{ route('vendor.report') }}"
                class="card card-body pd-20 pd-md-40 border shadow-none">
                @csrf()
                <h5 class="card-title mg-b-20">Feedback</h5>
                <img src="" alt="" class="report-img">
                <div class="my-2"> 
                    <label class="rdiobox">
                        <input name="issue" type="radio" value="Misleading Product Information" checked> <span>Misleading Product Information</span>
                    </label> 
                </div>
                <div class="my-2"> 
                    <label class="rdiobox">
                        <input name="issue" type="radio" value="Abuse Report"> <span>Report Abuse</span>
                    </label> 
                </div>
                <div class="my-2"> 
                    <label class="rdiobox">
                        <input name="issue" type="radio" value="Technical Bug or Error"> <span>Technical Bug or Error</span>
                    </label> 
                </div>
                <div class="my-2"> 
                    <label class="rdiobox">
                        <input name="issue" type="radio" value="Others"> <span>Others</span>
                    </label> 
                </div>
                <div class="my-2">
                    <label for="" class="form-label">Explain your Issue</label>
                    <textarea name="comment" rows="6" class="form-control"></textarea>
                </div>
                <button class="btn btn-main-primary btn-block mt-3">Send FeedBack</button>
            </form>
        </div>
    </div>
</div>
