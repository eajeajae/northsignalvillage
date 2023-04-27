$(document).ready(function() {
   $('#adminTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/admins/all",
      dataSrc: "",
      method: "get",
    },
    scrollX: true,
    select: true,
    dom: 'Bfrtip',
    buttons: [
      'colvis', 'excel', 'pdf','print',
      {
        text: '+',
        className: 'btn btn-success',
        action: function ( e, dt, node, config ) {
        // alert( 'Button activated' )
          $("#addAdminForm").trigger("reset");
          $('#addAdminModal').modal('show');
        }
      } 
    ],
    columns: [
      { "data": "id" },
      { "data": "name" },
      { "data": null,
          render: function ( data, type, row ) {
            return row.addressNo + ' ' + row.street + '' + row.addressZone;
      }
      },
      { "data": "gender" },
      { "data": "age" },
      { "data": "email" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editAdminbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteAdminbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end adminTable
  $(document).on( 'click', '.editAdminbtn', function (e) {
    e.preventDefault();
    var id = $(this).val();
    console.log(id);
    $('#editAdminModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/admins/edit/" + id,
      success: function(response){
        console.log(response);
        $('#edit_admin_avatar').html('<img class="rounded-circle d-block avatar" src="'+response.admin.avatar+'" alt="Image" height="100px" width="100px"/>')
        $('#edit_admin_status').val(response.admin.status);
        $('#edit_admin_role').val(response.admin.role);
        $('#edit_admin_name').val(response.admin.name);
        $('#edit_admin_age').val(response.admin.age);
        $('#edit_admin_gender').val(response.admin.gender);
        $('#edit_admin_birthday').val(response.admin.birthdate);
        $('#edit_admin_phone_num').val(response.admin.phoneNum);
        $('#edit_admin_email').val(response.admin.email);
        $('#edit_admin_addressNo').val(response.admin.addressNo);
        $('#edit_admin_street').val(response.admin.street);
        $('#edit_admin_addressZone').val(response.admin.addressZone);
        $('#edit_admin_id').val(response.admin.id);
      }
    });
  });// end #document #editadminsbtn
  $(document).on( 'click', '.deleteAdminbtn', function (e) {
    var id = $(this).data('id');
    console.log(id);
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        console.log(result);
        $.ajax({
          type: "DELETE",
          url: "/api/admin/"+ id,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: "json",
          success: function(data, myrequest) {
            console.log(data);
            console.log(myrequest);
            Swal.fire(
              'Deleted!',
              'Admin has been deleted.',
              'success'
            ) 
            $('#adminTable').DataTable().ajax.reload();
          },
          error: function(error) {
            console.log('error');
          }
        });
        
      }
    })
  });//  end #adminTable delete
});
//add-admin 
$(document).ready(function() {
  var validationAdmin = $('#addAdminForm').validate({
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
 $('#addAdminForm').submit(function(e){
  e.preventDefault();
   if(!validationAdmin.form()){
     alert('Incomplete data. Please check your input');
   } 
   else{
    var formData = new FormData(this);
    $("#addAdminbtn").text("Adding...");
    $.ajax({
      type: 'POST',
      url: 'api/add-admin',
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
              text: 'Admin/employee has been added!',
          });
          $('#adminTable').DataTable().ajax.reload();
        }
        $("#addAdminbtn").text("Add");
        $('#addAdminForm')[0].reset();
        $("#addAdminModal").modal('hide');
      }
    });
   }//  end ng else
 });//  end ng addAdminForm.submit   
});
$(document).ready(function() {
  $('#updateAdminForm').get(0).reset();
  $('#updateAdminForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id = $('#edit_admin_id').val();
    console.log(id);
    $("#adminUpdateSubmit").text("Updating...");
    $.ajax({
      url: "/api/admin/"+id,
      type: "POST",
      data: formData, 
      cache: false,
      processData: false, 
      contentType: false, 
      dataType: "json",
      success: function(response) {
        console.log(response);
        if(response.status == 200){
          Swal.fire(
            'Updated!',
            'Admin Updated Successfully',
            'success'
            )
          $('#adminTable').DataTable().ajax.reload();
        }
        $("#adminUpdateSubmit").text('Update');
        $("#updateAdminForm")[0].reset();
        $("#editAdminModal").modal('hide');
      }
    });
   });//  end ng adminUpdateSubmit.submit
});// end document.ready updateAdminForm

