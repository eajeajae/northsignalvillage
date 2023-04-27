$(document).ready(function() {
  $('#barangayidTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/barangayids/all",
			dataSrc: "",
      method: "get",
		},
		select: true,
		dom: 'Bfrtip',
    lengthChange: false,
		buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
		columns: [
      { "data": "id" },
      { "data": "fullname" },
      { "data": "contactno" },
      { data: null,
        render: function ( data, type, row ) {
          return row.addressNo + ' ' + row.street + '' + row.addressZone;
        }
      },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editBarangayidbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-eye'></i></button><button type='button' data-id="+data.id+" class='deleteBarangayidbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } 
      }
    ],
  });//	end barangayidTable

  //pending barangay id table
  $('#pendingBarangayidTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/pending-barangayids/all",
      dataSrc: "",
      method: "get",
    },
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "fullname" },
      { "data": "contactno" },
      { data: null,
        render: function ( data, type, row ) {
          return row.addressNo + ' ' + row.street + '' + row.addressZone;
        }
      },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editPendingBarangayidbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteBarangayidbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } 
      }
    ],
  });//	end pendingTable
}); //barangayidTable
//edit-show barangay id
$(document).on( 'click', '.editBarangayidbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editBarangayIdModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/barangayid/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_barangayid_id_img').html('<img class="rounded-circle d-block avatar" src="storage/users/'+response.barangayid.id_img+'" alt="Image" height="100px" width="100px"/>');
      $('#edit_barangayid_status').val(response.barangayid.status);
      $('#edit_barangayid_fullname').val(response.barangayid.fullname);
      $('#edit_barangayid_birthdate').val(response.barangayid.birthdate);
      $('#edit_barangayid_contactno').val(response.barangayid.contactno);
      $('#edit_barangayid_addressNo').val(response.barangayid.addressNo);
      $('#edit_barangayid_street').val(response.barangayid.street);
      $('#edit_barangayid_addressZone').val(response.barangayid.addressZone);
      $('#edit_barangayid_precintNo').val(response.barangayid.precintNo);
      $('#edit_barangayid_contactperson').val(response.barangayid.contactperson);
      $('#edit_barangayid_guardianContact').val(response.barangayid.guardianContact);
      $('#edit_barangayid_guardianAddress').val(response.barangayid.guardianAddress);
      $('#edit_barangayid_precintNo').val(response.barangayid.precintNo);
      $('#edit_barangayid_id').val(response.barangayid.id);
      if(response.barangayid.status == 'pending'){
        $('#buttons').html('<button id="barangayIdUpdate" type="submit" class="btn btn-success">Update</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
      }
      else{
        $('#buttons').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
      }
    }
  });
});// end #document #editbarangayidsbtn
$(document).ready(function() {
  $('#updateBarangayidForm').get(0).reset();
  $('#updateBarangayidForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_barangayid_id').val();
    console.log(id);
    $("#barangayIdUpdate").text("Updating...");
    $.ajax({
      url: "/api/barangayid-request/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.success == true){
          Swal.fire(
            'Updated!',
            'Request has been updated.',
            'success'
          ) 
          $('#barangayidTable').DataTable().ajax.reload();
        }
        $("#barangayIdUpdate").text('Update');
        $("#updateBarangayidForm")[0].reset();
        $("#editBarangayIdModal").modal('hide');
      }
    });
   });//  end ng barangayIdUpdate.submit
});// end document.ready barangayIdUpdate
//edit pending barangay id requests
$(document).on( 'click', '.editPendingBarangayidbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editPendingBarangayidModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/barangayid/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_barangayid_id_img').html('<img class="rounded-circle d-block avatar" src="storage/users/'+response.barangayid.id_img+'" alt="Image" height="100px" width="100px"/>');
      $('#edit_barangayid_status').val(response.barangayid.status);
      $('#edit_barangayid_user_id').val(response.barangayid.user_id);
      $('#edit_barangayid_typeofrequest_id').val(response.barangayid.typeofrequest_id);
      $('#edit_barangayid_fullname').val(response.barangayid.fullname);
      $('#edit_barangayid_birthdate').val(response.barangayid.birthdate);
      $('#edit_barangayid_contactno').val(response.barangayid.contactno);
      $('#edit_barangayid_addressNo').val(response.barangayid.addressNo);
      $('#edit_barangayid_street').val(response.barangayid.street);
      $('#edit_barangayid_addressZone').val(response.barangayid.addressZone);
      $('#edit_barangayid_precintNo').val(response.barangayid.precintNo);
      $('#edit_barangayid_contactperson').val(response.barangayid.contactperson);
      $('#edit_barangayid_guardianContact').val(response.barangayid.guardianContact);
      $('#edit_barangayid_guardianAddress').val(response.barangayid.guardianAddress);
      $('#edit_barangayid_precintNo').val(response.barangayid.precintNo);
      $('#edit_barangayid_id').val(response.barangayid.id);
    }
  });
});// end #document #editPendingBarangayidbtn
//update pending barangay id request
$(document).ready(function() {
  $('#updatePendingBarangayidForm').get(0).reset();
  $('#updatePendingBarangayidForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_barangayid_id').val();
    console.log(id);
    $("#pendingBarangayidUpdate").text("Updating...");
    $.ajax({
      url: "/api/barangayid-request/update/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.success == true){
          Swal.fire(
            'Updated!',
            'Request has been updated.',
            'success'
          ) 
          $('#pendingBarangayidTable').DataTable().ajax.reload();
        }
        $("#pendingBarangayidUpdate").text('Update');
        $("#updatePendingBarangayidForm")[0].reset();
        $("#editPendingBarangayidModal").modal('hide');
      }
    });
   });//  end ng pendingBarangayidUpdate.submit
});// end document.ready pendingBarangayidUpdate
//delete barangay id request 
$(document).on( 'click', '.deleteBarangayidbtn', function (e) {
  var id = $(this).data('id');
  console.log(id);
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result);
      $.ajax({
        type: "DELETE",
        url: "/api/barangayid/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
          Swal.fire(
            'Deleted!',
            'Request has been deleted.',
            'success'
          ) 
          $('#barangayidTable').DataTable().ajax.reload();
        },
        error: function(error) {
          console.log('error');
        }
      });
    }
  })
});//  end barangayid delete

