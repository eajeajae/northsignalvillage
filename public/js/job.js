$(document).ready(function() {
    var validationEmployer = $('#jobForm').validate({
      rules: {
        employer_id: { required:true },
        job: { required:true },
        jobDesc: { required:true },
      },
      messages: {
        employer_id: { required:"Please add the company logo" },
        job: { required:"Please add the name of the company" },
        jobDesc: { required:"Please add a description of the company"  },
      },
      errorPlacement: function(error, element){
          error.insertAfter(element)
      }
    });//  end ng login-form.validate()
   $('#jobForm').submit(function(e){
    e.preventDefault();
    var $form = $(this);
     if(!validationEmployer.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      $("#jobSubmit").text("Adding...");
      // console.log(formData);
      url = $form.attr('action');
      $.ajax({
        type: 'POST',
        url: url,
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
                text: 'New Employer has been added!',
            });
          }
          $("#jobSubmit").text("Add");
          $('#jobForm')[0].reset();
          $("#jobModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng jobSubmit.submit
      // employer table
        $('#jobofferTable').DataTable({
        ajax: {
          url :"/api/joboffer/all",
          dataSrc: "",
          method: "get",
            },
            select: true,
            dom: 'Bfrtip',
        lengthChange: false,
            buttons: [
          'colvis', 'excel', 'pdf', 'print',
    
          {
            text: '+',
            className: 'btn btn-primary',
            action: function ( e, dt, node, config ) {
            // alert( 'Button activated' )
              $("#jobForm").trigger("reset");
              $('#jobModal').modal('show');
            }
          }
        ],
            columns: [
          { "data": "id" },
          { "data": "employer_id" },
          { "data": "job" },
          { "data": "jobDesc" },
          { "data" : null, render : function ( data, type, row ) {
            return "<button type='button' value="+data.id+" class='editEmployerbtn btn btn-primary btn-sm' ><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteEmployerbtn btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>"
          } }
        ],
      });//	end employerTable
  
      
});

$(document).ready(function() {

    // employer table
    var id = $('#get_joboffer_id').val();
    

    
});