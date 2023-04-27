$(document).ready(function() {
    $('#scholarshipForm')[0].reset();
        var validationScholarship = $('#scholarshipForm').validate({
          rules: {
            scholarFname: { required:true, minlength: 1 },
            scholarPhonenum: { required:true, maxlength: 12 },
            scholarSchool: { required:true},
            scholarCourse: { required:true },
            scholarCor_img: { required:true },
            scholarGrade_img: { required:true },
          },
          messages: {
            scholarFname: { required:"Please input your first name", minlength:"It should consist of 2 or more characters" },
            scholarPhonenum: { required:"Please input your surname", maxlength: "Contact number should consist of 11 digits only." },
            scholarSchool: { required:"Please input your current school (Ex. TUP-T)" },
            scholarCourse: { required:"Please input your course (Ex. BSIT)" },
            scholarCor_img: { required:"Please upload your current COR." },
            scholarGrade_img: { required:"Please upload your past term grade." },
          },
          errorPlacement: function(error, element){
              error.insertAfter(element)
          }
        });//  end ng login-form.validate()
       $('#scholarshipForm').submit(function(e){
        e.preventDefault();
        var $form = $(this);
         if(!validationScholarship.form()){
        //    alert('Incomplete data. Please check your input');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please check your application form.',
            })
         } 
         else{
          var formData = new FormData(this);
          $("#scholarshipSubmit").text("Submitting...");
          url = $form.attr('action');
          // console.log(formData);
          $.ajax({
            url: url,
            type: "post",
            headers: {'X-CSRF-Token': '{{ csrf_token() }}',},
            data: formData, 
            cache: false,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function(res) {
              if(res.success == true){
                console.log(res);
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Thank you! Please wait for the notification for further instructions.',
                });
              }
              $("#scholarshipSubmit").text("Submit");
              $('#scholarshipForm')[0].reset();
            }
          });
         }//  end ng else
       });//  end ng barangayidSubmit.submit
});// end document.ready scholarship
$(document).on( 'click', '.editMyScholarshipApplicationbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editMyScholarshipApplication').modal('show');
  $.ajax({
    type: "GET",
    url: "api/scholarship-application/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_myscholarapplication_scholarFname').val(response.scholarship.scholarFname);
      $('#edit_myscholarapplication_scholarPhonenum').val(response.scholarship.scholarPhonenum);
      $('#edit_myscholarapplication_scholarSchool').val(response.scholarship.scholarSchool);
      $('#edit_myscholarapplication_scholarEmail').val(response.scholarship.scholarEmail);
      $('#edit_myscholarapplication_scholarCourse').val(response.scholarship.scholarCourse);
      $('#edit_myscholarapplication_status').val(response.scholarship.status);
      $('#edit_myscholarapplication_id').val(response.scholarship.id);
      $('#edit_myscholarapplication_scholarCor_img').html('<img src="storage/scholarships/'+response.scholarship.scholarCor_img+'" height="400" width="700" style="display:block;id="edit_myscholarapplication_scholarCor_img"></img>');
      $('#edit_myscholarapplication_scholarGrade_img').html('<img src="storage/scholarships/'+response.scholarship.scholarGrade_img+'" height="400" width="700" style="display:block;id="edit_myscholarapplication_scholarGrade_img"></img>');
      $('#edit_myscholarapplication_comment').val(response.comment.comment);
    }
  });
});// end #document #editcomplaintbtn
$(document).ready(function() {
  $('#editMyscholarshipApplicationForm').get(0).reset();
    var validationScholarshipApplication = $('#editMyscholarshipApplicationForm').validate({
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
    });//  end ng editMyscholarshipApplicationForm.validate()
   validationScholarshipApplication.form();
   $('#editMyscholarshipApplicationForm').submit(function(e){
    e.preventDefault();
     if(!validationScholarshipApplication.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_myscholarapplication_id').val();
      console.log(id);
      $("#scholarshipApplicationUpdate").text("Updating...");
      $.ajax({
        url: "/api/scholarship-application/"+id,
        type: "POST",
        data: formData, 
        cache: false,
        processData: false, 
        contentType: false, 
        dataType: "json",
        success: function(response) {
          console.log(response);
          if(response.status == 200){
            $("#scholarshipApplicationUpdate").text('Update');
            $("#editMyscholarshipApplicationForm")[0].reset();
            $("#editMyScholarshipApplication").modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Updated',
              text: 'Scholarship Application Updated Successfully',
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
   });//  end ng scholarshipApplicationUpdate.submit
});// end document.ready editMyscholarshipApplicationForm
$(document).on( 'click', '.showMyScholarshipApplicationbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#showScholarshipApplicationModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/scholarship-application/show/" + id,
    success: function(response){
      console.log(response);
      $('#show_myscholarapplication_scholarFname').val(response.scholarship.scholarFname);
      $('#show_myscholarapplication_scholarPhonenum').val(response.scholarship.scholarPhonenum);
      $('#show_myscholarapplication_scholarSchool').val(response.scholarship.scholarSchool);
      $('#show_myscholarapplication_scholarEmail').val(response.scholarship.scholarEmail);
      $('#show_myscholarapplication_scholarCourse').val(response.scholarship.scholarCourse);
      $('#show_myscholarapplication_status').val(response.scholarship.status);
      $('#show_myscholarapplication_id').val(response.scholarship.id);
      $('#show_myscholarapplication_scholarCor_img').html('<img src="storage/scholarships/'+response.scholarship.scholarCor_img+'" height="400" width="700" style="display:block;id="show_myscholarapplication_scholarCor_img"></img>');
      $('#show_myscholarapplication_scholarGrade_img').html('<img src="storage/scholarships/'+response.scholarship.scholarGrade_img+'" height="400" width="700" style="display:block;id="show_myscholarapplication_scholarGrade_img"></img>');
      $('#show_myscholarapplication_comment').val(response.comment.comment);
    }
  });
});// end #document #editcomplaintbtn

//admin
