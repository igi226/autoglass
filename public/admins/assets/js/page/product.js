"use strict";
$("#table-2").dataTable({
  paging: false,
  info: false,
  searching:false,
  "columnDefs": [
    { "sortable": false }
  ]
});
$('[data-delete]').on('click', function () {
  let url = $(this).attr('data-delete');
  let message = $(this).attr('data-message');
  swal({
    title: 'Warning',
    text: message,
    icon: 'warning',
    buttons: true,
    confirmButtonColor:'#fc544b',
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = url
      }
    });

})