//certificate-requests
$(document).ready(function() {
  $('#certificateTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/certificates/all",
      dataSrc: "",
      method: "get",
    },
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "purpose" },
      { "data": "name" },
      { "data": "contact_num" },
      { data: null,
        render: function ( data, type, row ) {
          return row.addressNo + ' ' + row.street + '' + row.addressZone;
        }
      },
      { "data": "typeofdoc" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editCertificatebtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-eye'></i></button><button type='button' data-id="+data.id+" class='deleteCertificatebtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } 
      }
    ],
  });//	end certificateTable

  //pending certificate table 
  $('#pendingCertificatesTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/pending-certificates/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "purpose" },
      { "data": "name" },
      { "data": "contact_num" },
      { data: null,
        render: function ( data, type, row ) {
          return row.addressNo + ' ' + row.street + '' + row.addressZone;
        }
      },
      { "data": "typeofdoc" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editPendingCertificatebtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteCertificatetebtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } 
      }
    ],
  });//	end pendingTable
});// certificateTable
//edit-show certificate
$(document).on( 'click', '.editCertificatebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editCertificateModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/certificate/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_certificate_typeofrequest_id').val(response.certificate.typeofrequest_id);
      $('#edit_certificate_status').val(response.certificate.status);
      $('#edit_certificate_purpose').val(response.certificate.purpose);
      $('#edit_certificate_isRegistered').val(response.certificate.isRegistered);
      $('#edit_certificate_havePendingCase').val(response.certificate.havePendingCase);
      $('#edit_certificate_name').val(response.certificate.name);
      $('#edit_certificate_gender').val(response.certificate.gender);
      $('#edit_certificate_birthdate').val(response.certificate.birthdate);
      $('#edit_certificate_p_birth').val(response.certificate.p_birth);
      $('#edit_certificate_nationality').val(response.certificate.nationality);
      $('#edit_certificate_contact_num').val(response.certificate.contact_num);
      $('#edit_certificate_c_status').val(response.certificate.c_status);
      $('#edit_certificate_addressNo').val(response.certificate.addressNo);
      $('#edit_certificate_street').val(response.certificate.street);
      $('#edit_certificate_addressZone').val(response.certificate.addressZone);
      $('#edit_certificate_provincialAddress').val(response.certificate.provincialAddress);
      $('#edit_certificate_yearLiving').val(response.certificate.yearLiving);
      $('#edit_certificate_areYouSure').val(response.certificate.areYouSure);
      $('#edit_certificate_id').val(response.certificate.id);
      if(response.certificate.status == 'pending'){
        $('#buttons').html('<button class="btn btn-info" type="button" id="certificateGeneratebtn" style="color:white;">Create Certificate</button><button class="btn btn-success" type="submit" id="certificateUpdate">Update</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
      }
      else{
        $('#buttons').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
      }
    }
  }); 
  //creating certificate
  $(document).on('click', '#certificateGeneratebtn', function (e) {
    var id = $('#edit_certificate_id').val();
    console.log(id);
    $('#editCertificateModal').modal('hide');
    $('#generatecertificateModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/certificate-preview/" + id,
      success: function(response){
        console.log(response);
        $('#generate_certificate_control_no').val(response.certificateRequest.control_no);
        $('#generate_certificate_created_at').val(response.certificateRequest.created_at);
        $('#generate_certificate_typeofdoc').val(response.certificateRequest.typeofdoc);
        $('#generate_certificate_name').val(response.certificateRequest.name);
        $('#generate_certificate_address').val(response.certificateRequest.addressNo + ' ' + response.certificateRequest.street);
        $('#generate_certificate_id').val(response.certificateRequest.id);
      }
    });
  });
});// end #document #editCertificatebtn
//update pendingCertificate
$(document).ready(function() {
  $('#certificateUpdateForm').get(0).reset();
  $('#certificateUpdateForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_certificate_id').val();
    console.log(id);
    $("#certificateUpdate").text("Updating...");
    $.ajax({
      url: "/api/certificate/update/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Certificate Request Updated Successfully',
            'success'
            )
          $('#pendingCertificatesTable').DataTable().ajax.reload();
        }
        $("#certificateUpdate").text('Update');
        $("#certificateUpdateForm")[0].reset();
        $("#editCertificateModal").modal('hide');
      }
    });
   });//  end ng certificateUpdate.submit
});// end document.ready pendingCertificateForm
//editing of pending certificate
$(document).on( 'click', '.editPendingCertificatebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editPendingCertificateModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/certificate/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_certificate_typeofrequest_id').val(response.certificate.typeofrequest_id);
      $('#edit_certificate_status').val(response.certificate.status);
      $('#edit_certificate_user_id').val(response.certificate.user_id);
      $('#edit_certificate_purpose').val(response.certificate.purpose);
      $('#edit_certificate_isRegistered').val(response.certificate.isRegistered);
      $('#edit_certificate_havePendingCase').val(response.certificate.havePendingCase);
      $('#edit_certificate_name').val(response.certificate.name);
      $('#edit_certificate_gender').val(response.certificate.gender);
      $('#edit_certificate_birthdate').val(response.certificate.birthdate);
      $('#edit_certificate_p_birth').val(response.certificate.p_birth);
      $('#edit_certificate_nationality').val(response.certificate.nationality);
      $('#edit_certificate_contact_num').val(response.certificate.contact_num);
      $('#edit_certificate_c_status').val(response.certificate.c_status);
      $('#edit_certificate_addressNo').val(response.certificate.addressNo);
      $('#edit_certificate_street').val(response.certificate.street);
      $('#edit_certificate_addressZone').val(response.certificate.addressZone);
      $('#edit_certificate_provincialAddress').val(response.certificate.provincialAddress);
      $('#edit_certificate_yearLiving').val(response.certificate.yearLiving);
      $('#edit_certificate_areYouSure').val(response.certificate.areYouSure);
      $('#edit_certificate_id').val(response.certificate.id);
    }
  }); 
  //creating certificate
  $(document).on('click', '#certificateGeneratebtn', function (e) {
    var id = $('#edit_certificate_id').val();
    console.log(id);
    $('#editPendingCertificateModal').modal('hide');
    $('#generatecertificateModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/certificate-preview/" + id,
      success: function(response){
        console.log(response);
        $('#generate_certificate_control_no').val(response.certificateRequest.control_no);
        $('#generate_certificate_created_at').val(response.certificateRequest.created_at);
        $('#generate_certificate_typeofdoc').val(response.certificateRequest.typeofdoc);
        $('#generate_certificate_name').val(response.certificateRequest.name);
        $('#generate_certificate_address').val(response.certificateRequest.addressNo + ' ' + response.certificateRequest.street);
        $('#generate_certificate_id').val(response.certificateRequest.id);
      }
    });
  });
});// end #document #editPendingCertificatebtn
//update pendingCertificate
$(document).ready(function() {
  $('#pendingCertificateForm').get(0).reset();
  $('#pendingCertificateForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_certificate_id').val();
    console.log(id);
    $("#pendingCertificateUpdate").text("Updating...");
    $.ajax({
      url: "/api/pending-certificate/update/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Certificate Request Updated Successfully',
            'success'
            )
          $('#pendingCertificatesTable').DataTable().ajax.reload();
        }
        $("#pendingCertificateUpdate").text('Update');
        $("#pendingCertificateForm")[0].reset();
        $("#editPendingCertificateModal").modal('hide');
      }
    });
   });//  end ng pendingCertificateUpdate.submit
});// end document.ready pendingCertificateForm
//deleteCertificate Request
$(document).on( 'click', '.deleteCertificatebtn', function (e) {
  var id = $(this).data('id');
  console.log(id);
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result);
      $.ajax({
        type: "DELETE",
        url: "/api/certificate/delete/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
          Swal.fire(
            'Deleted!',
            'Request has been deleted.',
            'success'
          ) 
          $('#certificateTable').DataTable().ajax.reload();
        },
        error: function(error) {
          console.log('error');
        }
      });
      
    }
  })
});//  end #myrequest delete


