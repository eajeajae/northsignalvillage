$(document).ready(function () {
	$('#complaintForm')[0].reset();
	var validationComplaint = $('#complaintForm').validate({
		rules:{
            respondentName: { required:true, minlength: 1 },
            respondentAge: { required:true },
            complaintDesc: { required:true },
            complaintLocation: { required:true },
            complaintWhy: { required:true },
            complainantPrayer: { required:true },
            complaintDate: { required:true },
            complainantSignature_img: { required:true }
        },
        errorPlacement: function( error, element ){
            var n = element.attr("name");
            if (n == "respondentName")
            element.attr("placeholder", "Please enter their name");
            else if (n == "respondentAge")
            element.attr("placeholder", "Please enter their age");
            else if (n == "complaintDesc")
            element.attr("placeholder", "Please describe the incident.");
            else if (n == "complaintLocation")
            element.attr("placeholder", "Please enter the incident's location.");
            else if (n == "complaintWhy")
            element.attr("placeholder", "Please state your reason in filling this report.");
            else if (n == "complainantPrayer")
            element.attr("placeholder", "Please state what you want us to do with the incident.");
            else if (n == "complaintDate")
            element.attr("placeholder", "Please enter the date of the incident");
            else if (element.is(':checkbox')){
                error.insertAfter($('input:checkbox:last').next('label'))
            }
        },
        messages: {
            complainantAgrees: { required:"This is to testify that the inputted data are true."}
        },
        unhighlight: function(element){
            $(element).removeClass('errorClass');
        },
    }); //eng ng complaintForm.validate()
    $('#complaintForm').submit(function(e){
        e.preventDefault();
        var $form = $(this);
        if(!validationComplaint.form()){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please check your form',
            })
        }
        else
        {
            const formData = new FormData(this);
            $('#complaintSubmit').text("Submitting...");
            url = $form.attr('action');
            $.ajax({
                type: 'POST',
                url: 'api/complaint/create',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
									console.log(res);
                    if(res.status == 200){
                        Swal.fire({
                            icon: 'success',
                            title: 'Submitted Successfuly!',
                            text: 'Thank you!, Please wait for our notification on what status your request is',
                        })
                    }
                    $("#complaintSubmit").text('Submit');
                    $("#complaintForm")[0].reset();
                }
            });
        }
    });

});
$(document).on( 'click', '.editMyComplaintbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#editMyComplaintModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/complaint/edit/" + id,
    success: function(response){
      console.log(response);
      $('#edit_mycomplaint_complainantName').val(response.complaint.complainantName);
      $('#edit_mycomplaint_cAddressno').val(response.complaint.cAddressno);
      $('#edit_mycomplaint_cStreet').val(response.complaint.cStreet);
      $('#edit_mycomplaint_cAddresszone').val(response.complaint.cAddresszone);
      $('#edit_mycomplaint_respondentName').val(response.complaint.respondentName);
      $('#edit_mycomplaint_respondentAge').val(response.complaint.respondentAge);
      $('#edit_mycomplaint_rAddressno').val(response.complaint.rAddressno);
      $('#edit_mycomplaint_rStreet').val(response.complaint.rStreet);
      $('#edit_mycomplaint_rAddresszone').val(response.complaint.rAddresszone);
      $('#edit_mycomplaint_complaintDesc').val(response.complaint.complaintDesc);
      $('#edit_mycomplaint_locationAddressno').val(response.complaint.locationAddressno);
      $('#edit_mycomplaint_locationStree').val(response.complaint.locationStreet);
      $('#edit_mycomplaint_complaintDate').val(response.complaint.complaintDate);
      $('#edit_mycomplaint_complaintWhy').val(response.complaint.complaintWhy);
      $('#edit_mycomplaint_complainantPrayer').val(response.complaint.complainantPrayer);
      $('#edit_mycomplaint_id').val(response.complaint.id);
    }
  });
});// end #document #editcomplaintbtn
$(document).ready(function() {
  var validationUpdateComplaint = $('#myClearanceEditForm').validate({
    rules:{
      respondentName: { required:true, minlength: 1 },
      respondentAge: { required:true },
      complaintDesc: { required:true },
      complaintLocation: { required:true },
      complaintWhy: { required:true },
      complainantPrayer: { required:true },
      complaintDate: { required:true },
      complainantSignature_img: { required:true }
    },
    errorPlacement: function( error, element ){
        var n = element.attr("name");
        if (n == "respondentName")
        element.attr("placeholder", "Please enter their name");
        else if (n == "respondentAge")
        element.attr("placeholder", "Please enter their age");
        else if (n == "complaintDesc")
        element.attr("placeholder", "Please describe the incident.");
        else if (n == "complaintLocation")
        element.attr("placeholder", "Please enter the incident's location.");
        else if (n == "complaintWhy")
        element.attr("placeholder", "Please state your reason in filling this report.");
        else if (n == "complainantPrayer")
        element.attr("placeholder", "Please state what you want us to do with the incident.");
        else if (n == "complaintDate")
        element.attr("placeholder", "Please enter the date of the incident");
        else if (element.is(':checkbox')){
            error.insertAfter($('input:checkbox:last').next('label'))
        }
    },
    messages: {
        complainantAgrees: { required:"This is to testify that the inputted data are true."}
    },
    unhighlight: function(element){
        $(element).removeClass('errorClass');
    },
  });//  end ng myClearanceEditForm.validate()
   validationUpdateComplaint.form();
   $('#editMyComplaintForm').submit(function(e){
    e.preventDefault();
     if(!validationUpdateComplaint.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_mycomplaint_id').val();
      console.log(id);
      $("#complaintUpdate").text("Updating...");
      $.ajax({
        url: "/api/complaint/"+id,
        type: "POST",
        data: formData, 
        cache: false,
        processData: false, 
        contentType: false, 
        dataType: "json",
        success: function(response) {
          console.log(response);
          if(response.status == 200){
            $("#complaintUpdate").text('Update');
            $("#editMyComplaintForm")[0].reset();
            $("#editMyClearanceModal").modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Updated',
              text: 'Updated Successfully! Please wait for the schedule of your first hearing.',
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
   });//  end ng complaintUpdate.submit
});// end document.ready editMyComplaintForm
$(document).on( 'click', '.showMyComplaintbtn', function (e) {
  e.preventDefault();
  var id = $(this).val();
  console.log(id);
  $('#showMyComplaintModal').modal('show');
  $.ajax({
    type: "GET",
    url: "api/complaint/show/" + id,
    success: function(response){
      console.log(response);
      $('#show_mycomplaint_complainantName').val(response.complaint.complainantName);
      $('#show_mycomplaint_status').val(response.complaint.status);
      $('#show_mycomplaint_cAddressno').val(response.complaint.cAddressno);
      $('#show_mycomplaint_cStreet').val(response.complaint.cStreet);
      $('#show_mycomplaint_cAddresszone').val(response.complaint.cAddresszone);
      $('#show_mycomplaint_respondentName').val(response.complaint.respondentName);
      $('#show_mycomplaint_respondentAge').val(response.complaint.respondentAge);
      $('#show_mycomplaint_rAddressno').val(response.complaint.rAddressno);
      $('#show_mycomplaint_rStreet').val(response.complaint.rStreet);
      $('#show_mycomplaint_rAddresszone').val(response.complaint.rAddresszone);
      $('#show_mycomplaint_complaintDesc').val(response.complaint.complaintDesc);
      $('#show_mycomplaint_locationAddressno').val(response.complaint.locationAddressno);
      $('#show_mycomplaint_locationStree').val(response.complaint.locationStreet);
      $('#show_mycomplaint_complaintDate').val(response.complaint.complaintDate);
      $('#show_mycomplaint_complaintWhy').val(response.complaint.complaintWhy);
      $('#show_mycomplaint_complainantPrayer').val(response.complaint.complainantPrayer);
      $('#show_mycomplaint_id').val(response.complaint.id);
    }
  });
});// end #document #showcomplaintbtn

//admin

  $(document).ready(function() {
    $('#reportsComplaintTable').DataTable({
      order: [[ 0, 'desc' ]],
      ajax: {
        url :"/api/report-complaint/all",
        dataSrc: "",
        method: "get",
      },
      select: true,
      dom: 'Bfrtip',
      lengthChange: false,
      buttons: [
        'excel', 'pdf','print',
      ],
      columns: [
        { "data": "count" },
        { "data": "complaint" },
        { "data": "street" },
      ],
    });//	end reportsComplaintTable
  });
  