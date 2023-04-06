const capture = async () => {
    const screenshotTarget = document.body;
    let canvas = await html2canvas(screenshotTarget);
    let imageUrl = canvas.toDataURL('image/png', 1.0);

    let image = document.querySelector('.report-img');
    image.src = imageUrl;
    image.onload = () => {
        imageUrl = null;
    }
};
const createReportContext = async () => {
    await capture();
    $('#reportModal').modal('show');

}

document.querySelector('#createReportContext').addEventListener('click', (e) => {
    e.preventDefault();
    document.body.click();
    createReportContext()
})
document.addEventListener('keydown', (e) => {
    if (e.altKey && e.ctrlKey && e.key === 'r') {
        e.preventDefault();
        createReportContext();
    }

})
const reportForm = document.querySelector('#report_form');

reportForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    e.target.classList.add('is_uploading')
    let formData = new FormData(e.target);
    let url = e.target.action;

    let image = document.querySelector('.report-img').src;

    formData.append('file', image);

    let options = {
        method: "POST",
        body: formData
    }
    let response = await fetch(url, options);
    let data = await response.json();
    if (response.ok) {
        document.querySelector('.report_modal_conetnt').innerHTML = `<div class="modal-body tx-center pd-y-20 pd-x-20"> <button aria-label="Close" class="close"
        data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button> <i
        class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
    <h4 class="tx-success tx-semibold mg-b-20" id="successHeading">Thanks for your Feedback!</h4>
    <p class="mg-b-20 mg-x-20" id="successText">We will Look into your Feedback as soon as Possible! Please Note Below Unique Id as reference of Your feedback!<br> ${data.reference}</p>
    <button aria-label="Close" class="btn btn-success pd-x-25" data-dismiss="modal"
        type="button">Ok</button>
    </div>`
    }

    console.log(data);

})