//clearance-requests
$(document).ready(function() {
  $('#clearanceTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/clearances/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "purpose" },
      { "data": "name" },
      { "data": "contact_num" },
      { data: null,
        render: function ( data, type, row ) {
          return row.addressNo + ' ' + row.street + '' + row.addressZone;
        }
      },
      { "data": "typeofdoc" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editClearancetebtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteClearancetebtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } 
      }
    ],
  });//	end clearanceTable
  
  //pending clearance requests 
  $('#pendingTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/pending-clearances/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "purpose" },
      { "data": "name" },
      { "data": "contact_num" },
      { data: null,
        render: function ( data, type, row ) {
          return row.addressNo + ' ' + row.street + '' + row.addressZone;
        }
      },
      { "data": "typeofdoc" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editPendingClearancebtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteClearancetebtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } 
      }
    ],
  });//	end pendingTable
  //creating clearances
  $(document).on('click', '#clearanceGeneratebtn', function (e) {
    var id = $('#edit_clearance_id').val();
    console.log(id);
    $('#editClearanceModal').modal('hide');
    $('#generateclearanceModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/clearance-preview/" + id,
      success: function(response){
        console.log(response);
        $('#generate_clearance_control_no').val(response.clearanceRequest.control_no);
        $('#generate_clearance_created_at').val(response.clearanceRequest.created_at);
        $('#generate_clearance_typeofdoc').val(response.clearanceRequest.typeofdoc);
        $('#generate_clearance_name').val(response.clearanceRequest.name);
        $('#generate_clearance_address').val(response.clearanceRequest.addressNo + ' ' + response.clearanceRequest.street);
        $('#generate_clearance_id').val(response.clearanceRequest.id);
      }
    });
  });
});
//edit-show clearance requests
$(document).on( 'click', '.editClearancetebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editClearanceModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/clearance/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_clearance_status').val(response.clearance.status);
      $('#edit_clearance_typeofrequest_id').val(response.clearance.typeofrequest_id);
      $('#edit_clearance_purpose').val(response.clearance.purpose);
      $('#edit_clearance_isRegistered').val(response.clearance.isRegistered);
      $('#edit_clearance_havePendingCase').val(response.clearance.havePendingCase);
      $('#edit_clearance_name').val(response.clearance.name);
      $('#edit_clearance_gender').val(response.clearance.gender);
      $('#edit_clearance_birthdate').val(response.clearance.birthdate);
      $('#edit_clearance_p_birth').val(response.clearance.p_birth);
      $('#edit_clearance_nationality').val(response.clearance.nationality);
      $('#edit_clearance_contact_num').val(response.clearance.contact_num);
      $('#edit_clearance_c_status').val(response.clearance.c_status);
      $('#edit_clearance_addressNo').val(response.clearance.addressNo);
      $('#edit_clearance_street').val(response.clearance.street);
      $('#edit_clearance_addressZone').val(response.clearance.addressZone);
      $('#edit_clearance_businessAddress').val(response.clearance.businessAddress);
      $('#edit_clearance_provincialAddress').val(response.clearance.provincialAddress);
      $('#edit_clearance_yearLiving').val(response.clearance.yearLiving);
      $('#edit_clearance_id').val(response.clearance.id);
      if(response.clearance.status == 'pending'){
        $('#buttons').html('<button class="btn btn-info" type="button" id="clearanceGeneratebtn" style="color:white;">Create Clearance</button><button class="btn btn-success" type="submit" id="clearanceUpdate">Submit</button> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
      }
      else{
        $('#buttons').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
      }
    }
  });
});// end #clearanceTable #editClearancebtn
$(document).ready(function() {
  var formData = new FormData(this);
  var id = $('#edit_clearance_id').val();
  console.log(id);
  $("#clearanceUpdate").text("Updating...");
  $.ajax({
    url: "/api/clearance/"+id,
    type: "POST",
    data: formData, 
    cache: false,
    processData: false, 
    contentType: false, 
    dataType: "json",
    success: function(response) {
      console.log(response);
      if(response.success == true){
        Swal.fire(
          'Updated!',
          'Request has Updated Successfully',
          'success'
        )
        $('#clearanceTable').DataTable().ajax.reload();
      }
      $("#clearanceUpdate").text('Update');
      $("#clearanceUpdateForm")[0].reset();
      $("#editClearanceModal").modal('hide');
    }
  });
});// end document.ready clearanceUpdateForm

