$(document).ready(function() {
	$('#vaccineForm')[0].reset();
    var validationVaccine = $('#vaccineForm').validate({
      rules: {
				name: { required:true },
				category: { required:true },
				stocks: { required:true },
			},
			messages: {
				name: { required:"Please input your first name" },
				category: { required:"Please upload your current COR." },
				stocks: { required:"Please upload your past term grade." },
			},
			errorPlacement: function(error, element){
				error.insertAfter(element)
			}
		});//  end ng login-form.validate()
    $('#vaccineForm').submit(function(e){
      e.preventDefault();
      var $form = $(this);
      if(!validationVaccine.form()){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Please check your application form.',
        })
     	} 
      else{
    		var formData = new FormData(this);
    		$("#vaccineSubmit").text("Adding...");
    		url = $form.attr('action');
    		// console.log(formData);
    		$.ajax({
        	url: url,
        	type: "post",
        	headers: {'X-CSRF-Token': '{{ csrf_token() }}',},
        	data: formData, 
        	cache: false,
        	processData: false, 
        	contentType: false, 
        	dataType: 'json',
        	success: function(res) {
            if(res.status == 200){
                console.log(res);
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Vaccine Added Successfully',
                });
              }
              $('#vaccineForm')[0].reset();
              $("#vaccineSubmit").text("Add");
							$("#vaccineModal").modal('hide');
            }
					});
				}
    });//  end ng barangayidSubmit.submit
});// end document.ready barangayid
$(document).ready(function() {    
    var i = 0;
    $('#vaccineListAdd').click(function() {
    ++i; 
    $('#list-vaccine').append(
      `<div id="another-list">
					<div class="d-grid gap-2 justify-content-md-end mx-auto">
						<button id="vaccineListRemove" class="btn btn-danger">-</button>
					</div>
					<div class="col-sm-12">
						<div class="form-group"> 
							<label for="name" class="control-label" style="font-weight: bolder;">Name of vaccine: </label>
							<input type="text" class="form-control" id="name" name="name>
						</div>
						<div class="form-group"> 
							<label for="category" class="control-label" style="font-weight: bolder;">Category: </label>
							<select id="category" class="form-select" name="category">
								<option selected>Choose category of vaccine</option>
								<option value="Infants (Children immunization)">Infants (Children immunization)</option>
								<option value="Kids">Kids</option>
								<option value="Adults">Adults</option>
								<option value="Senior Citizens">Senior Citizens</option>
							</select>
						</div>
						<div class="form-group"> 
							<label for="stock" class="control-label" style="font-weight: bolder;">Stock: </label>
							<input type="text" class="form-control" id="stock" name="stocks">
						</div>
					</div>
				</div>`
    );
  });

  $(document).on('click', '#vaccineListRemove', function() {
    // alert('hello');
    $(this).parents('#another-list').remove();
  });
});// end document.ready barangayid

$(document).ready(function() {
    $('#vaccineTable').DataTable({
      order: [[ 0, 'desc' ]],
      ajax: {
        url :"/api/vaccines/all",
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
            $("#vaccineForm").trigger("reset");
            $('#vaccineModal').modal('show');
          }
        } 
      ],
      
      columns: [
        { "data": "id" },
        { "data": "name" },
        { "data": "category" },
        { "data": "stocks" },
        { "data" : null, render : function ( data, type, row ) {
          return "<button type='button' value="+data.id+" class='editVaccine btn btn-primary btn-sm' id='button-edit-request'><i class='fas fa-edit'></i></button><button type='button' data-id="+data.id+" class='deleteVaccine btn btn-danger btn-sm' id='button-delete-request'><i class='fas fa-trash-alt'></i></button>"
        } }
      ],
    });//	end vaccineTable
    $(document).on( 'click', '.editVaccine', function (e) {
			e.preventDefault();
			var id = $(this).val();
			console.log(id);
			$('#vaccineEditModal').modal('show');
			$.ajax({
				type: "GET",
				url: "/api/vaccines/edit/" + id,
				success: function(response){
					console.log(response);
					$('#edit_vaccine_name').val(response.vaccine.name);
					$('#edit_vaccine_category').val(response.vaccine.category);
					$('#edit_vaccine_stocks').val(response.vaccine.stocks);
					$('#edit_vaccine_id').val(response.vaccine.id);
				}
			});
		});// end #document #editvaccinesbtn
		$(document).on( 'click', '.deleteVaccine', function (e) {
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
						url: "/api/vaccines/"+ id,
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						dataType: "json",
						success: function(data, myrequest) {
							console.log(data);
							console.log(myrequest);
							Swal.fire(
								'Deleted!',
								'Vaccine has been deleted.',
								'success'
							) 
							$('#vaccineTable').DataTable().ajax.reload();
						},
						error: function(error) {
							console.log('error');
						}
					});
					
				}
			})
		});//  end #vaccineTable delete
});
$(document).ready(function() {
  $('#updateVaccineForm').get(0).reset();
    var validationVaccineUpdate = $('#updateVaccineForm').validate({
      rules: {
        name: { required:true, minlength:2 },
        category: { required:true },
        stocks: {required:true},
      },
      messages: {
        name: { required:"Please input the vaccine name", minlength:"Name should be 2 or more characters" },
        category: { required:"Please choose category for the vaccine" },
        stocks: {required:"Please input number of stocks"},
      },
      errorPlacement: function(error, element){
        error.insertAfter(element)
      }
    });//  end ng updateVaccineForm.validate()
   validationVaccineUpdate.form();
   $('#updateVaccineForm').submit(function(e){
    e.preventDefault();
     if(!validationVaccineUpdate.form()){
       alert('Incomplete data. Please check your input');
     } 
     else{
      var formData = new FormData(this);
      var id = $('#edit_vaccine_id').val();
      console.log(id);
      $("#vaccineUpdate").text("Updating...");
      $.ajax({
        url: "/api/vaccines/"+id,
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
              'Vaccine Updated Successfully',
              'success'
              )
            $('#vaccineTable').DataTable().ajax.reload();
          }
          $("#vaccineUpdate").text('Update');
          $("#updateVaccineForm")[0].reset();
          $("#vaccineEditModal").modal('hide');
        }
      });
     }//  end ng else
   });//  end ng adminUpdateSubmit.submit
});// end document.ready animalUpdateForm