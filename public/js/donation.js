$(document).ready(function() {
    var validationDonation = $('#donationForm').validate({
      rules: {
        gcashName: { required:true, minlength: 1 },
        gcashPhoneNum: { required:true, maxlength: 12 },
        receipt_img: { required:true},
      },
      messages: {
        gcashName: { required:"Please input your gcash name", minlength:"It should consist of 2 or more characters" },
        gcashPhoneNum: { required:"Please input your surname", maxlength: "Contact number should consist of 11 digits only." },
        receipt_img: { required:"Please upload the receipt" },
      },
      errorPlacement: function(error, element){
          error.insertAfter(element)
      }
    });//  end ng login-form.validate()
   $('#donationForm').submit(function(e){
    e.preventDefault();
    var $form = $(this);
     if(!validationDonation.form()){
    //    alert('Incomplete data. Please check your input');
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please check your form.',
        })
     } 
     else{
      var formData = new FormData(this);
      $("#donationSubmit").text("Submitting...");
      // console.log(formData);
      url = $form.attr('action');
      $.ajax({
        url: 'api/donation/create',
        type: "post",
        headers: {'X-CSRF-Token': '{{ csrf_token() }}',},
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
                text: 'Thank you! Please wait for the notification after you pay for your request.',
            });
            console.log(res);
          }
          $("#donationSubmit").text("Submit");
          $('#donationForm')[0].reset();
        }
      });
     }//  end ng else
   });//  end ng donationSubmit.submit
});// end document.ready donation
//cash-donation
$(document).ready(function() {
  $('#cashdonationTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/cash-donation/all",
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
      { "data": "id" },
      { "data": "donorName" },
      { "data": "amountDonated" },
      { "data": null,
          render: function ( data, type, row ) {
            return row.gcashName + ' ' + row.gcashPhoneNum;
      }},
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='showCashdonationbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-eye'></i></button><button type='button' data-id="+data.id+" class='deleteCashdonationbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end cashdonationTable
  $(document).on( 'click', '.showCashdonationbtn', function (e) {
    e.preventDefault();
    var id = $(this).val();
    console.log(id);
    $('#showCashdonationModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/cash-donation/show/" + id,
      success: function(response){
        console.log(response);
        $('#edit_cashdonation_gcashName').val(response.cashdonation.gcashName);
        $('#edit_cashdonation_gcashPhoneNum').val(response.cashdonation.gcashPhoneNum);
        $('#edit_cashdonation_donorName').val(response.cashdonation.donorName);
        $('#edit_cashdonation_amountDonated').val(response.cashdonation.amountDonated);
        $('#edit_cashdonation_receipt_img').html('<img src="storage/donations/'+response.cashdonation.receipt_img+'" height="auto" width="400" style="display:block;id="edit_cashdonation_receipt_img"></img>');
        $('#edit_cashdonation_id').val(response.cashdonation.id);
      }
    });
  });// end #document #otherdonationsbtn
  $(document).on( 'click', '.deleteCashdonationbtn', function (e) {
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
          url: "/api/cash-donation/"+ id,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: "json",
          success: function(data) {
            console.log(data);
            Swal.fire(
              'Deleted!',
              'Donation has been deleted.',
              'success'
            ) 
            $('#cashdonationTable').DataTable().ajax.reload();
          },
          error: function(error) {
            console.log('error');
          }
        });
        
      }
    })
  });//  end #scholarshipTable delete
});
//other-donation
$(document).ready(function() {
  $('#otherdonationTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/other-donation/all",
			dataSrc: "",
      method: "get",
		},
		select: true,
		dom: 'Bfrtip',
    lengthChange: false,
		buttons: [
      'excel', 'pdf','print',
      {
        text: '+',
        className: 'btn btn-success',
        action: function ( e, dt, node, config ) {
          $("#otherdonationForm").trigger("reset");
          $('#otherdonationModal').modal('show');
        }
      } 
    ],
		columns: [
      { "data": "id" },
      { "data": "category" },
      { "data": "items" },
      { "data": "quantity" },
      { "data" : null, render : function ( data, type, row ) {
        return "<button type='button' value="+data.id+" class='editOtherdonationbtn btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteOtherdonationbtn btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
      } }
    ],
  });//	end otherdonationTable
  $(document).on( 'click', '.editOtherdonationbtn', function (e) {
    e.preventDefault();
    var id = $(this).val();
    console.log(id);
    $('#editOtherdonationModal').modal('show');
    $.ajax({
      type: "GET",
      url: "/api/other-donation/edit/" + id,
      success: function(response){
        console.log(response);
        $('#edit_otherdonation_category').val(response.otherdonation.category);
        $('#edit_otherdonation_items').val(response.otherdonation.items);
        $('#edit_otherdonation_quantity').val(response.otherdonation.quantity);
        $('#edit_otherdonation_id').val(response.otherdonation.id);
      }
    });
  });// end #document #otherdonationsbtn
  $(document).on( 'click', '.deleteOtherdonationbtn', function (e) {
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
          url: "/api/other-donation/"+ id,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: "json",
          success: function(data) {
            console.log(data);
            Swal.fire(
              'Deleted!',
              'Donation has been deleted.',
              'success'
            ) 
            $('#otherdonationTable').DataTable().ajax.reload();
          },
          error: function(error) {
            console.log('error');
          }
        });
        
      }
    })
  });//  end #scholarshipTable delete
});
$(document).ready(function() {
  
  var validationOtherdonations = $('#otherdonationForm').validate({
    rules: {
      category: { required:true },
      items: { required:true },
      quantity: { required:true },
    },
    messages: {
      category: { required:"Please select the category" },
      items: { required:"Please select the item" },
      quantity: { required:"Please input the quantity of the item"  },
    },
    errorPlacement: function(error, element){
        error.insertAfter(element)
    }
  });//  end ng login-form.validate()
 $('#otherdonationForm').submit(function(e){
  e.preventDefault();
  var $form = $(this);
   if(!validationOtherdonations.form()){
     alert('Incomplete data. Please check your input');
   } 
   else{
    var formData = new FormData(this);
    $("#otherdonationSubmit").text("Adding...");
    // console.log(formData);
    url = $form.attr('action');
    $.ajax({
      type: 'POST',
      url: 'api/other-donation/store',
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
              text: 'Other donations has been added!',
          });
          $('#otherdonationTable').DataTable().ajax.reload();
        }
        $("#otherdonationSubmit").text("Add");
        $('#otherdonationForm')[0].reset();
        $("#otherdonationModal").modal('hide');
      }
    });
   }//  end ng else
 });//  end ng otherdonationSubmit.submit
});// end document.ready donation
$(document).ready(function() {
  $('#editOtherdonationForm').get(0).reset();
    var validationAnimal = $('#editOtherdonationForm').validate({
      rules: {
        category: { required:true },
        items: { required:true },
        quantity: { required:true },
      },
      messages: {
        category: { required:"Please select the category" },
        items: { required:"Please select the item" },
        quantity: { required:"Please input the quantity of the item"  },
      },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng editOtherdonationForm.validate()
   validationAnimal.form();
   $('#editOtherdonationForm').submit(function(e){
    e.preventDefault();
     if(!validationAnimal.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_otherdonation_id').val();
      console.log(id);
      $("#otherdonationUpdate").text("Updating...");
      $.ajax({
        url: "/api/other-donation/"+id,
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
              'Donation is Updated Successfully',
              'success'
              )
            $('#otherdonationTable').DataTable().ajax.reload();
          }
          $("#otherdonationUpdate").text('Update');
          $("#editOtherdonationForm")[0].reset();
          $("#editOtherdonationModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng otherdonationUpdate.submit
});// end document.ready editOtherdonationForm
//reports other-donations
$(document).ready(function() {
  $('#reportsOtherdonationTable').DataTable({
    order: [[ 0, 'desc' ]],
    ajax: {
      url :"/api/report-other-donation/all",
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
      { "data": "sum" },
      { "data": "item" },
    ],
  });//	end reportsBarangayidTable
});