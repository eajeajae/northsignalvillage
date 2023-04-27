$(document).ready(function() {
    $(function() {
      var validationClearance = $('#clearanceForm').validate({
        rules: {
          purpose: { required:true },
          isRegistered: { required:true },
          havePendingCase: { required:true },
          name: { required:true, minlength:3 },
          gender: { required: true },
          birthdate: { required:true },
          p_birth: { required:true },
          nationality: { required:true },
          contact_num: { required:true, maxlength:13 },
          c_status: { required:true },
          address: { required:true },
          yearLiving: { required:true },
          areYouSure: { required:true },
        },
        messages: {
            purpose: { required:"Please state your purpose in requesting" },
            isRegistered: { required:"Please choose whether you are registered or not." },
            havePendingCase: { required:"Please be honset in answering this question." },
            name: { required:"Please input your full name", minlength:"Please input our name. It consist of given name and surname." },
            gender: { required: "Please choose your gender" },
            birthdate: { required:"Please select your date of birth" },
            p_birth: { required:"Please input your place of birth" },
            nationality: { required:"Please input your nationality" },
            contact_num: { required:"Please input your contact number", maxlength:"Contact number should consists of minimum of 11 digits" },
            c_status: { required:"Please select your civil status" },
            address: { required:"Please input your address" },
            yearLiving: { required:"Please input number of years living here in Barangay North Signal" },
            areYouSure: { required:"This is to ensure that all of the information here are honest and correct." },
        },
        errorPlacement: function(error, element){
            if (element.is(':checkbox')){
                error.insertAfter($('input:checkbox:last').next('label'))
             }  
             else {
               error.insertAfter(element)
             }
        }
      });//  end ng clearanceForm.validate()
      $('#clearanceForm').submit(function(e){
        e.preventDefault();
        var $form = $(this);
        if(!validationClearance.form()){
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please check your form.',
          })
        } 
        else{
          var formData = new FormData(this);
          $("#clearanceSubmit").text("Submitting...");
          url = $form.attr('action');
          $.ajax({
            url: 'api/clearance/create',
            type: 'post',
            data: formData, 
            cache: false,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function(res) {
              console.log(res);
              if(res.status == 200){
                Swal.fire({
                  icon: 'success',
                  title: 'Submitted',
                  text: 'Thank you! Please wait for the notification after you pay for your request.',
                });
                console.log(res);
              }
              $("#clearanceSubmit").text("Submit");
              $('#clearanceForm')[0].reset();
            }
          });
        }//  end ng else
      });//  end ng clearanceSubmit.submit
    });//end ng clearanceForm function
  });// end document.ready barangayid

