$(document).ready(function() {
  $(function() {
      var validationCertificate = $('#certificateForm').validate({
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
            havePendingCase: { required:"Please be honest in answering this question." },
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
      });//  end ng certificateForm.validate()
      $('#certificateForm').submit(function(e){
        e.preventDefault();
        var $form = $(this);
        if(!validationCertificate.form()){
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please check your form.',
          })
        } 
        else{
          var formData = new FormData(this);
          $("#certificateSubmit").text("Submitting...");
          url = $form.attr('action');
          $.ajax({
            url: 'api/certificate/create',
            type: 'post',
            data: formData, 
            cache: false,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function(res) {
              if(res.status == 200){
                Swal.fire({
                  icon: 'success',
                  title: 'Submitted',
                  text: 'Thank you! Your request is submitted',
                });
                console.log(res);
              }
              $("#certificateSubmit").text("Submit");
              $('#certificateForm')[0].reset();
            }
          });
        }//  end ng else
      });//  end ng certificateSubmit.submit
  });//end ng certificateForm function
});// end document.ready barangayid
$(document).ready(function() {
    $(document).on( 'click', '.editMyCertificatebtn', function (e) {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);
      $('#editMyCertificateModal').modal('show');
      $.ajax({
        type: "GET",
        url: "api/certificate/edit/" + id,
        success: function(response){
          console.log(response);
          $('#edit_mycertificate_typeofrequest_id').val(response.certificate.typeofrequest_id);
          $('#edit_mycertificate_purpose').val(response.certificate.purpose);
          $('#edit_mycertificate_isRegistered').val(response.certificate.isRegistered);
          $('#edit_mycertificate_havePendingCase').val(response.certificate.havePendingCase);
          $('#edit_mycertificate_name').val(response.certificate.name);
          $('#edit_mycertificate_gender').val(response.certificate.gender);
          $('#edit_mycertificate_birthdate').val(response.certificate.birthdate);
          $('#edit_mycertificate_p_birth').val(response.certificate.p_birth);
          $('#edit_mycertificate_nationality').val(response.certificate.nationality);
          $('#edit_mycertificate_contact_num').val(response.certificate.contact_num);
          $('#edit_mycertificate_c_status').val(response.certificate.c_status);
          $('#edit_mycertificate_addressNo').val(response.certificate.addressNo);
          $('#edit_mycertificate_street').val(response.certificate.street);
          $('#edit_mycertificate_addressZone').val(response.certificate.addressZone);
          $('#edit_mycertificate_provincialAddress').val(response.certificate.provincialAddress);
          $('#edit_mycertificate_yearLiving').val(response.certificate.yearLiving);
          $('#edit_mycertificate_areYouSure').val(response.certificate.areYouSure);
          $('#edit_mycertificate_id').val(response.certificate.id);
        }
      }); 
    });// end #document #editCertificatebtn 
});
$(document).ready(function() {
    $('#myCertificateEditForm').get(0).reset();
    var validationCertificate = $('#myCertificateEditForm').validate({
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
          havePendingCase: { required:"Please be honest in answering this question." },
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
      });//  end ng myCertificateEditForm.validate()
     validationCertificate.form();
     $('#myCertificateEditForm').submit(function(e){
      e.preventDefault();
       if(!validationCertificate.form()){
         alert('Incomplete data. Please check your input');
       } 
       else{
        var formData = new FormData(this);
        var id = $('#edit_mycertificate_id').val();
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
              $("#certificateUpdate").text('Update');
              $("#myCertificateEditForm")[0].reset();
              $("#editMyCertificateModal").modal('hide');
              Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: 'Updated Successfully! Please wait for the email notification, on when you can get your requested certificate.',
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
     });//  end ng certificateUpdate.submit
});// end document.ready certificateUpdate
$(document).on( 'click', '.showMyCertificatebtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#showMyCertificateModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/certificate/show/" + id,
    success: function(response){
      console.log(response);
      $('#show_mycertificate_status').val(response.certificate.status);
      $('#show_mycertificate_typeofrequest_id').val(response.certificate.typeofrequest_id);
      $('#show_mycertificate_purpose').val(response.certificate.purpose);
      $('#show_mycertificate_isRegistered').val(response.certificate.isRegistered);
      $('#show_mycertificate_havePendingCase').val(response.certificate.havePendingCase);
      $('#show_mycertificate_name').val(response.certificate.name);
      $('#show_mycertificate_gender').val(response.certificate.gender);
      $('#show_mycertificate_birthdate').val(response.certificate.birthdate);
      $('#show_mycertificate_p_birth').val(response.certificate.p_birth);
      $('#show_mycertificate_nationality').val(response.certificate.nationality);
      $('#show_mycertificate_contact_num').val(response.certificate.contact_num);
      $('#show_mycertificate_c_status').val(response.certificate.c_status);
      $('#show_mycertificate_addressNo').val(response.certificate.addressNo);
      $('#show_mycertificate_street').val(response.certificate.street);
      $('#show_mycertificate_addressZone').val(response.certificate.addressZone);
      $('#show_mycertificate_provincialAddress').val(response.certificate.provincialAddress);
      $('#show_mycertificate_yearLiving').val(response.certificate.yearLiving);
      $('#show_mycertificate_areYouSure').val(response.certificate.areYouSure);
      $('#show_mycertificate_id').val(response.certificate.id);
    }
  }); 
});// end #document #showCertificatebtn 

