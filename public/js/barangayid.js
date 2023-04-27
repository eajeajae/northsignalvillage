$(document).ready(function() {
  $(function() {
    var validationBarangayid = $('#barangayidForm').validate({
      rules: {
        precintNo: { required: true },
        contactperson: { required:true },
        guardianContact: { required:true, maxlength:12 },
        guardianAddress: { required:true }
      },
      messages: {
        precintNo: { required:"Please input your precint number" },
        contactperson: { required:"Please input your guardian's name" },
        guardianContact: { required:"Please input your guardian's contact number", maxlength:"Contact number should consist of 11 digits only." },
        guardianAddress: { required:"Please input your guardian's address." },
      },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng barangayidForm.validate()
    $('#barangayidForm').submit(function(e){
      e.preventDefault();
      var $form = $(this);
      if(!validationBarangayid.form()){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Please check your form.',
        })
      } 
      else{
        var formData = new FormData(this);
        $("#barangayidSubmit").text("Submitting...");
        url = $form.attr('action');
        $.ajax({
          url: 'api/barangayid/create',
          type: 'post',
          data: formData, 
          cache: false,
          processData: false, 
          contentType: false, 
          dataType: 'json',
          success: function(res) {
            // console.log(res);
            if(res.status == 200){
              Swal.fire({
                icon: 'success',
                title: 'Submitted',
                text: 'Thank you! Please wait for the notification after you pay for your request.',
              });
              console.log(res);
            }
            $("#barangayidSubmit").text("Submit");
            $('#barangayidForm')[0].reset();
          }
        });
      }//  end ng else
    });//  end ng barangayidSubmit.submit
  });//end ng barangayidForm function
});// end document.ready barangayid
$(document).on( 'click', '.editMyBarangayIdbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editMyBarangayidModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/barangayid/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_mybarangayid_id_img').html('<img class="rounded-circle d-block avatar" src="storage/users/'+response.barangayid.id_img+'" alt="Image" height="100px" width="100px"/>');
      
      $('#edit_mybarangayid_fullname').val(response.barangayid.fullname);
      $('#edit_mybarangayid_birthdate').val(response.barangayid.birthdate);
      $('#edit_mybarangayid_contactno').val(response.barangayid.contactno);
      $('#edit_mybarangayid_addressNo').val(response.barangayid.addressNo);
      $('#edit_mybarangayid_street').val(response.barangayid.street);
      $('#edit_mybarangayid_addressZone').val(response.barangayid.addressZone);
      $('#edit_mybarangayid_precintNo').val(response.barangayid.precintNo);
      $('#edit_mybarangayid_contactperson').val(response.barangayid.contactperson);
      $('#edit_mybarangayid_guardianContact').val(response.barangayid.guardianContact);
      $('#edit_mybarangayid_guardianAddress').val(response.barangayid.guardianAddress);
      $('#edit_mybarangayid_precintNo').val(response.barangayid.precintNo);
      $('#edit_mybarangayid_id').val(response.barangayid.id);
    }
  });
});// end #document #editbarangayidsbtn
$(document).ready(function() {
  var validationBarangayid = $('#myBarangayidEditForm').validate({
      rules: {
        precintNo: { required: true },
        contactperson: { required:true },
        guardianContact: { required:true, maxlength:12 },
        guardianAddress: { required:true }
      },
      messages: {
        precintNo: { required:"Please input your precint number" },
        contactperson: { required:"Please input your guardian's name" },
        guardianContact: { required:"Please input your guardian's contact number", maxlength:"Contact number should consist of 11 digits only." },
        guardianAddress: { required:"Please input your guardian's address." },
      },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng myBarangayidEditForm.validate()
   validationBarangayid.form();
   $('#myBarangayidEditForm').submit(function(e){
    e.preventDefault();
     if(!validationBarangayid.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_mybarangayid_id').val();
      console.log(id);
      $("#barangayIdUpdate").text("Updating...");
      $.ajax({
        url: "/api/barangayid/"+id,
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
              'Barangay ID application Updated Successfully',
              'success'
              )
          }
          $("#barangayIdUpdate").text('Update');
          $("#myBarangayidEditForm")[0].reset();
          $("#editMyBarangayidModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng barangayIdUpdate.submit
});// end document.ready barangayidUpdateForm
$(document).on( 'click', '.showMyBarangayidbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#showBarangayIdModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/barangayid/show/" + id,
    success: function(response){
      console.log(response);
      $('#show_mybarangayid_status').val(response.barangayid.status);
      $('#show_mybarangayid_id_img').html('<img class="rounded-circle d-block avatar" src="storage/users/'+response.barangayid.id_img+'" alt="Image" height="100px" width="100px"/>');
      
      $('#show_mybarangayid_fullname').val(response.barangayid.fullname);
      $('#show_mybarangayid_birthdate').val(response.barangayid.birthdate);
      $('#show_mybarangayid_contactno').val(response.barangayid.contactno);
      $('#show_mybarangayid_addressNo').val(response.barangayid.addressNo);
      $('#show_mybarangayid_street').val(response.barangayid.street);
      $('#show_mybarangayid_addressZone').val(response.barangayid.addressZone);
      $('#show_mybarangayid_precintNo').val(response.barangayid.precintNo);
      $('#show_mybarangayid_contactperson').val(response.barangayid.contactperson);
      $('#show_mybarangayid_guardianContact').val(response.barangayid.guardianContact);
      $('#show_mybarangayid_guardianAddress').val(response.barangayid.guardianAddress);
      $('#show_mybarangayid_precintNo').val(response.barangayid.precintNo);
      $('#show_mybarangayid_id').val(response.barangayid.id);
    }
  });
});// end #document #showbarangayidsbtn

//in my request section
$(document).on( 'click', '.editMyBarangayidModal', function (e) {
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
    }
  });
});// end #document #editbarangayidsbtn
$(document).ready(function() {
  var formData = new FormData(this);
  var id = $('#edit_barangayid_id').val();
  console.log(id);
  $("#barangayIdUpdate").text("Updating...");
  $.ajax({
    url: "/api/barangayid/"+id,
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
          'Barangay ID application Updated Successfully',
          'success'
        )
      }
      $("#barangayIdUpdate").text('Update');
      $("#updateBarangayidForm")[0].reset();
      $("#editBarangayIdModal").modal('hide');
    }
  });
});// end document.ready barangayidUpdateForm
$(document).ready(function() {
  $('.deleteMyBarangayidbtn').on( 'click', function (e) {
    var id = $(this).val();
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
          success: function(data, requestdocuments) {
            console.log(data);
            console.log(requestdocuments);
            Swal.fire({
              title: 'Deleted!',
              icon: 'success',
              confirmButtonText: 'Okay',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                location.reload();
              } 
            })
            
          },
          error: function(error) {
            console.log('error');
          }
        });
        
      }
    })
  });//  end clearance delete
});

//admin



//reports 
$(document).ready(function() {
  $('#reportsBarangayidTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/report-barangay-id/all",
			dataSrc: "",
      method: "get",
		},
		select: true,
		dom: 'Bfrtip',
    lengthChange: false,
		buttons: [
      'excel', 'pdf','print',
    ],
		columns: [
      { "data": "count" },
      { "data": "street" },
    ],
  });//	end reportsBarangayidTable
});