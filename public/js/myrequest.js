$(document).ready(function() {
  $('#proceedBtn').click( function (e) {
	// e.preventDefault();
  	$('#submitForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $("#proceedBtn").text("Submitting...");
      // console.log(formData);
			$.ajax({
				type: 'POST',
				url: 'api/myrequests/submit-payment',
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
            text: 'Thank you! You are now paid. You can check your profile for the lists documents you request.',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              location.reload();
            } 
          })
				}
				("#proceedBtn").text("Submit");
				location.reload(true);
				}
			});
		});//  end ng submitRequest.submit    
	});
  $('#modeofpayment-gcash').click( function (e) {
    e.preventDefault();
    var formData = new FormData(document.getElementById("submitForm"));
    // var $form = $("#barangayid_id");
    // modeofpayment = $form.attr('value');
    //   alert(modeofpayment);
      $.ajax({
				type: 'POST',
				url: 'api/myrequests/submit-payment',
				data: formData, 
				cache: false,
				processData: false, 
				contentType: false, 
				dataType: 'json',
				success: function(res) {
				if(res.status == 200){
					$('#proceedGcashpaymentModal').modal('show');
          $('#transactiondetail_id').val(res.transactiondetailId.id);
				}
				}
			});
      // $('#edit_otherdonation_items').val();
      // $('#edit_otherdonation_quantity').val();
      // $('#edit_otherdonation_id').val();
  });
  // $('#sampleModal').click(function (e) {
  //   $('#proceedGcashpaymentModal').modal('show');
  // });
});
$(document).ready(function() {
  var validationGcashPayment = $('#gcashpaymentForm').validate({
    rules: {
      gcashName: { required:true },
      gcashNumber: { required:true },
      payment_img: { required:true },
    },
    messages: {
      gcashName: { required:"Please input gcash name you used." },
      gcashNumber: { required:"Please input gcash number you used." },
      payment_img: { required:"Please upload the receipt downloaded from the app."  },
    },
    errorPlacement: function(error, element){
      error.insertAfter(element)
    }
  });//  end ng login-form.validate()
 $('#gcashpaymentForm').submit(function(e){
  e.preventDefault();
   if(!validationGcashPayment.form()){
    Swal.fire({
      icon: 'warning',
      title: 'Oops',
      text: 'Please check your form.',
    })
   } 
   else{
    var formData = new FormData(this);
    $("#gcashpaymentSubmit").text("Submitting...");
				console.log(formData);
			  $.ajax({
			    type: 'POST',
			    url: 'api/myrequests/submit-gcash-payment',
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
			            text: 'Thank you! You are now paid. You can check your profile for the lists documents you request.',
			        }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  location.reload();
                } 
              })
			      }
			      $("#gcashpaymentSubmit").text("Submit");
			      $('#gcashpaymentForm')[0].reset();
			      $("#proceedGcashpaymentModal").modal('hide');
			    }
			  });
   }//  end ng else
 });//  end ng addAdminForm.submit   
});