// in my request section 
$(document).on( 'click', '.editMyCertificaterequestbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editMyCertificateModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/certificate/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_mycertificate_purpose').val(response.certificate.purpose);
      $('#edit_mycertificate_isRegistered').val(response.certificate.isRegistered);
      $('#edit_mycertificate_havePendingCase').val(response.certificate.havePendingCase);
      $('#edit_mycertificate_name').val(response.certificate.name);
      $('#edit_mycertificate_gender').val(response.certificate.gender);
      $('#edit_mycertificate_birthdate').val(response.certificate.birthdate);
      $('#edit_mycertificate_p_birth').val(response.certificate.p_birth);
      $('#edit_mycertificate_nationality').val(response.certificate.nationality);
      $('#edit_mycertificate_contact_num').val(response.certificate.contact_num);
      $('#edit_mycertificate_c_status').val(response.certificate.c_status);
      $('#edit_mycertificate_addressNo').val(response.certificate.addressNo);
      $('#edit_mycertificate_street').val(response.certificate.street);
      $('#edit_mycertificate_addressZone').val(response.certificate.addressZone);
      $('#edit_mycertificate_provincialAddress').val(response.certificate.provincialAddress);
      $('#edit_mycertificate_yearLiving').val(response.certificate.yearLiving);
      $('#edit_mycertificate_areYouSure').val(response.certificate.areYouSure);
      $('#edit_mycertificate_id').val(response.certificate.id);
    }
  }); 
});// end #document #editCertificatebtn
$(document).on( 'click', '.deleteMyCertificaterequestbtn', function (e) {
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
        url: "/api/certificate/delete/"+ id,
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
$(document).ready(function() {
  $('#certificateUpdateForm').get(0).reset();
  var validationCertificate = $('#certificateUpdateForm').validate({
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
        havePendingCase: { required:"Please be honest in answering this question." },
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
    });//  end ng certificateUpdateForm.validate()
   validationCertificate.form();
   $('#certificateUpdateForm').submit(function(e){
    e.preventDefault();
     if(!validationCertificate.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
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
            Swal.fire({
              icon: 'success',
              title: 'Updated',
              text: 'Updated Successfully!',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                location.reload(); //ajax.DataTable reload
              } 
            })
          }
          $("#certificateUpdate").text('Update');
          $("#certificateUpdateForm")[0].reset();
          $("#editCertificateModal").modal('hide');
          location.reload();
        }
      });
     }//  end ng else
   });//  end ng updateAnimalbtn.submit
});// end document.ready certificateUpdate

//reports 
$(document).ready(function() {
  $('#reportsCertificateTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/report-certificate/all",
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
  });//	end reportsCertificateTable
});