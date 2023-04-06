$(document).ready(function() {
    $('#checkModal').on('shown.bs.modal', function(e){
        let url = e.relatedTarget.dataset.action;
        $('#checkForm').attr('action', url)
    })
})