//editMyClearance
$(document).on( 'click', '.editMyClearancebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editMyClearanceModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/clearance/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_myclearance_typeofrequest_id').val(response.clearance.typeofrequest_id);
      $('#edit_myclearance_purpose').val(response.clearance.purpose);
      $('#edit_myclearance_isRegistered').val(response.clearance.isRegistered);
      $('#edit_myclearance_havePendingCase').val(response.clearance.havePendingCase);
      $('#edit_myclearance_name').val(response.clearance.name);
      $('#edit_myclearance_gender').val(response.clearance.gender);
      $('#edit_myclearance_birthdate').val(response.clearance.birthdate);
      $('#edit_myclearance_p_birth').val(response.clearance.p_birth);
      $('#edit_myclearance_nationality').val(response.clearance.nationality);
      $('#edit_myclearance_contact_num').val(response.clearance.contact_num);
      $('#edit_myclearance_c_status').val(response.clearance.c_status);
      $('#edit_myclearance_addressNo').val(response.clearance.addressNo);
      $('#edit_myclearance_street').val(response.clearance.street);
      $('#edit_myclearance_addressZone').val(response.clearance.addressZone);
      $('#edit_myclearance_businessAddress').val(response.clearance.businessAddress);
      $('#edit_myclearance_provincialAddress').val(response.clearance.provincialAddress);
      $('#edit_myclearance_yearLiving').val(response.clearance.yearLiving);
      $('#edit_myclearance_id').val(response.clearance.id);
    }
  });
});// end #document #editMyclearancebtn
$(document).ready(function() {
  var validationUpdateClearance = $('#myClearanceEditForm').validate({
    rules: {
      purpose: { required:true },
      isRegistered: { required:true },
      havePendingCase: { required:true },
      name: { required:true, minlength:3 },
      gender: { required: true },
      birthdate: { required:true },
      p_birth: { required:true },
      nationality: { required:true },
      contact_num: { required:true, maxlength:13 },
      c_status: { required:true },
      address: { required:true },
      yearLiving: { required:true },
      areYouSure: { required:true },
    },
    messages: {
        purpose: { required:"Please state your purpose in requesting" },
        isRegistered: { required:"Please choose whether you are registered or not." },
        havePendingCase: { required:"Please be honset in answering this question." },
        name: { required:"Please input your full name", minlength:"Please input our name. It consist of given name and surname." },
        gender: { required: "Please choose your gender" },
        birthdate: { required:"Please select your date of birth" },
        p_birth: { required:"Please input your place of birth" },
        nationality: { required:"Please input your nationality" },
        contact_num: { required:"Please input your contact number", maxlength:"Contact number should consists of minimum of 11 digits" },
        c_status: { required:"Please select your civil status" },
        address: { required:"Please input your address" },
        yearLiving: { required:"Please input number of years living here in Barangay North Signal" },
        areYouSure: { required:"This is to ensure that all of the information here are honest and correct." },
    },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng myClearanceEditForm.validate()
   validationUpdateClearance.form();
   $('#myClearanceEditForm').submit(function(e){
    e.preventDefault();
     if(!validationUpdateClearance.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_myclearance_id').val();
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
            $("#clearanceUpdate").text('Update');
            $("#myClearanceEditForm")[0].reset();
            $("#editMyClearanceModal").modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Updated',
              text: 'Updated Successfully! Please wait for the email notification, on when you can get your requested clearance.',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                location.reload();
              } 
            })
          }
        }
      });
     }//  end ng else
   });//  end ng clearanceUpdate.submit
});// end document.ready myClearanceEditForm
$(document).on( 'click', '.showMyClearancebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#showMyClearanceModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/clearance/show/" + id,
    success: function(response){
      console.log(response);
      $('#show_myclearance_status').val(response.clearance.status);
      $('#show_myclearance_typeofrequest_id').val(response.clearance.typeofrequest_id);
      $('#show_myclearance_purpose').val(response.clearance.purpose);
      $('#show_myclearance_isRegistered').val(response.clearance.isRegistered);
      $('#show_myclearance_havePendingCase').val(response.clearance.havePendingCase);
      $('#show_myclearance_name').val(response.clearance.name);
      $('#show_myclearance_gender').val(response.clearance.gender);
      $('#show_myclearance_birthdate').val(response.clearance.birthdate);
      $('#show_myclearance_p_birth').val(response.clearance.p_birth);
      $('#show_myclearance_nationality').val(response.clearance.nationality);
      $('#show_myclearance_contact_num').val(response.clearance.contact_num);
      $('#show_myclearance_c_status').val(response.clearance.c_status);
      $('#show_myclearance_addressNo').val(response.clearance.addressNo);
      $('#show_myclearance_street').val(response.clearance.street);
      $('#show_myclearance_addressZone').val(response.clearance.addressZone);
      $('#show_myclearance_businessAddress').val(response.clearance.businessAddress);
      $('#show_myclearance_provincialAddress').val(response.clearance.provincialAddress);
      $('#show_myclearance_yearLiving').val(response.clearance.yearLiving);
      $('#show_myclearance_id').val(response.clearance.id);
    }
  });
});// end #document #showMyclearancebtn