//edit pending clearance request 
$(document).on( 'click', '.editPendingClearancebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editPendingClearanceModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/clearance/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_clearance_status').val(response.clearance.status);
      $('#edit_clearance_user_id').val(response.clearance.user_id);
      $('#edit_clearance_typeofrequest_id').val(response.clearance.typeofrequest_id);
      $('#edit_clearance_purpose').val(response.clearance.purpose);
      $('#edit_clearance_isRegistered').val(response.clearance.isRegistered);
      $('#edit_clearance_havePendingCase').val(response.clearance.havePendingCase);
      $('#edit_clearance_name').val(response.clearance.name);
      $('#edit_clearance_gender').val(response.clearance.gender);
      $('#edit_clearance_birthdate').val(response.clearance.birthdate);
      $('#edit_clearance_p_birth').val(response.clearance.p_birth);
      $('#edit_clearance_nationality').val(response.clearance.nationality);
      $('#edit_clearance_contact_num').val(response.clearance.contact_num);
      $('#edit_clearance_c_status').val(response.clearance.c_status);
      $('#edit_clearance_addressNo').val(response.clearance.addressNo);
      $('#edit_clearance_street').val(response.clearance.street);
      $('#edit_clearance_addressZone').val(response.clearance.addressZone);
      $('#edit_clearance_businessAddress').val(response.clearance.businessAddress);
      $('#edit_clearance_provincialAddress').val(response.clearance.provincialAddress);
      $('#edit_clearance_yearLiving').val(response.clearance.yearLiving);
      $('#edit_clearance_id').val(response.clearance.id);
    }
  });
  //creating clearances
  $(document).on('click', '#clearanceGeneratebtn', function (e) {
    var id = $('#edit_clearance_id').val();
    console.log(id);
    $('#editPendingClearanceModal').modal('hide');
    $('#generateclearanceModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/clearance-preview/" + id,
      success: function(response){
        console.log(response);
        $('#generate_clearance_control_no').val(response.clearanceRequest.control_no);
        $('#generate_clearance_created_at').val(response.clearanceRequest.created_at);
        $('#generate_clearance_typeofdoc').val(response.clearanceRequest.typeofdoc);
        $('#generate_clearance_name').val(response.clearanceRequest.name);
        $('#generate_clearance_address').val(response.clearanceRequest.addressNo + ' ' + response.clearanceRequest.street);
        $('#generate_clearance_id').val(response.clearanceRequest.id);
      }
    });
  });
});// end #clearanceTable #editClearancebtn
//udpate pending clearance request
$(document).ready(function() {
  $('#pendingClearanceForm').get(0).reset();
  $('#pendingClearanceForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_clearance_id').val();
    console.log(id);
    $("#pendingClearanceUpdate").text("Updating...");
    $.ajax({
      url: "/api/pending-clearance/update/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Clearance Request Updated Successfully',
            'success'
            )
          $('#pendingTable').DataTable().ajax.reload();
        }
        $("#pendingClearanceUpdate").text('Update');
        $("#pendingClearanceForm")[0].reset();
        $("#editPendingClearanceModal").modal('hide');
      }
    });
   });//  end ng pendingClearanceUpdate.submit
});// end document.ready clearanceUpdateForm
$(document).on( 'click', '.deleteClearancetebtn', function (e) {
  var id = $(this).data('id');
  console.log(id);
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result);
      $.ajax({
        type: "DELETE",
        url: "/api/clearance/delete/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
          Swal.fire(
            'Deleted!',
            'Request has been deleted.',
            'success'
          ) 
          $('#clearanceTable').DataTable().ajax.reload();
        },
        error: function(error) {
          console.log('error');
        }
      });
      
    }
  })
});//  end #clearanceTable delete

