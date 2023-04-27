$(document).ready(function() {
  $('#schedulevaccineForm')[0].reset();
  var validationSchedulevaccine = $('#schedulevaccineForm').validate({
    rules: {
      vaccine: { required:true},
      date: { required:true },
      time: { required:true },
    },
    messages: {
      vaccine: { required:"Please choose vaccine" },
      date: { required:"Please choose date of your prefer vaccination" },
      time: { required:"Please choose your prefer time for vaccination" },
    },
    errorPlacement: function(error, element){
      error.insertAfter(element)
    }
  });//  end ng login-form.validate()
       $('#schedulevaccineForm').submit(function(e){
        e.preventDefault();
        var $form = $(this);
         if(!validationSchedulevaccine.form()){
        //    alert('Incomplete data. Please check your input');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please check your application form.',
            })
         } 
         else{
          var formData = new FormData(this);
          $("#schedulevaccineSubmit").text("Submitting...");
          url = $form.attr('action');
          // console.log(formData);
          $.ajax({
            url: 'api/schedule-vaccination/store',
            type: "post",
            headers: {'X-CSRF-Token': '{{ csrf_token() }}',},
            data: formData, 
            cache: false,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function(res) {
              if(res.success == true){
                console.log(res);
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Thank you! Please wait for the notification for further instructions.',
                });
              }
              $("#schedulevaccineSubmit").text("Submit");
              $('#schedulevaccineForm')[0].reset();
            }
          });
         }//  end ng else
       });//  end ng barangayidSubmit.submit
});// end document.ready barangayid

//admin

//reports
$(document).ready(function() {
  $('#reportsScheduleVaccinationTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/report-schedule-vaccination/all",
      dataSrc: "",
      method: "get",
    },
    select: true,
    dom: 'Bfrtip',
    lengthChange: false,
    buttons: [
      'colvis', 'excel', 'pdf','print', 
    ],
    
    columns: [
      { "data": "count" },
      { "data": "street" },
    ],
  });//	end barangayidTable
  
});
