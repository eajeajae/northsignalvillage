$(document).ready(function() {
  var validationEmployer = $('#employerForm').validate({
    rules: {
      company_img: { required:true },
      companyName: { required:true },
      companyDesc: { required:true },
    },
    messages: {
      company_img: { required:"Please add the company logo" },
      companyName: { required:"Please add the name of the company" },
      companyDesc: { required:"Please add a description of the company"  },
    },
    errorPlacement: function(error, element){
        error.insertAfter(element)
    }
  });//  end ng login-form.validate()
 $('#employerForm').submit(function(e){
  e.preventDefault();
  var $form = $(this);
   if(!validationEmployer.form()){
     alert('Incomplete data. Please check your input');
   } 
   else{
    var formData = new FormData(this);
    $("#employerSubmit").text("Adding...");
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
        $("#employerSubmit").text("Add");
        $('#employerForm')[0].reset();
        $("#employerSubmit").modal('hide');
      }
    });
   }//  end ng else
 });//  end ng employerSubmit.submit
    // employer table
      $('#employerTable').DataTable({
        order: [[ 0, 'desc' ]],
      ajax: {
        url :"/api/employer/all",
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
            $("#employerForm").trigger("reset");
            $('#employerModal').modal('show');
          }
        }
      ],
          columns: [
        { "data": "id" },
        { "data" : null, render : function ( data, type, row ) {
          return "<img src="+data.company_img +" width='100px', height='100px'/>";
        } },
        { "data": "companyName" },
        { "data": "companyDesc" },
        { "data" : null, render : function ( data, type, row ) {
          return "<button type='button' value="+data.id+" class='editEmployerbtn btn btn-primary btn-sm' ><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteEmployerbtn btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>"
        } }
      ],
    });//	end employerTable

    
});