//complaints
$(document).ready(function() {
  //all complaint datatable
  $('#complaintTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/complaints/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    buttons: [
      'colvis', 'excel', 'pdf','print',
      {
        text: '+',
        className: 'btn btn-success',
        action: function ( e, dt, node, config ) {
        // alert( 'Button activated' )
          $("#addComplaintForm").trigger("reset");
          $('#addComplaintModal').modal('show');
        }
      } 
    ],
    columns: [
      { "data": "id", "name": "complaints.id" },
      { "data": "caseNo", "name": "complaints.caseNo" },
      { data: null,
          render: function ( data, type, row ) {
            return row.complainantName + ' ' + 'vs.' + ' ' + row.respondentName;
      }
      },
      { "data": "complaintDesc", "name": "complaints.complaintDesc" },
      { "data": "created_at" },
      { "data": "mediationSchedule", "name": "mediations.mediationSchedule" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editComplaint btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteComplaint btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end complaintTable
  //pending complaint datatable
  $('#pendingComplaintTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/pending-complaints/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    buttons: [
      'colvis', 'excel', 'pdf','print',
      {
        text: '+',
        className: 'btn btn-success',
        action: function ( e, dt, node, config ) {
        // alert( 'Button activated' )
          $("#addComplaintForm").trigger("reset");
          $('#addComplaintModal').modal('show');
        }
      } 
    ],
    columns: [
      { "data": "id", "name": "complaints.id" },
      { "data": "caseNo", "name": "complaints.caseNo" },
      { data: null,
          render: function ( data, type, row ) {
            return row.complainantName + ' ' + 'vs.' + ' ' + row.respondentName;
      }
      },
      { "data": "complaintDesc", "name": "complaints.complaintDesc" },
      { "data": "created_at" },
      { "data": "mediationSchedule", "name": "mediations.mediationSchedule" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editComplaint btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteComplaint btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end pendingComplaintTable
  //pending complaint datatable
  $('#onprocessComplaintTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/on-process-complaints/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    buttons: [
      'colvis', 'excel', 'pdf','print',
      {
        text: '+',
        className: 'btn btn-success',
        action: function ( e, dt, node, config ) {
        // alert( 'Button activated' )
          $("#addComplaintForm").trigger("reset");
          $('#addComplaintModal').modal('show');
        }
      } 
    ],
    columns: [
      { "data": "id", "name": "complaints.id" },
      { "data": "caseNo", "name": "complaints.caseNo" },
      { data: null,
          render: function ( data, type, row ) {
            return row.complainantName + ' ' + 'vs.' + ' ' + row.respondentName;
      }
      },
      { "data": "complaintDesc", "name": "complaints.complaintDesc" },
      { "data": "created_at" },
      { "data": "mediationSchedule", "name": "mediations.mediationSchedule" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editComplaint btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteComplaint btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end pendingComplaintTable
  //edit-show complaint
  $(document).on( 'click', '.editComplaint', function (e) {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);
      $('#editComplaintModal').modal('show');
      $.ajax({
        type: "GET",
        url: "api/complaint-edit/" + id,
        success: function(response){
          console.log(response);
          $('#edit_complaint_complainantName').val(response.complaint.complainantName);
          $('#edit_complaint_caseNo').val(response.complaint.caseNo);
          $('#edit_complaint_status').val(response.complaint.status);
          $('#edit_complaint_user_id').val(response.complaint.user_id);
          $('#edit_complaint_cAddressno').val(response.complaint.cAddressno);
          $('#edit_complaint_cStreet').val(response.complaint.cStreet);
          $('#edit_complaint_cAddresszone').val(response.complaint.cAddresszone);
          $('#edit_complaint_respondentName').val(response.complaint.respondentName);
          $('#edit_complaint_respondentAge').val(response.complaint.respondentAge);
          $('#edit_complaint_rAddressno').val(response.complaint.rAddressno);
          $('#edit_complaint_rStreet').val(response.complaint.rStreet);
          $('#edit_complaint_rAddresszone').val(response.complaint.rAddresszone);
          $('#edit_complaint_complaintDesc').val(response.complaint.complaintDesc);
          $('#edit_complaint_complaintLocation').val(response.complaint.locationAddressno + ' ' + response.complaint.locationStreet);
          $('#edit_complaint_complaintDate').val(response.complaint.complaintDate);
          $('#edit_complaint_complaintWhy').val(response.complaint.complaintWhy);
          $('#edit_complaint_complainantPrayer').val(response.complaint.complainantPrayer);
          $('#edit_complaint_id').val(response.complaint.id);
          if(response.complaint.status == 'pending'){
            $('#scheduleHearing').html('<h6 class="card_tags" style="color:#234880;">No Schedule....</h6>');
            $('#buttons').html('<button type="button" class="btn btn-primary" id="schedulehearingbtn">Schedule first hearing</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
          }
          else if(response.complaint.status == 'on process'){
            $('#scheduleHearing').html('<h6 class="card_tags" style="color:#234880;">Schedule of first hearing</h6><input type="input" class="form-control" id="edit_complaint_mediationSchedule" name="mediationSchedule">');
            $('#edit_complaint_mediationSchedule').val(response.mediationSchedule.mediationSchedule);
            $('#buttons').html('<button type="button" class="btn btn-success" id="generateSummonbtn">Generate Summoning Letter</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
          }
          else{
            $('#buttons').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
          }
        }
      });
      $(document).on('click', '#schedulehearingbtn', function (e) {
        e.preventDefault();
        var id = $('#edit_complaint_id').val();
        console.log(id);
        $('#editComplaintModal').modal('hide');
        $('#scheduleHearingModal').modal('show');
        $.ajax({
          type: "GET",
          url: "api/complaint/edit/" + id,
          success: function(response){
            console.log(response);
            $('#sched_complaint_id').val(response.complaint.id);
            $('#sched_complaint_user_id').val(response.complaint.user_id);
            $('#sched_complaint_complainantName').val(response.complaint.complainantName);
            $('#sched_complaint_respondentName').val(response.complaint.respondentName);
            $('#sched_complaint_complaintLocation').val(response.complaint.locationAddressno + ' ' + response.complaint.locationStreet);
            $('#sched_complaint_complaintDate').val(response.complaint.complaintDate);
          }
        });
      });
      $(document).on('click', '#generateSummonbtn', function (e) {
        e.preventDefault();
        var id = $('#edit_complaint_id').val();
        console.log(id);
        $('#editComplaintModal').modal('hide');
        $('#generateSummonLetterModal').modal('show');
        $.ajax({
          type: "GET",
          url: "api/complaint-edit/" + id,
          success: function(response){
            console.log(response);
            $('#generate_complaint_caseNo').val(response.complaint.caseNo);
            $('#generate_complaint_forComplainantName').val(response.complaint.complainantName);
            $('#generate_complaint_id').val(response.complaint.id);
            $('#generate_complaint_user_id').val(response.complaint.user_id);
            $('#generate_complaint_complainantName').val(response.complaint.complainantName);
            $('#generate_complaint_respondentName').val(response.complaint.respondentName);
            $('#generate_complaint_toRespondents').val(response.complaint.respondentName);
            $('#generate_complaint_mediationSchedule').val(response.mediationSchedule.mediationSchedule)
            $('#generate_complaint_created_at').val(response.mediationSchedule.created_at);
          }
        });
      });
      $('#addScheduleForm').submit(function(e){
        e.preventDefault();
        const formData = new FormData(this);
        var id = $('#sched_complaint_id').val();
        console.log(id);
        $('#addSchedulebtn').text("Adding...");
        $.ajax({
          type: 'POST',
          url: 'api/add-schedule/'+id,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(res) {
            console.log(res);
            if(res.status == 200){
              Swal.fire({
                icon: 'success',
                title: 'Added!',
                text: 'Schedule is added successfuly',
              })
              $('#pendingComplaintTable').DataTable().ajax.reload();
            }
            $("#addSchedulebtn").text('Add Schedule');
            $("#addScheduleForm")[0].reset();
            $("#scheduleHearingModal").modal('hide');
          }
        });
      });
  });// end #document #editcomplaintbtn

});
//update complaint 
//udpate pending clearance request
$(document).ready(function() {
  $('#editComplaintForm').get(0).reset();
  $('#editComplaintForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_complaint_id').val();
    console.log(id);
    $("#complaintUpdatebtn").text("Updating...");
    $.ajax({
      url: "/api/complaint-update/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Complaint Updated Successfully',
            'success'
            )
          $('#complaintTable').DataTable().ajax.reload();
          $('#pendingComplaintTable').DataTable().ajax.reload();
          $('#onprocessComplaintTable').DataTable().ajax.reload();
        }
        $("#complaintUpdatebtn").text('Update');
        $("#editComplaintForm")[0].reset();
        $("#editPendingClearanceModal").modal('hide');
      }
    });
   });//  end ng complaintUpdatebtn.submit
});// end document.ready editComplaintForm
//delete complaint
$(document).on( 'click', '.deleteComplaint', function (e) {
  var id = $(this).data('id');
  console.log(id);
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result);
      $.ajax({
        type: "DELETE",
        url: "/api/complaint/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
          Swal.fire(
            'Deleted!',
            'Complaint has been deleted.',
            'success'
          ) 
          $('#complaintTable').DataTable().ajax.reload();
        },
        error: function(error) {
          console.log('error');
        }
      });
      
    }
  })
});//  end #scholarshipTable delete

