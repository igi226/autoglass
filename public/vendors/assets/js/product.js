let checkAll = document.querySelector('#check-all');
let checkInit = false;
checkAll.addEventListener('change', (e) => {
    checkInit = !checkInit;
    document.querySelectorAll('.product-checked').forEach(elem => {
        elem.checked = checkInit;
    })
})

$('#btn-import').on('click', function() {
    let initValue = [];

    $('.product-checked:checked').each(function() {
        initValue = [...initValue, $(this).val()]
    })
    if(!initValue.length) {
        $('#errorHeading').html(`Error: No Row Selected`);
        $('#errorMessage').html('Please Select a Row to import Into your Inventory');
        $('#errorModal').modal('show')

        return false;
    }

    let url = $('#script').attr('data-src');
    let csrf = $('#script').attr('data-csrf');

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type" :"application/json"
        },
        body : JSON.stringify({
            _token : csrf,
            products : initValue
        })
    })
    .then( (res) => {
        if(!res.ok) {
            $('#errorHeading').html(`Error`);
            $('#errorMessage').html('Some Error Occured While Importing Products!');
            $('#errorModal').modal('show')

            return false;
        }
        $.toast({
            text: `${initValue.length} Products Imported To Your Inventory`,
            icon: 'success',
            hideAfter: 3000
        })
    })
});
$('.import_now').on('click', function() {
    $('.prev-message').hide();
    $('#import_form').show();
})