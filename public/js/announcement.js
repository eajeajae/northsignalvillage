$(document).ready(function() {
  
    var validationAnnouncement = $('#announcementForm').validate({
      rules: {
        article_img: { required:true },
        heading: { required:true },
        caption: { required:true },
      },
      messages: {
        article_img: { required:"Please select image" },
        heading: { required:"Please input a heading for this announcement" },
        caption: { required:"Please input the caption of this announcement"  },
      },
      errorPlacement: function(error, element){
          error.insertAfter(element)
      }
    });//  end ng login-form.validate()
   $('#announcementForm').submit(function(e){
    e.preventDefault();
    var $form = $(this);
     if(!validationAnnouncement.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      $("#announcementSubmit").text("Adding...");
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
                text: 'New Announcement has been added!',
            });
            $('#announcementTable').DataTable().ajax.reload();
          }
          $("#announcementSubmit").text("Add");
          $('#announcementForm')[0].reset();
          $("#allAnnouncementModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng announcementSubmit.submit
  });// end document.ready donation
$(document).ready(function() {
  $('#announcementTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/announcement/all",
			dataSrc: "",
      method: "get",
		},
		select: true,
		dom: 'Bfrtip',
    lengthChange: false,
		buttons: [
      'colvis', 'excel', 'pdf','print',
      {
        text: '+',
        className: 'btn btn-success',
        action: function ( e, dt, node, config ) {
        // alert( 'Button activated' )
          $("#announcementForm").trigger("reset");
          $('#announcementModal').modal('show');
        }
      } 
    ],
		columns: [
      { "data": "id" },
      { "data": "heading" },
      { "data": "caption" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editAnnouncement btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' value="+data.id+" class='editAnnouncement btn btn-success btn-sm' id='button-edit-request'><i class='fas fa-eye'></i></button><button type='button' data-id="+data.id+" class='deleteAnnouncement btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end animalTable
});