//schedulevaccineTable
$(document).ready(function() {
  $('#schedulevaccineTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/schedulevaccines/all",
      dataSrc: "",
      method: "get",
    },
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print', 
    ],
    
    columns: [
      { "data": "scheduleId" },
      { "data": "name" },
      { "data": "contact_num" },
      { "data": "vaccine_id" },
      { "data": "date" },
      { "data": "time" },
      { "data": "status" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editSchedule btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteSchedule btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end barangayidTable
  
});
$(document).ready(function() {
  $('#schedulevaccineUpdateForm').get(0).reset();

   $('#schedulevaccineUpdateForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_schedulevaccine_id').val();
    console.log(id);
    $("#schedulevaccineUpdate").text("Updating...");
    $.ajax({
      url: "/api/vaccination-schedule/waiting-list/update/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Data Updated Successfully',
            'success'
            )
        }
        $("#schedulevaccineUpdate").text('Update');
        $("#schedulevaccineUpdateForm")[0].reset();
        $("#vaccinationScheduleModal").modal('hide');
      }
    });
   });//  end ng schedulevaccineUpdate.submit
});// end document.ready schedulevaccineUpdateForm

//scholarship applications
$(document).ready(function() {
  $('#scholarshipTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/scholarships/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "scholarFname" },
      { "data": "scholarPhonenum" },
      { "data": "scholarSchool" },
        { "data": "scholarCourse" },
        { "data": "scholarEmail" },
      { "data": "status" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editScholarshipApplicationbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteScholarshipApplicationbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end scholarshipTable
  
  $('#grantedApplicantTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/granted-applicants/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "scholarFname" },
      { "data": "scholarPhonenum" },
      { "data": "scholarSchool" },
        { "data": "scholarCourse" },
        { "data": "scholarEmail" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editScholarshipApplicationbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteScholarshipApplicationbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end grantedApplicantTable

  $('#notGrantedApplicantTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/not-granted-applicants/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "scholarFname" },
      { "data": "scholarPhonenum" },
      { "data": "scholarSchool" },
        { "data": "scholarCourse" },
        { "data": "scholarEmail" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='addCommentbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-comment'></i></button><button type='button' data-id="+data.id+" class='deleteScholarshipApplicationbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end notGrantedApplicantTable
});
$(document).on( 'click', '.editScholarshipApplicationbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editScholarshipApplicationModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/scholarship-applicantion-edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_scholarApplication_scholarFname').val(response.scholarship.scholarFname);
      $('#edit_scholarApplication_scholarPhonenum').val(response.scholarship.scholarPhonenum);
      $('#edit_scholarApplication_scholarSchool').val(response.scholarship.scholarSchool);
      $('#edit_scholarApplication_scholarEmail').val(response.scholarship.scholarEmail);
      $('#edit_scholarApplication_scholarCourse').val(response.scholarship.scholarCourse);
      $('#edit_scholarApplication_status').val(response.scholarship.status);
      $('#edit_scholarApplication_user_id').val(response.scholarship.user_id);
      $('#edit_scholarApplication_id').val(response.scholarship.id);
      $('#edit_scholarApplication_scholarCor_img').html('<img src="storage/scholarships/'+response.scholarship.scholarCor_img+'" height="400" width="700" style="display:block;id="edit_scholarApplication_scholarCor_img"></img>');
      $('#edit_scholarApplication_scholarGrade_img').html('<img src="storage/scholarships/'+response.scholarship.scholarGrade_img+'" height="400" width="700" style="display:block;id="edit_scholarApplication_scholarGrade_img"></img>');
    }
  });
});// end #document #editApplicationbtn

//add-show the not granted application
$(document).on( 'click', '.addCommentbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#commentScholarshipModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/scholarship-applicant/not-granted/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_scholarApplication_scholarFname').val(response.scholarship.scholarFname);
      $('#edit_scholarApplication_scholarPhonenum').val(response.scholarship.scholarPhonenum);
      $('#edit_scholarApplication_scholarSchool').val(response.scholarship.scholarSchool);
      $('#edit_scholarApplication_scholarEmail').val(response.scholarship.scholarEmail);
      $('#edit_scholarApplication_scholarCourse').val(response.scholarship.scholarCourse);
      $('#edit_scholarApplication_status').val(response.scholarship.status);
      $('#edit_scholarApplication_id').val(response.scholarship.id);
      $('#edit_scholarApplication_scholarCor_img').html('<img src="storage/scholarships/'+response.scholarship.scholarCor_img+'" height="400" width="700" style="display:block;id="edit_scholarApplication_scholarCor_img"></img>');
      $('#edit_scholarApplication_scholarGrade_img').html('<img src="storage/scholarships/'+response.scholarship.scholarGrade_img+'" height="400" width="700" style="display:block;id="edit_scholarApplication_scholarGrade_img"></img>');
      $('#edit_scholarApplication_comment').val(response.comment.comment);
    }
  });
});// end #document #editApplicationbtn

