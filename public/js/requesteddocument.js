$(document).ready(function() {
    $('#requestdocumentTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/requests/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "requestId", "name": "requestdocuments.requestId" },
      { "data": "typeofdoc", "name": "requestdocuments.typeofdoc" },
      { "data": "price", "name": "requestdocuments.price" },
      { "data": "modeofdelivery", "name": "mods.modeofdelivery" },
      { "data": "modeofpayment", "name": "requestdocuments.modeofpayment" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editAdmin btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-print'></i></button><button type='button' value="+data.id+" class='editAdmin btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteAdmi btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end animalTable
});