$(document).ready(function() {
  var validationContactus = $('#contactusForm').validate({
    rules: {
      inquiry: { required:true },
    },
    messages: {
      inquiry: { required:"Please input your inquiry." },
    },
    errorPlacement: function(error, element){
        error.insertAfter(element)
    }
  });//  end ng login-form.validate()
 $('#contactusForm').submit(function(e){
  e.preventDefault();
   if(!validationContactus.form()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please check your form',
  });
   } 
   else{
    var formData = new FormData(this);
    $("#contactusSubmit").text("Submitting...");
    $.ajax({
      type: 'post',
      url: '/send-email',
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: 'json',
      success: function(res) {
        if(res.status == 200){
          // alert('hello');
          Swal.fire({
              icon: 'success',
              title: 'Submitted',
              text: 'Submitted successfuly! Wait for our response with regards to your inquiry, thank you.',
          });
          // $('#adminTable').DataTable().ajax.reload();
        }
        $("#contactusSubmit").text("Submit");
        $('#contactusForm')[0].reset();
        $("#contactUsModal").modal('hide');
      }
    });
   }//  end ng else
 });
});// end document.ready loginregister