$(document).ready(function() {
  $('#updateSchoalrshipApplicationForm').get(0).reset();
    var validationScholarshipApplication = $('#updateSchoalrshipApplicationForm').validate({
      rules: {
        scholarFname: { required:true, minlength:2 },
        scholarSchool: { required:true },
        scholarPhonenum: {required:true},
        scholarCourse: { required:true, maxlength:13 },
        scholarEmail: { required:true, email:true },
        status: { required:true },
      },
      messscholarSchools: {
        scholarFname: { required:true, minlength:2 },
        age: { required:true },
        scholarPhonenum: {required:true},
        scholarCourse: { required:true, maxlength:3 },
        scholarEmail: { required:true, email:true },
        status: { required:true },
      },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng updateSchoalrshipApplicationForm.validate()
   validationScholarshipApplication.form();
   $('#updateSchoalrshipApplicationForm').submit(function(e){
    e.preventDefault();
     if(!validationScholarshipApplication.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_scholarApplication_id').val();
      console.log(id);
      $("#scholarshipApplicationUpdate").text("Updating...");
      $.ajax({
        url: "/api/scholarship-applicant/"+id,
        type: "POST",
        data: formData, 
        cache: false,
        processData: false, 
        contentType: false, 
        dataType: "json",
        success: function(response) {
          console.log(response);
          if(response.status == 200){
            Swal.fire(
              'Updated!',
              'Admin Updated Successfully',
              'success'
              )
            $('#scholarshipTable').DataTable().ajax.reload();
          }
          $("#scholarshipApplicationUpdate").text('Update');
          $("#updateSchoalrshipApplicationForm")[0].reset();
          $("#editScholarshipApplicationModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng scholarshipApplicationUpdate.submit
});// end document.ready updateSchoalrshipApplicationForm

//add comment to rejected scholarship application 
$(document).ready(function() {
  $('#commentScholarshipForm').get(0).reset();
  var validationAddComment = $('#commentScholarshipForm').validate({
    rules: {
      comment: { required:true },
    },
    messages: {
      comment: { required:"Please input the reason why this person's scholarship application is not granted." },
    },
    errorPlacement: function(error, element){
      error.insertAfter(element)
    }
  });//  end ng commentScholarshipForm.validate()
 validationAddComment.form();
 $('#commentScholarshipForm').submit(function(e){
  e.preventDefault();
   if(!validationAddComment.form()){
     alert('Incomplete data. Please check your input');
   } 
   else{
    var formData = new FormData(this);
    var id = $('#edit_scholarApplication_id').val();
    console.log(id);
    $("#commentScholarshipAdd").text("Updating...");
    $.ajax({
      url: "/api/scholarship-applicant/not-granted/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Added!',
            'Comment has been added successfully',
            'success'
            )
          $('#notGrantedApplicantTable').DataTable().ajax.reload();
        }
        $("#commentScholarshipAdd").text('Update');
        $("#commentScholarshipForm")[0].reset();
        $("#commentScholarshipModal").modal('hide');
      }
    });
   }//  end ng else
 });//  end ng commentScholarshipAdd.submit
});// end document.ready commentScholarshipForm
$(document).on( 'click', '.deleteScholarshipApplicationbtn', function (e) {
  var id = $(this).data('id');
  console.log(id);
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result);
      $.ajax({
        type: "DELETE",
        url: "/api/scholarship-applicant/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
          Swal.fire(
            'Deleted!',
            'Scholarship Application has been deleted.',
            'success'
          ) 
          $('#scholarshipTable').DataTable().ajax.reload();
        },
        error: function(error) {
          console.log('error');
        }
      });
      
    }
  })
});//  end #scholarshipTable delete

//resident
$(document).ready(function () {
  $('#residentTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/residents/all",
      dataSrc: "",
      method: "get",
    },
    select: true,
    dom: 'Bfrtip',
    buttons: [
      'colvis', 'excel', 'pdf','print',
    ],
    columns: [
      { "data": "id" },
      { "data": "name" },
      { "data": "gender" },
      { "data": "age" },
      { "data": "email" },
      { "data": "status" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editResidentbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteResidentbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end residentTable

  //not verified residents
  // $('#notverifiedResidentTable').DataTable({
  //   order: [[ 0, 'desc' ]],
  //   ajax: {
  //     url :"/api/residents/not-verified/all",
  //     dataSrc: "",
  //     method: "get",
  //   },
  //   select: true,
  //   dom: 'Bfrtip',
  //   buttons: [
  //     'colvis', 'excel', 'pdf','print',
  //   ],
  //   columns: [
  //     { "data": "id" },
  //     { "data": "name" },
  //     { "data": "gender" },
  //     { "data": "age" },
  //     { "data": "email" },
  //     { "data" : null, render : function ( data, type, row ) {
  //       return "<button type='button' value="+data.id+" class='editResidentbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteResidentbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
  //     } }
  //   ],
  // });//	end notverifiedResidentTable

  //verified residents
  // $('#verifiedResidentTable').DataTable({
  //   order: [[ 0, 'desc' ]],
  //   ajax: {
  //     url :"/api/residents/verified/all",
  //     dataSrc: "",
  //     method: "get",
  //   },
  //   select: true,
  //   dom: 'Bfrtip',
  //   buttons: [
  //     'colvis', 'excel', 'pdf','print',
  //   ],
  //   columns: [
  //     { "data": "id" },
  //     { "data": "name" },
  //     { "data": "gender" },
  //     { "data": "age" },
  //     { "data": "email" },
  //     { "data" : null, render : function ( data, type, row ) {
  //       return "<button type='button' value="+data.id+" class='editVerifiedResidentbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteResidentbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
  //     } }
  //   ],
  //   });//	end verifiedResidentTable
  
   
});
$(document).on('click', '.editResidentbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editResidentModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/resident/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_resident_valid_id').html('<img src="storage/validId/'+response.resident.valid_id+'" height="400" width="700" style="display:block;id="edit_scholarApplication_scholarCor_img"></img>');
      $('#edit_resident_avatar').html('<img class="rounded-circle d-block avatar" src="storage/users/'+response.resident.avatar+'" alt="Image" height="100px" width="100px"/>')
      $('#edit_resident_status').val(response.resident.status);
      $('#edit_resident_user_id').val(response.resident.user_id);
      $('#edit_resident_name').val(response.resident.name);
      $('#edit_resident_age').val(response.resident.age);
      $('#edit_resident_gender').val(response.resident.gender);
      $('#edit_resident_birthday').val(response.resident.birthdate);
      $('#edit_resident_phone_num').val(response.resident.phoneNum);
      $('#edit_resident_email').val(response.resident.email);
      $('#edit_resident_addressNo').val(response.resident.addressNo);
      $('#edit_resident_street').val(response.resident.street);
      $('#edit_resident_addressZone').val(response.resident.addressZone);
      $('#edit_resident_id').val(response.resident.id);
    }
  });
});// end #document #editResidentbtn
$(document).ready(function() {
  $('#editResidentForm').get(0).reset();
  $('#editResidentForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_resident_id').val();
    console.log(id);
    $("#residentUpdateSubmit").text("Updating...");
    $.ajax({
      url: "/api/resident/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Resident Updated Successfully',
            'success'
            )
          $('#residentTable').DataTable().ajax.reload();
        }
        $("#residentUpdateSubmit").text('Update');
        $("#editResidentForm")[0].reset();
        $("#editResidentModal").modal('hide');
      }
    });
   });//  end ng residentUpdateSubmit.submit
});// end document.ready editResidentForm
$(document).on('click', '.deleteResidentbtn', function (e) {
  var id = $(this).data('id');
  console.log(id);
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result);
      $.ajax({
        type: "DELETE",
        url: "/api/delete-resident/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
          Swal.fire(
            'Deleted!',
            'Account has been deleted.',
            'success'
          ) 
          $('#residentTable').DataTable().ajax.reload();
          $('#notverifiedResidentTable').DataTable().ajax.reload();
          $('#verifiedResidentTable').DataTable().ajax.reload();
        },
        error: function(error) {
          console.log('error');
        }
      });
      
    }
  })
});//  end #residentTable delete