$(document).ready(function() {
    var validationEmployee = $('#employeeForm').validate({
      rules: {
        name: { required:true },
        birthdate: { required:true },
        age: { required:true },
        phoneNum: { required:true },
        address: { required:true },
        email: { required:true },
        avatar: { required:true },
      },
      messages: {
        name: { required:"Please input their name" },
        birthdate: { required:"Please input their birthdate" },
        age: { required:"Please input their age"  },
        phoneNum: { required:"Please input their contact number"  },
        address: { required:"Please input their home address"  },
        email: { required:"Please input their email address"  },
        avatar: { required:"Please select profile picture"  },
      },
      errorPlacement: function(error, element){
          error.insertAfter(element)
      }
    });//  end ng login-form.validate()
   $('#employeeForm').submit(function(e){
    e.preventDefault();
    var $form = $(this);
     if(!validationEmployee.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      $("#employeeSubmit").text("Adding...");
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
          $("#employeeSubmit").text("Add");
          $('#employeeForm')[0].reset();
          $("#employeeModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng employerSubmit.submit
      // employer table
        $('#employeeTable').DataTable({
          order: [[ 0, 'desc' ]],
        ajax: {
          url :"/api/employee/all",
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
              $("#employeeForm").trigger("reset");
              $('#employeeModal').modal('show');
            }
          } 
        ],
            columns: [
          { "data": "id" },
          { "data" : null, render : function ( data, type, row ) {
            return "<img src="+data.avatar +" width='100px', height='100px'/>";
          } },
          { "data": "name" },
          { "data": "birthdate" },
          { "data": "age" },
          { "data": "address" },
          { "data": "phoneNum" },
          { "data": "email" },
          { "data" : null, render : function ( data, type, row ) {
            // return "<a href='#' data-bs-toggle='modal' data-bs-target='#editAnimalModal' id='editAnimalbtn' data-id="+ data.id + "><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></i></a><a href='#'  class='deleteAnimalbtn' data-id="+ data.id + "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i>";
            return "<button type='button' value="+data.id+" class='editEmployeebtn btn btn-primary btn-sm' >Edit</button><button type='button' data-id="+data.id+" class='deleteEmployeebtn btn btn-danger btn-sm'>Delete</button>"
          } }
        ],
      });//	end employerTable
  
      
  });
  