//in my request section 
$(document).on( 'click', '.editMyClearancerequestbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editMyClearanceModal').modal('show');
  $.ajax({
    type: "GET",
    url: "/api/clearance/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_myclearance_typeofrequest_id').val(response.clearance.typeofrequest_id);
      $('#edit_myclearance_purpose').val(response.clearance.purpose);
      $('#edit_myclearance_isRegistered').val(response.clearance.isRegistered);
      $('#edit_myclearance_havePendingCase').val(response.clearance.havePendingCase);
      $('#edit_myclearance_name').val(response.clearance.name);
      $('#edit_myclearance_gender').val(response.clearance.gender);
      $('#edit_myclearance_birthdate').val(response.clearance.birthdate);
      $('#edit_myclearance_p_birth').val(response.clearance.p_birth);
      $('#edit_myclearance_nationality').val(response.clearance.nationality);
      $('#edit_myclearance_contact_num').val(response.clearance.contact_num);
      $('#edit_myclearance_c_status').val(response.clearance.c_status);
      $('#edit_myclearance_addressNo').val(response.clearance.addressNo);
      $('#edit_myclearance_street').val(response.clearance.street);
      $('#edit_myclearance_addressZone').val(response.clearance.addressZone);
      $('#edit_myclearance_businessAddress').val(response.clearance.businessAddress);
      $('#edit_myclearance_provincialAddress').val(response.clearance.provincialAddress);
      $('#edit_myclearance_yearLiving').val(response.clearance.yearLiving);
      $('#edit_myclearance_id').val(response.clearance.id);
    }
  });
});// end #document #editClearancebtn
$(document).ready(function() {
  var validationUpdateClearance = $('#clearanceUpdateForm').validate({
    rules: {
      purpose: { required:true },
      isRegistered: { required:true },
      havePendingCase: { required:true },
      name: { required:true, minlength:3 },
      gender: { required: true },
      birthdate: { required:true },
      p_birth: { required:true },
      nationality: { required:true },
      contact_num: { required:true, maxlength:13 },
      c_status: { required:true },
      address: { required:true },
      yearLiving: { required:true },
      areYouSure: { required:true },
    },
    messages: {
        purpose: { required:"Please state your purpose in requesting" },
        isRegistered: { required:"Please choose whether you are registered or not." },
        havePendingCase: { required:"Please be honset in answering this question." },
        name: { required:"Please input your full name", minlength:"Please input our name. It consist of given name and surname." },
        gender: { required: "Please choose your gender" },
        birthdate: { required:"Please select your date of birth" },
        p_birth: { required:"Please input your place of birth" },
        nationality: { required:"Please input your nationality" },
        contact_num: { required:"Please input your contact number", maxlength:"Contact number should consists of minimum of 11 digits" },
        c_status: { required:"Please select your civil status" },
        address: { required:"Please input your address" },
        yearLiving: { required:"Please input number of years living here in Barangay North Signal" },
        areYouSure: { required:"This is to ensure that all of the information here are honest and correct." },
    },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng clearanceUpdateForm.validate()
   validationUpdateClearance.form();
   $('#clearanceUpdateForm').submit(function(e){
    e.preventDefault();
     if(!validationUpdateClearance.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
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
              'Clearance application Updated Successfully',
              'success'
              )
          }
          $("#clearanceUpdate").text('Update');
          $("#clearanceUpdateForm")[0].reset();
          $("#editClearanceModal").modal('hide');
          location.reload();
        }
      });
     }//  end ng else
   });//  end ng clearanceUpdate.submit
});// end document.ready clearanceUpdateForm
$(document).on( 'click', '.deleteMyClearancerequestbtn', function (e) {
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
        url: "/api/clearance/delete/"+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(data) {
          console.log(data);
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
});//  end #myrequest delete

//admin

  $(document).ready(function() {
    $('#reportsClearanceTable').DataTable({
      order: [[ 0, 'desc' ]],
      ajax: {
        url :"/api/report-clearance/all",
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
    });//	end reportsClearanceTable
  });