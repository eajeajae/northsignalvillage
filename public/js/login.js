$(document).ready(function() {
  $('#loginForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $("#loginSubmit").text("Login...");
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: 'post-login',
      type: 'POST', 
      data: formData,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      cache: false,
      processData: false, 
      contentType: false ,
      success: function(res) {
        // console.log(formData);
        if(res.status == 200){
          alert( "Load was performed." );
        }
        else{
          alert('nako po! mali ang iyong login')
        }
      }
    });
  });//  end ng loginSubmit.submit
});// end document.ready loginregister
