$(document).ready(function() {
    var validationUpdate = $('#profileForm').validate({
      rules: {
        name: { required:true },
        birthdate: { required:true },
        age: { required:true },
        phoneNum: { required:true, maxlength:13 },
        addressNo: { required:true },
        street: { required:true },
      },
      messages: {
        name: { required:"Please input your name" },
        birthdate: { required:"Please input your birthdate" },
        age: { required:"Please input your age"  },
        phoneNum: { required:"Please input your contact number", maxlength:"Phone number should consist of 11 digits"  },
        addressNo: { required:"Please input your home address"  },
        street: { required:"Please input your home address"  },
      },
      errorPlacement: function(error, element){
          error.insertAfter(element)
      }
    });//  end ng login-form.validate()
   $('#profileForm').submit(function(e){
    e.preventDefault();
    var $form = $(this);
     if(!validationUpdate.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      $("#updateprofileSubmit").text("Updating...");
      // console.log(formData);
      // var id = $('#edit_user_id').val('id');
      url = $form.attr('action');
      $.ajax({
        type: "POST",
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
                text: 'Your profile is updated!',
            });
          }
          $("#updateprofileSubmit").text("Update");
          $('#profileForm')[0].reset();
          $("#updateprofileModal").modal('hide');
          location.reload();
        }
      });
     }//  end ng else
   });//  end ng employerSubmit.submit
   
});
