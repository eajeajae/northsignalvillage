$(document).ready(function() {
  var validationApplicationForm = $('#applicantForm').validate({
    rules: {
      resume_file: { required:true }
    },
    messages: {
      resume_file: { required:"Please submit your resume first." }
    },
    errorPlacement: function(error, element){
        error.insertAfter(element)
    }
  });//  end ng login-form.validate()
  $('#applicantForm').submit(function(e){
    e.preventDefault();
    var $form = $(this);
    if(!validationApplicationForm.form()){
    //    alert('Incomplete data. Please check your input');
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please check your form.',
      })
    } 
    else{
      var formData = new FormData(this);
      var id = $('#get_joboffer_id').val();
      $("#applicantSubmit").text("Submitting...");
      // console.log(formData);
      $.ajax({
        type: 'POST',
        url: '/api/apply-job/'+id+'/store',
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
              text: 'Thank you! Please wait for the notificaion whether you are qualified or not.',
            });
          }
          $("#applicantSubmit").text("Submit Resume");
          $('#applicantForm')[0].reset();
        }
      });
    }//  end ng else
  });//  end ng donationSubmit.submit
  
  //employer table
  $('#applicantTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/applicants/all",
      dataSrc: "",
      method: "get",
        },
        select: true,
        dom: 'Bfrtip',
    lengthChange: false,
        buttons: [
      'colvis', 'excel', 'pdf', 'print',

    ],
    columns: [
      { "data": "id", "name": "applicants.id" },
      { "data": "name", "name": "users.name" },
      { "data": "companyName", "name": "employers.companyName" },
      { "data": "job", "name": "joboffer.job" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editApplicationbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-eye'></i></button><button type='button' data-id="+data.id+" class='deleteApplicationbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end employerTable

  $(document).on( 'click', '.editApplicationbtn', function (e) {
    e.preventDefault();
    var id = $(this).val();
    console.log(id);
    $('#editApplicationModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/applicants/edit/" + id,
      success: function(response){
        // var img = '<img src="{{asset(Storage::url('uploadedImages'))}}/'+data+'" width="100" height="100" id="insertedImages">';
    //  $("#insertedImages").html(img);  
        console.log(response);
        $('#edit_application_id').val(response.applicant.id);
        $('#edit_application_resume').html('<iframe src="'+response.applicant.resume_file+'" height="400" width="700" style="display:block;"frameborder="0" id="edit_application_resume"></iframe>');
      }
    });
  });// end #document #editApplicationbtn
  $(document).on( 'click', '.deleteApplicationbtn', function (e) {
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
          url: "/api/applicants/"+ id,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: "json",
          success: function(data) {
            console.log(data);
            Swal.fire(
              'Deleted!',
              'Application has been deleted.',
              'success'
            ) 
            $('#applicantTable').DataTable().ajax.reload();
          },
          error: function(error) {
            console.log('error');
          }
        });
        
      }
    })
  });//  end #vaccineTable delete
});//  end ng document.ready