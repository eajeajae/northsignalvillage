$(document).ready(function() {
  $('#registerForm')[0].reset();
  var validationRegister = $('#registerForm').validate({
    rules: {
      name: {required: true, minlength: 1},
      email: { required:true, email:true},
      password: { required:true, minlength: 7},
      password_confirm: { minlength: 7, equalTo: "#password"}
    },
    errorPlacement: function( error, element ) {
      var n = element.attr("name");
      if (n == "name")
      element.attr("placeholder", "Please enter your Full Name. Ex. Juan Dela Cruz");
      else if (n == "email")
      element.attr("placeholder", "Please enter your email address");
      else if (n == "password")
      element.attr("placeholder", "Please enter your password. At least 8 Characters or more.");
      else if (n == "password_confirm")
      element.attr("placeholder", "Your password is incorrect.");
    },
    unhighlight: function(element) {
      $(element).removeClass('errorClass');
    },
  });//  end ng login-form.validate()
  $('#registerForm').submit(function(e){
    e.preventDefault();
    if(!validationRegister.form()){
      // alert('Incomplete data. Please check your input');
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please check your registration',
      })
    } 
    else{
      var formData = new FormData(this);
      $("#registerSubmit").text("Loading...");
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/api/post-register',
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(res) {
          if(res.status == 200){
            Swal.fire({
              icon: 'success',
              title: 'Registered',
              text: 'Thank you! Please wait for the personnel to verify your account.',
            });
            $('#registerForm')[0].reset();
          }
        }
      });
    }//  end ng else
  });//  end ng registerSubmit.submit
});// end document.ready loginregister